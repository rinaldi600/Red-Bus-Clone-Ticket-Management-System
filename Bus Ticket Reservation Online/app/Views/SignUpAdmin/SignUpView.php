<?= $this->extend('LoginTemplate/Login') ?>

<?= $this->section('content') ?>

<div class="login-admin position-absolute top-50 start-50 translate-middle">
    <?php if (session()->getFlashdata("success")) { ?>
        <div class="success">
            <div class="text-center notifications alert alert-success position-absolute top-50 start-50 translate-middle" role="alert">
                <?= session()->getFlashdata("success") ?> <a class="text-decoration-none" href="/loginAdmin">Login</a>
            </div>
        </div>
    <?php } ?>

    <h1 class="text-center title-signup">Form Pendaftaran Admin Ticket</h1>
    <form action="/SignUpAdmin/signup" method="post">
        <div class="form-signup row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('nama') ? 'is-invalid' : ( old('nama') ? 'is-valid' : '' ) ?>" name="nama" id="nama" placeholder="Masukkan Nama" value="<?= old('nama') ? old('nama') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('nama') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : ( old('username') ? 'is-valid' : '' ) ?>" name="username" id="username" placeholder="Masukkan Username" value="<?= old('username') ? old('username') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('username')  ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('email') ? 'is-invalid' : ( old('email') ? 'is-valid' : '' ) ?>" name="email" id="email" placeholder="Masukkan Email" value="<?= old('email') ? old('email') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('email') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="handphone" class="form-label">Handphone</label>
                    <input type="text" class="form-control <?= session()->getFlashdata('handphone') ? 'is-invalid' : ( old('handphone') ? 'is-valid' : '' ) ?>" name="handphone" id="handphone" placeholder="Masukkan No. Handphone" value="<?= old('handphone') ? old('handphone') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('handphone') ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control <?= session()->getFlashdata('alamat') ? 'is-invalid' : ( old('alamat') ? 'is-valid' : '' ) ?>" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap"><?= old('alamat') ? old('alamat') : '' ?></textarea>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('alamat') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : ( old('password') ? 'is-valid' : '' ) ?>" name="password" id="exampleInputPassword1" placeholder="Masukkan Password" value="<?= old('password') ? old('password') : '' ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('password') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control <?= session()->getFlashdata('confirmPassword') ? 'is-invalid' : ( session()->getFlashdata('password') ? 'is-invalid' : ( old('confirmPasswword') ? 'is-valid' : '') ) ?>" name="confirmPassword" id="confirmPassword" placeholder="Masukkan Password" value="<?= session()->getFlashdata('password') ? '' : old('confirmPassword') ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->getFlashdata('confirmPassword') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-secondary">Sign Up</button>
                <a href="/LoginAdmin" class="btn btn-outline-success">Back</a>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
