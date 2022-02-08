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

        <div class="grid grid-cols-4 gap-4 text-sm place-content-center justify-items-center place-items-center justify-center">
            <div class="place-content-center self-start">
                <img src="/img/file.png" class="w-2/5" alt="gambar">
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



        <?php if (in_groups('kepala')) : ?>
            <div class="text-2xl mt-2">Form Disposisi</div>
            <!-- Nampilin pesan error di view -->
            <!-- <h1>$validation->ListErrors();</h1> -->
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

        <a href="/surat/edit/<?= $surat['id']; ?>" class="mb-5 bg-yellow-500 rounded-xl text-sm text-white px-3 py-1">Edit</a>
        <a href="/surat/lembar/<?= $surat['id']; ?>" class="mb-5 bg-blue-700 rounded-xl text-sm text-white px-3 py-1">Lembar</a>

        <?php if (in_groups(['bid_umum', 'kf'])) : ?>
            <a href="/surat/download/<?= $surat['id']; ?>" class="mb-5 bg-blue-300 rounded-xl text-sm text-white px-3 py-1">Download File</a>
        <?php endif; ?>

        <form action="/surat/<?= $surat['id']; ?>" method="POST" class="inline">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="bg-red-500 rounded-xl text-sm text-white px-3 py-1" onclick="return confirm('Apakah Anda Yakin?');">Delete</button>
        </form>

        <a href="/surat" class="text-blue-500">Kembali ke daftar surat</a>
    </div>
    <?= $this->endSection(); ?>