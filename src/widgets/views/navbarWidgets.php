<?php
use yii\helpers\Url;
use modava\pages\PagesModule;

?>
<ul class="nav nav-tabs nav-sm nav-light mb-25">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'document') echo ' active' ?>"
           href="<?= Url::toRoute(['/pages/document']); ?>">
            <i class="ion ion-ios-locate"></i><?= PagesModule::t('pages', 'Document'); ?>
        </a>
    </li>
</ul>
