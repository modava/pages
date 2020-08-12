<?php

namespace modava\pages\models;

use common\models\User;
use modava\pages\PagesModule;
use modava\pages\models\table\PagesPartnerTable;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
* This is the model class for table "pages_partner".
*
    * @property int $id
    * @property string $title
    * @property string $image
    * @property string $link
    * @property int $status
    * @property string $language
    * @property int $created_at
    * @property int $updated_at
    * @property int $created_by
    * @property int $updated_by
    *
            * @property User $createdBy
            * @property User $updatedBy
    */
class PagesPartner extends PagesPartnerTable
{
    public $toastr_key = 'pages-partner';
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'created_by',
                    'updatedByAttribute' => 'updated_by',
                ],
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'preserveNonEmptyValues' => false,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
            ]
        );
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
			[['title'], 'required'],
			[['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
			[['title', 'image', 'link'], 'string', 'max' => 255],
			[['language'], 'string', 'max' => 25],
			[['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
			[['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
		];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'id' => PagesModule::t('pages', 'ID'),
            'title' => PagesModule::t('pages', 'Title'),
            'image' => PagesModule::t('pages', 'Image'),
            'link' => PagesModule::t('pages', 'Link'),
            'status' => PagesModule::t('pages', 'Status'),
            'language' => PagesModule::t('pages', 'Language'),
            'created_at' => PagesModule::t('pages', 'Created At'),
            'updated_at' => PagesModule::t('pages', 'Updated At'),
            'created_by' => PagesModule::t('pages', 'Created By'),
            'updated_by' => PagesModule::t('pages', 'Updated By'),
        ];
    }

    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUserCreated()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUserUpdated()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
