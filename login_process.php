<?php
require_once("conectare.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT id, name, password, tip_user_id FROM useri WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = ($user['tip_user_id'] == 1) ? 'admin' : 'contabil';

        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: contabil_dashboard.php");
        }
        exit();
    } else {
        $_SESSION['message'] = "Invalid email or password";
        header("Location: login.php");
        exit();
    }
}
?>
