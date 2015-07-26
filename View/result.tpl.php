<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */
 
/**
 * Since PHP 5.4, the echo short tag "<?= ?> is always available, so I use it to simplify the visibility of the template.
 * I also use the alternative PHP syntax that is much more clearly in template files.
*/
?>
<?php if (empty($this->mSearch) || !$this->mSearch): ?>
    <p class="warning">Whoops! You have to specify a "Rental" or "Sale" property. Please <a href="./?c=main&a=index">try again</a>!</p>

<?php else: ?>

    <?php $oResults = $this->mSearch->results // Store "results" attribute in a variable ?>
    
    <?php if($oResults->pagination->total_results > 0): ?>
        <ul>
        <?php foreach ($oResults->ads as $oAd):?>
            <li><?=ucfirst($oAd->property_type)?> in <?=$oAd->general_area?> - <a href="<?=$oAd->daft_url?>" title="<img src=<?=$oAd->small_thumbnail_url?>>"><?=$oAd->full_address?></a></li>
        <?php endforeach ?>
        </ul>
    <?php else: ?>
        <p class="warning">Whoops! Any proprety has been found. Please <a href="./?c=main&a=index">re-try</a>.</p>
    <?php endif ?>
    
<?php endif ?>

<h4 class="s_tMarg">Want to <a href="./?c=main&a=index">make a new search</a>?</h4>

<?php if (!empty($this->aParamResults)): ?>
    <h3>Property Results Set</h3>
    <?php var_dump($this->aParamResults) ?>
<?php endif ?>
