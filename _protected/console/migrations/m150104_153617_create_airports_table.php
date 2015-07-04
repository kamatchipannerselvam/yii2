<?php
use yii\db\Schema;
use yii\db\Migration;

class m150104_153617_create_article_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%airports}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'airport_name' => Schema::TYPE_STRING . ' NOT NULL',
            'airport_code' => Schema::TYPE_STRING . ' NOT NULL',
            'country' => Schema::TYPE_STRING . ' NOT NULL',
            'city' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'FOREIGN KEY (user_id) REFERENCES {{%user}}(id)
                ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%article}}');
    }
}
