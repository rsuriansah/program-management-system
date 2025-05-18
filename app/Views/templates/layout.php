<!DOCTYPE html>
<html lang="en">

<?= $this->include('templates/head') ?>

<body>
    <div class="page">
        <!-- Sidebar -->
        <?= $this->include('templates/sidebar') ?>
        <div class="page-wrapper">
            <!-- Page body -->
            <?= $this->renderSection('content') ?>
            <!-- Footer -->
            <?= $this->include('templates/footer') ?>
        </div>
    </div>
    <?= $this->include('templates/js'); ?>
</body>

</html>