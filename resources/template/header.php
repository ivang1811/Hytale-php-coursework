<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
 
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hytale</title>
    <!-- Bootstrap CSS import -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./css/header.css" />
  </head>
 
<body>
<header>
      <nav
        class="navbar nav-bg navbar-expand-lg navbar-light background-colour"
      >
        <a class="navbar-brand" href="#">Hytale Servers</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="./"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
              <li class="nav-item">
                <a class="nav-link" href="./logout.php">Logout</a>
              </li>
              <li class="nav-item">
                <a id="dashboard-link" class="nav-link" href="./dashboard.php" >Dashboard</a>
              </li>
            <?php else : ?>

              <li class="nav-item">
                <a class="nav-link" href="./login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./register.php">Register</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </nav>

      <div class="jumbotron background-image"></div>
    </header>