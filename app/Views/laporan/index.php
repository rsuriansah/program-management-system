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
        <div class="row row-deck row-cards">
            <div class="col-lg-12 col-md-12 d-flex flex-column">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan</h3>
                    </div>
                    <div class="table-responsive">
                        <?php if (!$empty) : ?>
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">ID</th>
                                    <th>Nama Program</th>
                                    <th>Tarikh Program</th>
                                    <th>Nama Pemohon</th>
                                    <th class="text-end">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($application as $value) : ?>
                                <?php 
                                $tarikhMula = date('d/m/Y', strtotime($value['tarikh_mula'])); 
                                $tarikhTamat = date('d/m/Y', strtotime($value['tarikh_tamat']));
                                $matchingReport = null;
                                foreach ($report as $r) {
                                    if ($r['id_permohonan'] === $value['id_permohonan']) {
                                        $matchingReport = $r;
                                        break;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><span class="text-secondary">#<?= $value['id_permohonan']; ?></span></td>
                                    <td><?= $value['nama_program']; ?></td>
                                    <td><?= $tarikhMula.' - '.$tarikhTamat;; ?></td>
                                    <td><?= esc($value['nama_pemohon']) ?></td>
                                    <td class="text-end">
                                        <?php if (!auth()->user()->inGroup('superadmin', 'admin')) : ?>
                                        <button class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#uploadFiles<?= $value['id_permohonan']; ?>"
                                            title="Muat naik">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                <path d="M7 9l5 -5l5 5" />
                                                <path d="M12 4l0 12" />
                                            </svg>
                                        </button>
                                        <?php endif; ?>
                                        <button class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#viewFiles<?= $value['id_permohonan']; ?>" title="Papar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Upload Laporan -->
                                <div class="modal modal-blur fade" id="uploadFiles<?= $value['id_permohonan']; ?>"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('report') ?>" method="post"
                                                    enctype="multipart/form-data">
                                                    <?= csrf_field() ?>
                                                    <?php $validation = \Config\Services::validation(); ?>
                                                    <input type="hidden" name="id_permohonan"
                                                        value="<?= esc($value['id_permohonan']) ?>">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Nama Program</label>
                                                        <?= $value['nama_program'] ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gambar_program">Gambar
                                                            Program</label>
                                                        <div>
                                                            <input type="text" name="gambar_program"
                                                                class="form-control"
                                                                placeholder="Masukkan URL Google Drive (https://drive.google.com)"
                                                                required>
                                                            <small class="form-hint">Gambar program mestilah dimuat naik
                                                                ke Google Drive.</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="laporan_program">Laporan
                                                            Program</label>
                                                        <?= form_upload([
                                                            'name'    => 'laporan_program',
                                                            'id'      => 'laporan_program',
                                                            'required'=> 'required',
                                                            'accept'  => '.pdf',
                                                            'class'   => 'form-control ' . (isset($validation) && $validation->getError('laporan_program') ? 'is-invalid' : ''),
                                                        ]); ?>
                                                        <small class="form-hint">Jenis fail: pdf. Maksimum saiz:
                                                            10MB.</small>
                                                        <div class="invalid-feedback">
                                                            <?= $errors['laporan_program'] ?? ''; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="laporan_kewangan">Laporan
                                                            Kewangan</label>
                                                        <?= form_upload([
                                                            'name'    => 'laporan_kewangan',
                                                            'id'      => 'laporan_kewangan',
                                                            'required'=> 'required',
                                                            'accept'  => '.pdf',
                                                            'class'   => 'form-control ' . (isset($validation) && $validation->getError('laporan_kewangan') ? 'is-invalid' : ''),
                                                        ]); ?>
                                                        <small class="form-hint">Jenis fail: pdf. Maksimum saiz:
                                                            10MB.</small>
                                                        <div class="invalid-feedback">
                                                            <?= $errors['laporan_kewangan'] ?? ''; ?>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link link-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <?php
                                                    $data = array(
                                                        'class'       => 'btn btn-primary',
                                                        'name'        => 'uploadLaporan', 
                                                        'id'          => 'uploadLaporan',
                                                        'value'       => 'Simpan'
                                                    );
                                                    echo form_submit($data);
                                                ?>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Lihat Laporan -->
                                <div class="modal modal-blur fade" id="viewFiles<?= $value['id_permohonan']; ?>"
                                    tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Nama Program</label>
                                                    <?= $value['nama_program'] ?>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="gambar_program">Gambar
                                                        Program</label>
                                                    <div class="list-inline-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="text-secondary icon icon-tabler icons-tabler-outline icon-tabler-brand-google-drive">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 10l-6 10l-3 -5l6 -10z" />
                                                            <path d="M9 15h12l-3 5h-12" />
                                                            <path d="M15 15l-6 -10h6l6 10z" />
                                                        </svg>
                                                        <a href="<?= $matchingReport ? esc($matchingReport['gambar_program']) : '/'; ?>"
                                                            class="text-black" target="_blank">
                                                            Google Drive</a>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Dokumen</label>
                                                    <div class="list-inline-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="text-secondary icon icon-tabler icons-tabler-outline icon-tabler-file">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                            <path
                                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                        </svg>
                                                        <a class="text-black"
                                                            href="<?= base_url('uploads/laporan/'.$value['id_permohonan']) ?>/laporan_program.pdf">
                                                            laporan_program.pdf</a>
                                                    </div>
                                                    <div class="list-inline-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="text-secondary icon icon-tabler icons-tabler-outline icon-tabler-file">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                            <path
                                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                        </svg>
                                                        <a class="text-black"
                                                            href="<?= base_url('uploads/laporan/'.$value['id_permohonan']) ?>/laporan_kewangan.pdf">
                                                            laporan_kewangan.pdf</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link link-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <?= $pager->links('permohonan', 'pagination') ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else : ?>
        <div class="empty">
            <p class="empty-title">Tiada permohonan</p>
            <p class="empty-subtitle text-secondary">
                Sila buat permohonan terlebih dahulu.
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>