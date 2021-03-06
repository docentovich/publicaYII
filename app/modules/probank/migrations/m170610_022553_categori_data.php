<?php

use yii\db\Schema;
use yii\db\Migration;

class m170610_022553_categori_data extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%categori_data}}',
            [
                'categori_id'=> $this->primaryKey(10),
                'categori_desc'=> $this->text()->notNull(),
                'categori_short_desc'=> $this->string(255)->notNull(),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%categori_data}}');
    }
}
