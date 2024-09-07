<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\UserCount;
use App\Models\Relationship;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestingAndCreatingDataController extends Controller
{
    protected static ?string $password;
    public function createData()
    {
        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'identification_card' => fake()->unique()->numerify('#########'),
                'username' => fake()->unique()->userName() . ' ' . bin2hex(random_bytes(2)),
                /* 'username' => fake()->unique()->regexify('[a-zA-Z0-9]{8,12}'), */
                'email' => bin2hex(random_bytes(2)) . fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                /* 'password' => static::$password ??= Hash::make('password'), */
                'password' => static::$password ??= Hash::make('123'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ]);

            $parentId = User::where('id', '<', $user->id)->inRandomOrder()->first();
            $position = $this->getBinaryPosition($parentId);
            $binaryParentId = $this->getBinarySponsor($parentId->id, $position);

            $relationship = $this->saveRelationshipData($user->id, $parentId->id, $binaryParentId, $position);
            $this->updateUserCounts($relationship, $parentId->id);
            $this->createOrder($user);
        }
    }

    private function getBinaryPosition($parentId)
    {
        $userCount = $parentId->userCount;
        $left = $userCount ? $userCount->total_binary_left : 0;
        $right = $userCount ? $userCount->total_binary_right : 0;
        return $left < $right ? 'left' : 'right';
    }

    private function getBinarySponsor($parentId, $position)
    {
        while (true) {
            $relationship = Relationship::where('binary_parent_id', $parentId)
                ->where('position', $position)
                ->first();

            if (!$relationship) {
                return $parentId;
            }

            $parentId = $relationship->user_id;
            $this->incrementBinaryCount($parentId, $position);
        }
    }

    private function saveRelationshipData($userId, $parentId, $binaryParentId, $position)
    {
        return Relationship::create([
            'user_id' => $userId,
            'parent_id' => $parentId,
            'binary_parent_id' => $binaryParentId,
            'position' => $position,
        ]);
    }

    private function updateUserCounts($relationship, $parentId)
    {
        $this->addUnilevelUsers($relationship->parent_id);
        $this->addAscendingUnilevelUsers($relationship->parent_id);
        $this->addAscendingBinaryUsers($parentId, $relationship->position);
    }

    private function addUnilevelUsers($userId)
    {
        UserCount::updateOrCreate(
            ['user_id' => $userId],
            [
                'total_direct' => DB::raw('total_direct + 1'),
                'total_unilevel' => DB::raw('total_unilevel + 1')
            ]
        );
    }

    private function addAscendingUnilevelUsers($userId)
    {
        while ($userId > 1) {
            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship) break;

            $userId = $relationship->parent_id;
            UserCount::where('user_id', $userId)->increment('total_unilevel');
        }
    }

    private function addAscendingBinaryUsers($userId, $position)
    {
        while (true) {
            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship) break;

            $this->incrementBinaryCount($userId, $position);

            $userId = $relationship->binary_parent_id;
            $position = $relationship->position;
        }
    }

    private function incrementBinaryCount($userId, $position)
    {
        UserCount::updateOrCreate(
            ['user_id' => $userId],
            [
                "total_binary_$position" => DB::raw("total_binary_$position + 1")
            ]
        );
    }

    private function createOrder($user)
    {
        $order = Order::create([
            'public_order_number' => strtoupper(dechex(time()) . bin2hex(random_bytes(4))),
            'user_id' => $user->id,
            'contact' => 'fredy',
            'phone' => '627728',
            'status' => 'approved',
            'envio_type' => 1,
            'discount' => 0,
            'shipping_cost' => 0,
            'total' => 100000,
            'total_pts' => 10,
        ]);

        $this->updateUserPoints($order->user_id, $order->total_pts);
        $this->updateBinarySponsorPoints($order->user_id, $order->total_pts);
    }

    private function updateUserPoints($userId, $points)
    {
        UserPoint::updateOrCreate(
            ['user_id' => $userId, 'status' => 1],
            ['personal_pts' => DB::raw("personal_pts + $points")]
        );
    }

    private function updateBinarySponsorPoints($userId, $points)
    {
        while (true) {
            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship || !$relationship->binary_parent_id) return;

            $userId = $relationship->binary_parent_id;
            $pointField = $relationship->position === 'left' ? 'left_pts' : 'right_pts';

            UserPoint::updateOrCreate(
                ['user_id' => $userId],
                [$pointField => DB::raw("$pointField + $points")]
            );
        }
    }
}
