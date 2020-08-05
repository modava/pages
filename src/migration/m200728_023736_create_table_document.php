<?php

use yii\db\Migration;

/**
 * Class m200728_023736_create_table_document
 */
class m200728_023736_create_table_document extends Migration
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

        $this->createTable('{{%pages_document}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'description' => $this->text()->null(),
            'image' => $this->string(255)->null(),
            'file' => $this->string(255)->null(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->addColumn('pages_document', 'language', "ENUM('', 'vi', 'en', 'jp') COLLATE utf8mb4_unicode_ci NULL COMMENT 'Language' AFTER `status`");
        $this->createIndex('idx-slug-document', 'pages_document', 'slug');
        $this->addForeignKey('fk_document_created_user', 'pages_document', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_document_updated_user', 'pages_document', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages_document}}');
    }
}
