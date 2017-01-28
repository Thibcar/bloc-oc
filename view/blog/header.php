<!DOCTYPE html>
<html>

<head>
    <title><?= $titre; ?></title>
    <meta charset="UTF-8">
    <!--Import Google Icon Font and Quicksand font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/style.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="container">
        <header>
            <nav id="main-nav" class="row">
                <div class="col s12">
                    <i class="medium material-icons"><span id="menu-icon">menu</span></i>
                </div>

                <div id="display-nav" class="col s12">

                    <div class="col s6 left-nav">
                        <h3 class="col s12">A propos</h3>
                        <div class="col s5">
                            <img class="apropos responsive-img" src="img/photoblog.jpg">
                        </div>
                        <div class="col s7">
                            <p>Je suis Thibault, apprenti développeur.
                                <br> Cela fait maintenant environ 5 ans que je travaille sur le Web. La révolution digitale accompagne ou favorise d'autres révolutions, pas toujours évidentes à déceler. Ce blog se veut témoin des changements qui agitent notre monde.</p>
                        </div>
                        <div class="col s12">
                            <a href="apropos.php" class="btn waves-effect waves-light grey darken-4">En savoir plus</a>
                        </div>
                    </div>
                    <div class="col s6 right-nav">
                        <h3 class="col s12">A découvrir dans ce blog</h3>
                        <?php include("menu.php"); ?>
                    </div>
                </div>
            </nav>
            <div id="site-title">
               <?php if(isset($_GET['type'])) : ?>
                <h1 class="center-align"><a href="index.php">Révolutions Digitales</a></h1>
                <?php else : ?>
                <h1 class="center-align">Révolutions Digitales</h1>
                <?php endif; ?>
                <div class="center-align">Soyons acteurs de ce monde qui change</div>
            </div>
        </header>