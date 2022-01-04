<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">
    <div class="text-2xl mt-2">Lembar Disposisi Surat <?= $surat['perihal']; ?></div>
    <div class="my-6 mx-52">
        <table class="table-fixed w-full">
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
<?= $this->endSection(); ?>