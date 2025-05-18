<?php 
$context = $ctx ?? '/';

// Split the string into an array of words
$userFullName = auth()->user()->full_name;
$nameParts = explode(' ', $userFullName);

// Check if there are at least two parts (first and second names)
if (count($nameParts) >= 2) {
    // Get the first character of the first and second strings
    $initials = strtoupper($nameParts[0][0]) . strtoupper($nameParts[1][0]);
} else {
    $initials = strtoupper($nameParts[0][0]);
}
?>
<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="<?= base_url('static/logo-uthm.png'); ?>" width="110" height="32" alt="UTHM"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <?php if (empty(auth()->user()->picture)) : ?>
                    <span class="avatar avatar-sm"><?= $initials ?></span>
                    <?php else : ?>
                    <span class="avatar avatar-sm"
                        style="background-image: url(/uploads/user-images/<?= auth()->user()->picture ?>)"></span>
                    <?php endif; ?>
                    <div class="d-none d-xl-block ps-2">
                        <div><?= auth()->user()->username; ?></div>
                        <div class="mt-1 small text-secondary">
                            <?= auth()->user()->inGroup('superadmin', 'admin') == true ? 'Admin' : 'Pengguna'; ?>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="<?= base_url('profile'); ?>" class="dropdown-item">Akaun</a>
                    <a href="#!" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">Log keluar</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <div class="text-center py-2 d-none d-lg-block">
                <div class="mb-2">
                    <?php if (empty(auth()->user()->picture)) : ?>
                    <span class="avatar avatar-lg"><?= $initials ?></span>
                    <?php else : ?>
                    <span class="avatar avatar-lg"
                        style="background-image: url(/uploads/user-images/<?= auth()->user()->picture ?>)"></span>
                    <?php endif; ?>
                </div>
                <span class="fw-bold"><?= auth()->user()->username ?></span>
                <span
                    class="text-secondary"><?= auth()->user()->inGroup('admin', 'superadmin') ? '(admin)':'(pengguna)' ?>
                </span>
            </div>
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item <?= $context == 'utama' ? 'active' : ''; ?>">
                    <a class="nav-link" href="/">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title <?= $context == 'utama' ? 'fw-bold' : ''; ?>">
                            Utama
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= $context == 'permohonan' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('application'); ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            </svg>
                        </span>
                        <span class="nav-link-title <?= $context == 'permohonan' ? 'fw-bold' : ''; ?>">
                            Permohonan
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= $context == 'laporan' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('report'); ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-data">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path
                                    d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M9 17v-4" />
                                <path d="M12 17v-1" />
                                <path d="M15 17v-2" />
                                <path d="M12 17v-1" />
                            </svg>
                        </span>
                        <span class="nav-link-title <?= $context == 'laporan' ? 'fw-bold' : ''; ?>">
                            Laporan
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= $context == 'pengguna' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= base_url('profile'); ?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <span class="nav-link-title <?= $context == 'pengguna' ? 'fw-bold' : ''; ?>">
                            Akaun
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#logout">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Log keluar
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

<div class="modal modal-blur fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Log keluar</div>
                <div>Adakah anda pasti ingin log keluar?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <a href="<?= url_to('logout'); ?>" class="btn btn-danger">Ya, saya pasti</a>
            </div>
        </div>
    </div>
</div>