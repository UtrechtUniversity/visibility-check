<?php

namespace Database\Seeders;

use Database\Seeders\Traits\SqlFileSeeder;
use Illuminate\Database\Seeder;

class RespondentsSeeder extends Seeder
{
    use SqlFileSeeder;

    public function run(): void
    {
        $sqlPath = $this->resolveSqlPath();

        if ($this->shouldTruncate()) {
            $this->truncateTable('respondents');
        }

        $this->importTableInsertsFromSql($sqlPath, 'respondents', $this->insertMode());
    }
}
