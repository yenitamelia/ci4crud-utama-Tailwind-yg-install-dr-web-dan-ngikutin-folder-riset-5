<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Detail Surat <?= $surat['perihal']; ?></div>
    <table class="table-fixed text-center">
        <thead>
            <tr>
                <td class="w-1/2">Nomor Agenda</td>
                <td class="w-1/2"><?= $surat['nomor_agenda']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Tanggal Penerimaan</td>
                <td class="w-1/2"><?= $surat['tanggal_penerimaan']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Tingkat Keamanan</td>
                <td class="w-1/2"><?= $surat['tk_keamanan']; ?></td>
            </tr>
            <tr>
                <td class="w-1/2">Tanggal Penyelesaian</td>
                <td class="w-1/2"><?= $surat['tanggal_penyelesaian']; ?></td>
            </tr>
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
                <td class="w-1/2"><?= $surat['lampiran']; ?></td>
            </tr>
        </thead>
    </table>

    <a href="/surat/edit/<?= $surat['id']; ?>" class="bg-yellow-500 rounded-xl text-sm text-white px-3 py-1">Edit</a>
    <div>
        <a href="/surat/lembar/<?= $surat['id']; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Lembar</a>
    </div>
    <form action="/surat/<?= $surat['id']; ?>" method="POST" class="inline">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="bg-red-500 rounded-xl text-sm text-white px-3 py-1" onclick="return confirm('Apakah Anda Yakin?');">Delete</button>
    </form>

    <a href="/surat" class="text-blue-500">Kembali ke daftar surat</a>
</div>
<?= $this->endSection(); ?>