<?= $this->extend('HomePage/HomeLayout') ?>

<?= $this->section('content') ?>
<?php //d($detailTicket) ?>
<?php //d(time()) ?>

<?php if (empty($detailTicket)) { ?>
    <h1>Data Not Found</h1>
<?php } else { ?>
    <div class="details-ticket mx-auto p-2 rounded-3">
        <?php if (session()->getFlashdata('successOrder')) { ?>
            <div class="notifications d-grid justify-content-center align-content-center">
                <div class="alert alert-success fw-bold" role="alert">
                   <?= session()->getFlashdata('successOrder') ?>, Silahkan Refresh Kembali Untuk Menghilangkan Pop-up Ini.
                </div>
            </div>
        <?php } ?>
        <div class="banner-image">
            <img class="img-fluid rounded-3" src="<?= base_url() ?>/bg/jeremy-bishop-QUwLZNchflk-unsplash.jpg" alt="">
        </div>

        <div class="description-ticket mt-2 position-relative">

            <h2 class="fw-bold"><?= $detailTicket['namaBus'] ?></h2>

            <div class="asal-and-tujuan d-flex align-items-center gap-3 mt-4">
                <div class="asal">
                    <p class="fs-5 text-wrap"><span class="fw-bold">Asal :</span> <?= $detailTicket['asal'] ?></p>
                </div>
                <div class="icons">
                    <img class="img-fluid" src="<?= base_url() ?>/icons/journey.png" alt="">
                </div>
                <div class="tujuan">
                    <p class="fs-5 text-wrap"><span class="fw-bold">Tujuan :</span> <?= $detailTicket['tujuan'] ?></p>
                </div>
            </div>

            <div class="tanggal-berangkat mt-4">
                <p class="mt-2 fs-5 fw-bold">Tanggal Berangkat : </p>
                <p class="mt-2 fs-5"><?= $detailTicket['tanggalBerangkat'] ?></p>
            </div>

            <div class="kapasitas-penumpang mt-4">
                <p class="mt-2 fs-5 fw-bold">Kapasitas Penumpang : </p>
                <p class="mt-2 fs-5"><?= $countSold['jumlah'] == null ? 0 : $countSold['jumlah']?> / <?= $detailTicket['jumlahPenumpang'] ?> Orang</p>
            </div>

            <div class="class">
                <p class="mt-2 fs-5 fw-bold">Class : </p>
                <p class="mt-2 fs-5"><?= ucfirst($detailTicket['category']) ?></p>
            </div>

            <div class="facility">
                <p class="mt-2 fs-5 fw-bold">Fasilitas : </p>
                <p class="mt-2 fs-5"><?= $detailTicket['fasilitas'] ?></p>
            </div>

            <div class="keterangan">
                <p class="mt-2 fs-5 fw-bold">Keterangan : </p>
                <p class="mt-2 fs-5"><?= $detailTicket['keterangan'] ?></p>
            </div>

            <div class="button-beli d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">Rp. <?= number_format($detailTicket['harga'],0,".",".") ?></h3>

                <?php if (($countSold['jumlah'] === $detailTicket['jumlahPenumpang']) && ($countSold['jumlah'] != null)) { ?>
                    <button class="btn order-tiket" type="button">Penuh</button>
                <?php } else if (strtotime($detailTicket['tanggalBerangkat']) < time()) {  ?>
                    <button class="btn order-tiket" type="button">Masa Tiket Sudah Habis</button>
                <?php } else { ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Order
                    </button>

                    <!-- Modal -->
                    <div class="modal fade position-absolute top-50 start-50 translate-middle" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/tiket/orderTiket" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="idTicket" value="<?= $detailTicket['idTicket'] ?>">
                                        <input type="hidden" name="idUser" value="<?= $idUser ?>">
                                        <input type="hidden" name="harga" value="<?= $detailTicket['harga']?>">
                                        <input type="number" min="1" max="<?= $detailTicket['jumlahPenumpang'] ?>" name="jumlahPenumpang" class="form-control fw-bold <?= session()->getFlashdata('errorMessage') ? 'is-invalid' : '' ?>" placeholder="Jumlah Penumpang" value="<?= old('jumlahPenumpang') ? old('jumlahPenumpang') : '' ?>">
                                        <div id="validationServer03Feedback" class="invalid-feedback fw-bold">
                                            <?= session()->getFlashdata('errorMessage') ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                        <button class="btn order-tiket" type="submit">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
<?php } ?>

<?= $this->endSection() ?>
