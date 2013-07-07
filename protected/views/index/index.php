
<header>

    <div class = 'row'>
    <span class = 'span7'>
        <h2><?= RMC\T::get('PHP, MySQL Developer')?></h2>
    </span>
    </div>

    <div class="subnav">
        <ul class="nav nav-pills">
            <li><a href="#generalinfo"><?= RMC\T::get('General information')?></a></li>
            <li><a href="#skills"><?= RMC\T::get('Skills')?></a></li>
            <li><a href="#technologies"><?= RMC\T::get('Technologies')?></a></li>
            <li><a href="#jobs"><?= RMC\T::get('Jobs')?></a></li>
            <li><a href="#experience"><?= RMC\T::get('Experience')?></a></li>
            <li><a href="#education"><?= RMC\T::get('Education')?></a></li>
            <li><a href="#expectations"><?= RMC\T::get('Expectations')?></a></li>
        </ul>
    </div>`
</header>
<!-- print -->
<section id="generalinfo">


    <p class='title'><?= RMC\T::get('General information')?></p>
    <div>
        <b><?= RMC\T::get('Name')?>: </b> <i><?= RMC\T::get($name)?></i> <br />
        <b><?= RMC\T::get('Age')?>:</b> <i><?= $age ?></i> <br />
        <b><?= RMC\T::get('City')?>:</b> <i><?= RMC\T::get($city)?></i> <br />
        <b><?= RMC\T::get('Overall experience')?>:</b> <i>2+ years</i> <br />
        <b><?= RMC\T::get('Email')?>:</b> <span id="email"></span> <br />
        <b><?= RMC\T::get('Phone')?>:</b> <span id="phone"></span> <br />
        <b><?= RMC\T::get('GitHub profile')?>:</b> <a href="https://github.com/t0m-gitHub" target = "_blank">https://github.com/t0m-gitHub</a><br />
    </div>
</section>

<section id="skills">
    <p class='title'><?= RMC\T::get('Skills')?></p>
    <ul>
        <? foreach($skillsArray as $level => $skills): ?>
            <li>
                <i><?= ucfirst(RMC\T::get($level))?></i>
                <ul>
                    <? foreach($skills as $skill): ?>
                        <li> <b><?= RMC\T::get($skill['name'])?></b> — <?= RMC\T::get($skill['description'])?></li>
                    <? endforeach ?>
                </ul>

            </li>
        <? endforeach ?>
    </ul>
</section>

<section id="technologies">
    <p class='title'><?= RMC\T::get('Technologies')?></p>
    <ul>
        <? foreach($technologies as $technology): ?>
            <li>
                <b><?= RMC\T::get($technology->name)?></b> — <?= RMC\T::get($technology->description)?>
            </li>
        <? endforeach ?>
    </ul>
</section>

<section id="jobs">
    <p class='title'><?= RMC\T::get('Jobs')?></p>
    <? foreach($jobs as $job): ?>
        <b><?= RMC\T::get($job->name)?></b> <br/>
        <i><?= RMC\T::get($job->description)?></i> <br />
        <?= DateTime::createFromFormat(DB_DATE_FORMAT, $job->startDate)->format('Y.m') . ' - '. (empty($job->quitDate) ? 'current' :DateTime::createFromFormat(DB_DATE_FORMAT, $job->quitDate)->format('Y.m')) ?>
        <ul>
            <? foreach($job->tasks as $task): ?>
                <li>
                    <b><?= RMC\T::get($task->taskName)?></b> — <?= RMC\T::get($task->taskDescription)?>
                </li>
            <? endforeach ?>
        </ul>
    <? endforeach ?>
</section>

<section id="experience">
    <p class='title'><?= RMC\T::get('Experience')?></p>
    <ul>
        <? foreach($experience as $task): ?>
            <li>
                <b><?= RMC\T::get($task->taskName)?></b> — <?= str_replace('gitHub', '<a href="https://github.com/t0m-gitHub/RMCFramework/" target = "_blank"> gitHub </a>', RMC\T::get($task->solutions))?>
            </li>
        <? endforeach ?>
    </ul>
</section>

<section id="education">
    <p class='title'><?= RMC\T::get('Education')?></p>
    <? foreach($education as $univ): ?>
        <p>
            <b><?= RMC\T::get($univ->name)?></b><br />
            <b><?= RMC\T::get('Graduation year')?>: </b><?= DateTime::createFromFormat(DB_DATE_FORMAT, $univ->graduateDate)->format('Y')?><br />
            <i><?= RMC\T::get($univ->description)?></i>
        </p>
    <? endforeach ?>
</section>

<section id="expectations">
    <p class='title'><?= RMC\T::get('Expectations')?></p>
    <?= RMC\T::get($expectations)?>
</section>
<br />
<br />
<!-- printEnd -->
<a href = 'index.php?action=index&print=1' target="_blank"><button class="btn btn-inverse" id="print"><?= RMC\T::get('Print CV')?></button></a>

<script src="assets/js/index.js"></script>
<script src="assets/js/getContactInfo.js"></script>