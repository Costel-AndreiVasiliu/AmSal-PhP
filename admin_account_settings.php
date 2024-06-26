<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

include 'header_admin.php'; // Încărcăm header-ul specific pentru admin

// Preluăm datele utilizatorului
$user_id = $_SESSION["user_id"];
$sql_user = "SELECT * FROM useri WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12"> <h1>Account Settings</h1></div>
        </div>
        <div class="row">
            <!-- <div class="col-md-6 mb-3"> -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">User</h5>
                        <h6 class="form-label text-center">Please complete all fields</h6>
                        <form action="procesare_account_settings_user.php" method="POST" class="ms-auto me-auto mt-3" style="max-width: 500px;">
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Password:</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password:</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
