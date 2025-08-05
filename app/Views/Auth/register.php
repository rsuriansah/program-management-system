<?= $this->extend('Auth/layout'); ?>

<?= $this->section('title') ?>Daftar<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div class="text-center mb-4">
    <a href="." class="navbar-brand navbar-brand-autodark">
        <img src="<?= base_url('static/logo-uthm.png'); ?>" width="110" height="32" alt="UTHM"
            class="navbar-brand-image">
    </a>
</div>

<form class="card card-md" action="<?= url_to('register') ?>" method="post">
    <?= csrf_field() ?>
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Daftar</h2>

        <?php $errors = session('errors'); ?>
        <!-- Nama penuh -->
        <div class="mb-3">
            <label class="form-label required">Nama penuh</label>
            <input type="text" class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : ''; ?>"
                name="full_name" value="<?= old('full_name') ?>" placeholder="Seperti dalam Kad Pengenalan" autofocus>
            <div class="invalid-feedback">
                <?= $errors['full_name'] ?? ''; ?>
            </div>
        </div>
        <!-- Emel -->
        <div class="mb-3">
            <label class="form-label required">Emel</label>
            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" name="email"
                value="<?= old('email') ?>" placeholder="emel@gmail.com">
            <div class="invalid-feedback">
                <?= $errors['email'] ?? ''; ?>
            </div>
        </div>
        <!-- Nama pengguna -->
        <div class="mb-3">
            <label class="form-label required">Nama pengguna</label>
            <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''; ?>"
                name="username" value="<?= old('username') ?>" placeholder="Nama pengguna">
            <small class="form-hint">
                Minimum 6 hingga 16 aksara. Hanya dibenarkan mengandungi huruf, nombor, atau simbol '.' sahaja.
                Contoh, ridhwan.123
            </small>
            <div class="invalid-feedback">
                <?= $errors['username'] ?? ''; ?>
            </div>
        </div>
        <!-- Nombor telefon -->
        <div class="mb-3">
            <label class="form-label required">Nombor telefon</label>
            <input type="text" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : ''; ?>" name="phone"
                value="<?= old('phone') ?>" placeholder="0123456789">
            <div class="invalid-feedback">
                <?= $errors['phone'] ?? ''; ?>
            </div>
        </div>
        <!-- Kata laluan -->
        <div class="mb-3">
            <label class="form-label required">Kata laluan</label>
            <input type="password" id="password"
                class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" name="password"
                placeholder="Kata laluan" autocomplete="off">
            <div class="invalid-feedback">
                <?= $errors['password'] ?? ''; ?>
            </div>
        </div>
        <!-- Ulang kata laluan -->
        <div class="mb-3">
            <label class="form-label required">Ulang kata laluan</label>
            <input type="password" class="form-control <?= isset($errors['password_confirm']) ? 'is-invalid' : ''; ?>"
                name="password_confirm" placeholder="Ulang kata laluan" autocomplete="off">
            <div class="invalid-feedback">
                <?= $errors['password_confirm'] ?? ''; ?>
            </div>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </div>
    </div>
</form>
<div class="text-center text-secondary mt-3">
    Sudah mendaftar? <a href="<?= url_to('login') ?>" tabindex="-1">Log masuk</a>
</div>
<?= $this->endSection(); ?>