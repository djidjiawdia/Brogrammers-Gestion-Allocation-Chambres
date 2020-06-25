<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Allocation</title>

    <link rel="stylesheet" href="<?= ROOT ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/public/css/style.css">
    
</head>
<body>
    <div class="main">
        <div class="btn-menu">
            <span><i class="fas fa-bars"></i></span>
        </div>
        <div class="menu">
            <div class="brand">
                Gestion d'allocation des chambres
            </div>
            <ul>
                <li class="active"><a href="<?= ROOT ?>/etudiant">Liste des étudiants</a></li>
                <li><a href="<?= ROOT ?>/chambre">Liste des chambres</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="title">
                <?= $title ?>
            </div>
            <div class="wrapper m-3">
                <?= $content_for_layout ?>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/public/js/all.min.js"></script>
    <script src="<?= ROOT ?>/public/js/bootstarp.min.js"></script>
    <script src="<?= ROOT ?>/public/js/jquery-3.4.1.min.js"></script>
    <script src="<?= ROOT ?>/public/js/script.js"></script>
</body>
</html>