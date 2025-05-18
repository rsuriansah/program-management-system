<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    <?= $pretitle; ?>
                </div>
                <h2 class="page-title">
                    <?= $title; ?>
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="<?= base_url('application/add'); ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Permohonan baru
                    </a>
                    <a href="<?= base_url('application/add'); ?>" class="btn btn-primary d-sm-none btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="page-body">
    <!-- Success Message -->
    <?php if (session()->getFlashdata('msg')) : ?>
    <div class="pb-2 px-3">
        <div class="alert alert-important alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <?= session()->getFlashdata('msg') ?>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    </div>
    <?php endif; ?>
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Senarai Permohonan</h3>
                    </div>
                    <?php if (!$empty) : ?>
                    <form action="" method="get">
                        <div class="d-none card-body border-bottom py-3">
                            <div class="input-group mb-2">
                                <input name="keyword" type="text" class="form-control"
                                    placeholder="Masukkan kata kunci permohonan...">
                                <button class="btn" name="submit" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="permohonan" class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Nama Program</th>
                                    <th>Tarikh Hantar</th>
                                    <th>Status</th>
                                    <th>Tarikh Semakan</th>
                                    <th class="text-end">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                                <?php foreach ($application as $value) : ?>
                                <?php
                                    switch ($value['status_id']) {
                                    case '1':
                                        $statusColor = 'status-default';
                                        break;
                                    case '2':
                                        $statusColor = 'status-blue';
                                        break;
                                    case '3':
                                        $statusColor = 'status-green';
                                        break;
                                    case '4':
                                        $statusColor = 'status-red';
                                        break;
                                    default:
                                        $statusColor = 'status-yellow';
                                        break;
                                    }
                                ?>
                                <tr>
                                    <td><span class="text-secondary"><?= $i++; ?></span></td>
                                    <td><?= $value['nama_program']; ?></td>
                                    <td>
                                        <?= date('d/m/Y H:i:s', strtotime($value['created_at'])); ?>
                                    </td>
                                    <td>
                                        <span class="status <?= $statusColor; ?>">
                                            <?= $value['status_name']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $value['reviewed_at'] ? date('d/m/Y H:i:s', strtotime($value['reviewed_at'])) : 'Belum disemak.'; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= base_url('application/detail/' . $value['id_permohonan']); ?>"
                                            type="button" class="btn btn-primary btn-icon" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Papar" id="<?= $value['id_permohonan']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <?= $pager->links('permohonan', 'pagination') ?>
                    </div>
                    <?php else : ?>
                    <div class="empty">
                        <p class="empty-title">Tiada permohonan</p>
                        <p class="empty-subtitle text-secondary">
                            Anda belum membuat apa-apa permohonan.
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>