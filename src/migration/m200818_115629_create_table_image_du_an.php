<?php

use yii\db\Migration;

/**
 * Class m200818_115629_create_table_image_du_an
 */
class m200818_115629_create_table_image_du_an extends Migration
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

        $this->createTable('{{%project_image}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(11)->notNull(),
            'image_url' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'created_by' => $this->integer(11)->null(),
            'updated_by' => $this->integer(11)->null(),
        ], $tableOptions);

        $this->addForeignKey('fk-project_image-created_by-user-id', 'project_image', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-project_image-update_by-user-id', 'project_image', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk-project_image-project_id-project_image-id', 'project_image', 'project_id', 'project', 'id', 'RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_image}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200818_115629_create_table_image_du_an cannot be reverted.\n";

        return false;
    }
    */
}
