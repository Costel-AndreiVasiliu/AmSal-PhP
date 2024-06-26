<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'contabil') {
    redirect("admin_dashboard.php");
}
check_access(basename(__FILE__));

include 'header_contabil.php';

// Preluăm toate ajutoarele contabili din baza de date
$sql = "SELECT a.id, an.nume, an.prenume, a.tip_job 
        FROM ajutor_contabili a 
        JOIN angajati an ON a.angajat_id = an.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Ajutoare Contabili</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12">
                <h1>Lista Ajutoare Contabili</h1>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-info">
                        <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                        ?>
                    </div>
                <?php endif; ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nume</th>
                            <th>Prenume</th>
                            <th>Tip Job</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nume']); ?></td>
                                <td><?php echo htmlspecialchars($row['prenume']); ?></td>
                                <td><?php echo htmlspecialchars($row['tip_job']); ?></td>
                                <td>
                                    <a href="contabil_editare_ajutor.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editează</a>
                                    <a href="contabil_stergere_ajutor.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest ajutor contabil?');">Șterge</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a href="contabil_ajutor_contabili.php" class="btn btn-primary">Înapoi</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
$conn->close();
?>
