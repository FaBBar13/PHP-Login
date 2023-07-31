<?php
// Aymeric : stocke le html ds un buffer et à la fin du code , mettre ob_flush() pour la chasse d'eau du buffer vers la page
// permet d'utilise header(location) librement
ob_start();

include __DIR__ . '/header.php';

//echo "ICI ET LA !!" 


?>

<div>

    <form method="POST">

        <div class="form-group">
            <h1>Connexion</h1>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" id="username" name="username">

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" id="password" name="password">

            <input type="submit" id='submit' name="action" value='Se Connecter'>
    </form>
    <?php

    if (!empty($_POST['action'])) {
        if (empty($_POST['username'])) {
            echo "<p style='color:red'>Saisir le Nom Utilisateur</p>";

        } else if (empty($_POST['password'])) {
            echo "<p style='color:red'>Saisir le Mot de Passe</p>";

        } else {
            echo "controler existence";
        }
        ;
    }
    ;
    $res = '';
    function ControleExistence($par_user, $par_mdp)
    {

        $req_ctrl = getConnection()->prepare("SELECT id_user,id_email,id_nom,id_prenom FROM users WHERE id_nom=:id_nom ORDER BY 1");
        $req_ctrl->bindValue(':id_nom', $_POST['username']);
        $req_ctrl->execute();

        $res = $req_ctrl->fetchAll(PDO::FETCH_ASSOC);
        var_dump($res);
    }
    ;


    ?>


</div>


<?php

ob_flush();

include __DIR__ . '/footer.php'; ?>