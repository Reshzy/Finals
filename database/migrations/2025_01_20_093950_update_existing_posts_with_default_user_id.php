<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateExistingPostsWithDefaultUserId extends Migration
{
    public function up()
    {
        // Ensure there is at least one user to assign as default
        $defaultUser = User::first();
        if (!$defaultUser) {
            $defaultUser = User::create([
                'name' => 'Default User',
                'email' => 'default@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Update existing posts with the default user ID
        DB::table('posts')->update(['user_id' => $defaultUser->id]);
    }

    public function down()
    {
        // Optionally, you can set user_id to null if you roll back
        DB::table('posts')->update(['user_id' => null]);
    }
} 
