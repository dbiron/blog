<?php

function bdd(){
    /* Connexion à une base MySQL avec l'invocation de pilote */
    $data = 'mysql:dbname=blog;host=127.0.0.1';
    $user = 'root';
    $password = '';
    
    try {
        $bdd = new PDO($data, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }

    return $bdd;
}
