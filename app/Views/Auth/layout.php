<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $this->renderSection('title') ?></title>
    <!-- CSS files -->
    <?= $this->include('templates/css'); ?>
</head>

<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="d-none text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                </a>
            </div>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <?= $this->include('templates/js'); ?>
</body>

</html>