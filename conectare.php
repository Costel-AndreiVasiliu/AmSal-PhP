<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
$conn = mysqli_connect("127.0.0.1", "root", "", "amsalc");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

require_once 'redirect.php';

function check_access($page) {
    global $conn;
    if (!isset($_SESSION['user_id'])) {
        redirect("index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Preluăm id-ul paginii din tabelul pagini
    $sql_page = "SELECT id FROM pagini WHERE pagina = ?";
    $stmt_page = $conn->prepare($sql_page);
    $stmt_page->bind_param("s", $page);
    $stmt_page->execute();
    $result_page = $stmt_page->get_result();
    $page_data = $result_page->fetch_assoc();
    $stmt_page->close();

    if ($page_data) {
        $page_id = $page_data['id'];

        // Verificăm dacă utilizatorul are acces la această pagină
        $sql_access = "SELECT * FROM drepturi WHERE IdPage = ? AND IdUser = ?";
        $stmt_access = $conn->prepare($sql_access);
        $stmt_access->bind_param("ii", $page_id, $user_id);
        $stmt_access->execute();
        $result_access = $stmt_access->get_result();
        $stmt_access->close();

        if ($result_access->num_rows == 0) {
            // Utilizatorul nu are acces la această pagină
            session_destroy();
            redirect("index.php");
            exit();
        }
    } else {
        // Pagina nu există în baza de date
        session_destroy();
        redirect("index.php");
        exit();
    }
}
?>
