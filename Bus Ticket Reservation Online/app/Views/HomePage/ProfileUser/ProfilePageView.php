<?= $this->extend('HomePage/HomeLayout') ?>

<?= $this->section('content') ?>

    <div class="profile-user mx-auto">
        <div class="bg-profile position-relative">
            <div class="profile position-absolute top-100 start-50 translate-middle bg-warning rounded-circle">

            </div>
        </div>
        <div class="detail-user">
            <div class="detail-text">
                <h2 class="text-center"><?= $userLogIn['nama'] ?></h2>
            </div>
            <div class="about p-2">
                <h2 class="fw-bold">About <?= explode(' ', $userLogIn['nama'])[0] ?></h2>
                <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                <h5><span class="fw-bold">Username</span> : <?= $userLogIn['username'] ?></h5>
                <h5><span class="fw-bold">Email</span> : <?= substr_replace($userLogIn['email'], "********", 2,5) ?>
                    <button class="btn mt-2 btn-see" type="button">Lihat</button>
                    <span class="fw-bold d-none"><?= $userLogIn['email'] ?></span>
                </h5>
                <h5><span class="fw-bold">Handphone</span> : <?= substr_replace($userLogIn['handphone'], "********", 2,5)  ?>
                    <button class="btn mt-2 btn-see" type="button">Lihat</button>
                    <span class="fw-bold d-none"><?= $userLogIn['handphone'] ?></span>
                </h5>
                <h5><span class="fw-bold">Alamat</span> : <?= $userLogIn['alamat'] ?></h5>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
