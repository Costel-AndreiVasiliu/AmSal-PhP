<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}
check_access(basename(__FILE__));

include 'header_admin.php'; // Încărcăm header-ul specific pentru admin

// Preluăm toate firmele din baza de date
$sql = "SELECT * FROM firme";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lista Firme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>Admin - Vizualizare Lista Firme</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nume firma</th>
                    <th>CIF</th>
                    <th>Registru Comert</th>
                    <th>Forma juridica</th>
                    <th>Banca</th>
                    <th>IBAN</th>
                    <th>Adresa</th>
                    <th>Localitate</th>
                    <th>Judet</th>
                    <th>Tara</th>
                    <th>Capital social</th>
                    <th>Platitor TVA</th>
                    <th>Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nume']; ?></td>
                        <td><?php echo $row['cif']; ?></td>
                        <td><?php echo $row['reg_com']; ?></td>
                        <td><?php echo $row['forma_juridica']; ?></td>
                        <td><?php echo $row['banca']; ?></td>
                        <td><?php echo $row['iban']; ?></td>
                        <td><?php echo $row['adresa']; ?></td>
                        <td><?php echo $row['localitate']; ?></td>
                        <td><?php echo $row['judet']; ?></td>
                        <td><?php echo $row['tara']; ?></td>
                        <td><?php echo $row['capital_social']; ?></td>
                        <td><?php echo $row['platitor_tva']; ?></td>
                        <td>
                            <a href="editare_firma.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="stergere_firma.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Esti sigur ca vrei sa stergi aceasta firma?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
