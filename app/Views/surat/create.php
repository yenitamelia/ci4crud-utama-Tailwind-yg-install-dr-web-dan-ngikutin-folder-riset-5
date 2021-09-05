<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Form Tambah Surat Masuk</div>
    <!-- Nampilin pesan error di view -->
    <!-- <h1>$validation->ListErrors();</h1> -->
    <form action="/surat/save" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <!-- Menyimpan file lampiran lama biar ga bermasalah waktu yg diganti cuman judulnya aja, dst -->
        <input type="hidden" name="lampiranLama" value="<?= old('lampiran'); ?>">
        <div class="grid grid-cols-6">
            <label for="nomor_agenda">Nomor Agenda</label>
            <input type="text" id="nomor_agenda" name="nomor_agenda" class="border-2 <?= ($validation->hasError('nomor_agenda')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('nomor_agenda'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('nomor_agenda'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="tanggal_penerimaan">Tanggal Penerimaan</label>
            <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" class="border-2 <?= ($validation->hasError('tanggal_penerimaan')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('tanggal_penerimaan'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('tanggal_penerimaan'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="tk_keamanan">Tingkat Keamanan</label>
            <input type="text" id="tk_keamanan" name="tk_keamanan" class="border-2 <?= ($validation->hasError('tk_keamanan')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('tk_keamanan'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('tk_keamanan'); ?>
            </div>
        </div>
        <div class="mb-3 grid grid-cols-6">
            <label for="tanggal_penyelesaian">Tanggal Penyelesaian</label>
            <input type="date" id="tanggal_penyelesaian" name="tanggal_penyelesaian" class="border-2 <?= ($validation->hasError('tanggal_penyelesaian')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('tanggal_penyelesaian'); ?>">
        </div>
        <div class="grid grid-cols-6">
            <label for="date">Tanggal Surat</label>
            <input type="date" id="date" name="tanggal" class="border-2 <?= ($validation->hasError('tanggal')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('tanggal'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('tanggal'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat" class="border-2 <?= ($validation->hasError('nomor_surat')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('nomor_surat'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('nomor_surat'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="dari">Dari</label>
            <input type="text" id="dari" name="dari" class="border-2 <?= ($validation->hasError('dari')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('dari'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('dari'); ?>
            </div>
        </div>
        <div class="grid grid-cols-6">
            <label for="perihal">Perihal</label>
            <input type="text" id="perihal" name="perihal" class="border-2 <?= ($validation->hasError('perihal')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('perihal'); ?>">
        </div>
        <div class="mb-3 grid grid-cols-6">
            <div></div>
            <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <?= $validation->getError('perihal'); ?>
            </div>
        </div>
        <!-- <div class="mb-3 grid grid-cols-6">
            <label for="lampiran">Lampiran</label>
            <input type="text" id="lampiran" name="lampiran" class="border-2 border-blue-500 rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('lampiran'); ?>">
        </div> -->
        <p class="text-blue-500 font-bold">Unggah Lampiran</p>
        <div class="flex mt-5">
            <div class="flex justify-start items-center mb-1 w-full relative">
                <input type="file" hidden accept=".doc, .docx, .pdf" title="Pilih File" id='lampiran' name="lampiran" onchange="label()">
                <label for="lampiran" title="Harus Diisi" class="bg-blue-500 text-white rounded-full w-24 py-1 text-center cursor-pointer hover:bg-blue-400 transition-colors duration-300 text-sm mr-4 outline-none">Pilih File</label>
                <span class="customLabel text-blue-500 absolute md:left-28 left-28 select-none cursor-default cursor md:text-sm text-sm" id="labelLampiran"><?= old('lampiranLama'); ?></span>
            </div>
        </div>
        <div class="font-medium tracking-wide text-red-500 text-xs ml-1 mb-2">
            <?= $validation->getError('lampiran'); ?>
        </div>

        <button type="submit" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">Submit</button>
    </form>
</div>

<?= $this->endSection(); ?>