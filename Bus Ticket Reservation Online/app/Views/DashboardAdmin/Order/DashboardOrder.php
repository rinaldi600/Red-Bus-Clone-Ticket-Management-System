<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>
<div class="list-order">

    <form action="/DashboardOrder" method="get">
        <div class="search-button input-group mb-3">
            <input type="text" class="form-control" name="namaAtauTicket" placeholder="Masukkan Nama atau Tujuan atau Asal" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-dark" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="text-center">
                <th scope="col">No.</th>
                <th scope="col">ID Order</th>
                <th scope="col">No Resi</th>
                <th scope="col">ID User</th>
                <th scope="col">ID Ticket</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Status</th>
                <th scope="col">Total</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($dataOrder)) { ?>
                <th class="text-center" colspan="9">Data Tidak Ditemukan</th>
            <?php } else { ?>
                <?php foreach ($dataOrder as $order) { ?>
                    <tr class="text-center">
                        <th scope="row"><?= $number++ ?></th>
                        <td>
                            <?= $order['idOrder'] ?>
                        </td>
                        <td>
                            <?= $order['noResi'] ?>
                        </td>
                        <td>
                            <input type="hidden" value="<?= $order['idUser'] ?>">
                            <button type="button" class="btn btn-outline-secondary detail-id-user" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <?= $order['idUser'] ?>
                            </button>
                        </td>
                        <td>
                            <input type="hidden" value="<?= $order['idTicket'] ?>">
                            <button type="button" class="btn btn-outline-secondary detail-id-ticket" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <?= $order['idTicket'] ?>
                            </button>
                        </td>
                        <td><?= $order['jumlah'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td>Rp. <?= number_format($order['total'],0,',','.') ?></td>
                        <td class="d-grid justify-content-center">
                            <ul class="d-flex justify-content-center">
                                <li>
                                    <input type="hidden" name="idOrder" value="<?= $order['idOrder'] ?>">
                                    <button class="on-delete-order" type="submit">
                                        <img src="<?= base_url() ?>/icons/delete.png" alt="">
                                    </button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="page-pagination d-grid justify-content-center mt-3">
        <?= $pager->links('order', 'custom_pagination') ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Detail Info</h5>
            </div>
            <div class="modal-body text-center text-dark">

            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
