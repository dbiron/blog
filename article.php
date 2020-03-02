<?php
session_start();
require_once 'fonctions/bdd.php';
include_once 'fonctions/blog.php';
include_once 'fonctions/user.php';
$bdd = bdd();
$article = article();
$nb = nb_comments();
$comments = comments();
if(!empty($_POST)){
    $error = post_comment();
}
include_once 'layouts/head.php';
include_once 'layouts/header.php'
?>
<div class="container article">

    <div class="row">
        <article>
            <div class="col-sm-5">
                <img src="img/<?= $article['image'] ?>" title="<?= $article['title'] ?>" alt="<?= $article['title'] ?>">
            </div>
            <div class="col-sm-7">
                <p class="date">Posté le <time
                        datetime="<?= $article['created_at'] ?>"><?= formatage_date($article['created_at']) ?></time>
                </p>
                <h1><?= $article['title'] ?></h1>
                <p><?= $article['content'] ?> </p>
            </div>
        </article>
    </div>
</div>
<div class="container commentaires">
    <div class="row">
        <div class="col-xs-12">
            <h1>Commentaires (<?= $nb ?>)</h1>
        </div>
    </div>
    <?php foreach($comments as $comment) : ?>
    <div class="row commentaire">
        <div class="col-xs-12">
            <p class="date">Posté par <?= $comment['pseudo'] ?> le <time
                    datetime="<?= $comment['created_at'] ?>"><?= formatage_date($comment['created_at']) ?></time> :</p>
            <p><?= $comment['content'] ?></p>
        </div>
    </div>
    <?php 
    endforeach;
    if(isset($_SESSION['user'])):
     ?>

    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="">
                <?php
                if(isset($error)) :
                if($error) :
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="message erreur"><?= $error ?></div>
                    </div>
                </div>
                <?php
                else :
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="message confirmation">Votre commentaire a bien été posté !</div>
                    </div>
                </div>
                <?php
                endif;
                endif
                ?>
                <textarea name="commentaire" placeholder="Votre commentaire *"></textarea>
                <input type="submit" value="Commenter">
            </form>
        </div>
    </div>


    <?php
    endif;
    include 'layouts/footer.php';
    ?>