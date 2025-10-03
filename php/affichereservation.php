<?php
echo "<link rel='stylesheet' href='affichereserv.css'>";
echo "<h1> Affichage des réservations </h1>";
echo "</br>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservation1";

$conn = new mysqli($servername, $username, $password, $dbname); 

$req = "SELECT * FROM reservations";
$res = $conn->query($req);

echo "<table border='2'>";

echo " <tr>
        <th>Identifiant</th>
        <th>Nom</th>
        <th>Numéro téléphone</th>
        <th>Email</th>
        <th>Localisation</th>
        <th>Date de réservation</th>
        <th>Nombre d'invités</th>
        <th>Services</th>
        <th>Mode de paiment </th>
        <th>Demande</th>
    </tr> ";

while ($don = $res->fetch_assoc()) {
    echo "
    <tr>
        <td>{$don['id']}</td>
        <td>{$don['nom']}</td>
        <td>{$don['tel']}</td>
        <td>{$don['email']}</td>
        <td>{$don['localisation']}</td>
        <td>{$don['date']}</td>
        <td>{$don['nombre']}</td>
        <td>{$don['services']}</td>
        <td>{$don['modepaiement']}</td>
        <td>{$don['demandes']}</td>
        <td>
            <a href='updatereserv.php?id={$don['id']}'>Modifier</a>
            <a href='deletereserv.php?id={$don['id']}' onclick=\"return confirm('Voulez-vous vraiment supprimer cette réservation ?');\">Supprimer</a>
        </td>
    </tr>
    ";
}

echo "</table>";


?>
