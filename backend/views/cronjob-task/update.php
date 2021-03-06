<?php

/* @var $this yii\web\View */
/* @var $model backend\models\support\CronjobTask */

$this->title = Yii::t('backend', 'Actualizar').' '. Yii::t('backend', 'Tarea de CronJob').': '. $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tareas de CronJob'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Actualizar');
?>
<div class="cronjob-task-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
