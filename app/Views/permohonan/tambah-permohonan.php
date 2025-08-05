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

<!-- Section Navigation -->
<ul class="steps steps-counter mt-4">
    <li class="step-item active" id="step-program"></li>
    <li class="step-item" id="step-applicant"></li>
    <li class="step-item" id="step-document"></li>
    <li class="step-item" id="step-acknowledgement"></li>
</ul>

<!-- Page content -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            <?php if (session()->getFlashdata('error_message')): ?>
            <div>
                <div class="alert alert-danger alert-dismissible mb-0">
                    <?= session()->getFlashdata('error_message'); ?>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('msg')) : ?>
            <div>
                <div class="alert alert-success mb-0" role="alert">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            </div>
            <?php endif ?>

            <!-- Seksyen 1: Butiran Program -->
            <div class="form-section col-lg-12 col-md-12" id="section-program">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M11 15h1" />
                                        <path d="M12 15v3" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="card-title">Butiran Program</div>
                                <div class="card-subtitle"><em>Program Details</em></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php $validation = \Config\Services::validation(); ?>

                        <form id="applicationForm" action="<?= base_url('application/add') ?>" method="POST"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <!-- Nama Program -->
                            <div class="mb-3">
                                <label class="form-label required" for="nama_program">Nama
                                    Program</label>
                                <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ' . (isset($validation) && $validation->getError('nama_program') ? 'is-invalid' : ''),
                                        'name'        => 'nama_program',
                                        'id'          => 'nama_program',
                                        'value'       => old('nama_program') ?? $oldInput['nama_program'] ?? '',
                                        'required'    => 'required'
                                    );
                                    echo form_input($data); 
                                ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_program'); ?>
                                </div>
                            </div>

                            <!-- Lokasi Program -->
                            <div class="mb-3">
                                <label class="form-label required" for="lokasi_program">Lokasi
                                    Program</label>
                                <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ' . (isset($validation) && $validation->getError('lokasi_program') ? 'is-invalid' : ''),
                                        'name'        => 'lokasi_program',
                                        'id'          => 'lokasi_program',
                                        'value'       => old('lokasi_program') ?? $oldInput['lokasi_program'] ?? '',
                                        'required'    => 'required'
                                    );
                                    echo form_input($data); 
                                ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('lokasi_program') ?>
                                </div>
                            </div>

                            <!-- Nama Penganjur -->
                            <div class="mb-3">
                                <label class="form-label" for="penganjur">Nama Penganjur (jika
                                    ada)</label>
                                <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ',
                                        'name'        => 'penganjur',
                                        'id'          => 'penganjur',
                                        'value'       => old('penganjur') ?? $oldInput['penganjur'] ?? '',
                                    );
                                    echo form_input($data); 
                            ?>
                            </div>

                            <!-- Tarikh Program -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label required" for="tarikh_mula">Tarikh Mula Program</label>
                                    <div class="input-icon">
                                        <input id="tarikh_mula" name="tarikh_mula"
                                            class="form-control datepicker <?= (isset($validation) && $validation->getError('tarikh_mula') ? 'is-invalid' : ''); ?>"
                                            placeholder="Pilih tarikh mula"
                                            value="<?= old('tarikh_mula') ?? $oldInput['tarikh_mula']  ?? '' ?>"
                                            required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tarikh_mula') ?>
                                        </div>
                                        <span
                                            class="input-icon-addon <?= (isset($validation) && $validation->getError('tarikh_mula') ? 'd-none' : ''); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label required" for="tarikh_tamat">Tarikh Tamat Program</label>
                                    <div class="input-icon">
                                        <input id="tarikh_tamat" name="tarikh_tamat"
                                            class="form-control datepicker <?= (isset($validation) && $validation->getError('tarikh_tamat') ? 'is-invalid' : ''); ?>"
                                            placeholder="Pilih tarikh tamat"
                                            value="<?= old('tarikh_tamat') ?? $oldInput['tarikh_tamat']  ?? '' ?>"
                                            required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tarikh_tamat') ?>
                                        </div>
                                        <span
                                            class="input-icon-addon <?= $validation->hasError('tarikh_tamat') ? 'd-none' : ''; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Peruntukan -->
                            <div class="mb-3">
                                <label class="form-label required" for="peruntukan">Jumlah Peruntukan yang
                                    Dipohon (RM)</label>
                                <?php
                                    $data = array(
                                        'type'        => 'number',
                                        'class'       => 'form-control ' . (isset($validation) && $validation->getError('peruntukan') ? 'is-invalid' : ''),
                                        'name'        => 'peruntukan',
                                        'id'          => 'peruntukan',
                                        'value'       => old('peruntukan') ?? $oldInput['peruntukan'] ?? '',
                                        'required'    => 'required'
                                    );
                                    echo form_input($data); 
                                ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('peruntukan') ?>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary saveDraft">Simpan</button>
                        <button type="button" class="btn nextBtn">
                            Seterusnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-0 ms-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 6l6 6l-6 6" />
                            </svg>
                        </button>
                    </div> <!-- /card-footer -->
                </div>
            </div>

            <!-- Seksyen 2: Butiran Pemohon -->
            <div class="form-section d-none col-lg-12 col-md-12" id="section-applicant">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="card-title">Butiran Pemohon</div>
                                <div class="card-subtitle"><em>Applicant Details</em></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Nama Kelab -->
                        <div class="mb-3">
                            <label class="form-label required" for="nama_kelab">Nama
                                Pasukan/Kelab/Persatuan</label>
                            <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'name'        => 'nama_kelab',
                                        'id'          => 'nama_kelab',
                                        'class'       => 'form-control ' . (isset($validation) && $validation->getError('nama_kelab') ? 'is-invalid' : ''),
                                        'value'       => old('nama_kelab') ?? $oldInput['nama_kelab'] ?? '',
                                        'required'    => 'required'
                            );
                            echo form_input($data);
                            ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_kelab') ?>
                            </div>
                        </div>

                        <!-- Nama Pemohon -->
                        <div class="mb-3">
                            <label class="form-label required" for="nama_pemohon">Nama
                                Pemohon</label>
                            <?php
                                    $data = array(
                                        'required'    => 'required',
                                        'class'       => 'form-control',
                                        'name'        => 'nama_pemohon', 
                                        'id'          => 'nama_pemohon',
                                        'value'       => auth()->user()->full_name
                            );
                            echo form_input($data);
                            ?>
                        </div>

                        <!-- Nombor Matrik -->
                        <div class="mb-3">
                            <label class="form-label required" for="no_matrik">Nombor
                                Matrik</label>
                            <?php
                                    $data = array(
                                        'required'    => 'required',
                                        'class'       => 'form-control',
                                        'name'        => 'no_matrik', 
                                        'id'          => 'no_matrik',
                                        'value'       => auth()->user()->matric_no
                            );
                            echo form_input($data);
                            ?>
                        </div>

                        <!-- Jawatan -->
                        <div class="mb-3">
                            <label class="form-label required" for="jawatan">Jawatan</label>
                            <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'name'        => 'jawatan',
                                        'id'          => 'jawatan',
                                        'class'       => 'form-control ' . (isset($validation) && $validation->getError('jawatan') ? 'is-invalid' : ''),
                                        'value'       => old('jawatan') ?? $oldInput['jawatan'] ?? '',
                                        'placeholder' => 'Contoh: Pengerusi',
                                        'required'    => 'required'
                            );
                            echo form_input($data);
                            ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jawatan') ?>
                            </div>
                        </div>

                        <!-- Fakulti -->
                        <div class="mb-3">
                            <label class="form-label required" for="fakulti">Fakulti</label>
                            <select
                                class="form-select <?= (isset($validation) && $validation->getError('fakulti') ? 'is-invalid' : ''); ?>"
                                id="fakulti" name="fakulti">
                                <option value="">- Pilih -</option>
                                <?php foreach ($fakulti as $f) : ?>
                                <option value="<?= $f['fakulti']; ?>"
                                    <?= old('fakulti') ?? $oldInput['fakulti'] ?? '' == $f['fakulti'] ? 'selected' : ''; ?>>
                                    <?= $f['fakulti'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('fakulti') ?>
                            </div>
                        </div>

                        <!-- Nombor telefon -->
                        <div class="mb-3">
                            <label class="form-label required" for="no_telefon">Nombor
                                Telefon</label>
                            <?php
                                    $data = array(
                                        'required'    => 'required',
                                        'class'       => 'form-control',
                                        'name'        => 'no_telefon', 
                                        'id'          => 'no_telefon',
                                        'value'       => auth()->user()->phone
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn prevBtn float-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 6l-6 6l6 6" />
                            </svg>
                            Kembali
                        </button>
                        <button class="btn btn-primary saveDraft">Simpan</button>
                        <button type="button" class="btn nextBtn">
                            Seterusnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-0 ms-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 6l6 6l-6 6" />
                            </svg>
                        </button>
                    </div> <!-- /card-footer -->
                </div>
            </div>

            <!-- Seksyen 3: Dokumen yang Diperlukan -->
            <div class="form-section d-none col-lg-12 col-md-12" id="section-document">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-file">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="card-title">Dokumen yang Diperlukan</div>
                                <div class="card-subtitle"><em>Required Documents</em></div>
                            </div>
                        </div>
                    </div>

                    <!-- Kertas Kerja -->
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="custom-file-input form-label required" for="kertas_kerja">Kertas Kerja
                                Program</label>
                            <?= form_upload([
                                    'name'    => 'kertas_kerja',
                                    'id'      => 'kertas_kerja',
                                    'accept'  => '.pdf',
                                    'class'   => 'form-control ' . (isset($validation) && $validation->getError('kertas_kerja') ? 'is-invalid' : ''),
                                ]); ?>
                            <small class="form-hint">Format fail: PDF. Maksimum saiz: 10MB.</small>
                            <div class="invalid-feedback">
                                <?= isset($validation) ? $validation->getError('kertas_kerja') : ''; ?>
                            </div>
                        </div>
                        <a class="btn btn-pill btn-sm" target="_blank"
                            href="https://sukan.uthm.edu.my/images/Edited_Format_Kertas_Kerja_PSU.pdf">
                            Muat turun Format Kertas Kerja
                        </a>
                    </div>

                    <div class="card-footer text-end">
                        <button type="button" class="btn prevBtn float-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 6l-6 6l6 6" />
                            </svg>
                            Kembali
                        </button>
                        <button type="button" class="btn nextBtn">
                            Seterusnya
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-0 ms-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 6l6 6l-6 6" />
                            </svg>
                        </button>
                    </div> <!-- /card-footer -->
                </div>
            </div>

            <!-- Section 4: Perakuan -->
            <div class="form-section d-none col-lg-12 col-md-12" id="section-acknowledgement">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-checkbox">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 11l3 3l8 -8" />
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="card-title">Perakuan Pemohon</div>
                                <div class="card-subtitle"><em>Acknowledgement</em></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <p>Dengan ini saya bersetuju dan faham bahawa aktiviti pelajar yang ingin dianjurkan
                                adalah
                                tertakluk kepada syarat-syarat dan peraturan-peraturan yang sedang berkuatkuasa
                                seperti
                                berikut:
                            <ol>
                                <li>Akta Universiti dan Kolej Universiti 1971 (Akta 30)</li>
                                <li>Kaedah-Kaedah UTHM (Tatatertib Pelajar-pelajar) 2009</li>
                                <li>Pekeliling Pengurusan, Kewangan dan Perbendaharaan Universiti Tun Hussein Onn
                                    Malaysia</li>
                                <li>Arahan dan peraturan yang diberikan dari semasa ke semasa oleh pihak Universiti
                                </li>
                            </ol>
                            </p>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input
                                        class="cursor-pointer form-check-input <?= (isset($validation) && $validation->getError('perakuan') ? 'is-invalid' : ''); ?>"
                                        type="checkbox" value="1" name="perakuan" id="setuju" required> Setuju
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('perakuan'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn prevBtn float-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 6l-6 6l6 6" />
                            </svg>
                            Kembali
                        </button>
                        <button class="btn btn-primary saveDraft">Simpan</button>
                        <button type="submit" class="btn btn-success" name="hantar" id="submitBtn">
                            Hantar
                        </button>
                    </div>
                    </form> <!-- /form -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('error_message')): ?>
<div class="modal modal-blur fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon mb-2 text-danger icon-lg">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v4" />
                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                    <path d="M12 16h.01" />
                </svg>
                <h3>Maklumat tidak lengkap</h3>
                <p><?= session()->getFlashdata('error_message'); ?></p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-bs-dismiss="modal">OK</a>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const myModal = new bootstrap.Modal(document.getElementById('errorModal'), {
        keyboard: false
    });
    myModal.show();
});
</script>
<?php endif; ?>
<script src="<?= base_url('assets/js/add-application.js') ?>"></script>
<script>
// @formatter:off
document.addEventListener("DOMContentLoaded", function() {
    const dateInputs = document.querySelectorAll('.datepicker');

    dateInputs.forEach(input => {
        window.Litepicker && (new Litepicker({
            element: input,
            buttonText: {
                previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
            },
        }));
    });
});
// @formatter:on
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.getElementById('submitBtn');
    const form = document.getElementById('applicationForm');

    if (submitButton) {
        submitButton.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent immediate form submission

            // Change button to loading state
            submitButton.disabled = true;
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    Hantar
                `;

            // Add a 1-second delay before form submission
            setTimeout(() => {
                form.submit(); // Submit the form after delay
            }, 500); // 1000ms = 1 second
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Get all 'Save as Draft' buttons
    const saveDraftButtons = document.querySelectorAll('.saveDraft');

    saveDraftButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            // Change button to loading state
            button.disabled = true;
            const originalText = button.innerHTML;
            button.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                Simpan
            `;

            // Add a delay before sending the POST request
            setTimeout(() => {
                // Get the form element
                const form = document.getElementById('applicationForm');
                const formData = new FormData(form);

                // Send the form data as a draft via a POST request
                fetch("<?= base_url('application/draft') ?>", {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert('Permohonan berjaya disimpan.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan, sila cuba lagi.');
                    })
                    .finally(() => {
                        // Revert button to original state
                        button.disabled = false;
                        button.innerHTML = originalText;
                    });
            }, 500); // 1000ms = 1 second
        });
    });
});

// Fetch and pre-fill the form data if a draft exists
document.addEventListener('DOMContentLoaded', function() {
    fetch("<?= base_url('application/draft') ?>")
        .then(response => response.json())
        .then(data => {
            if (data.draft) {
                for (const [key, value] of Object.entries(data.draft)) {
                    const field = document.querySelector(`[name="${key}"]`);
                    if (field) {
                        field.value = value;
                    }
                }
            }
        })
        .catch(error => console.error('Error loading draft:', error));
});
</script>
<?= $this->endSection() ?>