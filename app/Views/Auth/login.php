<?= $this->extend('Auth/layout'); ?>

<?= $this->section('title') ?>Log Masuk<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<div class="text-center mb-4">
    <a href="." class="navbar-brand navbar-brand-autodark">
        <img src="<?= base_url('static/logo-uthm.png'); ?>" width="110" height="32" alt="UTHM"
            class="navbar-brand-image">
    </a>
</div>

<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Log Masuk</h2>

        <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
        <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
            <?php foreach (session('errors') as $error) : ?>
            <?= $error ?>
            <br>
            <?php endforeach ?>
            <?php else : ?>
            <?= session('errors') ?>
            <?php endif ?>
        </div>
        <?php endif ?>

        <?php if (session('message') !== null) : ?>
        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
        <?php endif ?>

        <form action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Nama pengguna -->
            <div class="mb-3">
                <label class="form-label">Nama pengguna</label>
                <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''; ?>"
                    name="username" inputmode="username" value="<?= old('username') ?>" placeholder="Nama pengguna"
                    autocomplete="username">
                <div class="invalid-feedback">
                    <?= $errors['username'] ?? ''; ?>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-2">
                <label class="form-label">
                    Kata laluan
                    <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                    <span class="form-label-description">
                        <a href="<?= url_to('magic-link') ?>">Lupa kata laluan</a>
                    </span>
                    <?php endif; ?>
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" id="password-field"
                        class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" name="password"
                        placeholder="Kata laluan anda" inputmode="text" autocomplete="current-password">
                    <span class="input-group-text">
                        <button type="button" id="togglePassword" class="btn-link link-secondary p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                </path>
                            </svg>
                        </button>
                    </span>
                </div>
                <div class="invalid-feedback">
                    <?= $errors['password'] ?? ''; ?>
                </div>
            </div>

            <!-- Remember me -->
            <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input " <?php if (old('remember')): ?>
                        checked<?php endif ?>>
                    <span class="form-check-label">Remember me on this device</span>
                </label>
            </div>
            <?php endif; ?>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Log masuk</button>
            </div>
        </form>
    </div>

    <!-- Login guna Social Media -->
    <div class="d-none hr-text">or</div>
    <div class="d-none card-body">
        <div class="row">
            <div class="col"><a href="#" class="btn w-100">
                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                    </svg>
                    Login with Github
                </a></div>
            <div class="col"><a href="#" class="btn w-100">
                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-twitter" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" />
                    </svg>
                    Login with Twitter
                </a></div>
        </div>
    </div>
</div>
<div class="text-center text-secondary mt-3">
    Tiada akaun? <a href="<?= url_to('register') ?>" tabindex="-1">Daftar</a>
</div>
<script>
document.getElementById('togglePassword').addEventListener('click', function(e) {
    e.preventDefault();

    // Get the password input field and the SVG icon
    const passwordField = document.getElementById('password-field');
    const icon = this.querySelector('svg');

    // Toggle password visibility
    if (passwordField.type === 'password') {
        passwordField.type = 'text';

        // Change to "eye-off" icon
        icon.innerHTML = `
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
            <path d="M3 3l18 18" />
        `;
    } else {
        passwordField.type = 'password';

        // Change to "eye" icon
        icon.innerHTML = `
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
            </path>
        `;
    }
});
</script>
<?= $this->endSection(); ?>