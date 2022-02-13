<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">
    <div class="text-xl py-4"><b>Detail </b><span class="text-sm text-gray-500">Surat <?= $surat['perihal']; ?></span></div>
    <div class="w3-bar w3-border-bottom bg-gray-400 text-sm">
        <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'surat_masuk')">Surat Masuk</button>
        <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'disposisi')">Disposisi</button>
        <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'lembar_disposisi')">Lembar Disposisi</button>
    </div>

    <div id="surat_masuk" class="w3-container city bg-white px-4 py-12 rounded-b-lg">

        <div class="grid grid-cols-4 gap-4 text-sm place-content-center  cursor-pointer justify-items-center place-items-center justify-center">
            <div class="place-content-center self-start cursor-pointer">
                <button type="button" class="cursor-pointer"><img src="/img/fil.png" class="w-2/5" alt="gambar" target='_blank'></button>
            </div>
            <div class="col-span-3 ...">
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
                    <div class="text-right">Isi Disposisi</div>
                    <div id="isi_disposisi">-</div>
                </div>
                <div class="grid grid-cols-3 gap-8 mb-2">
                    <div class="text-right">Diteruskan</div>
                    <div id="diteruskan">-</div>
                </div>

            </div>
        </div>




    </div>

    <div id="disposisi" class="w3-container city bg-white p-4 rounded-b-lg">
        <h1>Disposisi</h1>
        <p>Paris is the capital of France.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

    <div id="lembar_disposisi" class="w3-container city bg-white p-4 rounded-b-lg">
        <div class=" container mx-auto px-6">
            <div class="text-2xl mt-2">Lembar Disposisi Surat <?= $surat['perihal']; ?></div>
            <div class="my-6 mx-52">
                <table class="table-fixed w-full border-none">
                    <thead>
                        <tr>
                            <tD class="" colspan="4"><b>BADAN PUSAT STATISTIK <br> KABUPATEN TUBAN</b></tD>
                            <!-- <th class="w-1/4 ...">Author</th>
                <th class="w-1/4 ...">Views</th>
                <th class="w-1/4 ...">Views</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="4"><b>LEMBAR DISPOSISI</b></td>
                            <!-- <th class="w-1/4 ...">Author</th>
                <th class="w-1/4 ...">Views</th>
                <th class="w-1/4 ...">Views</th> -->
                        </tr>
                        <tr>
                            <td class="pl-2">Nomor Agenda</td>
                            <td class="pl-2"><?= $surat['nomor_agenda']; ?></td>
                            <td class="pl-2">Tingkat Keamanan</td>
                            <td class="pl-2"><?= $surat['tk_keamanan']; ?></td>
                        </tr>
                        <tr class="bg-blue-200">
                            <td class="pl-2">Tanggal Penerimaan</td>
                            <td class="pl-2"><?= $surat['tanggal_penerimaan']; ?></td>
                            <td class="pl-2">Tanggal Penyelesaian</td>
                            <td class="pl-2"><?= $surat['tanggal_penyelesaian']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="pl-2">Tanggal Surat</td>
                            <td class="pl-20" colspan="3"> : <?= $surat['tanggal']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="pl-2">Nomor Surat</td>
                            <td class="pl-20" colspan="3"> : <?= $surat['nomor_surat']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="pl-2">Dari</td>
                            <td class="pl-20" colspan="3"> : <?= $surat['dari']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="pl-2">Perihal</td>
                            <td class="pl-20" colspan="3"> : <?= $surat['perihal']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="pl-2">Lampiran</td>
                            <td class="pl-20" colspan="3"> : <?= $surat['lampiran']; ?></td>
                        </tr>
                        <tr class="">
                            <td class="text-center" colspan="2">Disposisi</td>
                            <td class="text-center" colspan="2">Diteruskan kepada :</td>
                        </tr>
                        <tr class="">
                            <td class="text-center" colspan="2">Untuk dipedomani</td>
                            <td class="text-center" colspan="2">1. </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w3-container w3-light-grey w3-padding">



        <?php if (session('auth_groups_id') == 1) : ?>

            <div class="mt-5">
                <!-- <iframe src="lampiran/" height="100%" width="100%" title="W3Schools Free Online Web Tutorials"></iframe> -->
                <!-- <iframe src="/surat/detail/$surat['lampiran']" height="500px" width="100%" title="W3Schools Free Online Web Tutorials"></iframe> -->

                <object data="<?= base_url() . "/lampiran/" . $surat['lampiran'] ?>#toolbar=0" type="application/pdf" width="100%" height="800px">
                    <embed src="/kasubag/surat/read/" width="680" height="480" allowfullscreen />
            </div>
        <?php endif; ?>

        <!-- <a href="/surat/edit/?= $surat['id']; ?>" class="mb-5 bg-yellow-500 rounded-xl text-sm text-white px-3 py-1">Edit</a> -->
        <!-- <a href="/Kasubag/surat/lembar/?= $surat['id']; ?>" class="mb-5 bg-blue-700 rounded-xl text-sm text-white px-3 py-1">Lembar</a> -->

        <?php if (session('auth_groups_id') != 2) : ?>
            <a href="/surat/download/<?= $surat['id']; ?>" class="mb-5 bg-blue-300 rounded-xl text-sm text-white px-3 py-1">Download File</a>
        <?php endif; ?>

        <!-- <form action="/surat/?= $surat['id']; ?>" method="POST" class="inline">
            ?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="bg-red-500 rounded-xl text-sm text-white px-3 py-1" onclick="return confirm('Apakah Anda Yakin?');">Delete</button>
        </form> -->

        <a href="/surat" class="text-blue-500">Kembali ke daftar surat</a>
    </div>
    <?= $this->endSection(); ?>