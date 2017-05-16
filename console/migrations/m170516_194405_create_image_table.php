<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `image`.
 */
class m170516_194405_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'filepath' => $this->string()->notNull(),
            'user_id'  => $this->integer()->notNull(),

        ]);
        // creates index for column `author_id`
        $this->createIndex(
            'idx-user_id',
            'image',
            'user_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    { // drops index for column `author_id`
        $this->dropIndex(
            'idx-user_id',
            'user'
        );




        $this->dropTable('image');
    }
}
