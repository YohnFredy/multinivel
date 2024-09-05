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
        for ($i = 0; $i < 1000; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'identification_card' => fake()->unique()->numerify('#########'),
                'username' => fake()->unique()->userName() . ' ' . bin2hex(random_bytes(2)),
                /* 'username' => fake()->unique()->regexify('[a-zA-Z0-9]{8,12}'), */
                'email' => bin2hex(random_bytes(2)).fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                /* 'password' => static::$password ??= Hash::make('password'), */
                'password' => static::$password ??= Hash::make('123'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ]);

            $parentId = $this->getSponsor($user);
            $position = $this->getBinaryPosition($parentId);
            $binaryParentId = $this->getBinarySponsor($parentId->id, $position);
            $relationship = $this->saveRelationshipData($user->id, $parentId->id, $binaryParentId, $position);
            $this->countUsers($relationship, $parentId->id);

            $this->createOrder($user);
        }
    }

    private function getSponsor($user)
    {
        return User::where('id', '<', $user->id)->inRandomOrder()->first();
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
        $upward = true;
        while ($upward) {
            $relationship = Relationship::where('binary_parent_id', $parentId)
                ->where('position', $position)
                ->first();

            if (!$relationship) {
                return $parentId;
                break;
            }

            $parentId = $relationship->user_id;
            $userCount = UserCount::firstOrCreate(
                ['user_id' => $parentId],
                [
                    'total_binary_left' => 0,
                    'total_binary_right' => 0
                ]
            );

            if ($position === 'left') {
                $userCount->increment('total_binary_left');
            } else {
                $userCount->increment('total_binary_right');
            }
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

    private function countUsers($relationship, $parentId)
    {
        $this->addUnilevelUsers($relationship->parent_id);
        $this->addAscendingUnilevelUsers($relationship->parent_id);
        $this->addAscendingBinaryUsers($parentId, $relationship->position);
    }

    private function addUnilevelUsers($userId)
    {
        $userCount = UserCount::firstOrCreate(
            ['user_id' => $userId],
            [
                'total_direct' => 0,
                'total_unilevel' => 0
            ]
        );

        $userCount->increment('total_direct');
        $userCount->increment('total_unilevel');
    }

    private function addAscendingUnilevelUsers($userId)
    {
        $ascending = true;
        while ($ascending) {
            if ($userId <= 1) {
                break;
            }

            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship) {
                break;
            }

            $userId = $relationship->parent_id;
            UserCount::where('user_id', $userId)->increment('total_unilevel');
        }
    }

    private function addAscendingBinaryUsers($userId, $position)
    {
        $ascending = true;
        while ($ascending) {
            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship) {
                break;
            }

            $userCount = UserCount::firstOrCreate(
                ['user_id' => $userId],
                [
                    'total_binary_left' => 0,
                    'total_binary_right' => 0
                ]
            );

            if ($position === 'left') {
                $userCount->increment('total_binary_left');
            } else {
                $userCount->increment('total_binary_right');
            }

            $userId = $relationship->binary_parent_id;
            $position = $relationship->position;
        }
    }

    public function createOrder($user)
    {
        $publicOrderNumber = strtoupper(dechex(time()) . bin2hex(random_bytes(4)));
        $orderData = [
            'public_order_number' => $publicOrderNumber,
            'user_id' => $user->id,
            'contact' => 'fredy',
            'phone' => '627728',
            'status' => 'approved',
            'envio_type' => 1,
            'discount' => 0,
            'shipping_cost' => 0,
            'total' => 100000,
            'total_pts' => 10,
        ];

        $order = Order::create($orderData);


        $this->updateUserPoints($order->user_id, $order->total_pts);
        $this->findBinarySponsor($order->user_id, $order->total_pts);
    }

    private function updateUserPoints($userId, $points, $pointType = 'personal_pts')
    {
        UserPoint::updateOrCreate(
            ['user_id' => $userId, 'status' => 1],
            [$pointType => DB::raw("$pointType + " . $points)]
        );
    }

    private function findBinarySponsor($parentId, $pts)
    {
        while (true) {
            $relationship = Relationship::where('user_id', $parentId)->first();
            // Si no se encuentra una relación o no hay padre binario, salir del bucle
            if (!$relationship || !$relationship->binary_parent_id) {
                return;
            }

            $parentId = $relationship->binary_parent_id;
            $this->updateUserPoints($parentId, $pts, 'binary_pts');
        }
    }
}
