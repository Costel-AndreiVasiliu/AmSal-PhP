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
              require_once("conectare.php");
              $menu_items = [
                'contabil_dashboard.php' => 'Dashboard',
                'contabil_pontaj.php' => 'Pontaj',
                'contabil_ajutor_contabili.php' => 'Ajutor contabili',
                'contabil_account_settings.php' => 'Account Settings'
              ];
              foreach ($menu_items as $page => $name) {
                echo '<li class="nav-item"><a class="nav-link" href="' . $page . '">' . $name . '</a></li>';
              }
            ?>
          </ul>
        </div>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
    </nav>
  </body>
</html>
