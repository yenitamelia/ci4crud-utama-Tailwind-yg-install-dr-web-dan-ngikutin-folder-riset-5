<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Form Tambah Surat Masuk</div>
    <form action="/surat/save" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3 grid grid-cols-6">
            <label for="date">Tanggal Surat</label>
            <input type="date" id="date" name="tanggal" class="border-2 border-blue-500 rounded-lg px-2">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat" class="border-2 border-blue-500 rounded-lg px-2">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <label for="dari">Dari</label>
            <input type="text" id="dari" name="dari" class="border-2 border-blue-500 rounded-lg px-2">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <label for="perihal">Perihal</label>
            <input type="text" id="perihal" name="perihal" class="border-2 border-blue-500 rounded-lg px-2">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <label for="lampiran">Lampiran</label>
            <input type="text" id="lampiran" name="lampiran" class="border-2 border-blue-500 rounded-lg px-2">
        </div>
        <button type="submit" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Submit</button>
    </form>
</div>

<?= $this->endSection(); ?>