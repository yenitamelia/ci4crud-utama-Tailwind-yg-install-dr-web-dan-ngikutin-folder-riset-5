<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">
    <div class="text-xl py-4"><b>Detail </b><span class="text-sm text-gray-500">Surat <?= $surat['perihal']; ?></span></div>
    <div class="w3-bar w3-border-bottom bg-gray-400 text-sm">
        <button class="tablink w3-bar-item w3-button px-4 py-4" onclick="openCity(event, 'surat_masuk')">Surat Masuk</button>
        <!-- <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'disposisi')">Disposisi</button> -->
        <button class="tablink w3-bar-item w3-button px-4 py-4" onclick="openCity(event, 'lembar_disposisi')">Lembar Disposisi</button>
    </div>

    <div id="surat_masuk" class="w3-container city bg-white px-4 py-12 rounded-b-lg">

        <div class="grid grid-cols-6 gap-4 text-sm place-content-center justify-items-center place-items-center justify-center">
            <div></div>
            <div class="place-content-center self-start">
                <div>
                    <img src="/img/file.png" class="w-4/6 cursor-pointer" id="lihat-btn<?= $surat['id']; ?>" onclick="modalpdf('<?= $surat['id']; ?>','<?= $surat['nomor_surat']; ?>')" alt="gambar">
                </div>
                <div class="flex pt-2 ml-5">
                    <div class="flex bg-blue-300 hover:bg-blue-400 rounded px-3 py-2 cursor-pointer" id="disposisi-btn<?= $surat['id']; ?>" onclick="modalpdf('<?= $surat['id']; ?>','<?= $surat['nomor_surat']; ?>')">
                        <img src="/img/eye.png" class="flex-auto w-5 h-5 mr-1" alt="gambar">
                        <div class="flex-auto text-xs">Lihat</div>
                    </div>
                </div>
                <div class="flex py-2 ml-1">
                    <a href="/Kasubag/Surat/download/<?= $surat['id']; ?>" class="flex bg-gray-300 hover:bg-gray-400 rounded pl-3 pr-4 py-2">
                        <img src="/img/download.png" class="flex-auto w-4 h-4 mr-1" alt="gambar">
                        <span class="flex-auto text-xs">Download</span>
                    </a>
                </div>
            </div>
            <div class="col-span-4">
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Nomor Agenda</div>
                    <div class="col-span-2 ..."><?= $surat['nomor_agenda']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Tanggal Penerimaan</div>
                    <div><?= $surat['tanggal_penerimaan']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Tingkat Keamanan</div>
                    <div><?= $surat['tk_keamanan']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Tanggal Penyelesaian</div>
                    <div><?= $surat['tanggal_penyelesaian']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Tanggal Surat</div>
                    <div><?= $surat['tanggal']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Nomor Surat</div>
                    <div><?= $surat['nomor_surat']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Dari</div>
                    <div><?= $surat['dari']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Perihal</div>
                    <div><?= $surat['perihal']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Lampiran</div>
                    <div><?= $surat['lampiran']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">File</div>
                    <div><?= $surat['file_masuk']; ?></div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Isi Disposisi</div>
                    <?php if (isset($disposisi['isi_disposisi'])) { ?>
                        <div id="isi_disposisi">
                            <?= $disposisi['isi_disposisi']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Diteruskan</div>
                    <div id="diteruskan">
                        <?php $i = 1;
                        foreach ($role as $r) : ?>
                            <?php if ($r['status_disposisi'] == 1) : ?>
                                <?php if ($r['role_id'] == 8) : ?>
                                    <?= $i . '. ' . $r['fullname'] . '<br>';  ?>
                                <?php else : ?>
                                    <?= $i . '. ' . $r['description'] . '<br>';  ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php $i++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-black bg-opacity-50 fixed inset-0 hidden justify-end items-left z-30 w-full h-screen" id="overlay">
        <div class="bg-white py-2 px-3 rounded shadow-xl text-gray-800 absolute top-2 z-20 w-4/5 h-screen">
            <div class="flex justify-between items-center p-1">
                <h4 class="font-bold" id="noSurat"></h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <embed src="<?= base_url() . "/file_masuk/" . $surat['file_masuk'] ?>" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>

    <!-- <div id="disposisi" class="w3-container city bg-white p-4 rounded-b-lg">
        <h1>Disposisi</h1>
        <p>Paris is the capital of France.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div> -->

    <div id="lembar_disposisi" class="w3-container city bg-white p-4 rounded-b-lg">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-4 mt-5 gap-4">
                <div class="col-span-3 text-xl text-center mt-2">Lembar Disposisi Surat <?= $surat['perihal']; ?></div>
                <div class="py-2 ml-5 w-24">
                    <div class="flex bg-blue-300 hover:bg-blue-400 rounded px-5 py-2 cursor-pointer" id="disposisi-btn<?= $surat['id']; ?>" onclick="window.print();">
                        <img src="/img/printing.png" class="flex-auto w-5 h-5 mr-2" alt="gambar">
                        <div class="flex-auto text-xs">Print</div>
                    </div>
                </div>
            </div>
            <!-- <button class="bg-blue-300 hover:bg-blue-200 py-2 px-3 rounded-lg" onclick="window.print();">Print</button> -->
            <div class="my-6 mx-32">
                <table cellspacing="0" cellpadding="0" class="table-fixed text-sm w-full print-container">
                    <thead>
                        <tr>
                            <td class="" colspan="12">
                                <div class="flex items-center">
                                    <div class="flex-none"><img class="w-28 h-20" src="/img/bps.png" alt=""></div>
                                    <div class="flex-auto text-base ml-2"><b><i>BADAN PUSAT STATISTIK <br> KABUPATEN TUBAN</i></b></div>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center py-2 text-base" colspan="12"><b>LEMBAR DISPOSISI</b></td>
                        </tr>
                        <tr>
                            <td class="pl-2 py-1" colspan="4">Nomor Agenda</td>
                            <td class="pl-2 py-1" colspan="2"><?= $surat['nomor_agenda']; ?></td>
                            <td class="pl-2 py-1" colspan="4">Tingkat Keamanan</td>
                            <td class="pl-2 py-1" colspan="2"><?= $surat['tk_keamanan']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="pl-2 py-1" colspan="4">Tanggal Penerimaan</td>
                            <td class="pl-2 py-1" colspan="2"><?= $surat['tanggal_penerimaan']; ?></td>
                            <td class="pl-2 py-1" colspan="4">Tanggal Penyelesaian</td>
                            <td class="pl-2 py-1" colspan="2"><?= $surat['tanggal_penyelesaian']; ?></td>
                        </tr>
                        <tr class="none">
                            <td class="pl-2 py-2" colspan="3">Tanggal Surat</td>
                            <td class="pl-20" colspan="9"> : <?= $surat['tanggal']; ?></td>
                        </tr>
                        <tr class="none">
                            <td class="pl-2 py-2" colspan="3">Nomor Surat</td>
                            <td class="pl-20" colspan="9"> : <?= $surat['nomor_surat']; ?></td>
                        </tr>
                        <tr class="none">
                            <td class="pl-2 py-2" colspan="3">Dari</td>
                            <td class="pl-20" colspan="9"> : <?= $surat['dari']; ?></td>
                        </tr>
                        <tr class="none">
                            <td class="pl-2 py-2" colspan="3">Perihal</td>
                            <td class="pl-20" colspan="9"> : <?= $surat['perihal']; ?></td>
                        </tr>
                        <tr class="none mb-2">
                            <td class="pl-2 py-2 pb-3" colspan="3">Lampiran</td>
                            <td class="pl-20" colspan="9"> : <?= $surat['lampiran']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="text-center py-1" colspan="6">Disposisi</td>
                            <td class="text-center py-1" colspan="6">Diteruskan kepada :</td>
                        </tr>
                        <tr class="">
                            <?php if (isset($disposisi)) { ?>
                                <td class="text-left p-3" colspan="6">
                                    <div><?= $disposisi['isi_disposisi']; ?></div>
                                    <div class="grid justify-items-center mt-6">
                                        <div><img class="w-24 h-24 items-center justify-items-center justify-self-center" src="/gambar/<?= $disposisi['gambar']; ?>" alt=""></div>
                                    </div>
                                </td>
                            <?php } ?>
                            <td class="text-left p-3 content-start items-start" colspan="6">
                                <?php $i = 1;
                                foreach ($role as $r) : ?>
                                    <?php if ($r['status_disposisi'] == 1) : ?>
                                        <?php if ($r['role_id'] == 8) : ?>
                                            <?= $i . '. ' . $r['fullname'] . '<br>';  ?>
                                        <?php else : ?>
                                            <?= $i . '. ' . $r['description'] . '<br>';  ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php $i++;
                                endforeach; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w3-container w3-light-grey w3-padding">



        <?php if (session('role_id') == 1) : ?>

            <div class="mt-5">
                <!-- <iframe src="lampiran/" height="100%" width="100%" title="W3Schools Free Online Web Tutorials"></iframe> -->
                <!-- <iframe src="/surat/detail/$surat['lampiran']" height="500px" width="100%" title="W3Schools Free Online Web Tutorials"></iframe> -->

                <!-- <object data="<?= base_url() . "/lampiran/" . $surat['lampiran'] ?>#toolbar=0" type="application/pdf" width="100%" height="800px"> -->
                <!-- <embed src="/kasubag/surat/read/" width="680" height="480" allowfullscreen /> -->
            </div>
        <?php endif; ?>

        <!-- <a href="/surat/edit/?= $surat['id']; ?>" class="mb-5 bg-yellow-500 rounded-xl text-sm text-white px-3 py-1">Edit</a> -->
        <!-- <a href="/Kasubag/surat/lembar/?= $surat['id']; ?>" class="mb-5 bg-blue-700 rounded-xl text-sm text-white px-3 py-1">Lembar</a> -->

        <!-- <?php if (session('role_id') != 2) : ?>
            <a href="/Kasubag/Surat/download/<?= $surat['id']; ?>" class="mb-5 bg-blue-300 rounded-xl text-sm text-white px-3 py-1">Download File</a>
        <?php endif; ?> -->

        <!-- <form action="/surat/?= $surat['id']; ?>" method="POST" class="inline">
            ?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="bg-red-500 rounded-xl text-sm text-white px-3 py-1" onclick="return confirm('Apakah Anda Yakin?');">Delete</button>
        </form> -->

        <!-- <a href="/surat" class="text-blue-500">Kembali ke daftar surat</a> -->
    </div>


    <?= $this->endSection(); ?>