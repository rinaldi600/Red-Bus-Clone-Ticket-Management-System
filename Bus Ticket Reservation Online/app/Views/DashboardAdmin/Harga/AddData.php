<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>

<div class="form-addData">

    <?php if (session()->getFlashdata('suksesAddData')) { ?>
        <div class="alert alert-success position-relative" role="alert">
            <?= session()->getFlashdata('suksesAddData') ?>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2" aria-label="Close"></button>
        </div>
    <?php } ?>


    <h1 class="mb-3">Tambah Data Harga</h1>
    <form action="/DashboardHarga/addHarga" method="post">
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control input-harga <?= session()->getFlashdata('harga') ? 'is-invalid' : (old('harga') ? 'is-valid' : '') ?>" id="harga" value="<?= old('harga') ? old('harga') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('harga') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-select <?= session()->getFlashdata('kategori') ? 'is-invalid' : (old('kategori') ? 'is-valid' : '') ?>" id="kategori" aria-label="Default select example">
                <option selected>Pilih Kategori</option>
                <option <?= old('kategori') === 'standard' ? 'selected' : '' ?> value="standard">Standard</option>
                <option <?= old('kategori') === 'premium' ? 'selected' : '' ?> value="premium">Premium</option>
                <option <?= old('kategori') === 'platinum' ? 'selected' : '' ?> value="platinum">Platinum</option>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('kategori') ?>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <textarea class="form-control <?= session()->getFlashdata('fasilitas') ? 'is-invalid' : (old('fasilitas') ? 'is-valid' : '') ?>" placeholder="Leave a comment here" name="fasilitas" id="floatingTextarea2" style="height: 100px"><?= old('fasilitas') ? old('fasilitas') : '' ?></textarea>
                <label for="floatingTextarea2">Fasilitas</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('fasilitas') ?>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" id="floatingTextarea2" style="height: 100px"><?= old('keterangan') ? old('keterangan') : '' ?></textarea>
                <label for="floatingTextarea2">Keterangan</label>
                <div id="emailHelp" class="form-text">Default : Harga Bisa Berubah Sesuai Dengan Ketentuan Yang Berlaku</div>
                <div id="emailHelp" class="form-text">Form Keterangan Tidak Wajib Diisi</div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Tambah Data</button>
        <a class="btn btn-outline-secondary" href="/DashboardHarga">Back</a>
    </form>
</div>


<?= $this->endSection() ?>

