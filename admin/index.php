<?php
require_once '../fonctions/bdd.php';
include_once '../fonctions/admin.php';
$bdd = bdd();
if(!empty($_POST)){
    $errors = post_article();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warp Code Admin - Accueil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,300,700">
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <a href="index.php">Administration</a>
                </div>
                <div class="col-sm-9">
                    <nav>
                        <ul>
                            <li><a href="index.php">Nouveau post</a></li>
                            <li><a href="posts.php">Anciens posts</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Poster un article !</h1>
            </div>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
        <?php
            if(isset($errors)): 
            if($errors): 
            foreach($errors as $error):
        ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="message erreur"><?= $error ?></div>
                </div>
            </div>
        <?php
        endforeach;
        else:
        ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="message confirmation">Le post a bien été créé !</div>
                </div>
            </div>
        <?php
        endif;
        endif
        ?>
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" name="titre" placeholder="Titre *" value="<?php if(isset($_POST['titre'])) echo $_POST['titre'] ?>">
                </div>
                <div class="col-sm-6">
                    <input type="file" name="file">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <textarea name="contenu" placeholder="Corps de l'article *"><?php if(isset($_POST['contenu'])) echo $_POST['contenu'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" value="Poster!">
                </div>
            </div>
        </form>
        <footer>
            <div class="row">
                <div class="col-xs-12">
                    <a href="contact.php">Contact</a> -  <a target="blank" href="https://www.warp-code.fr">Warp Code<Code></a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>