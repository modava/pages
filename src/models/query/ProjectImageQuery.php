<?php

namespace modava\pages\models\query;

use modava\pages\models\ProjectImage;

/**
 * This is the ActiveQuery class for [[ProjectImage]].
 *
 * @see ProjectImage
 */
class ProjectImageQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([ProjectImage::tableName() . '.status' => ProjectImage::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([ProjectImage::tableName() . '.status' => ProjectImage::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([ProjectImage::tableName() . '.id' => SORT_DESC])
            ->orWhere([ProjectImage::tableName() . '.language' => '']);
    }

    public function findByLanguage()
    {
        return $this->andWhere([ProjectImage::tableName() . '.language' => \Yii::$app->language])
            ->orWhere([ProjectImage::tableName() . '.language' => '']);
    }
}
