<?= $this->extend('v_layout') ?> <!-- Mengambil template dari v_layout.php -->

<?= $this->section('content') ?> <!-- Mengambil content dari v_layout.php -->

<section>
    <h1><?= $judul ?></h1>
    <div class="about-container">
        <div class="about-picture">
            <img src="<?= base_url() ?>/img/me.png" alt="profile">
        </div>
        <div class="about-description">
            <div class="typography">
                <p align="justify">
                    Nama saya Fahri Anggara, saya adalah seorang Web Programmer. Saat ini saya sedang
                    belajar di Universitas Bina Sarana Informatika, Fakultas Teknik Informatika, Jurusan
                    Rekayasa Perangkat Lunak. Saya sangat tertarik dengan dunia pemrograman!
                </p>
                <p align="justify">
                    Bahasa pemrograman yang saya sukai adalah PHP, karena saya merasa PHP sangat mudah untuk
                    dipelajari dan dipahami. Selain itu, PHP juga memiliki banyak framework yang dapat
                    mempermudah pekerjaan seorang programmer. Framework PHP yang saya sukai adalah Laravel 8+.
                </p> 
            </div>
            <ul class="social-media">
                <li>
                    <a href="https://github.com/fahrianggara" target="_blank">
                        Github
                    </a>
                </li>
                <li>
                    <a href="https://instagram.com/f.anggae" target="_blank">
                        Instagram
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>

<?= $this->endSection() ?> <!-- Mengakhiri content dari v_layout.php -->