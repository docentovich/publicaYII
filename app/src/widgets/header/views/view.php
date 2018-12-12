<?php
$bundle = \app\widgets\header\HeaderAssets::register($this);
/**
 * @var string $currentProject
 * @var array $projects
 */
$filtered_projects = array_filter(
    $projects,
    function ($item) use ($currentProject) {
        return $item !== $currentProject;
    });
?>
    <div style="box-sizing: content-box">
        <header style="box-sizing: content-box">
            <div id="header-inner">
                <div class="navigation-panel">
                    <div class="navigation-part">
                        <div class="menu">
                            <div class="hamburger toggle-overlay" id="service-menu" rel="service-menu">
                                <i class="icon-burger"></i>
                            </div>
                            <div class="toggle-drop-down-action-panel base-logo" id="services" rel="services">
                                <?= \yii\helpers\Html::a(
                                        \yii\helpers\Html::img("{$bundle->baseUrl}/images/logo-inline/{$currentProject}.svg"),
                                        '/'
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-part">
                        <div class="controls">
                            <div class="toggle-drop-down-action-panel control" id="search" rel="search">
                                <i class="icon-search"></i>
                            </div>
                            <div class="toggle-drop-down-action-panel control" id="geo" rel="geo">
                                <i class="icon-geo"></i>
                            </div>
                            <div class="toggle-drop-down-action-panel control" id="enter" rel="enter">
                                <?php if (Yii::$app->id === "app-backend" and \Yii::$app->user->identity !== null) {
                                    echo \yii\helpers\Html::beginForm(['/user/security/logout'], 'post');
                                    echo \yii\helpers\Html::button(
                                        '<i class="icon-enter"></i>',
                                        ["class" => "button-only-icon", 'type' => 'submit']
                                    );
                                    echo \yii\helpers\Html::endForm();

                                } else { ?>
                                    <a href="/admin">
                                        <i class="icon-enter"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-panel toggle-overlay" id="drop-down-geo" rel="geo">
                    <div class="action-panel-control">
                        <i class="icon-geo"></i><span>Орел. Russia</span>
                    </div>
                </div>
                <div class="action-panel" id="drop-down-search">
                    <div class="action-panel-control">
                        <div id="search-placeholder"><i class="icon-search"></i>
                            <span>Найти на сайте</span></div>
                        <input type="text" value="" id="search-input" rel="search"/>
                    </div>
                </div>
                <div class="action-panel" id="drop-down-services">

                    <?php foreach ($filtered_projects as $project) { ?>
                        <a class="drop-down-service" href="http://publica.shablonkin.shn-host.ru/">
                            <div class="drop-down-service-image drop-down-service--publica">
                                <?= \yii\helpers\Html::img("{$bundle->baseUrl}/images/logo-inline/{$project}.svg"); ?>
                            </div>
                            <div class="drop-down-service-description"></div>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </header>
    </div>
    <div class="overlay" id="geo-overlay">
        <ul class="overlay-list">
            <li>Москва</li>
            <li>Санкт-Петербург</li>
            <li>Орел</li>
            <li>Хацапетовка</li>
            <li>Ньюйорк</li>
            <li>Токио</li>
            <li>Вырица</li>
            <li>Орел</li>
            <li>Хацапетовка</li>
            <li>Ньюйорк</li>
            <li>Токио</li>
            <li>Вырица</li>
        </ul>
    </div>
    <div class="overlay" id="search-overlay">
        <ul id="search-results-list"  class="overlay-list"></ul>
    </div>
<?= $content; ?>