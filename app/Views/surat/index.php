<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">
    <div class="text-2xl my-5">Daftar Surat</div>
    <!-- Alert jika data berhasil ditambahkan -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="bg-green-200 text-green-600 text-sm py-3 px-6 rounded-lg mb-5">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <!-- Tombol Tambah Surat -->
    <a href="/surat/create" class="mb-5 bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Tambah Surat</a>
    <table class="table-fixed text-center">
        <thead>
            <tr>
                <th class="w-1/6">No</th>
                <th class="w-1/5">Status</th>
                <th class="w-1/3">Perihal</th>
                <th class="w-1/5">Aksi</th>
                <th class="w-1/5">Aksi 2</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($surat as $s) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td>Telah dikirim ke kepala</td>
                    <td><?= $s['perihal']; ?></td>
                    <td>
                        <a href="/surat/<?= $s['id']; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Detail</a>
                    </td>
                    <td>
                        <a href="/surat/viewpdf/<?= $s['id']; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">View Kepala</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>