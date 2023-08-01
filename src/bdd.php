<?php

$id_user = '';
$id_email = '';
$id_pwd = '';
$id_nom = '';
$id_prenom = '';
function getConnection()
{
    static $conn;
    if ($conn) {
        return $conn;
    }
    $servername = 'localhost';
    $username = 'root';
    // $password = 'root';

    //On essaye la connexion

    try {
        $conn = new PDO("mysql:host=$servername;dbname=test_fab", $username);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
        //echo "connnecté OK";

        // $req = $conn->prepare("SELECT id_user,id_email,id_nom,id_prenom FROM users ORDER BY 1");
        // $req->execute();

        // $liste_users = $req->fetchAll(PDO::FETCH_ASSOC);
        // print_r($users);

    }

    /* en cas d'erreur de connexion */catch (PDOException $e) {
        throw new ErrorException("Horreur : " . $e->getMessage());
    }

}