<?php

namespace modava\pages\models\query;

use modava\pages\models\Project;

/**
 * This is the ActiveQuery class for [[Project]].
 *
 * @see Project
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere([Project::tableName() . '.status' => Project::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([Project::tableName() . '.status' => Project::STATUS_DISABLED]);
    }

    public function sortDescById()
    {
        return $this->orderBy([Project::tableName() . '.id' => SORT_DESC]);
    }
}
