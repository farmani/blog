<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php $this->widget('application.widgets.CounterWidget',array('logFile'=>Yii::getPathOfAlias('webroot') . '/logCounter.txt')); ?>