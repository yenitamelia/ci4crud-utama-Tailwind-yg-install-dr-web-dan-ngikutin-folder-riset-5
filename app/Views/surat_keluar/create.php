<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container py-10">
    <div class="mx-auto w-3/5 shadow-inner rounded-2xl py-6 px-8 bg-gray-100">
        <div class="text-xl text-center mb-8">Form Tambah Surat Keluar</div>
        <!-- Nampilin pesan error di view -->
        <!-- <h1>$validation->ListErrors();</h1> -->
        <form action="/Kasubag/SuratKeluar/saveSuratKeluar" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Menyimpan file lampiran lama biar ga bermasalah waktu yg diganti cuman judulnya aja, dst -->
            <div class="grid grid-cols-3">
                <label for="nomor_urut">Nomor Urut</label>
                <input type="text" id="nomor_urut" name="nomor_urut" class="border-2 col-span-2 <?= ($validation->hasError('nomor_urut')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('nomor_urut'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('nomor_urut'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="alamat">Alamat Yang Dituju</label>
                <input type="text" id="alamat" name="alamat" class="border-2 col-span-2 <?= ($validation->hasError('alamat')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('alamat'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('alamat'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="perihal">Perihal Surat</label>
                <input type="text" id="perihal" name="perihal" class="border-2 col-span-2 <?= ($validation->hasError('perihal')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('perihal'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('perihal'); ?>
                </div>
            </div>
            <div class="mb-3 grid grid-cols-3">
                <label for="tanggal_keluar">Keluar Tanggal Nomor</label>
                <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="border-2 col-span-2 <?= ($validation->hasError('tanggal_keluar')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('tanggal_keluar'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('tanggal_keluar'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="lampiran">Lampiran</label>
                <input type="text" id="lampiran" name="lampiran" class="border-2 col-span-2 <?= ($validation->hasError('lampiran')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('lampiran'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('lampiran'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="nomor_petunjuk">Nomor Petunjuk</label>
                <input type="text" id="nomor_petunjuk" name="nomor_petunjuk" class="border-2 col-span-2 <?= ($validation->hasError('nomor_petunjuk')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('nomor_petunjuk'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('nomor_petunjuk'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" class="border-2 col-span-2 <?= ($validation->hasError('keterangan')) ? 'border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('keterangan'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('keterangan'); ?>
                </div>
            </div>
            <p class="text-blue-500 font-bold">Unggah File</p>
            <div class="flex mt-5">
                <div class="flex justify-start items-center mb-1 w-full relative">
                    <input type="file" hidden accept=".pdf" title="Pilih File" id='file_keluar' name="file_keluar" onchange="label_keluar()">
                    <label for="file_keluar" title="Harus Diisi" class="bg-blue-500 text-white rounded-full w-24 py-1 text-center cursor-pointer hover:bg-blue-400 transition-colors duration-300 text-sm mr-4 outline-none">Pilih File</label>
                    <span class="customLabel text-blue-500 absolute md:left-28 left-28 select-none cursor-default cursor md:text-sm text-sm" id="labelfile_keluar"><?= old('file_keluarLama'); ?></span>
                </div>
            </div>
            <div class="font-medium tracking-wide text-red-500 text-xs ml-1 mb-2">
                <?= $validation->getError('file_keluar'); ?>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 transition-colors duration-300 rounded-xl text-sm text-white px-3 py-1">Submit</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>