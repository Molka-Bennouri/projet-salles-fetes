<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation1";

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nom = htmlspecialchars($_POST['nom']);
    $numero = htmlspecialchars($_POST['numero']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);


    // Validation de l'email
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if(!preg_match($regex,$email)) {
        die("Adresse email invalide.");
    } else {
        $sql = "INSERT INTO contact (nom, numero, email, message) VALUES ('$nom', '$numero', '$email', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo "Message Envoyé avec succés!";}
        else {
            echo"Message non Envoyé";
        }
    }

}   

$conn->close();

?>