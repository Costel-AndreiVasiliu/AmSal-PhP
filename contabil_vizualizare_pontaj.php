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

$nume_luna = '';
$sql = "SELECT * FROM pontaj";
if (isset($_POST['nume_luna'])) {
    $nume_luna = htmlspecialchars($_POST['nume_luna']);
    $sql .= " WHERE nume_luna = ?";
}

$stmt = $conn->prepare($sql);
if (!empty($nume_luna)) {
    $stmt->bind_param("s", $nume_luna);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezultate Pontaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12">
                <h1>Rezultate Pontaj</h1>
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
                            <th>Nume Luna</th>
                            <th>Total Ore Lucratoare</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nume_luna']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_ore_lucratoare']); ?></td>
                                <td>
                                    <a href="contabil_editare_pontaj.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editează</a>
                                    <a href="contabil_stergere_pontaj.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi această lună de pontaj?');">Șterge</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a href="contabil_pontaj.php" class="btn btn-primary">Înapoi la Pontaj</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
