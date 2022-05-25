<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">
    <div class="text-xl py-4"><b>Detail </b><span class="text-sm text-gray-500">Surat <?= $surat_keluar['perihal']; ?></span></div>
    <div class="w3-bar w3-border-bottom bg-gray-400 text-sm">
    </div>

    <div id="surat_masuk" class="w3-container city bg-white px-4 py-12 rounded-b-lg">

        <div class="grid grid-cols-6 gap-4  text-sm place-content-center justify-items-center place-items-center justify-center">
            <div></div>
            <div class="place-content-center self-start">
                <div>
                    <img src="/img/file.png" class="w-4/6 cursor-pointer" id="lihat-btn<?= $surat_keluar['id']; ?>" onclick="modalpdfSuratKeluar('<?= $surat_keluar['id']; ?>','<?= $surat_keluar['nomor_urut']; ?>')" alt="gambar">
                </div>
                <div class="flex pt-2 ml-5">
                    <div class="flex bg-blue-300 hover:bg-blue-400 rounded px-3 py-1 cursor-pointer">
                        <img src="/img/eye.png" class="flex-auto w-5 h-5 mr-1" alt="gambar">
                        <div class="flex-auto" id="disposisi-btn<?= $surat_keluar['id']; ?>" onclick="modalpdf('<?= $surat_keluar['id']; ?>','<?= $surat_keluar['nomor_urut']; ?>')">Lihat</div>
                    </div>
                </div>
                <div class="flex py-2 ml-1">
                    <a href="/Kasubag/SuratKeluar/download/<?= $surat_keluar['id']; ?>" class="flex bg-gray-300 hover:bg-gray-400 rounded px-3 py-1">
                        <img src="/img/download.png" class="flex-auto w-4 h-4 mr-1" alt="gambar">
                        <span class="flex-auto">Download</span>
                    </a>
                </div>
                <div class="flex ml-5">
                    <a href="/Kasubag/SuratKeluar/download/<?= $surat_keluar['id']; ?>" class="flex bg-gray-300 hover:bg-gray-400 rounded pl-3 pr-4 py-2">
                        <img src="/img/printing.png" class="flex-auto w-4 h-4 mr-1" alt="gambar">
                        <span class="flex-auto text-xs">Print</span>
                    </a>
                </div>
            </div>
            <div class="col-span-4">
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Nomor Urut</div>
                    <div class="col-span-2"><?= $surat_keluar['nomor_urut']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Alamat</div>
                    <div><?= $surat_keluar['alamat']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Perihal</div>
                    <div><?= $surat_keluar['perihal']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Tanggal Keluar</div>
                    <div><?= $surat_keluar['tanggal_keluar']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Lampiran</div>
                    <div><?= $surat_keluar['lampiran']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Nomor Petunjuk</div>
                    <div><?= $surat_keluar['nomor_petunjuk']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Keterangan</div>
                    <div><?= $surat_keluar['keterangan']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">File</div>
                    <div><?= $surat_keluar['file_keluar']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-black bg-opacity-50 fixed inset-0 hidden justify-end items-left z-30 w-full h-screen" id="overlay">
        <div class="bg-white py-2 px-3 rounded shadow-xl text-gray-800 absolute top-2 z-20 w-4/5 h-screen">
            <div class="flex justify-between items-center p-1">
                <h4 class="font-bold" id="noSurat">Surat No. </h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <embed src="<?= base_url() . "/file_keluar/" . $surat_keluar['file_keluar'] ?>" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>

    <div class="w3-container w3-light-grey w3-padding">
        <?php if (session('auth_groups_id') == 1) : ?>
            <div class="text-2xl mt-2">Form Disposisi</div>
            <!-- Nampilin pesan error di view -->
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

    </div>
    <?= $this->endSection(); ?>