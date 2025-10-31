<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed only data content for specific tables from the SQL dump
        $this->call([
            TopicsSeeder::class,
            QuestionsSeeder::class,
            QuestionValuesSeeder::class,
            RespondentsSeeder::class,
            AnswersSeeder::class,
        ]);
    }
}
