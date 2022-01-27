<?= $this->extend('HomePage/HomeLayout') ?>

<?= $this->section('content') ?>
<div class="home">
    <p class="text-break"><span class="fw-bold">Beranda ></span> Tiket Bus Online > Jakarta Bis > <a href="" class="text-decoration-none text-danger">Bis Jakarta Ke Bandung</a></p>
</div>
<div class="content mx-auto mt-3">
    <div class="urgent d-flex justify-content-between">
        <p><span class="fw-bold"><?= count($dataTicket) ?> Buses</span> found</p>
        <p><span class="fw-bold date-time text-wrap"><?= $dateTime ?></p>
    </div>

    <form action="" method="get">
        <div class="search-box input-group mb-3 position-relative">
            <input type="text" class="form-control search" name="tujuanAsal" placeholder="Masukkan Keyword" aria-label="Recipient's username">
            <button class="btn" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search text-white" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
    </form>
    <?php foreach ($dataTicket as $ticket) { ?>
        <div class="position-relative ticket text-center p-2 mb-3">

            <?php if (strtotime($ticket['tanggalBerangkat']) < $currentTime) { ?>
                <h1 class="disable-ticket fw-bolder text-white">Masa Berlaku Ticket Habis</h1>
            <?php } ?>

            <img class="" src="<?= base_url() ?>/icons/bus (1).png" alt="">
            <div class="detail">
                <p class="fw-bold"><?= $ticket['namaBus'] ?></p>
                <img src="<?= base_url() ?>/icons/heart.png" alt="">
                <img src="<?= base_url() ?>/icons/hospital-facility.png" alt="">
                <img src="<?= base_url() ?>/icons/lavatory.png" alt="">
            </div>
            <div class="tujuan text-wrap">
                <span class="fw-bold">Asal</span> : <?= $ticket['asal'] ?> <br>
                <span class="fw-bold">Tujuan</span> : <?= $ticket['tujuan'] ?>
            </div>
            <div class="berangkat text-wrap">
                <span class="fw-bold">Tanggal Berangkat</span> <br>
                <?= $ticket['tanggalBerangkat'] ?>
                <p><span class="fw-bolder"><?= (int) (round(strtotime($ticket['tanggalBerangkat']) - time()) / 86400)  ?></span> Hari Lagi</p>
            </div>
            <div class="kapasitas text-wrap">
                <span class="fw-bold">Kapasitas Penumpang</span> <br>
                <?= $ticket['jumlahPenumpang'] ?>
            </div>
            <div class="berangkat text-wrap">
                <span class="fw-bold">Harga</span> <br>
                Rp. <?= number_format($ticket['harga'],0,".",".") ?>
            </div>
            <div class="beli d-grid align-items-center">
                <a class="text-decoration-none btn" href="/tiket/detail/<?= $ticket['idTicket'] ?>">Beli</a>
            </div>
        </div>
    <?php } ?>
</div>
<?= $this->endSection() ?>
