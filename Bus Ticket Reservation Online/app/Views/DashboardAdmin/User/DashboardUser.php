<?= $this->extend('DashboardTemplate/DashboardTemplate') ?>

<?= $this->section('content') ?>
    <div class="list-user">
        <form action="/DashboardUser" method="get">
            <div class="search-button input-group mb-3">
                <input type="text" class="form-control" name="namaAtauAlamat" placeholder="Masukkan Nama atau Alamat" aria-label="Recipient's username" aria-describedby="button-addon2">
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
                    <th scope="col">ID User</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Handphone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($dataUser)) { ?>
                    <th class="text-center" colspan="9">Data Tidak Ditemukan</th>
                <?php } else { ?>
                    <?php foreach ($dataUser as $user) { ?>
                        <tr class="text-center">
                            <th scope="row"><?= $number++ ?></th>
                            <td><?= $user['idUser'] ?></td>
                            <td><?= $user['nama'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['handphone'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['alamat'] ?></td>
                            <td class="d-grid justify-content-center">
                                <ul class="d-flex justify-content-center">
                                    <li>
                                        <input type="hidden" name="idOrder" value="<?= $user['idUser'] ?>">
                                        <button class="on-delete-user" type="submit">
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
            <?= $pager->links('user','custom_pagination') ?>
        </div>
    </div>
<?= $this->endSection() ?>