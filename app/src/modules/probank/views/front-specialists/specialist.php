<?php
/**
 * @var \app\dto\ProbankSpecialistsTransportModel $specialistTransportModel
 * @var $this yii\web\View
 */

?>

<div class="single-member">
    <div class="member-header">
        <a href="<?= $specialistTransportModel->prevLink; ?>">
            <div class="chevron-left"></div>
        </a>

        <a href="<?= $specialistTransportModel->nextLink; ?>">
            <div class="chevron-right"></div>
        </a>

        <div class="title"><?= $specialistTransportModel->result->user->profile->fullName; ?></div>
        <div class="sub-title"><?= \Yii::t('app/probank', $specialistTransportModel->result->typeEn); ?></div>
    </div>
    <div class="member-body">
        <div class="member-base-image">
            <div class="image-inner"><?= $specialistTransportModel->result->mainPhotoNN->getImgSizeOf("800xR") ?></div>
            <?php if (\Yii::$app->user->can('user')) { ?>
                <div class="order"><a href="#">Заказать</a></div>
            <?php } ?>
        </div>
        <div class="member-description">
            <?= $specialistTransportModel->result->about; ?>
        </div>
        <div class="member-additional-photos masonry">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>


            <?php foreach ($specialistTransportModel->result->additionalImages as $key => $image) {
                /** @var \app\models\Image $image */
                ?>
                <div class="item-photo item-masonry" style="display: none">
                    <a class="item-photo-a" data-fancybox="gallery" href="#modal-<?= $key ?>">
                        <?= \app\widgets\pictures\Picture::widget([
                            "src" => $image->getUrlImageSizeOf('390xR'),
                            "points" => [
                                "sm, md, lg" => "450xR",
                            ]
                        ]) ?>
                    </a>
                </div>
            <?php } ?>


        </div>
    </div>
</div>
<div style="display: none">

    <?php foreach ($specialistTransportModel->result->additionalImages as $key => $image) {
        include '_modal-window.php';
    } ?>

</div>