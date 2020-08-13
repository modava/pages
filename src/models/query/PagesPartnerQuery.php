<?php

namespace modava\pages\models\query;

use modava\pages\models\PagesPartner;

/**
 * This is the ActiveQuery class for [[PagesPartner]].
 *
 * @see PagesPartner
 */
class PagesPartnerQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([PagesPartner::tableName() . '.status' => PagesPartner::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([PagesPartner::tableName() . '.status' => PagesPartner::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([PagesPartner::tableName() . '.id' => SORT_DESC]);
    }

    public function findByLanguage()
    {
        return $this->andWhere([PagesPartner::tableName() . '.language' => \Yii::$app->language]);
    }
}
