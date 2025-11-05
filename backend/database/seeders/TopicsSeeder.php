<?php

namespace Database\Seeders;

use Database\Seeders\Traits\SqlFileSeeder;
use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    use SqlFileSeeder;

    public function run(): void
    {
        $sqlPath = $this->resolveSqlPath();

        if ($this->shouldTruncate()) {
            $this->truncateTable('topics');
        }

        $this->importTableInsertsFromSql($sqlPath, 'topics', $this->insertMode());
    }
}
