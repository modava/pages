<?php
namespace modava\pages\components;

class MyErrorHandler extends \yii\web\ErrorHandler
{
    public $errorView = '@modava/pages/views/error/error.php';

}
