<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $userId = $user->id;

        $followers = $users->slice(1);
        $followerIds = $followers->pluck('id')->toArray();

        // 关注除1号用户的所有用户
        $user->follow($followerIds);

        // 除了1号用户以外的用户都关注1号用户
        foreach ($followers as $follower) {
            $follower->follow($userId);
        }
    }
}
