<?php
require_once("conectare.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AmSal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./img/logo_jpeg.jpeg" alt="Logo" height="70">
            </a>
            <a class="navbar-brand" href="#">AmSal</a>
            <div class="collapse navbar-collapse justify-content-center" id="navbarsExample07">
                <ul class="navbar-nav">
                    <?php
                    $admin_pages = array('admin_dashboard.php', 'admin_angajati.php', 'admin_contabili.php', 'admin_functii.php', 'admin_firme.php', 'admin_account_settings.php');
                    $sql_menu = "SELECT * FROM pagini WHERE meniu = 1 AND pagina IN ('" . implode("','", $admin_pages) . "') ORDER BY FIELD(pagina, 'admin_dashboard.php', 'admin_angajati.php', 'admin_contabili.php', 'admin_functii.php', 'admin_firme.php', 'admin_account_settings.php')";
                    $result_menu = $conn->query($sql_menu);
                    while ($row = $result_menu->fetch_assoc()) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="' . $row['pagina'] . '">' . $row['nume_meniu'] . '</a>
                              </li>';
                    }
                    ?>
                </ul>
            </div>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>
