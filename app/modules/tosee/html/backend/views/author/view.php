<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use components\helpers\Helpers;

/* @var $this yii\web\View */
/* @var $model modules\tosee\models\common\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">


    <p>
        <?= Html::a(Yii::t('app/post', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/post', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/post', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <br/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'postData.title',
            'postData.sub_header',
            'event_at:date',
            [
                'attribute' => 'image_id',
                'value' => Helpers::renderImage($model->image, ['size' => "350x390"]),
                'label' => 'Изображение',
                'format'=>'raw',
            ],
            'postData.post_short_desc',
            [
                'attribute' => 'postData.post_desc',
                'format'=>'raw',
            ],
            'created_at:datetime',
        ],
    ]) ?>

    <div class="additional-images">
        <?php foreach($model->images as $image){ ?>
            <?= \components\helpers\Helpers::renderImage($image, ["size" => "215x215", "class" => "add-img"]) ?>
        <?php } ?>
    </div>

</div>
