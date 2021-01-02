<?php

namespace modava\pages\models\query;

use modava\pages\models\PagesFaq;

/**
 * This is the ActiveQuery class for [[PagesFaq]].
 *
 * @see PagesFaq
 */
class PagesFaqQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([PagesFaq::tableName() . '.status' => PagesFaq::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([PagesFaq::tableName() . '.status' => PagesFaq::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([PagesFaq::tableName() . '.id' => SORT_DESC]);
    }
}
