<?php

use yii\db\Migration;

/**
 * Class m180707_033624_init
 */
class m180707_033624_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('track', [
            'id' => $this->primaryKey(),
            'station' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createTable('track_blacklist', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('track');
        $this->dropTable('track_blacklist');
    }
}
