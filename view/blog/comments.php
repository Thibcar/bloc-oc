<div class="row row-com">

    <div id="com-infos" class="col s2">
        <!-- nom + gravatar -->
        <div class="author-name center-align">
            <?= $com_author; ?>
        </div>
        <div class="center-align">
            <img src="<?= $grav_url; ?>" alt="<?= $com_author; ?>" class="gravatar">
        </div>
    </div>
    <div id="com" class="col s8 push-s1">
        <!-- message -->
        <?= $com_message; ?>
    </div>
</div>
