<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-6">

    <div class="bg-black bg-opacity-50 fixed inset-0 hidden justify-center items-center z-30 w-full h-sceen" id="overlay">
        <div class="bg-white py-4 px-6 rounded shadow-xl text-gray-800 absolute top-12 z-20">
            <div class="flex justify-between items-center p-3">
                <h4 class="font-bold" id="noSurat">Teruskan Disposisi Surat</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>

            <div class="mt-5 md:mt-0 max-w-lg">
                <form action="/Kasubag/Surat/saveTandai" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_disposisi" id="idDisposisi">
                    <input type="hidden" name="id_surat" id="idSurat">
                    <div class="shadow overflow-y-auto sm:rounded-md">
                        <div class="bg-white py-4 px-6">
                            <div class="">
                                <div class="mb-3 w-96">
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
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Teruskan Kepada</label>
                                    <div class="mt-2 space-y-2">
                                        <!-- <input type="text" class="border-b-4 border-indigo-500 outline-none"> -->
                                        <!-- <div class="text-primary font-medium">Tags :</div> -->
                                        <div id="tags-container">
                                            <div class="control-group">
                                                <select id="tags" class="tags font-heading text-xs" placeholder="Tandai orang"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="tags" id="tags_form">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div id="close-modal2" class="cursor-pointer inline-flex justify-center closeBtn py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-gray-400 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </div>
                            <button type="submit" class="inline-flex justify-center disposisiBtn ml-1 py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Teruskan
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

    <div class="mt-5">
        <table id="myTable" class="display text-sm" width="100%">
            <thead>
                <tr>
                    <th class="w-1/10">No</th>
                    <th class="w-1/7">Nomor Agenda</th>
                    <th class="w-1/7">Tanggal Surat</th>
                    <th class="w-1/7">Asal</th>
                    <th class="w-1/3">Perihal</th>
                    <th class="w-1/8">Aksi</th>
                    <!-- <th class="w-1/5">Aksi 2</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($surat as $s) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $s['nomor_agenda']; ?></td>
                        <td><?= $s['tanggal']; ?></td>
                        <td><?= $s['dari']; ?></td>
                        <td><?= $s['perihal']; ?></td>
                        <td class="text-center flex">
                            <a href="/Kasubag/Surat/detail/<?= $s['id']; ?>" class="bg-blue-500 hover:bg-blue-400 text-xs rounded text-white mr-1 px-3 py-1">Detail</a>
                            <?php if ($s['status_diteruskan_kasubbag'] == 0) : ?>
                                <div id="disposisi-btn<?= $s['id_disposisi']; ?>" class="flex-auto items-center bg-yellow-500 cursor-pointer hover:bg-yellow-400 text-xs rounded text-white px-3 py-1" onclick="modalDisposisiKetuaTim('<?= $s['id_disposisi']; ?>','<?= $s['id']; ?>','<?= $s['perihal']; ?>','<?= $s['dari']; ?>','<?= $s['nomor_surat']; ?>')">Teruskan</div>
                            <?php else : ?>
                                <div class="py-1 text-xs flex-auto bg-green-400 rounded">Terkirim</div>
                            <?php endif; ?>
                        </td>
                        <!-- <td>
                        <a href="/surat/viewpdf/<= $s->id; ?>" class="bg-blue-500 rounded-xl text-sm text-white px-3 py-1">View Kepala</a>
                    </td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    //buat tags
    var formatTags = function(item) {
        return $.trim((item.name || ''));
    };

    $('#tags').selectize({
        plugins: ['remove_button'],
        persist: false,
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        sortField: [{
            field: 'name',
            direction: 'asc'
        }],
        maxOptions: 5,
        maxItems: 10,
        options: [
            <?php foreach ($users as $u) {
                // if ($u['id'] !== session()['id'])
                echo ("{
                        name: \"" . $u['email'] . "\",
                        id: \"" . $u['id'] . "\"
                    },");
            } ?>
        ],
        render: {
            item: function(item, escape) {
                var name = formatTags(item);
                return '<div>' +
                    (name ? '<span class="name">' + escape(name) + '</span>' : '') +
                    '</div>';
            },
            option: function(item, escape) {
                var name = formatTags(item);
                var label = name;
                var caption = name;
                return '<div>' +
                    '<span class="label">' + escape(label) + '</span>' +
                    (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
                    '</div>';
            }
        }
    });

    $('#tags').change(function() {
        $tags = $('#tags').val();
        $('#tags_form').val($tags);
    });

    $(function() {
        $("select").selectize(options);
    });
</script>

<script type="text/javascript" charset="utf8" src="https://releases.jquery.com/git/jquery-3.x-git.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>



<?= $this->endSection(); ?>