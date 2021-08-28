<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Detail Surat <?= $surat['perihal']; ?></div>
    <table class="table-fixed text-center">
        <thead>
            <tr>
                <td class="w-1/2">Tanggal Surat</td>
                <td class="w-1/2"><?= $surat['tanggal']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Nomor Surat</td>
                <td class="w-1/2"><?= $surat['nomor_surat']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Dari</td>
                <td class="w-1/2"><?= $surat['dari']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Perihal</td>
                <td class="w-1/2"><?= $surat['perihal']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Lampiran</td>
                <td class="w-1/2">-</td>
            </tr>
        </thead>
    </table>

    <a href="" class="bg-yellow-500 rounded-xl text-sm text-white px-3 py-1">Edit</a>
    <a href="" class="bg-red-500 rounded-xl text-sm text-white px-3 py-1">Delete</a>
    <a href="/surat" class="text-blue-500">Kembali ke daftar surat</a>
</div>
<?= $this->endSection(); ?>