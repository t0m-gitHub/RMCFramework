<header>

    <div class = 'row'>
    <span class = 'span6'>
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

<div id="generalinfo"></div>


    <p class = 'title'><?= RMC\T::get('General information')?></p>
    <div>
        <b><?= RMC\T::get('Name:')?> </b> <i><?= RMC\T::get($name)?></i> <br />
        <b><?= RMC\T::get('Age:')?></b> <i><?= $age ?></i> <br />
        <b><?= RMC\T::get('City:')?></b> <i><?= RMC\T::get($city)?></i> <br />
        <b><?= RMC\T::get('Overall experience:')?></b> <i>3+ years</i> <br />
    </div>


<section id="skills">
    <p class = 'title'><?= RMC\T::get('Skills')?></p>
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
    <p class = 'title'><?= RMC\T::get('Technologies')?></p>
    <ul>
        <? foreach($technologies as $technology): ?>
            <li>
                <b><?= RMC\T::get($technology->name)?></b> — <?= RMC\T::get($technology->description)?>
            </li>
        <? endforeach ?>
    </ul>
</section>

<button class="btn btn-inverse" id="print"><?= RMC\T::get('Print CV')?></button>