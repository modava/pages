<?php

namespace modava\pages\models;

use common\models\User;
use modava\pages\components\MyUpload;
use modava\pages\PagesModule;
use modava\pages\models\table\ProjectTable;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\helpers\MyHelper;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property string $content
 * @property array $tech
 * @property int $position
 * @property string $ads_pixel
 * @property string $ads_session
 * @property int $status
 * @property string $language
 * @property int $views
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $createdBy0
 */
class Project extends ProjectTable
{
    public $toastr_key = 'project';

    public $iptImages;

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'slug' => [
                    'class' => SluggableBehavior::class,
                    'immutable' => false,
                    'ensureUnique' => true,
                    'value' => function () {
                        return MyHelper::createAlias($this->title);
                    }
                ],
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
            [['title', 'slug'], 'required'],
            [['description', 'content', 'ads_pixel', 'ads_session'], 'string'],
            [['tech', 'iptImages'], 'safe'],
            [['position', 'status', 'views', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 25],
            [['slug'], 'unique'],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'gif', 'jpeg'],
                'maxSize' => 1024 * 1024],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'slug' => Yii::t('backend', 'Slug'),
            'image' => Yii::t('backend', 'Image'),
            'description' => Yii::t('backend', 'Description'),
            'content' => Yii::t('backend', 'Content'),
            'tech' => Yii::t('backend', 'Tech'),
            'position' => Yii::t('backend', 'Position'),
            'ads_pixel' => Yii::t('backend', 'Ads Pixel'),
            'ads_session' => Yii::t('backend', 'Ads Session'),
            'status' => Yii::t('backend', 'Status'),
            'language' => Yii::t('backend', 'Language'),
            'views' => Yii::t('backend', 'Views'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
        ];
    }

    public function validateImages()
    {
        $iptImages = json_decode($this->iptImages);
        if ($iptImages != null) {
            $this->iptImages = $iptImages;
        }
        if ($this->iptImages == null) {
            $this->addError('iptImages', 'Images null');
            return false;
        } else {
            if (is_string($this->iptImages)) $this->iptImages = [$this->iptImages];
            if (!is_array($this->iptImages)) {
                $this->addError('iptImages', 'Data type failed');
                return false;
            } else {
                foreach ($this->iptImages as $image) {
                    $modelImages = new ProjectImage([
                        'project_id' => $this->primaryKey,
                        'image_url' => $image
                    ]);
                    if (!$modelImages->validate()) {
                        var_dump($modelImages->getErrors());
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function saveImages()
    {
        if (is_array($this->iptImages)) {
            foreach ($this->iptImages as $image) {
                $path = Yii::getAlias('@frontend/web/uploads/project/');
                $imageName = null;
                foreach (Yii::$app->params['project'] as $key => $value) {
                    $pathSave = $path . $key;
                    if (!file_exists($pathSave) && !is_dir($pathSave)) {
                        mkdir($pathSave);
                    }
                    $imageName = MyUpload::uploadFromOnline($value['width'], $value['height'], $image, $pathSave . '/', $imageName);
                }
                $modelImage = new ProjectImage([
                    'project_id' => $this->primaryKey,
                    'image_url' => $imageName
                ]);
                if (!$modelImage->save()) {
                    var_dump($modelImage->getErrors());
                    return false;
                }
            }
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->on(yii\db\BaseActiveRecord::EVENT_AFTER_INSERT, function (yii\db\AfterSaveEvent $e) {
            if ($this->position == null)
                $this->position = $this->primaryKey;
            $this->save();
        });
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
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
