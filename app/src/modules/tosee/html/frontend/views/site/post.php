<?php
/**
 * @var \app\dto\PostTransportModel $postModel
 */
?>
<div class="content-wrapper">
    <div class="content">
        <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
        <div class="single-post">
            <div class="post-header"><a href="#">
                    <div class="chevron-left"></div>
                </a><a href="#">
                    <div class="chevron-right"></div>
                </a>
                <div class="title"><?= $postModel->result->postData->title; ?></div>
                <div class="sub-title"><?= $postModel->result->eventAt; ?></div>
            </div>
            <div class="post-body">
                <div class="post-description">
                    <?= $postModel->result->postData->postShortDesc; ?>
                </div>
                <div class="post-additional-photos masonry">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>

                    <?php foreach ($postModel->result->images as $key => $image) { ?>
                        <div class="item-photo item-masonry" style="display: none">
                            <a class="item-photo-a" data-fancybox="gallery" href="#modal-<?= $key ?>">
                                <?= \app\widgets\picture\Picture::widget([
                                    "src" => "/uploads/post/{$image->getFullPathImageSizeOf('200x150')}",
                                    "points" => [
                                        "sm, md" => "280x200",
                                        "lg" => "390x280",
                                    ]
                                ]) ?>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div style="display: none">

            <?php foreach ($postModel->result->images as $key => $image) { ?>
                <div class="modal-window" id="modal-<?= $key ?>">
                    <div class="modal-header">
                        <div class="modal-image">
                            <?= \app\widgets\picture\Picture::widget([
                                "src" => "/uploads/post/{$image->getFullPathImageSizeOf('768x500')}",
                                "points" => [
                                    "sm, md" => "1200x500",
                                    "lg" => "1500x500",
                                ]
                            ]) ?>
<!--                            --><?//= \yii\helpers\Html::img("/uploads/post/{$image->getFullPathImageSizeOf('770x500')}") ?>
                        </div>
                        <div class="modal-controls">
                            <div class="left-controls">
                                <i class="icon-info modal-tab-control" rel="0-info"></i>
                                <i class="icon-comments modal-tab-control" rel="0-comments"></i>
                            </div>
                            <div class="right-controls">
                                <i class="icon-like"></i>
                                <i class="icon-share"></i>
                                <i class="icon-buy"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="modal-tab" id="tab-0-comments">
                            <div class="modal-likes">
                                <div class="fa fa-heart"></div>
                                <div class="likes-counter">544</div>
                            </div>
                            <div class="modal-comments modal-inner-body">
                                <div class="comment">
                                    <div class="comment-avatar">
                                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                    </div>
                                    <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="comment-avatar">
                                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                    </div>
                                    <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                    </div>
                                </div>
                                <div class="comment">
                                    <div class="comment-avatar">
                                        <?= \yii\helpers\Html::img("/uploads/post/2/59494728a2ead[320x200].jpg") ?>
                                    </div>
                                    <div class="comment-description"><strong>user name</strong><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-tab" style="display: none" id="tab-0-info">
                            <div class="modal-info modal-inner-body">Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim
                                veniam, quis nostrud exercitation ullamco
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>