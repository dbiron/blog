<?php

require_once "../fonctions/bdd.php";
include_once "../fonctions/admin.php";

$bdd = bdd();
delete();

header('Location: posts.php');