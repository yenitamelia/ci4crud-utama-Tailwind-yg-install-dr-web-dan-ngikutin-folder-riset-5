<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">




    <div class="text-2xl py-5">Data Surat Masuk</div>
    <!-- Alert jika data berhasil ditambahkan -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="bg-green-200 text-green-600 text-sm py-3 px-6 rounded-lg mb-5">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <?php if (session('auth_groups_id') == 1) : ?>
        <!-- Tombol Tambah Surat -->
        <a href="/surat/create" class="mb-5 bg-blue-500 hover:bg-blue-600 rounded text-sm text-white px-3 py-1">+ Tambah Surat Masuk</a>
    <?php endif; ?>
    <div class="mt-5">
        <table id="myTable" class="display text-sm" width="100%">
            <thead>
                <tr>
                    <th class="w-1/10">No</th>
                    <th class="w-1/8">Tanggal Surat</th>
                    <th class="w-1/8">Tanggal Diterima</th>
                    <th class="w-1/3">Perihal</th>
                    <th class="w-1/7">Aksi</th>
                    <!-- <th class="w-1/5">Aksi 2</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($surat as $s) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $s->tanggal; ?></td>
                        <td><?= $s->tanggal_penerimaan; ?></td>
                        <td><?= $s->perihal; ?></td>
                        <td class="text-center">
                            <a href="/surat/<?= $s->id_surat; ?>" class="bg-blue-500 hover:bg-blue-600 text-xs rounded text-white px-3 py-1">Detail</a>
                        </td>
                        <!-- <td>
                        <a href="/surat/viewpdf/<= $s->id; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">View Kepala</a>
                    </td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript" charset="utf8" src="https://releases.jquery.com/git/jquery-3.x-git.js"></script>
<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>




<?= $this->endSection(); ?>