<?php

function post_article(){
    global $bdd;

    extract($_POST);

    $validation = true;
    $errors = [];

    if(empty($titre) || empty($contenu)){
        $validation = false;
        $errors[] = 'Tous les champs sont obligatoires !';
    }

    if(!isset($_FILES["file"]) || $_FILES['file']['error'] > 0 ){
        $validation = false;
        $errors[] = "L'image est obligatoire !";
    }

    if($validation){
        $image = basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], '../img/'. $image);

        $post = $bdd->prepare("INSERT INTO articles(title, extract, content, image) VALUES(:title, :extract, :content, :image)");
        $post->execute([
            "title" => htmlentities($titre),
            "extract" => substr(htmlentities($contenu), 0,150 ),
            "content" => htmlentities($contenu),
            "image" => htmlentities($image)
        ]);

        unset($_POST['titre']);
        unset($_POST['contenu']);
    }
    return $errors;

}


function posts(){
    global $bdd;

    $posts = $bdd->query("SELECT id, title FROM articles ORDER BY id DESC");
    $posts = $posts->fetchAll();

    return $posts;
}


function delete(){
    global $bdd;

    $id = (int)$_GET["id"];

    $image = $bdd->prepare("SELECT image FROM articles WHERE id = ?");
    $image->execute([$id]);
    $image = $image->fetch()["image"];

    unlink("../img/" . $image);

    $delete = $bdd->prepare("DELETE FROM articles WHERE id = ?");

    $delete->execute([$id]);

}


function post(){
    global $bdd;

    $id = (int)$_GET["id"];

    $post = $bdd->prepare("SELECT title, content FROM articles WHERE id = ?");
    $post->execute([$id]);
    $post = $post->fetch();

    return $post;
}


function update(){
    global $bdd;
    $errors = '';
    extract($_POST);

    $id = (int)$_GET["id"];
    if(!empty($titre) AND !empty($contenu)){
        $update = $bdd->prepare("UPDATE articles SET title = :title, extract = :extract, 
        content = :content WHERE id = :id");
        $update->execute([
            "title" => htmlentities($titre),
            "extract" => substr(htmlentities($contenu),0, 150),
            "content" => nl2br(htmlentities($contenu)),
            "id" => $id
        ]);
    }else{
        $errors .= "Les champs ne doivent pas être vides !";
    }
    return $errors;
}