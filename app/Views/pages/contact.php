<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2>Contact Us</h2>
<?php foreach ($alamat as $a) : ?>
    <ul>
        <li><?= $a['tipe']; ?></li>
        <li><?= $a['alamat']; ?></li>
        <li><?= $a['kota']; ?></li>
    </ul>
<?php endforeach; ?>
<?= $this->endSection(); ?>