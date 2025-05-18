<?= $this->extend('Auth/layout'); ?>

<?= $this->section('title') ?>Lupa Kata Laluan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form class="card card-md" action="<?= url_to('magic-link') ?>" method="post">
    <?= csrf_field() ?>
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Lupa kata laluan</h2>

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

        <p class="text-secondary mb-4">Masukkan emel anda dan kata laluan anda akan diset semula dan dihantar melalui
            emel.</p>
        <div class="mb-3">
            <label for="emailInput" class="form-label required">Emel</label>
            <input type="email" id="emailInput" placeholder="Emel yang didaftar" class="form-control" name="email"
                autocomplete="email" value="<?= old('email', auth()->user()->email ?? null) ?>" required>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                    <path d="M3 7l9 6l9 -6" />
                </svg>
                Hantar kata laluan baru
            </button>
        </div>
    </div>
</form>
<div class="text-center text-secondary mt-3">
    Lupakan, <a href="<?= url_to('login') ?>">kembali</a> ke halaman log masuk.
</div>
<?= $this->endSection(); ?>