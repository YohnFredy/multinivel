<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Relationship;
use App\Models\User;
use App\Models\UserCount;
use App\Models\UserPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Relationship::create([
            'user_id' => 1,
            'parent_id' => null,
            'binary_parent_id' => null,
            'position' => null,
        ]);

        $users = User::where('id', '>', 1)->get();

        foreach ($users as $user) {
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
