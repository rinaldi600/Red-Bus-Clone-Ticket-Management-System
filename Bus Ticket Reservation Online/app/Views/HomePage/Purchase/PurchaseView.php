<?= $this->extend('HomePage/HomeLayout') ?>

<?= $this->section('content') ?>

<div class="payment-user mx-auto mt-5">
    <div class="link d-flex align-items-center justify-content-center gap-5 fs-5">
        <p>Belum Dibayar</p>
        <p>Sudah Dibayar</p>
    </div>

    <div class="incomplete-payment text-center">
        <div class="table-responsive">
            <table class="table fw-bold">
                <thead>
                <tr>
                    <th scope="col">No. </th>
                    <th scope="col">ID Order</th>
                    <th scope="col">No Resi</th>
                    <th scope="col">ID User</th>
                    <th scope="col">ID Ticket</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Hapus</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($orderIncomplete)) { ?>
                    <?php foreach ($orderIncomplete as $incomplete) { ?>
                        <tr class="position-relative">
                            <th scope="row"><?= $number++ ?>.</th>
                            <td><?= $incomplete['idOrder'] ?></td>
                            <td><?= $incomplete['noResi'] ?></td>
                            <td><?= $incomplete['idUser'] ?></td>
                            <td><?= $incomplete['idTicket'] ?></td>
                            <td><?= $incomplete['jumlah'] ?></td>
                            <td>Rp. <?= number_format($incomplete['total'],0,".",".") ?></td>
                            <td><?= $incomplete['status'] ?></td>
                            <td>
                                <?php if (strtotime($incomplete['tanggalBerangkat']) < time()) { ?>
                                    <div class="block-order d-grid align-items-center">
                                        <h1 class="fw-bolder">Masa Ticket Sudah Expired</h1>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="idOrder" value="<?= $incomplete['idOrder'] ?>">
                                <label for="flexCheckDefault"></label>
                                <input class="form-check-input checklist-order" type="checkbox" value="" id="flexCheckDefault">
                            </td>
                            <td class="d-grid justify-content-start border-0">
                                <ul class="d-flex justify-content-start position-relative">
                                    <li>
                                        <input type="hidden" name="idOrder" value="<?= $incomplete['idOrder'] ?>">
                                        <button class="on-delete-order position-absolute top-0 start-50 translate-middle-x" type="submit">
                                            <img src="<?= base_url() ?>/icons/delete.png" alt="">
                                        </button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="9">Data Not Found</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="price-total d-flex justify-content-between align-items-center p-2">
            <h1 class="count-total-order">Rp. 0</h1>
            <div class="button-order">
                <!-- Button trigger modal -->
                <button type="button" class="btn-order" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Proses
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header fw-bold">
                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Uang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control input-money" placeholder="Masukkan Disini...">
                                </div>
                                <p></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Close</button>
                                <button class="btn" type="button">Proses</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="complete-payment text-center d-none">
        <div class="table-responsive">
            <table class="table fw-bold">
                <thead>
                <tr>
                    <th scope="col">No. </th>
                    <th scope="col">ID Order</th>
                    <th scope="col">No Resi</th>
                    <th scope="col">ID User</th>
                    <th scope="col">ID Ticket</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($orderComplete)) { ?>
                    <th colspan="9" scope="row">Data Not Found</th>
                <?php } else { ?>
                    <?php $number !== 1 ? $number = 1 : '' ?>
                    <?php foreach ($orderComplete as $complete) { ?>
                        <tr>
                            <th scope="row"><?= $number++ ?></th>
                            <td><?= $complete['idOrder'] ?></td>
                            <td><?= $complete['noResi'] ?></td>
                            <td><?= $complete['idUser'] ?></td>
                            <td><?= $complete['idTicket'] ?></td>
                            <td><?= $complete['jumlah'] ?></td>
                            <td>Rp. <?= number_format($complete['total'],0,',','.') ?></td>
                            <td><?= $complete['status'] ?></td>
                            <td>
                                <form action="/tiket/printOrder" method="post">
                                    <input type="hidden" name="idOrder" value="<?= $complete['idOrder'] ?>">
                                    <button type="submit" class="btn">Cetak</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="count-total-complete-order d-flex justify-content-start align-items-center p-2">
            <div class="price-order-complete">
                <h1>Rp. <?= number_format($totalCountComplete[0]['total'],0,",",".") ?></h1>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
