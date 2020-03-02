<?php
require_once '../fonctions/bdd.php';
include_once '../fonctions/admin.php';
$bdd = bdd();
$post = post();
if(!empty($_POST)){
    $errors = update();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warp Code Admin - Modifier</title>
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
                <h1><?= $post['title'] ?></h1>
            </div>
        </div>
        <form method="post" action="">
            <?php
                if(isset($errors)) : 
                if($errors) :
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="message erreur"><?= $errors ?></div>
                </div>
            </div>
            <?php
                else :
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="message confirmation">Le post a bien été édité !</div>
                </div>
            </div>
            <?php
                endif;
                endif
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <input type="text" name="titre" placeholder="Titre *" value="<?= $post['title'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <textarea name="contenu" placeholder="Corps de l'article *"><?= str_replace("<br/>","", $post['content']) ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" value="Modifier!">
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