<?php

namespace modava\pages\models\query;

use modava\pages\models\Document;

/**
 * This is the ActiveQuery class for [[Document]].
 *
 * @see Document
 */
class DocumentQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([Document::tableName() . '.status' => Document::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([Document::tableName() . '.status' => Document::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([Document::tableName() . '.id' => SORT_DESC]);
    }

    public function findByLanguage()
    {
        return $this->andWhere([Document::tableName() . '.language' => \Yii::$app->language]);
    }
}
