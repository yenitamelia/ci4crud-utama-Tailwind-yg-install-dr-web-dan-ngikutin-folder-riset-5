<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Form Ubah Surat Masuk</div>
    <!-- Nampilin pesan error di view -->
    <!-- <h1>$validation->ListErrors();</h1> -->
    <!-- Dapet surat[id] nya dari controller -->
    <form action="/surat/update/<?= $surat['id']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="grid grid-cols-6">
            <label for="date">Tanggal Surat</label>
            <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
            <input type="date" id="date" name="tanggal" class="border-2 <?= ($validation->hasError('tanggal')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('tanggal')) ? old('tanggal') : $surat['tanggal'] ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('tanggal'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat" class="border-2 <?= ($validation->hasError('nomor_surat')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('nomor_surat')) ? old('nomor_surat') : $surat['nomor_surat'] ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('nomor_surat'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="dari">Dari</label>
            <input type="text" id="dari" name="dari" class="border-2 <?= ($validation->hasError('dari')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('dari')) ? old('dari') : $surat['dari'] ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('dari'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="perihal">Perihal</label>
            <input type="text" id="perihal" name="perihal" class="border-2 <?= ($validation->hasError('perihal')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('perihal')) ? old('perihal') : $surat['perihal'] ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('perihal'); ?>
            </div>
        </div>
        <div class="mb-3 grid grid-cols-6">
            <label for="lampiran">Lampiran</label>
            <input type="text" id="lampiran" name="lampiran" class="border-2 border-blue-500 rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('lampiran')) ? old('lampiran') : $surat['lampiran'] ?>">
        </div>
        <button type="submit" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Ubah</button>
    </form>
</div>

<?= $this->endSection(); ?>