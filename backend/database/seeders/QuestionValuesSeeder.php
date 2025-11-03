<?php

namespace Database\Seeders;

use Database\Seeders\Traits\SqlFileSeeder;
use Illuminate\Database\Seeder;

class QuestionValuesSeeder extends Seeder
{
    use SqlFileSeeder;

    public function run(): void
    {
        $sqlPath = $this->resolveSqlPath();

        if ($this->shouldTruncate()) {
            $this->truncateTable('question_values');
        }

        $this->importTableInsertsFromSql($sqlPath, 'question_values', $this->insertMode());
    }
}
