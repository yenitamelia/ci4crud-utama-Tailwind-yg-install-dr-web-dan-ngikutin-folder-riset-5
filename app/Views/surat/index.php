<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Daftar Surat</div>
    <table class="table-fixed text-center">
        <thead>
            <tr>
                <th class="w-1/4">No</th>
                <th class="w-1/3">Perihal</th>
                <th class="w-1/4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($surat as $s) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $s['perihal']; ?></td>
                    <td>
                        <a href="/surat/<?= $s['id']; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>