<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">


    <div class="bg-black bg-opacity-50 fixed inset-0 hidden justify-center items-center z-30 w-full h-sceen" id="overlay">
        <div class="bg-white py-2 px-3 rounded shadow-xl text-gray-800 absolute top-12 z-20">
            <div class="flex justify-between items-center p-3">
                <h4 class="font-bold" id="noSurat">Disposisi Surat</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>

            <div class="mt-5 md:mt-0">
                <form action="/surat/saveDisposisi" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_surat" id="idSurat">
                    <div class="shadow overflow-y-auto h-96 sm:rounded-md">
                        <div class="bg-white py-4 px-6">
                            <div class="">
                                <div class="mb-3">
                                    <label for="perihal" class="block text-sm font-medium text-gray-700">Perihal</label>
                                    <!-- <div class="text-sm" id="perihalSurat"></div> -->
                                    <input disabled class="text-sm w-full py-1 px-2" name="perihal_surat" id="perihalSurat">
                                </div>
                                <div class="mb-3 sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Dari</label>
                                    <!-- <div class="text-sm" id="dariSurat"></div> -->
                                    <input disabled class="text-sm w-full py-1 px-2" name="dari_surat" id="dariSurat">
                                </div>
                                <div class="mb-4 sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Disposisi Kepada</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                            </div>
                                            <div class="ml-3 text-sm" id="showRole">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3 sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Isi Disposisi</label>
                                    <div class="text-sm mt-2"><textarea name="isi-disposisi" id="isi-disposisi" cols="60" rows="4" class="border border-gray-400 rounded-md p-2 focus:ring focus:outline-none"></textarea></div>
                                </div>
                                <div class="sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Unggah Tanda Tangan</label>
                                    <div class="flex mt-5">
                                        <div class="flex justify-start items-center mb-1 w-full relative">
                                            <img src="" alt="" id="gambar" class="w-20 h-20">
                                        </div>
                                    </div>
                                    <div class="font-medium tracking-wide text-red-500 text-xs ml-1 mb-2">
                                        <?= $validation->getError('gambar'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div id="close-modal2" class="cursor-pointer inline-flex justify-center closeBtn py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-gray-400 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </div>
                            <button type="submit" class="inline-flex justify-center disposisiBtn ml-1 py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kirim
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="text-2xl py-5">Data Surat Masuk</div>
    <!-- Alert jika data berhasil ditambahkan -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="bg-green-200 text-green-600 text-sm py-3 px-6 rounded-lg mb-5">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <?php if (session('role_id') == 2) : ?>
        <!-- Tombol Tambah Surat -->
        <a href="/Kasubag/surat/create" class="mb-5 bg-blue-500 hover:bg-blue-600 rounded text-sm text-white px-3 py-1">+ Tambah Surat Masuk</a>
    <?php endif; ?>
    <div class="mt-5">
        <table id="myTable" class="display text-sm" width="100%">
            <thead>
                <tr>
                    <th class="w-1/9">No</th>
                    <th class="w-1/6">Tanggal Surat</th>
                    <th class="w-1/6">Tanggal Diterima</th>
                    <th class="w-1/3">Perihal</th>
                    <th class="w-1/5">Disposisi Saat Ini</th>
                    <th class="w-1/5">Opsi</th>
                    <!-- <th class="w-1/5">Aksi 2</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($surat as $s) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $s['tanggal']; ?></td>
                        <td><?= $s['tanggal_penerimaan']; ?></td>
                        <td><?= $s['perihal']; ?></td>
                        <?php if ($s['status_disposisi'] == 0) : ?>
                            <td class="text-center justify content-center items-center justify-center justify-content-center align-items-center">
                                <div class="flex items-center">

                                    <div class="py-1 text-xs flex-auto bg-yellow-400 rounded-lg">Menunggu</div>
                                </div>
                            </td>
                        <?php else : ?>
                            <td class="text-center justify content-center items-center justify-center justify-content-center align-items-center">
                                <?php if ($s['status_distribusi'] == 0) : ?>
                                    <div class="px-2 py-1 cursor-pointer text-center flex-auto justify-center justify-content-center bg-blue-400 hover:bg-blue-600 text-gray-100 rounded-lg shadow text-xs" id="disposisi-btn<?= $s['id']; ?>" onclick="modalDisposisiKasubag('<?= $s['id']; ?>','<?= $s['perihal']; ?>','<?= $s['dari']; ?>','<?= $s['nomor_surat']; ?>')">
                                        Kirim
                                    </div>
                                <?php else : ?>
                                    <div class="flex items-center">
                                        <div class="py-1 text-xs flex-auto bg-green-400 rounded-lg">Terkirim</div>
                                    </div>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                        <td class="text-center flex">
                            <!-- <a href="/surat/?= $s->id; ?>" class=" text-xs rounded text-white px-3 py-1">D</a> -->
                            <div class="flex-auto py-2"><a href="/Kasubag/Surat/detail/<?= $s['id']; ?>"><img src="/img/detail.png" class="w-7 h-7 bg-blue-300 hover:bg-blue-500 text-xs rounded text-white px-1 py-1" alt="gambar"></a></div>
                            <div class="flex-auto py-2"><a href="/Kasubag/Surat/edit/<?= $s['id']; ?>"><img src="/img/edit.png" class="w-7 h-7 bg-yellow-500 hover:bg-yellow-600 text-xs rounded text-white px-1 py-1" alt="gambar"></a></div>

                            <form action="/surat/<?= $s['id']; ?>" method="POST" class="inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="" onclick="return confirm('Apakah Anda Yakin?');">
                                    <div class="flex-auto py-2"><a href="kasubag/surat/<?= $s['id']; ?>"><img src="/img/delete.png" class="w-7 h-7 bg-red-500 hover:bg-red-600 text-xs rounded text-white px-1 py-1" alt="gambar"></a></div>
                                </button>
                            </form>



                        </td>
                        <!-- <td>
                        <a href="/surat/viewpdf/<?= $s['id']; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">View Kepala</a>
                    </td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript" charset="utf8" src="https://releases.jquery.com/git/jquery-3.x-git.js"></script>
<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>




<?= $this->endSection(); ?>