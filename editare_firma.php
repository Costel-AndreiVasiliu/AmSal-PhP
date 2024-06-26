<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM firme WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $firma = $result->fetch_assoc();
    $stmt->close();
} else {
    $_SESSION['message'] = "ID-ul firmei nu a fost specificat.";
    header("Location: admin_vizualizare_firme_lista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Firma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header_admin.php'; // Încărcăm header-ul specific pentru admin ?>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>Editare Firma</h1>
        <div class="row">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-center">Edit Company</h5>
                  <form action="procesare_editare_firma.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $firma['id']; ?>">
                    <div class="container_1">
                      <div class="row justify-content-center">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h3 class="small">Company's Name</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="Company" value="<?php echo $firma['nume']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <p></p>
                    <div class="container_1">
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group">
                            <h3 class="small">CIF</h3>
                            <input type="text" class="form-control" placeholder="RO########" name="CIF" pattern="RO\d{8}" title="Enter a valid CIF starting with RO and followed by 8 digits." value="<?php echo $firma['cif']; ?>">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <h3 class="small">Trade Reg</h3>
                            <input type="text" class="form-control" placeholder="J/C/F##/####/####" name="Register" pattern="[JCF]\d{2}/\d{4}/\d{4}" title="Enter a valid TradeReg starting with J, C or F followed by 11 digits." value="<?php echo $firma['reg_com']; ?>">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <h3 class="small" for="legal_form">Legal Form:</h3>
                            <select class="form-control" id="legal_form" name="Legal_form">
                              <option value="PFA" disabled>Choose the legal form</option>
                              <option value="SRL" <?php if ($firma['forma_juridica'] == 'SRL') echo 'selected'; ?>>SRL</option>
                              <option value="PFA" <?php if ($firma['forma_juridica'] == 'PFA') echo 'selected'; ?>>PFA</option>
                              <option value="II" <?php if ($firma['forma_juridica'] == 'II') echo 'selected'; ?>>II</option>
                              <option value="IF" <?php if ($firma['forma_juridica'] == 'IF') echo 'selected'; ?>>IF</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p></p>
                    <div class="container_1">
                      <div class="row justify-content-center">
                        <div class="col-md-5">
                          <div class="form-group">
                            <h3 class="small">Bank</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="Bank" value="<?php echo $firma['banca']; ?>">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <h3 class="small">IBAN</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="IBAN" value="<?php echo $firma['iban']; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <p></p>
                    <div class="container_1">
                      <div class="row justify-content-center">
                        <div class="col-md-5">
                          <div class="form-group">
                            <h3 class="small">Address</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="Address" value="<?php echo $firma['adresa']; ?>">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <h3 class="small">Locality</h3>
                            <input type="text" class="form-control" placeholder="Fill in here" name="Locality" value="<?php echo $firma['localitate']; ?>">
                          </div>
                        </div>
                      </div>
                      <p></p>
                      <div class="container_1">
                        <div class="row justify-content-center">
                          <div class="col-md-5">
                            <div class="form-group">
                              <h3 class="small">County</h3>
                              <input type="text" class="form-control" placeholder="Fill in here" name="County" value="<?php echo $firma['judet']; ?>">
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <h3 class="small">Country</h3>
                              <input type="text" class="form-control" placeholder="Fill in here" name="Country" value="<?php echo $firma['tara']; ?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <p></p>
                      <div class="container_1">
                        <div class="row justify-content-center">
                          <div class="col-md-5">
                            <div class="form-group">
                              <h3 class="small">Social Capital</h3>
                              <input type="text" class="form-control" placeholder="Fill in here" name="Social" value="<?php echo $firma['capital_social']; ?>">
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <h3 class="small">VAT payer?</h3>
                              <select class="form-control" name="VAT_Payer">
                                <option value="Yes" <?php if ($firma['platitor_tva'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                <option value="No" <?php if ($firma['platitor_tva'] == 'No') echo 'selected'; ?>>No</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <p></p>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary">Editeaza firma</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
