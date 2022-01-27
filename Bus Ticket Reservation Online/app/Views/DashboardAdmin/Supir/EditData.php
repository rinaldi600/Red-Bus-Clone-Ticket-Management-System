<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>

<div class="form-addData">

    <?php if (session()->getFlashdata('suksesAddData')) { ?>
        <div class="alert alert-success position-relative" role="alert">
            <?= session()->getFlashdata('suksesAddData') ?>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2" aria-label="Close"></button>
        </div>
    <?php } ?>

    <h1 class="mb-3">Edit Data Supir</h1>
    <form action="/DashboardSupir/editSupir" method="post">
        <input type="hidden" name="idSupir" value="<?= $dataSupir["idSupir"] ?>">
        <div class="mb-3">
            <label for="namaSupir" class="form-label">Nama</label>
            <input type="text" class="form-control <?= session()->getFlashdata('namaSupir') ? 'is-invalid' : ( old('namaSupir') ? 'is-valid' : '') ?>" id="namaSupir" name="namaSupir" placeholder="Masukkan Nama Supir" value="<?= old('namaSupir') ? old('namaSupir') : $dataSupir["nama"] ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('namaSupir') ?>
            </div>
            <div class="valid-feedback">
                Sudah Benar
            </div>
        </div>
        <div class="mb-3">
            <label for="handphoneSupir" class="form-label">Handphone</label>
            <input type="text" class="form-control <?= session()->getFlashdata('handphoneSupir') ? 'is-invalid' : (old('handphoneSupir') ? 'is-valid' : '') ?>" id="handphoneSupir" name="handphoneSupir" placeholder="Masukkan No. Handphone Supir" value="<?= old('handphoneSupir') ? old('handphoneSupir') : $dataSupir["handphone"] ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('handphoneSupir') ?>
            </div>
            <div class="valid-feedback">
                Sudah Benar
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <textarea class="form-control <?= session()->getFlashdata('alamatSupir') ? 'is-invalid' : (old('alamatSupir') ? 'is-valid' : '') ?>" placeholder="Masukkan Alamat" id="floatingTextarea2" name="alamatSupir" style="height: 100px"><?= old('alamatSupir') ? old('alamatSupir') : $dataSupir["alamat"] ?></textarea>
                <label for="floatingTextarea2">Alamat</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('alamatSupir') ?>
                </div>
                <div class="valid-feedback">
                    Sudah Benar
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Edit Data</button>
        <a class="btn btn-outline-secondary" href="/DashboardSupir">Back</a>
    </form>
</div>

<?= $this->endSection() ?>


