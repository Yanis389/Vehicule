<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>Compte bancaire</title>
</head>
<body>

    <header class="bg-secondary p-4 mb-3">
        <?php if( isset($_SESSION['user']) ): ?>
            <?php if( unserialize($_SESSION['user'])->getRole() == "GERANT" ): ?>
                <!-- GERANT -->
                <a href="?action=client" class="btn btn-success">Gestion Clients</a>
                <a href="?action=compte" class="btn btn-success">Gestion Comptes</a>
            <?php endif; ?>
            <!-- CLIENT -->
            <a href="?action=compteClient" class="btn btn-success">Compte</a>
            <a href="?action=logout" class="btn btn-danger">Logout</a>
        <?php endif; ?>

        <?= isset($_SESSION["user"]) ? unserialize($_SESSION["user"])->getPrenom() : '' ?>

    </header>

    <main class="container-fluid"></main>