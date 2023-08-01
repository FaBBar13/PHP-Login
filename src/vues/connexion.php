<?php
//var_dump($_SESSION);
session_start();
echo "<h1>Connexion Réussie ! </h1>";
echo "<br>";
echo ("Coucou Utilisateur N° " . $_SESSION['_user'] . ", vous êtes " . $_SESSION['_nom'] . " " . $_SESSION['_prenom']);
?>