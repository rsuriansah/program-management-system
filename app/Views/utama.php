<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    <?= $pretitle ?>
                </div>
                <h2 class="page-title">
                    <?= $title ?>
                </h2>
            </div>
        </div>
    </div>
</div>

<?php if (session('message') !== null) : ?>
<div class="alert alert-success" role="alert"><?= session('message') ?></div>
<?php endif ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <div class="col-12">
                <div class="card card-md sticky-top">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-rocket">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
                                <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
                                <path d="M15 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">Permohonan Aktiviti Pelajar</h3>
                                <div class="markdown text-secondary">
                                    Pemohon diminta untuk memastikan senarai semak dokumen dipenuhi atau kertas kerja
                                    anda akan ditolak dan tidak akan diproses. Garis panduan permohonan aktiviti
                                    pelajar
                                    boleh dimuat turun <a
                                        href="https://sukan.uthm.edu.my/images/BORANG%20PERMOHONAN%20AKTIVITI%20PELAJAR%20DALAM%20NEGARA.pdf"
                                        target="_blank" rel="noopener">di sini</a>.
                                </div>
                                <div class="mt-3">
                                    <a href="<?= url_to('application') ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Permohonan Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>