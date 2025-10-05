<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);

    //Validation de l'email
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (!preg_match($regex, $email)) {
        echo "Adresse email invalide.";
    }

    //Vérifier si l'email existe
    $check_email = "SELECT * FROM inscription WHERE email = '$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "L'email est déjà enregistré.";
    } else {
        $sql = "INSERT INTO inscription (email, mdp) VALUES ('$email', '$mdp')";
        if ($conn->query($sql) === TRUE) {
            echo "Inscription effectuée avec succès. <br>
            Vous pouvez maintenant effectuer des reservations.";
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error; 
        }
    }
}

$conn->close();
?>
