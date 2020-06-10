<?php

declare(strict_types=1);

use yii\db\Migration;

class m180707_033624_init extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('track', [
            'id' => $this->primaryKey(),
            'station' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createTable('track_blocklist', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        $this->dropTable('track');
        $this->dropTable('track_blocklist');
    }
}
