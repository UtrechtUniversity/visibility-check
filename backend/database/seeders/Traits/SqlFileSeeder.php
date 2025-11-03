<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait SqlFileSeeder
{
    /**
     * Resolve configured SQL path from env or fall back to default.
     */
    protected function resolveSqlPath(): string
    {
        $path = env('VC_SEED_SQL_PATH', '../docker/mariadb/B_data.sql');
        // Allow relative paths (from backend folder base_path())
        $candidate = realpath(base_path($path)) ?: base_path($path);
        return $candidate;
    }

    /**
     * Should we truncate before seeding (idempotent)?
     */
    protected function shouldTruncate(): bool
    {
        $raw = env('VC_SEED_TRUNCATE', false);
        if (is_bool($raw)) {
            return $raw;
        }
        return in_array(strtolower((string)$raw), ['1','true','yes','on'], true);
    }

    /**
     * Insert mode: 'ignore' (default) or 'normal'.
     */
    protected function insertMode(): string
    {
        $mode = strtolower((string) env('VC_SEED_INSERT_MODE', 'ignore'));
        return in_array($mode, ['ignore','normal'], true) ? $mode : 'ignore';
    }

    /**
     * Truncate a table with foreign key checks temporarily disabled.
     */
    protected function truncateTable(string $table): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($table)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Execute only INSERT statements for the given table from a large SQL dump.
     * - Ignores all non-INSERT statements
     * - Streams the file to keep memory usage low
     *
     * @param string $absoluteSqlPath Absolute filesystem path to the .sql file
     * @param string $tableName Exact table name to import (as in backticks in the SQL file)
     * @param string $insertMode 'normal' | 'ignore' — whether to rewrite INSERT into INSERT IGNORE for idempotency
     */
    protected function importTableInsertsFromSql(string $absoluteSqlPath, string $tableName, string $insertMode = 'normal'): void
    {
        if (!is_file($absoluteSqlPath)) {
            throw new \RuntimeException("SQL file not found: {$absoluteSqlPath}");
        }

        $handle = fopen($absoluteSqlPath, 'rb');
        if ($handle === false) {
            throw new \RuntimeException("Unable to open SQL file: {$absoluteSqlPath}");
        }

        $buffer = '';
        try {
            while (($line = fgets($handle)) !== false) {
                // Skip comments quickly
                $trim = ltrim($line);
                if ($trim === '' || str_starts_with($trim, '-- ') || str_starts_with($trim, '/*')) {
                    continue;
                }

                $buffer .= $line;

                // A statement ends at semicolon. Some dumps place statements on one line, others multi-line.
                if (str_ends_with(rtrim($line), ';')) {
                    $statement = trim($buffer);
                    $buffer = '';

                    // We only want INSERTs for this exact table (backticks as in the dump)
                    // Example: INSERT INTO `answers` (...) VALUES ...;
                    if (stripos($statement, 'INSERT INTO `'.$tableName.'`') === 0) {
                        if ($insertMode === 'ignore') {
                            // Rewrite the very first INSERT INTO to INSERT IGNORE INTO
                            $statement = preg_replace('/^INSERT\s+INTO\s+`'.preg_quote($tableName,'/').'`/i', 'INSERT IGNORE INTO `'.$tableName.'`', $statement, 1);
                        }
                        DB::unprepared($statement);
                    }
                }
            }

            // Safety: process any remaining buffer if it ends with semicolon (shouldn't happen)
            $statement = trim($buffer);
            if ($statement !== '' && str_ends_with($statement, ';')) {
                if (stripos($statement, 'INSERT INTO `'.$tableName.'`') === 0) {
                    if ($insertMode === 'ignore') {
                        $statement = preg_replace('/^INSERT\s+INTO\s+`'.preg_quote($tableName,'/').'`/i', 'INSERT IGNORE INTO `'.$tableName.'`', $statement, 1);
                    }
                    DB::unprepared($statement);
                }
            }
        } finally {
            fclose($handle);
        }
    }
}
