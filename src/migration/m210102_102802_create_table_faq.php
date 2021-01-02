<?php

use yii\db\Migration;

/**
 * Class m210102_102802_create_table_faq
 */
class m210102_102802_create_table_faq extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pages_faq}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'content' => $this->json()->null(),
            'language' => $this->string(25)->null(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->createIndex('idx-slug-faq', 'pages_faq', 'slug');
        $this->addForeignKey('fk-faq-created_by-user_id', 'pages_faq', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-faq-updated_by-user_id', 'pages_faq', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');

        $this->insert('pages_faq', [
            'id' => 1,
            'title' => 'Faq',
            'slug' => 'faq',
            'content' => '',
            'language' => '',
            'status' => '1',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages_faq}}');
    }
}
