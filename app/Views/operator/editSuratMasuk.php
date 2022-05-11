<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container py-10">
    <div class="mx-auto w-3/5 shadow-inner rounded-2xl py-6 px-8 bg-gray-100">
        <div class="text-xl text-center mb-8">Form Edit Surat Masuk</div>
        <!-- Nampilin pesan error di view -->
        <!-- <h1>$validation->ListErrors();</h1> -->
        <!-- Dapet surat[id] nya dari controller -->
        <form action="/Kasubag/Surat/update/<?= $surat['id']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Menyimpan file file_masuk lama biar ga bermasalah waktu yg diganti cuman judulnya aja, dst -->
            <input type="hidden" name="file_masukLama" value="<?= $surat['file_masuk']; ?>">
            <div class="grid grid-cols-3">
                <label for="nomor_agenda">Nomor Agenda</label>
                <label for="nomor_agenda"><?= (old('nomor_agenda')) ? old('nomor_agenda') : $surat['nomor_agenda'] ?></label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="text" id="nomor_agenda" name="nomor_agenda" class="col-span-2 border-2 <?= ($validation->hasError('nomor_agenda')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('nomor_agenda')) ? old('nomor_agenda') : $surat['nomor_agenda'] ?>" hidden>
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('nomor_agenda'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="tanggal_penerimaan">Tanggal Penerimaan</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" class="col-span-2 border-2 <?= ($validation->hasError('tanggal_penerimaan')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('tanggal_penerimaan')) ? old('tanggal_penerimaan') : $surat['tanggal_penerimaan'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('tanggal_penerimaan'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="tk_keamanan">Tingkat Keamanan</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="text" id="tk_keamanan" name="tk_keamanan" class="col-span-2 border-2 <?= ($validation->hasError('tk_keamanan')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('tk_keamanan')) ? old('tk_keamanan') : $surat['tk_keamanan'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('tk_keamanan'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="tanggal_penyelesaian">Tanggal Penyelesaian</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="date" id="tanggal_penyelesaian" name="tanggal_penyelesaian" class="col-span-2 border-2 <?= ($validation->hasError('tanggal_penyelesaian')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('tanggal_penyelesaian')) ? old('tanggal_penyelesaian') : $surat['tanggal_penyelesaian'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('tanggal_penyelesaian'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="date">Tanggal Surat</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="date" id="date" name="tanggal" class="col-span-2 border-2 <?= ($validation->hasError('tanggal')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('tanggal')) ? old('tanggal') : $surat['tanggal'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('tanggal'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="nomor_surat">Nomor Surat</label>
                <input type="text" id="nomor_surat" name="nomor_surat" class="col-span-2 border-2 <?= ($validation->hasError('nomor_surat')) ? 'col-span-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('nomor_surat')) ? old('nomor_surat') : $surat['nomor_surat'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('nomor_surat'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="dari">Dari</label>
                <input type="text" id="dari" name="dari" class="col-span-2 border-2 <?= ($validation->hasError('dari')) ? 'col-span-2 border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('dari')) ? old('dari') : $surat['dari'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('dari'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="perihal">Perihal</label>
                <input type="text" id="perihal" name="perihal" class="col-span-2 border-2 <?= ($validation->hasError('perihal')) ? 'col-span-2 border-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('perihal')) ? old('perihal') : $surat['perihal'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('perihal'); ?>
                </div>
            </div>
            <div class="mb-3 grid grid-cols-3">
                <label for="lampiran">Lampiran</label>
                <input type="text" id="lampiran" name="lampiran" class="col-span-2 border-2 border-blue-500 rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('lampiran')) ? old('lampiran') : $surat['lampiran'] ?>">
            </div>
            <p class="text-blue-500 font-bold">Unggah File Surat Masuk</p>
            <div class="flex mt-5">
                <div class="flex justify-start items-center mb-1 w-full relative">
                    <input type="file" hidden accept=".pdf" title="Pilih File" id='file_masuk' name="file_masuk" onchange="label()">
                    <label for="file_masuk" title="Harus Diisi" class="bg-blue-500 text-white rounded-full w-24 py-1 text-center cursor-pointer hover:bg-blue-400 transition-colors duration-300 text-sm mr-4 outline-none">Pilih File</label>
                    <span class="customLabel text-blue-500 absolute md:left-28 left-28 select-none cursor-default cursor md:text-sm text-sm" id="labelfile_masuk"><?= $surat['file_masuk']; ?></span>
                </div>
            </div>
            <div class="font-medium tracking-wide text-red-500 text-xs ml-1 mb-2">
                <?= $validation->getError('file_masuk'); ?>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 transition-colors duration-300 rounded-xl text-sm justify-end justify-items-end text-white px-3 py-1">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>