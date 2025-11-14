<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // テストユーザーを作成
        User::factory()->create([
            'name' => 'shogo',
            'email' => 'shogo@example.com',
        ]);

        // 300人のダミーユーザーを作成
        User::factory(300)->create();
        $users = User::all()->shuffle();

        // 20人のダミー企業を作成
        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create(['user_id' => $users->pop()->id]);
        }
        $employers = Employer::all();

        // 100件のダミー求人を作成
        for ($i = 0; $i < 100; $i++) {
            Job::factory()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }

        foreach ($users as $user) {
            $jobs = Job::inRandomOrder()->take(rand(0, 4))->get();

            foreach ($jobs as $job) {
                JobApplication::factory()->create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                ]);
            }
        }
    }
}
