<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>

<div class="form-addData">

    <?php if (session()->getFlashdata('suksesAddData')) { ?>
        <div class="alert alert-success position-relative" role="alert">
            <?= session()->getFlashdata('suksesAddData') ?>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2" aria-label="Close"></button>
        </div>
    <?php } ?>

    <h1 class="mb-3">Edit Data Harga</h1>
    <form action="/DashboardHarga/editHarga" method="post">
        <input type="hidden" name="idHarga" value="<?= $dataHarga['idHarga'] ?>">
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" name="harga" class="form-control <?= session()->getFlashdata('harga') ? 'is-invalid' : (old('harga') ? 'is-valid' : '') ?> input-harga" id="harga" value="<?= old('harga') ? old('harga') : number_format($dataHarga['harga'],0,".", ",") ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('harga') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-select <?= session()->getFlashdata('kategori') ? 'is-invalid' : (old('kategori') ? 'is-valid' : '') ?>" id="kategori" aria-label="Default select example">
                <option <?= session()->getFlashdata('kategori') ? 'selected' : '' ?>>Pilih Kategori</option>
                <option <?= session()->getFlashdata('kategori') ? '' : ($dataHarga['category'] === 'standard' ? 'selected' : '') ?> value="standard">Standard</option>
                <option <?= session()->getFlashdata('kategori') ? '' : ($dataHarga['category'] === 'premium' ? 'selected' : '') ?> value="premium">Premium</option>
                <option <?= session()->getFlashdata('kategori') ? '' : ($dataHarga['category'] === 'platinum' ? 'selected' : '') ?> value="platinum">Platinum</option>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('kategori') ?>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <textarea class="form-control <?= session()->getFlashdata('fasilitas') ? 'is-invalid' : '' ?>" placeholder="Leave a comment here" name="fasilitas" id="floatingTextarea2" style="height: 100px"><?= old('fasilitas') ? old('fasilitas') : $dataHarga["fasilitas"] ?></textarea>
                <label for="floatingTextarea2">Fasilitas</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?= session()->getFlashdata('fasilitas') ?>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="hidden" name="oldKeterangan" value="<?= $dataHarga['keterangan'] ?>">
                <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" id="floatingTextarea2" style="height: 100px"><?= $dataHarga['keterangan'] ?></textarea>
                <label for="floatingTextarea2">Keterangan</label>
                <div id="emailHelp" class="form-text">Default : Harga Bisa Berubah Sesuai Dengan Ketentuan Yang Berlaku</div>
                <div id="emailHelp" class="form-text">Form Keterangan Tidak Wajib Diisi</div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Edit Data</button>
        <a class="btn btn-outline-secondary" href="/DashboardHarga">Back</a>
    </form>
</div>


<?= $this->endSection() ?>


