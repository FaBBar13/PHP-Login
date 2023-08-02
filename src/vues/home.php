<?php



// ob_start : stocke le code dans un buffer , ob_flush en bas de page pour afficher la page, cela 
// permet d'utilise header(location) librement dans le code

ob_start();
session_start();

include __DIR__ . '/header.php';


?>

<div>

    <form method="POST">

        <div class="form-group">
            <h1>Connexion</h1>

            <label><b>Adresse e-mail</b></label>
            <input type="email" class="form-control" placeholder="Saisir adresse e-Mail" id="id_email" name="id_email">

            <label><b>Mot de passe</b></label>
            <input type="password" class="form-control" placeholder="Saisir le mot de passe" id="password"
                name="password">

            <input type="submit" id='submit' class="btn btn-primary" name="action" value='Se Connecter'>

        </div>
    </form>
    <?php
    // var_dump(realpath(__FILE__));
    include 'C:\xampp\htdocs\09-Login-PHP\src\bdd.php';


    if (!empty($_POST['action'])) {
        if (empty($_POST['id_email'])) {
            echo "<p style='color:red'>Saisir le Nom Utilisateur</p>";

        } else if (empty($_POST['password'])) {
            echo "<p style='color:red'>Saisir le Mot de Passe</p>";

        } else {
            //echo "controler existence";
            //print_r($_POST['id_email'] . " => " . $_POST['password'] . "<br>");
            ControleExistence(htmlspecialchars(strip_tags($_POST['id_email'])), htmlspecialchars(strip_tags($_POST['password'])));
        }

    }



    function ControleExistence($par_user, $par_mdp)
    {

        $req_ctrl = getConnection()->prepare("SELECT id_user,id_email,id_pwd,id_nom,id_prenom FROM users WHERE UPPER(id_email)=UPPER(:id_email)");
        $req_ctrl->bindValue(':id_email', $_POST['id_email']);
        $req_ctrl->execute();

        if ($entries = $req_ctrl->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($entries);
    
            if ($entries['id_pwd'] <> $_POST['password']) {
                echo "Mot de passe erroné";
                exit;
            } else {
                //echo "page connexion réussie";
                $_SESSION['_user'] = $entries['id_user'];
                $_SESSION['_email'] = $entries['id_email'];
                $_SESSION['_pwd'] = $entries['id_pwd'];
                $_SESSION['_nom'] = $entries['id_nom'];
                $_SESSION['_prenom'] = $entries['id_prenom'];
                //echo ($_SESSION['_user'] . ' ' . $_SESSION['_email'] . ' ');
                header("Location: /src/vues/connexion.php");
                exit;
            }
            ;

        } else { ?>
            <form method='POST' action='/src/vues/creation.php'>
                <h3 style='color : red'>Adresse Email Inconnue !</h3>
                <input type='submit' id='creation' name='new_user' value='Créer ?'>
            </form>
        <?php }
    }

    ?>

</div>


<?php

ob_flush();

include __DIR__ . '/footer.php'; ?>