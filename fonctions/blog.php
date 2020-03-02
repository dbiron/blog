<?php

function articles(){
    global $bdd;
    $articles = $bdd->query("SELECT id, extract, title, image, created_at FROM articles");
    $articles = $articles->fetchAll();
  
    return $articles;
}

function formatage_date($publication){
    // $publication = explode(" ", $publication);
    // $date = explode('-', $publication[0]);
    // $hour = explode(':', $publication[1]);
    // $months = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    // $resultat = $date[2] . ' ' . $months[(int)$date[1]] . ' ' . $date[0] . ' à ' . $hour[0] . 'h' . $hour[1];
    setlocale(LC_TIME, "fr_FR.UTF-8");
    $resultat = strftime("%A %d %B %G", strtotime($publication));
    return $resultat;

}

function article(){
    global $bdd;

    $id = (int)$_GET['id'];

    $article = $bdd->prepare('SELECT id, title, content, image, created_at FROM articles WHERE id=? ');

    $article->execute([$id]);

    $article = $article->fetch();

    
    if(empty($article)){
        header('Location: index.php');
    }else{

        return $article;
    }

}

function nb_comments(){
    global $bdd;

    $id_article = (int)$_GET['id'];

    $nb = $bdd->prepare('SELECT COUNT(*) FROM comments WHERE article_id=?');
    $nb->execute([$id_article]);

    $nb = $nb->fetch()[0];

    return $nb;

}

function comments(){
    global $bdd;

    $id_article = (int)$_GET['id'];

    $comments = $bdd->prepare('SELECT comments.*, users.pseudo FROM comments INNER JOIN users ON comments.user_id = users.id AND comments.article_id = ?');
    $comments->execute([$id_article]);

    $comments = $comments->fetchAll();
  
    return $comments;
}


function search(){
    global $bdd;

    extract($_POST);

    $search = $bdd->prepare('SELECT * FROM articles WHERE title LIKE :query OR content LIKE :query');

    $search->execute([
        'query' => '%' . $query . '%'
    ]);

    $search = $search->fetchAll();

    return $search;
}