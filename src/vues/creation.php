<?php
ob_start();
?>

<form method="POST">

    <div class="form-group">
        <h1>Inscription</h1>

        <label><b>Adresse e-mail</b></label>
        <input type="text" placeholder="Saisir adresse e-Mail" id="email" name="email" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Saisir le mot de passe" id="passwd" name="password" required>

        <label><b>Nom</b></label>
        <input type="text" placeholder="Saisir votre nom" id="nom" name="nom" required>

        <label><b>Prénom</b></label>
        <input type="text" placeholder="Saisir votre prénom" id="prenom" name="prenom" required>

        <input type="submit" id='submit' name="creation" value='Valider Création'>
</form>
<?php
require_once '../bdd.php';

if (!empty($_POST['creation'])) {

    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {

        /* controle existence email */
        $req_verif = getConnection()->prepare("SELECT 1 FROM users WHERE id_email = ? ");
        $req_verif->execute([$_POST['email']]);

        $retour = $req_verif->fetch();
        if ($retour) {
            echo "Adresse Déja Existante !";
        } else {
            try {
                $req_insert = getConnection()->prepare("INSERT INTO users (id_email,id_pwd,id_nom,id_prenom) VALUES ( :email , :passwd , :nom , :prenom) ");
                var_dump($req_insert);
                echo "<br>";
                $req_insert->execute([
                    ':email' => $_POST['email'],
                    ':passwd' => $_POST['password'],
                    ':nom' => $_POST['nom'],
                    ':prenom' => $_POST['prenom']
                ]);
                // var_dump($req_insert);
                // echo "<br>";

            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ;
            echo "Utilisateur Créé avec Succès...et difficultés...";
            sleep(2);
            header("Location: /src/vues/home.php");


        }
    }

}

ob_flush();
?>