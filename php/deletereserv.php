<?php
echo "<link rel='stylesheet' href='affichereserv.css'>";
echo "<h1>Supprime réservation</h1>";
echo "</br>";
$cnx = new PDO('mysql:host=localhost;dbname=reservation1;charset=utf8', 'root', '');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = $cnx->prepare("DELETE FROM reservations WHERE id = ?");
    $delete->execute([$id]);
    if ($delete->rowCount() > 0) {
        echo "reservation supprimé avec succès.";
    } else {
        echo "Aucun réservation trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant de réservation manquant.";
}

echo "<br><a href='affichereservation.php'>Retour à la liste</a>";
?>