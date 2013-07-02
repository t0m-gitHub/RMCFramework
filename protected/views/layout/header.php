<!DOCTYPE html>

<html>

<head>
   <title><?= isset($this->title) ? $this->title : '' ?></title>
    <meta charset='UTF-8'>
    <meta name='description' content='<?= RMC\T::get('Klimenko Alex. PHP Developer.') ?>'>
    <meta name='keywords' content='<?= RMC\T::get('PHP Developer,PHP Developer resume, hire PHP ' . (isset($skillsArray) ? $skills : '') ) ?>'>
    <meta name='author' content='<?= RMC\T::get('Klimenko Alex') ?>'>
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
            <a class='brand' href='#'><?= RMC\T::get('Klimenko Alex') ?></a>
            <div class='nav-collapse collapse'>
                <ul class='nav'>
                    <li class='active'><a href='#'><?= RMC\T::get('CV')?></a></li>
                    <li><a href='#contact'><?= RMC\T::get('Projects')?></a></li>
                    <li><a href='#about'><?= RMC\T::get('Contact')?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>