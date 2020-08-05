<?php
\modava\pages\assets\PagesAsset::register($this);
\modava\pages\assets\PagesCustomAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
<?php echo $content ?>
<?php $this->endContent(); ?>
