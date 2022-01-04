<?= $this->extend('layout/sidebar'); ?>

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
            <tr>
                <td class="w-1/2">Isi Disposisi</td>
                <td class="w-1/2" id="isi_disposisi"></td>
            </tr>
            <tr>
                <td class="w-1/2">Diteruskan</td>
                <td class="w-1/2" id="diteruskan"><?= $surat['diteruskan']; ?></td>
            </tr>
        </thead>
    </table>

    <?php if (in_groups('kepala')) : ?>
        <div class="text-2xl mt-2">Form Disposisi</div>
        <!-- Nampilin pesan error di view -->
        <!-- <h1>$validation->ListErrors();</h1> -->
        <form action="/surat/saveDisposisi/<?= $surat['id']; ?>" method="post" enctype="multipart/form-data" id="saveDisposisi">
            <?= csrf_field(); ?>
            <!-- Menyimpan file lampiran lama biar ga bermasalah waktu yg diganti cuman judulnya aja, dst -->
            <input type="hidden" name="lampiranLama" value="<?= old('lampiran'); ?>">
            <div class="grid grid-cols-6">
                <label for="isi_disposisi">Isi Disposisi</label>
                <input type="text" id="isi_disposisi" name="isi_disposisi" class="border-2 <?= ($validation->hasError('isi_disposisi')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('isi_disposisi'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-6">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('isi_disposisi'); ?>
                </div>
            </div>
            <div class="grid grid-cols-6">
                <label for="tanggal_penerimaan">Diteruskan kepada :</label>
                <?php foreach ($role as $row) : ?>
                    <?php if (($row["id"]) > 2) : ?>
                        <input type="checkbox" id="<?= $row["name"]; ?>" name="<?= $row["name"]; ?>" value="<?= $row["id"]; ?>">
                        <label for="<?= $row["name"]; ?>"><?= $row["description"]; ?></label><br>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- <div class="mb-3 grid grid-cols-6">
            <label for="lampiran">Lampiran</label>
            <input type="text" id="lampiran" name="lampiran" class="border-2 border-blue-500 rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('lampiran'); ?>">
        </div> -->
            <p class="text-blue-500 font-bold">Unggah Tanda Tangan Elektronik</p>
            <div class="flex mt-5">
                <div class="flex justify-start items-center mb-1 w-full relative">
                    <input type="file" hidden accept="image/jpg, image/jpeg, image/png" title="Pilih File" id='gambar' name="gambar" onchange="label2()">
                    <label for="gambar" title="Harus Diisi" class="bg-blue-500 text-white rounded-full w-24 py-1 text-center cursor-pointer hover:bg-blue-400 transition-colors duration-300 text-xs mr-4 outline-none">Pilih Gambar</label>
                    <span class="customLabel text-blue-500 absolute md:left-28 left-28 select-none cursor-default cursor md:text-sm text-sm" id="labelGambar"><?= old('gambarLama'); ?></span>
                </div>
            </div>
            <div class="font-medium tracking-wide text-red-500 text-xs ml-1 mb-2">
                <?= $validation->getError('gambar'); ?>
            </div>

            <button type="submit" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Submit</button>
        </form>

        <div class="mt-5">
            <!-- <iframe src="lampiran/" height="100%" width="100%" title="W3Schools Free Online Web Tutorials"></iframe> -->
            <!-- <iframe src="/surat/detail/$surat['lampiran']" height="500px" width="100%" title="W3Schools Free Online Web Tutorials"></iframe> -->

            <object data="<?= base_url() . "/lampiran/" . $surat['lampiran'] ?>#toolbar=0" type="application/pdf" width="100%" height="800px">
                <!-- <embed src="/surat/read/" width="680" height="480" allowfullscreen /> -->
        </div>
    <?php endif; ?>

    <a href="/surat/edit/<?= $surat['id']; ?>" class="mb-5 bg-yellow-500 rounded-xl text-sm text-white px-3 py-1">Edit</a>
    <a href="/surat/lembar/<?= $surat['id']; ?>" class="mb-5 bg-blue-700 rounded-xl text-sm text-white px-3 py-1">Lembar</a>

    <?php if (in_groups(['bid_umum', 'kf'])) : ?>
        <a href="/surat/download/<?= $surat['id']; ?>" class="mb-5 bg-blue-300 rounded-xl text-sm text-white px-3 py-1">Download File</a>
    <?php endif; ?>

    <form action="/surat/<?= $surat['id']; ?>" method="POST" class="inline">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="bg-red-500 rounded-xl text-sm text-white px-3 py-1" onclick="return confirm('Apakah Anda Yakin?');">Delete</button>
    </form>

    <a href="/surat" class="text-blue-500">Kembali ke daftar surat</a>
</div>
<?= $this->endSection(); ?>