<?php

/*
 * This file is part of the songclip-plus
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests;

class DatabaseSeeder
{
    /**
     * @param string $table
     * @param array $rows
     * @return void
     */
    public static function run(string $table, array $rows): void
    {
        $columns = db()->getTableSchema($table)->getColumnNames();

        db()->createCommand()->batchInsert($table, array_splice($columns, 1), $rows)
            ->execute();
    }
}
