<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('page')) {
            DB::table('page')->insert(
                [
                    'title' => 'home text',
                    'content' => '<p>The Visibility Check provides you with insight into the extent of your academic outreach. Moreover, it gives advice on how to generate more attention for your academic work and professional career.</p>\n\n<p>Do you see room for improvement? Any tips? Please use the Feedback button.</p>',
                ]
            );
            DB::table('page')->insert(
                [
                    'title' => 'results text',
                    'content' => '<p>The check helps you to gain insight into the extent of your academic visibility. Practical tips and advice can be found on <a href=\"https://www.uu.nl/en/university-library/advice-support-for/researchers/visibility-check/visibility-to-do-list\" target=\"_blank\" rel=\"noopener noreferrer\">the to-do list</a>.</p>\n\n<p>It could be that you have a specific question you need answered. If so, feel free to request a consultation with our team. Leave your details below and let us know what you need.</p>'
                ]
            );
        }
    }
}
