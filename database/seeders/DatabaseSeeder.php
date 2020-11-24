<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'email' => 'PSexvzwzBN@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $project = Project::create([
            'title' => 'test'
        ]);

        ProjectUser::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'hours_of_work' => 5,
            'date' => '2020-12-24',
        ]);
    }
}
