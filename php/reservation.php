<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation1";

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = trim($_POST['nom']);
    $tel = trim($_POST['tel']);
    $email = trim($_POST['email']);
    $mdp = trim($_POST['mdp']);
    $localisation = trim($_POST['localisation']);
    $date = trim($_POST['date']);
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $services = isset($_POST['services']) ? implode(", ", $_POST['services']) : null;
    $modepaiement = trim($_POST['modepaiement']);
    $demandes = trim($_POST['demandes']);
    $id = isset($_POST['id']) ? ($_POST['id']) : null;

    if (empty($nom) || empty($tel) || empty($email) || empty($mdp) || empty($date)) {
        echo "Veuillez remplir tous les champs obligatoires.";
        exit;
    }

    // Étape 1 : Vérifier si l'email est déjà utilisé pour une réservation
    $email = htmlspecialchars($email);
    $sql = "SELECT 1 FROM reservations WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Cet email est déjà utilisé pour une réservation. Veuillez utiliser un autre email.";
        exit;
    }

    // Étape 2 : Vérifier si le client est inscrit avec les informations fournies
    $email = htmlspecialchars($email);
    $mdp = htmlspecialchars($mdp);

    $sql = "SELECT * FROM inscription WHERE email = '$email' AND mdp = '$mdp'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        echo "Veuillez d'abord vous inscrire.";
        exit;
    }

    // Étape 3 : Vérifier si la salle est déjà réservée pour cette date
    $date = $conn->real_escape_string($date);
    $localisation = $conn->real_escape_string($localisation);
    $email = $conn->real_escape_string($email);

    $sql = "SELECT id FROM reservations WHERE `date` = '$date' AND localisation = '$localisation' AND email != '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
            echo "La salle est déjà réservée pour cette date.";
    exit;
    }


    // Étape 4 : Insérer la réservation si tout est valide
    $nom = htmlspecialchars($nom);
    $tel = htmlspecialchars($tel);
    $email = htmlspecialchars($email);
    $mdp = htmlspecialchars($mdp);
    $localisation = htmlspecialchars($localisation);
    $date = htmlspecialchars($date);
    $nombre = htmlspecialchars($nombre);
    $services = htmlspecialchars($services);
    $modepaiement = htmlspecialchars($modepaiement);
    $demandes = htmlspecialchars($demandes);

    $sql = "INSERT INTO reservations (nom, tel, email, mdp, localisation, `date`, nombre, services, modepaiement, demandes) 
        VALUES ('$nom', '$tel', '$email', '$mdp', '$localisation', '$date', '$nombre', '$services', '$modepaiement', '$demandes')";

    if ($conn->query($sql)) {
        header("Location: affichereservation.php");
        exit;
    } else {
        echo "Erreur lors de la réservation : " . $conn->error;
    }
}

$conn->close();
?>
