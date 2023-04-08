<?php

namespace Database\Seeders;

use App\Models\FormQuestionnaire;
use App\Models\FormSurvey;
use App\Models\User;
use Database\Factories\FormSurveyFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(30)
            ->has(FormSurvey::factory())
            ->create();
    }
}
