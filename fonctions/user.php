<?php


function register(){
    global $bdd;

    extract($_POST);

    $validation = true;

    $errors = [];

    if(empty($pseudo) || empty($email) || empty($emailconf) || empty($password) || empty($passwordconf)){
        $validation = false;
        $errors[] = 'Tous les champs sont obligatoires !';
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $validation = false;
        $errors[] = "L'adresse e-mail n'est pas valide !";
    }

    if($emailconf != $email){
        $validation = false;
        $errors[] = "L'adresse e-mail de confirmation est incorrecte !";
    }

    if($passwordconf != $password){
        $validation = false;
        $errors[] = "Le mot de passe de confirmation est incorrect !";
    }

    if(pseudo_check($pseudo)){
        $validation = false;
        $errors[] = 'Ce pseudo est déjà pris !';
    }

    if($validation){
        $register = $bdd->prepare('INSERT INTO users(pseudo, email, password) VALUES (:pseudo, :email, :password)');
        $register->execute([
          "pseudo" => htmlentities($pseudo),
          "email" => htmlentities($email),
          "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
        unset($_POST['pseudo']);
        unset($_POST['email']);
        unset($_POST['emailconf']);
    }

    return $errors;
}


function pseudo_check($pseudo){
    global $bdd;

    $result = $bdd->prepare('SELECT COUNT(*) FROM users WHERE pseudo = ?');
    $result->execute([$pseudo]);

    $result = $result->fetch()[0];

    return $result;
}


function login(){
    global $bdd;

    extract($_POST);

    $error = 'Ces identifiants ne correspondent pas à nos enregistrements !';

    $login = $bdd->prepare("SELECT id, password FROM users WHERE pseudo = ?");
    $login->execute([$pseudo]);

    $login = $login->fetch();
    if(password_verify($password, $login["password"])){
        $_SESSION['user'] = $login['id'];
       header("Location: compte.php");
    }else{
        return $error;
    }
}

function logout(){
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: connexion.php");
}


function infos(){
    global $bdd;

    $infos = $bdd->prepare("SELECT email, pseudo FROM users WHERE id = ?");
    $infos->execute([$_SESSION["user"]]);

    $infos = $infos->fetch();

    return $infos;
}

function comments_user(){
    global $bdd;

    $comments = $bdd->prepare("SELECT comments.*, articles.title FROM comments INNER JOIN articles ON comments.article_id = articles.id AND comments.user_id = ?");
    $comments->execute([$_SESSION["user"]]);

    $comments = $comments->fetchAll();


    return $comments;
}

function post_comment(){
    if(isset($_SESSION["user"])){
    
        global $bdd;
        extract($_POST);
    
        $error = '';

        if(!empty($commentaire)){
          
        $id_article = (int)$_GET["id"];
            $id = $_SESSION["user"];
            // var_dump($id);
        $comment = $bdd->prepare("INSERT INTO comments(user_id, article_id, content) VALUES(:user_id, :article_id, :content)");
        $comment->execute([
            "user_id" => $id,
            "article_id" => $id_article,
            "content" => nl2br(htmlentities($commentaire))
        ]);
 
        
        header("Location: article.php?id=". $id_article);
        }else{
            $error .= "Vous devez écrire du texte !";
        }
        return $error;
    }
}