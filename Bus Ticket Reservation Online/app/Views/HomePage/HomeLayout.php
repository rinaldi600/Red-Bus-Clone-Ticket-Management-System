<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/css/homePage.css" rel="stylesheet">

    <title><?= $title ?></title>
</head>
<body>

    <?= $this->include('HomePage/Navbar') ?>
    <?= $this->renderSection('content') ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/js/homePage.js"></script>
<script src="<?= base_url() ?>/js/JQuery.js"></script>
</body>
</html>
