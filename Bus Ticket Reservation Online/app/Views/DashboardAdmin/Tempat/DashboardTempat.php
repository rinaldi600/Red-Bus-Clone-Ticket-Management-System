<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>

<div class="list-tempat">

    <a class="btn btn-outline-secondary mb-3 text-dark" href="/DashboardTempat/AddTempatView">
        Tambah Data
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle text-dark ms-1" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
    </a>

    <form action="/DashboardTempat" method="get">
        <div class="search-button input-group mb-3">
            <input type="text" class="form-control" name="asalAtauTujuan" placeholder="Masukkan Asal atau Tujuan" aria-label="Recipient's username" aria-describedby="button-addon2">
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
                <th scope="col">Asal</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Dibuat Tanggal</th>
                <th scope="col">Diupdate Tanggal</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($listTempat)) { ?>
                <th colspan="6" class="text-center">Data Kosong, Silahkan Tambahkan Data</th>
            <?php } else { ?>
                <?php foreach($listTempat as $tempat) { ?>
                    <tr class="text-center">
                        <th scope="row"><?= $number++ ?></th>
                        <td><?= $tempat["asal"] ?></td>
                        <td><?= $tempat["tujuan"] ?></td>
                        <td><?= $tempat["created_at"] ?></td>
                        <td><?= $tempat["updated_at"] ?></td>
                        <td class="d-grid justify-content-center">
                            <ul class="d-flex gap-2">
                                <li>
                                    <form action="/DashboardTempat/editTempatView" method="get">
                                        <input type="hidden" name="idPlace" value="<?= $tempat["idPlace"] ?>">
                                        <button type="submit" onclick="return confirm('Yakin Ingin Mengubah Data Tersebut')">
                                            <img src="<?= base_url() ?>/icons/edit.png" alt="">
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <input type="hidden" name="idPlace" value="<?= $tempat["idPlace"] ?>">
                                    <button class="on-delete-place" type="submit">
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
        <?= $pager->links('place','custom_pagination') ?>
    </div>
</div>

<?= $this->endSection() ?>

