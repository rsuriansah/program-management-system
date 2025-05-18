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
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-lg-12 col-md-12 d-flex flex-column">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Maklumat Akaun</h3>
                    </div>
                    <div class="card-body">

                        <!-- Success Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <?= session()->getFlashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>

                        <?php $errors = session('errors'); ?>
                        <?= form_open_multipart('profile'); ?>
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Emel</label>
                            <?php
                                    $data = array(
                                        'type'        => 'email',
                                        'class'       => 'form-control',
                                        'name'        => 'email',
                                        'id'          => 'email',
                                        'value'       => auth()->user()->email,
                                        'disabled'    => 'disabled',
                                    );
                                    echo form_input($data); 
                                    ?>
                            <small class="form-hint">Emel sudah disahkan.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama pengguna</label>
                            <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ' . (isset($errors['username']) ? 'is-invalid' : ''),
                                        'name'        => 'username',
                                        'id'          => 'username',
                                        'value'       => old('username') ?? $oldInput['username'] ?? auth()->user()->username,
                                        'placeholder' => 'Nama pengguna',
                                    );
                                    echo form_input($data); 
                                ?>
                            <div class="invalid-feedback">
                                <?= $errors['username'] ?? ''; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama penuh</label>
                            <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ' . (isset($errors['full_name']) ? 'is-invalid' : ''),
                                        'name'        => 'full_name',
                                        'id'          => 'full_name',
                                        'value'       => old('full_name') ?? $oldInput['full_name'] ?? auth()->user()->full_name
                                    );
                                    echo form_input($data); 
                                ?>
                            <div class="invalid-feedback">
                                <?= $errors['full_name'] ?? ''; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombor matrik</label>
                            <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ' . (isset($errors['matric_no']) ? 'is-invalid' : ''),
                                        'name'        => 'matric_no',
                                        'id'          => 'matric_no',
                                        'value'       => old('matric_no') ?? $oldInput['matric_no'] ?? auth()->user()->matric_no,
                                    );
                                    echo form_input($data); 
                                ?>
                            <div class="invalid-feedback">
                                <?= $errors['matric_no'] ?? ''; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombor telefon</label>
                            <?php
                                    $data = array(
                                        'type'        => 'text',
                                        'class'       => 'form-control ' . (isset($errors['phone']) ? 'is-invalid' : ''),
                                        'name'        => 'phone',
                                        'id'          => 'phone',
                                        'value'       => old('phone') ?? $oldInput['phone'] ?? auth()->user()->phone,
                                    );
                                    echo form_input($data); 
                                ?>
                            <div class="invalid-feedback">
                                <?= $errors['phone'] ?? ''; ?>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <?php
                        $data = array(
                            'class'       => 'btn btn-primary',
                            'name'        => 'save_profile', 
                            'id'          => 'save_profile',
                            'value'       => 'Simpan'
                        );
                        echo form_submit($data);
                        ?>
                    </div>
                    <?=form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>