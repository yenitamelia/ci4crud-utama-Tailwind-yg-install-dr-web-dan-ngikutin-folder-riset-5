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
                        <div class="flex-auto" id="lihat-btn<?= $surat_keluar['id']; ?>" onclick="modalpdfSuratKeluar('<?= $surat_keluar['id']; ?>','<?= $surat_keluar['nomor_urut']; ?>')">Lihat</div>
                    </div>
                </div>
                <div class="flex py-2 ml-1">
                    <a href="/Kepala/SuratKeluar/download/<?= $surat_keluar['id']; ?>" class="flex bg-gray-300 hover:bg-gray-400 rounded px-3 py-1">
                        <img src="/img/download.png" class="flex-auto w-4 h-4 mr-1" alt="gambar">
                        <span class="flex-auto">Download</span>
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
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-keluar" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <embed src="<?= base_url() . "/file_keluar/" . $surat_keluar['file_keluar'] ?>" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>

    <?= $this->endSection(); ?>