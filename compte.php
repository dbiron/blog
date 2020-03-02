<?php
session_start();
require_once 'fonctions/bdd.php';
include_once 'fonctions/user.php';
include_once 'fonctions/blog.php';
$bdd = bdd();
$infos = infos();
$comments= comments_user();
include_once 'layouts/head.php';
include_once 'layouts/header.php'

?>

<div class="container commentaires">
    <div class="row">
        <div class="col-xs-12">
            <h1>Bienvenue <?= $infos['pseudo'] ?> !</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p>Adresse e-mail : <?= $infos['email'] ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1>Derniers commentaires !</h1>
        </div>
    </div>
    <?php
         foreach($comments as $comment) :
        ?>
    <div class="row commentaire">
        <div class="col-xs-12">
            <p class="date">Posté le <time
                    datetime="<?= $comment['created_at'] ?>"><?= formatage_date($comment['created_at']) ?></time> 
                sur l'article <?= $comment['title'] ?>
            </p>
            <p><?= $comment['content'] ?></p>
        </div>
    </div>
    <?php
       endforeach
    ?>
    <?php
include 'layouts/footer.php';
?>