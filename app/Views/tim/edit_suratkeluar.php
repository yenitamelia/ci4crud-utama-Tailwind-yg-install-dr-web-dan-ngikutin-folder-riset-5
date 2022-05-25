<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container py-10">
    <div class="mx-auto w-3/5 shadow-inner rounded-2xl py-6 px-8 bg-gray-100">
        <div class="text-xl text-center mb-8">Form Edit Surat Keluar</div>
        <!-- Nampilin pesan error di view -->
        <!-- <h1>$validation->ListErrors;</h1> -->
        <!-- Dapet surat id nya dari controller -->
        <form action="/Tim/SuratKeluar/update/<?= $surat_keluar['id']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Menyimpan file lampiran lama biar ga bermasalah waktu yg diganti cuman judulnya aja, dst -->
            <input type="hidden" name="file_keluarLama" value="<?= $surat_keluar['file_keluar']; ?>">
            <div class="grid grid-cols-3">
                <label for="nomor_urut">Nomor Urut</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="text" id="nomor_urut" name="nomor_urut" class="col-span-2 border-2 <?= ($validation->hasError('nomor_urut')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('nomor_urut')) ? old('nomor_urut') : $surat_keluar['nomor_urut'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('nomor_urut'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="alamat">Alamat</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="text" id="alamat" name="alamat" class="col-span-2 border-2 <?= ($validation->hasError('alamat')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('alamat')) ? old('alamat') : $surat_keluar['alamat'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('alamat'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="perihal">Perihal</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="text" id="perihal" name="perihal" class="col-span-2 border-2 <?= ($validation->hasError('perihal')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('perihal')) ? old('perihal') : $surat_keluar['perihal'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('perihal'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="tanggal_keluar">Tanggal Keluar</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="col-span-2 border-2 <?= ($validation->hasError('tanggal_keluar')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('tanggal_keluar')) ? old('tanggal_keluar') : $surat_keluar['tanggal_keluar'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('tanggal_keluar'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="lampiran">Lampiran</label>
                <!-- valuenya dikasih pengkondisian,biar apabila ada data yg diubah, trus misal gagal waktu mencet ubah data, biar data yg udah diubah barusan tadi ga ilang/balik ke value aslinya sebelum diubah, alias data yg diubah terakhir ini masih kesimpan-->
                <input type="text" id="lampiran" name="lampiran" class="col-span-2 border-2 <?= ($validation->hasError('lampiran')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('lampiran')) ? old('lampiran') : $surat_keluar['lampiran'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('lampiran'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="nomor_petunjuk">Nomor Petunjuk</label>
                <input type="text" id="nomor_petunjuk" name="nomor_petunjuk" class="col-span-2 border-2 <?= ($validation->hasError('nomor_petunjuk')) ? 'col-span-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('nomor_petunjuk')) ? old('nomor_petunjuk') : $surat_keluar['nomor_petunjuk'] ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('nomor_petunjuk'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" class="col-span-2 border-2 <?= ($validation->hasError('keterangan')) ? 'col-span-2 border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= (old('keterangan')) ? old('keterangan') : $surat_keluar['keterangan'] ?>">
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
                    <span class="customLabel text-blue-500 absolute md:left-28 left-28 select-none cursor-default cursor md:text-sm text-sm" id="labelfile_keluar"><?= $surat_keluar['file_keluar']; ?></span>
                </div>
            </div>
            <div class="font-medium tracking-wide text-red-500 text-xs ml-1 mb-2">
                <?= $validation->getError('file_keluar'); ?>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 transition-colors duration-300 rounded-xl text-sm justify-end justify-items-end text-white px-3 py-1">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>