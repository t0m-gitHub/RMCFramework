<? require_once(\Config::get()->basePath .
        DIRECTORY_SEPARATOR . \Config::get()->viewsPaths[0] .
        DIRECTORY_SEPARATOR . 'layout' .
        DIRECTORY_SEPARATOR . 'header.php'); ?>

<div class = 'container'>
    <?= $_content ?>

</div>

<? require_once(\Config::get()->basePath .
    DIRECTORY_SEPARATOR . \Config::get()->viewsPaths[0] .
    DIRECTORY_SEPARATOR . 'layout' .
    DIRECTORY_SEPARATOR . 'footer.php'); ?>