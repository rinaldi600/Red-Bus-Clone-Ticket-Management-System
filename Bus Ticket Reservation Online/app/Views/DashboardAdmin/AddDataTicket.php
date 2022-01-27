<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>
<div class="form-addData">

    <?php if (session()->getFlashdata('suksesAddData')) { ?>
        <div class="alert alert-success position-relative" role="alert">
            <?= session()->getFlashdata('suksesAddData') ?>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2" aria-label="Close"></button>
        </div>
    <?php } ?>

    <h1 class="mb-3">Tambah Data Ticket</h1>
    <form action="/DashboardAdmin/AddTicket" method="post">
        <div class="mb-3">
            <label for="bus" class="form-label">Bus</label>
            <input type="text" class="form-control <?= session()->getFlashdata('bus') ? 'is-invalid' : (old('bus') ? 'is-valid' : '') ?>" name="bus" id="bus" placeholder="Masukkan Nama Bus" value="<?= old('bus') ? old('bus') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('bus') ?>
            </div>
        </div>
        <div class="mb-3">
            <select name="supir" class="form-select fw-bolder <?= session()->getFlashdata('supir') ? 'is-invalid' : (old('supir') ? 'is-valid' : '') ?> font-monospace" aria-label="Default select example">
                <option <?= session()->getFlashdata('supir') ? 'selected' : '' ?> >Pilih Supir</option>
                <?php foreach ($dataSupir as $supir) { ?>
                    <option <?= old('supir') === $supir['idSupir'] ? 'selected' : '' ?> value="<?= $supir['idSupir'] ?>"><?= $supir['nama'] ?></option>
                <?php } ?>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('supir') ?>
            </div>
        </div>
        <div class="mb-3">
            <select name="tempat" class="form-select fw-bolder <?= session()->getFlashdata('tempat') ? 'is-invalid' : (old('tempat') ? 'is-valid' : '') ?> font-monospace" aria-label="Default select example">
                <option selected>Pilih Tempat</option>
                <?php foreach ($dataTempat as $tempat) { ?>
                    <option <?= old('tempat') === $tempat['idPlace'] ? 'selected' : '' ?> value="<?= $tempat['idPlace'] ?>">Asal : <?= $tempat['asal'] ?> | Tujuan : <?= $tempat['tujuan'] ?></option>
                <?php } ?>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('tempat') ?>
            </div>
        </div>
        <div class="mb-3">
            <select name="harga" class="form-select fw-bolder <?= session()->getFlashdata('harga') ? 'is-invalid' : (old('harga') ? 'is-valid' : '') ?> font-monospace" aria-label="Default select example">
                <option selected>Pilih Harga</option>
                <?php foreach ($dataHarga as $harga) { ?>
                    <option <?= old('harga') === $harga['idHarga'] ? 'selected' : '' ?> value="<?= $harga['idHarga'] ?>">Rp. <?= number_format($harga['harga'],0,",",".") ?> | <?= $harga['category'] ?></option>
                <?php } ?>
            </select>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('harga') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="tanggalBerangkat" class="form-label">Tanggal Berangkat</label>
            <input type="datetime-local" class="form-control <?= session()->getFlashdata('tanggalBerangkat') ? 'is-invalid' : (old('tanggalBerangkat') ? 'is-valid' : '') ?>" name="tanggalBerangkat" id="tanggalBerangkat" placeholder="Masukkan Tanggal Berangkat" value="<?= old('tanggalBerangkat') ? old('tanggalBerangkat') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('tanggalBerangkat') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="jumlahPenumpang" class="form-label">Kapasitas Jumlah Penumpang</label>
            <input type="text" class="form-control <?= session()->getFlashdata('jumlahPenumpang') ? 'is-invalid' : (old('jumlahPenumpang') ? 'is-valid' : '') ?>" name="jumlahPenumpang" id="jumlahPenumpang" placeholder="Masukkan Kapasitas Jumlah Penumpang" value="<?= old('jumlahPenumpang') ? old('jumlahPenumpang') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('jumlahPenumpang') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Tambah Data</button>
        <a class="btn btn-outline-secondary" href="/DashboardAdmin">Back</a>
    </form>
</div>

<?= $this->endSection() ?>
