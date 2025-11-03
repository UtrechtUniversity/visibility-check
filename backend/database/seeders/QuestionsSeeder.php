<?php

namespace Database\Seeders;

use Database\Seeders\Traits\SqlFileSeeder;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    use SqlFileSeeder;

    public function run(): void
    {
        $sqlPath = $this->resolveSqlPath();

        if ($this->shouldTruncate()) {
            $this->truncateTable('questions');
        }

        $this->importTableInsertsFromSql($sqlPath, 'questions', $this->insertMode());
    }
}
