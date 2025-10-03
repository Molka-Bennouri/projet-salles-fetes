<?php
echo "<link rel='stylesheet' type='text/css' href='affichereserv.css'>";
echo "<h1>Affichage de réservations</h1>";
echo "</br>";
$cnx = new PDO('mysql:host=localhost;dbname=reservation1;charset=utf8', 'root', '');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails existants de la réservation
    $query = $cnx->prepare("SELECT * FROM reservations WHERE id = ?"); 
    $query->execute([$id]);
    $res = $query->fetch(PDO::FETCH_ASSOC); // Retourner un tableau

    if ($res) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $tel = trim($_POST['tel']);
            $localisation = trim($_POST['localisation']);
            $date = trim($_POST['date']);
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
            $services = isset($_POST['services']) ? implode(", ", $_POST['services']) : null;
            $modepaiement = trim($_POST['modepaiement']);
            $demandes = trim($_POST['demandes']);

            // Mettre à jour les informations dans la base
            $update = $cnx->prepare("
                UPDATE reservations 
                SET nom = ?, tel = ?, `date` = ?, nombre = ?, services = ?, modepaiement = ?, demandes = ? 
                WHERE id = ?
            ");
            $update->execute([$nom, $tel, $date, $nombre, $services, $modepaiement, $demandes, $id]);

            echo "Réservation mise à jour avec succès.";
            echo "<a href='affichereservation.php'>Retour à la liste</a>";
            exit;
        }
        ?>
        <form action="" method="post">
            <h1>Modifier les informations de cette réservation</h1>

            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($res['nom'] ?? '') ?>" required /><br />

            <label for="tel">Numéro de téléphone</label>
            <input type="text" id="tel" name="tel" value="<?= htmlspecialchars($res['tel'] ?? '') ?>" required /><br />

            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="<?= htmlspecialchars($res['date'] ?? '') ?>" /><br />

            <label for="nombre">Nombre d'invités</label>
            <input type="number" id="nombre" name="nombre" value="<?= htmlspecialchars($res['nombre'] ?? '') ?>" /><br />

            <h3>Services Supplémentaires</h3>
            <div class="services">
                <label>
                    <input type="checkbox" name="services[]" value="Traiteur" <?= strpos($res['services'] ?? '', 'Traiteur') !== false ? 'checked' : '' ?> />
                    Traiteur
                </label><br />
                <label>
                    <input type="checkbox" name="services[]" value="Photographe" <?= strpos($res['services'] ?? '', 'Photographe') !== false ? 'checked' : '' ?> />
                    Photographe
                </label><br />
                <label>
                    <input type="checkbox" name="services[]" value="Orchestre" <?= strpos($res['services'] ?? '', 'Orchestre') !== false ? 'checked' : '' ?> />
                    Orchestre
                </label><br />
            </div>

            <h3>Mode de Paiement</h3>
            <label>
                <input type="radio" name="modepaiement" value="carte de crédit" <?= $res['modepaiement'] === 'carte de crédit' ? 'checked' : '' ?> /> Carte de crédit
            </label>
            <label>
                <input type="radio" name="modepaiement" value="espèces" <?= $res['modepaiement'] === 'espèces' ? 'checked' : '' ?> /> Espèces
            </label>

            <h3>Demandes Particulières</h3>
            <textarea name="demandes" rows="5" cols="30" placeholder="Indiquez vos besoins spécifiques ici.."><?= htmlspecialchars($res['demandes'] ?? '') ?></textarea><br />

            <button type="submit">Mettre à jour</button>
        </form>
        <?php
    } else {
        echo "Réservation introuvable.";
    }
} else {
    echo "Identifiant de réservation manquant.";
}
?>
