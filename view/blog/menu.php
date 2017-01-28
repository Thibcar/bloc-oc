<ul id="main-menu" class="col s12">
    <li><a href="index.php"><i class="material-icons">chevron_right</i><span>Acceuil</span></a></li>
    <?php if(!logged_in()) : ?>
    <li><a href="index.php?type=login"><i class="material-icons">chevron_right</i><span>Se connecter</span></a></li>
    <li><a href="index.php?type=register"><i class="material-icons">chevron_right</i><span>S'enregistrer</span></a></li>
    <?php else : ?>
        <li><a href="admin.php?section=logout"><i class="material-icons">chevron_right</i><span>Logout</span></a></li>
    <?php endif; ?>
    <li><a href="admin.php"><i class="material-icons">chevron_right</i><span>Admin</span></a></li>
</ul>

