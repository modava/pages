<?php

use yii\db\Migration;

/**
 * Class m200818_112142_create_table_du_an
 */
class m200818_112142_create_table_du_an extends Migration
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

        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'image' => $this->string(255)->null(),
            'description' => $this->text()->null(),
            'content' => $this->text()->null(),
            'tech' => $this->json()->null(),
            'position' => $this->integer(11)->null(),
            'ads_pixel' => $this->text()->null(),
            'ads_session' => $this->text()->null(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'language' => $this->string(25)->null(),
            'views' => $this->bigInteger(20)->null(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->createIndex('index-slug', 'project', 'slug');
        $this->createIndex('index-language', 'project', 'language');
        $this->addForeignKey('fk-project-created_by-user-id', 'project', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-project-updated_by-user-id', 'project', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200818_112142_create_table_du_an cannot be reverted.\n";

        return false;
    }
    */
}
