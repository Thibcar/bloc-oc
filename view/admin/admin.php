<?php $titre = "Espace d'administration"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?= $titre; ?>
    </title>
    <meta charset="UTF-8">
    <!--Import Google Icon Font and Quicksand font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/style.css" media="screen,projection" />

    <!-- TinyMCE -->
    
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <header>
        <nav>
            <div class="nav-wrapper black">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="index.php">Voir le site</a></li>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="admin.php?section=logout">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="row">
        <div id="admin-menu" class="col s2 black">
            <!-- Grey navigation panel -->
            <h3>Posts</h3>
            <ul>
                <li><a href="admin.php?section=all_posts">Voir tous les posts</a></li>
                <li><a href="admin.php?section=add_post">Ajouter un post</a></li>
            </ul>
            <h3>Commentaires</h3>
            <ul>
                <li><a href="admin.php?section=all_comments">Voir tous les commentaires</a></li>
            </ul>
        </div>
        <div id="admin-content" class="col s10">
            <?php if(isset($contenu)) : ?>
            <?= $contenu; ?>
            <?php else : ?>
            <h2>Bienvenue dans votre espace d'administration <?= $_SESSION['username']; ?></h2>
            <?php endif; ?>
        </div>
        
    </div>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>