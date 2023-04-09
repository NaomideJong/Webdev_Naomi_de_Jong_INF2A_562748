<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTG Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script>
</head>
<body class="dark-mode">
<nav class="navbar navbar-dark navbar-expand-md bg-dark bg-gradient">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            <span class="magic">MTG Checker</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navcol-1" class="collapse navbar-collapse d-md-flex justify-content-md-end">
            <ul class="navbar-nav">
                <li class="nav-item m-2"><a class="nav-link active" href="/home">Home</a></li>
                <li class="nav-item m-2"><a class="nav-link" href="/compare">Compare</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item dropdown m-2">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown">Account</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/account">My Decks</a>
                            <a class="dropdown-item" href="/logout">Log out</a>
                        </div>
                    </li>
                <?php else: ?>
                <li class="nav-item m-2"><a class="nav-link" href="/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">