
<body>
<header>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <a href="index.php">Blog</a>
                </div>
                <div class="col-sm-10">
                    <nav>
                        <ul>
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <?php 
                            
                            if(isset($_SESSION['user'])) :

                            ?>
                            <li><a href="compte.php">Mon Compte</a></li>
                            <li><a href="deconnexion.php">Deconnexion</a></li>
                            <?php
                            
                            else :
                            
                            ?>
                            <li><a href="connexion.php">Connexion</a></li>
                            <li><a href="inscription.php">Inscription</a></li>
                            <?php
                            
                            endif
                            
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

</body>
</html>