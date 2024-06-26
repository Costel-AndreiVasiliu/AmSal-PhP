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

// Preluăm toți angajații din baza de date
$sql = "SELECT * FROM angajati";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lista Angajati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>Admin - Vizualizare Lista Angajati</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Numar Telefon</th>
                    <th>Email</th>
                    <th>Functie</th>
                    <th>Salariu</th>
                    <th>Buletin</th>
                    <th>CNP</th>
                    <th>Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nume']; ?></td>
                        <td><?php echo $row['prenume']; ?></td>
                        
                        <td><?php echo $row['numar_telefon']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['functie']; ?></td>
                        <td><?php echo $row['salariu']; ?></td>
                        <td><a href="<?php echo $row['buletin']; ?>" target="_blank">Vezi</a></td>
                        <td><?php echo $row['cnp']; ?></td>
                        <td>
                            <a href="editare_angajat.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="stergere_angajat.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Esti sigur ca vrei sa stergi acest angajat?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
