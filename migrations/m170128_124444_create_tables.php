<?php

use yii\db\Schema;
use yii\db\Migration;

class m170128_124444_create_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('access_log', [
            'id' => Schema::TYPE_PK,
            'ip' => Schema::TYPE_STRING,
            'url' => Schema::TYPE_STRING,
            'date' => Schema::TYPE_DATETIME,
            'headers' => Schema::TYPE_STRING,
            'status_code' => Schema::TYPE_SMALLINT,
            'size' => Schema::TYPE_INTEGER,
            'referrer' => Schema::TYPE_STRING,
            'user_agent' => Schema::TYPE_STRING,
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('access_log');
        return true;
    }
}
