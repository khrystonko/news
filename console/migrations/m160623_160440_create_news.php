<?php

use yii\db\Migration;

/**
 * Handles the creation for table `news`.
 */
class m160623_160440_create_news extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull()->unique(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('news_index', 'news', ['created_by', 'updated_by']);
        $this->addForeignKey('fk_news_user_created_by', 'news', 'created_by', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_news_user_updated_by', 'news', 'updated_by', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_news_user_created_by', 'post');
        $this->dropForeignKey('fk_news_user_updated_by', 'post');
        $this->dropTable('news');
    }
}
