<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<?php
// Tukar warna untuk setiap status
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

// Convert the dates into DateTime objects
$startDate = new DateTime($value['tarikh_mula']);
$endDate = new DateTime($value['tarikh_tamat']);

// Calculate the difference
$interval = $startDate->diff($endDate);

// Get the number of days (including start and end dates)
$days = $interval->days + 1;

// Format tarikh
$TarikhMula = date('d/m/Y', strtotime($value['tarikh_mula']));
$TarikhTamat = date('d/m/Y', strtotime($value['tarikh_tamat']));

// Split the string into an array of words
$fullName = explode(' ', $value['nama_pemohon']);

// Check if there are at least two parts (first and second names)
if (count($fullName) >= 2) {
// Get the first character of the first and second strings
$initials = strtoupper($fullName[0][0]) . strtoupper($fullName[1][0]);
} else {
$initials = strtoupper($fullName[0][0]);
}
?>
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
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="<?= base_url('application'); ?>" class="btn d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Kembali ke Permohonan
                    </a>
                    <a href="<?= base_url('application'); ?>" class="btn d-sm-none btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
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
    <?php if (session()->getFlashdata('success')) : ?>
    <div class="pb-2 px-3">
        <div class="alert alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <?= session()->getFlashdata('success') ?>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    </div>
    <?php endif; ?>
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <!-- Status Permohonan -->
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Status</div>
                                <div class="datagrid-content">
                                    <span class="status <?= $statusColor; ?>">
                                        <?= $value['status_name']; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Tarikh Hantar</div>
                                <div class="datagrid-content">
                                    <?= date('d/m/Y H:i:s', strtotime($value['created_at'])); ?>
                                </div>
                            </div>
                            <div class="datagrid-item d-lg-block d-none"></div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Komen</div>
                                <div class="datagrid-content">
                                    <?= $value['komen'] ? $value['komen'] : 'Permohonan diterima.'; ?>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Tarikh Semakan</div>
                                <div class="datagrid-content">
                                    <?= $value['reviewed_at'] ? date('d/m/Y H:i:s', strtotime($value['reviewed_at'])) : 'Belum disemak.'; ?>
                                </div>
                            </div>
                            <div class="datagrid-item d-lg-block d-none"></div>
                        </div>
                    </div>
                    <!-- Detail Permohonan -->
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nama Program</div>
                                <div class="datagrid-content"><?= $value['nama_program']; ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Tarikh Program</div>
                                <div class="datagrid-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="text-secondary icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                    <?= $TarikhMula; ?> - <?= $TarikhTamat; ?>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Lokasi Program</div>
                                <div class="datagrid-content">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="text-secondary me-1 icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path
                                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                        </svg>
                                        <?= $value['lokasi_program']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Tempoh Program</div>
                                <div class="datagrid-content">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="text-secondary me-1 icon icon-tabler icons-tabler-outline icon-tabler-clock">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 7v5l3 3" />
                                        </svg>
                                        <?= $days.' hari'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Jumlah Peruntukan</div>
                                <div class="datagrid-content">
                                    <div class="d-flex align-items-center">
                                        RM<?= $value['peruntukan']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nama Pemohon</div>
                                <div class="datagrid-content">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-xs me-2 rounded"><?= $initials; ?></span>
                                        <?= $value['nama_pemohon']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nombor Matrik</div>
                                <div class="datagrid-content"><?= $value['no_matrik'] ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nama Kelab</div>
                                <div class="datagrid-content"><?= $value['nama_kelab'] ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Jawatan</div>
                                <div class="datagrid-content"><?= $value['jawatan'] ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Fakulti</div>
                                <div class="datagrid-content"><?= $value['fakulti'] ?></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Nombor Telefon</div>
                                <div class="datagrid-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="text-secondary icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                    </svg>
                                    <?= $value['no_telefon'] ?>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Kertas Kerja</div>
                                <div class="datagrid-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="text-secondary icon icon-tabler icons-tabler-outline icon-tabler-file">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    </svg>
                                    <a class="text-black"
                                        href="<?= base_url('uploads/permohonan/') . $value['kertas_kerja']; ?>">
                                        <?= $value['kertas_kerja']; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-list">
                            <?php if (!auth()->user()->inGroup('superadmin', 'admin')) : ?>
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete">Batal Permohonan</button>
                            <?php else : ?>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update-status">
                                Kemaskini Status
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Permohonan -->
<div class="modal modal-blur fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Buang permohonan?</div>
                <div>Jika anda teruskan, anda harus membuat permohonan baru.</div>
            </div>
            <?= form_open(base_url('application/delete/' . $value['id_permohonan'])); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Tutup</button>
                <?php
                    $data = array(
                        'class'       => 'btn btn-danger',
                        'name'        => 'delete_permohonan', 
                        'id'          => $value['id_permohonan'],
                        'value'       => 'Ya, buang permohonan.'
                    );
                    echo form_submit($data);
                ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kemaskini Status -->
<div class="modal modal-blur fade" id="update-status" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kemaskini Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open('application/detail/' . $value['id_permohonan']); ?>
                <?= csrf_field() ?>
                <input type="hidden" name="id_permohonan" value="<?= esc($value['id_permohonan']) ?>">
                <input type="hidden" name="reviewed_at" value="<?= date('Y-m-d H:i:s') ?>">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status_id">
                            <?php foreach ($status_name as $status) : ?>
                            <option value="<?= esc($status['id']) ?>"
                                <?= ($status['id'] == $value['status_id']) ? 'selected' : '' ?>>
                                <?= esc($status['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div>
                        <label class="form-label">Komen</label>
                        <textarea name="komen" class="form-control" rows="3"><?= $value['komen']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Tutup</button>
                <?php
                    $data = array(
                        'class'       => 'btn btn-success ms-auto',
                        'name'        => 'update_status', 
                        'id'          => 'update_status',
                        'value'       => 'Simpan'
                    );
                    echo form_submit($data);
                ?>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
// @formatter:off
document.addEventListener("DOMContentLoaded", function() {
    const dateInputs = document.querySelectorAll('.datepicker');

    dateInputs.forEach(input => {
        window.Litepicker && (new Litepicker({
            element: input,
            buttonText: {
                previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
    });
});
// @formatter:on
</script>
<?= $this->endSection() ?>