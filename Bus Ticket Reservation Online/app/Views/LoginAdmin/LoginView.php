<?= $this->extend('LoginTemplate/Login') ?>

<?= $this->section('content') ?>

    <div class="login-admin position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 bg-image">

            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 d-grid align-items-center mt-3">
                <form action="/LoginAdmin/login" method="post">
                    <?php if (session()->getFlashdata('failed')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('failed') ?>
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="usernameOrEmail" class="form-label">Username atau Email</label>
                        <input type="text" class="form-control <?= session()->getFlashdata('usernameOrEmail') ? 'is-invalid' : '' ?>" name="usernameOrEmail" id="usernameOrEmail" placeholder="Masukkan Username atau Email" value="<?= old('usernameOrEmail') ? old('usernameOrEmail') : '' ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= session()->getFlashdata('usernameOrEmail') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : (session()->getFlashdata('invalidPassword') ? 'is-invalid' : '') ?>" name="password" id="exampleInputPassword1" placeholder="Masukkan Password" value="<?= old('password') ? old('password') : '' ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= session()->getFlashdata('password') ? session()->getFlashdata('password') : session()->getFlashdata('invalidPassword')?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">Login</button>
                    <a href="/SignUpAdmin" class="btn btn-outline-success">Sign Up</a>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
