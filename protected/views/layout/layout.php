<? require_once(\Config::get()->basePath .
        DIRECTORY_SEPARATOR . \Config::get()->viewsPaths[0] .
        DIRECTORY_SEPARATOR . 'layout' .
        DIRECTORY_SEPARATOR . 'header.php'); ?>

<content>
    <?= $_content ?>

</content>

<? require_once(\Config::get()->basePath .
    DIRECTORY_SEPARATOR . \Config::get()->viewsPaths[0] .
    DIRECTORY_SEPARATOR . 'layout' .
    DIRECTORY_SEPARATOR . 'footer.php'); ?>