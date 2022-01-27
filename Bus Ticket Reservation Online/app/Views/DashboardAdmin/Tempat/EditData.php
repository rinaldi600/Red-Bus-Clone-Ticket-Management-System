<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>

<div class="form-addData">
    <?php if (session()->getFlashdata('suksesAddData')) { ?>
        <div class="alert alert-success position-relative" role="alert">
            <?= session()->getFlashdata('suksesAddData') ?>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if (session()->getFlashdata('samePlace')) { ?>
        <div class="alert alert-danger position-relative" role="alert">
            <?= session()->getFlashdata('samePlace') ?>
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2" aria-label="Close"></button>
        </div>
    <?php } ?>

    <h1 class="mb-3">Edit Data Tempat</h1>
    <form action="/DashboardTempat/editTempat" method="post">
        <input type="hidden" name="idPlace" value="<?= $dataTempat['idPlace'] ?>">
        <div class="mb-3 form-floating">
            <textarea class="form-control <?= session()->getFlashdata('asal') ? 'is-invalid' : ( session()->getFlashdata('samePlace') ? 'is-invalid' : (old('asal') ? 'is-valid' : '')) ?>" placeholder="Masukkan Asal Tempat" name="asal" id="floatingTextarea2" style="height: 100px"><?= old('asal') ? old('asal') : $dataTempat["asal"] ?></textarea>
            <label for="floatingTextarea2">Asal</label>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('asal') ?>
            </div>
        </div>
        <div class="mb-3 form-floating">
            <textarea class="form-control <?= session()->getFlashdata('tujuan') ? 'is-invalid' :  ( session()->getFlashdata('samePlace') ? 'is-invalid' : (old('tujuan') ? 'is-valid' : '')) ?>" placeholder="Masukkan Tempat Tujuan" name="tujuan" id="floatingTextarea2" style="height: 100px"><?= old('tujuan') ? old('tujuan') : $dataTempat["tujuan"] ?></textarea>
            <label for="floatingTextarea2">Tujuan</label>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('tujuan') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Edit Data</button>
        <a class="btn btn-outline-secondary" href="/DashboardTempat">Back</a>
    </form>
</div>


<?= $this->endSection() ?>

