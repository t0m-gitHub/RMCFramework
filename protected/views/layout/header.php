<!DOCTYPE html>

<html>

<head>
    <title><?= isset($this->title) ?  RMC\T::get($this->title) : '' ?></title>
    <meta charset='UTF-8'>
    <meta name='description' content='<?= RMC\T::get('Klimenko  Aleksander. PHP Developer.') ?>'>
    <meta name='keywords' content='<?= RMC\T::get('PHP Developer,PHP Developer resume, hire PHP ' . (isset($skillsArray) ? $skills : '') ) ?>'>
    <meta name='author' content='<?= RMC\T::get('Klimenko  Aleksander') ?>'>
    <link href='assets/css/bootstrap.css' rel='stylesheet'>
    <link href='assets/css/bootswatch.css' rel='stylesheet'>

    <script src = 'assets/js/jquery.js'></script>
    <style>
        body {
            padding-top: 60px;
        }
    </style>
</head>

<body>
<div class='navbar navbar-fixed-top'>
    <div class='navbar-inner'>
        <div class='container'>
            <a class='brand' href='index.php'><?= RMC\T::get('Aleksander Klimenko') ?></a>
            <div class='nav-collapse collapse'>
                <ul class='nav'>
                    <li <? if($this->context->getControllerName() == 'Index') : ?>class='active'<? endif ?> > <a href='index.php'> <?= RMC\T::get('CV')?></a></li>
                    <li <? if($this->context->getControllerName() == 'Contact') : ?>class='active'<? endif ?> > <a href='index.php?action=contact'><?= RMC\T::get('Contact')?></a></li>
                </ul>
                <ul class="nav pull-right" id="main-menu-right">
                    <li><a href='index.php?action=ChangeLang&lang=RU'>Рус</a></li>
                    <li><a href='index.php?action=ChangeLang&lang=Eng'>Eng</a></li>
                    <li></li>
                </ul>
            </div>

        </div>
    </div>
</div>