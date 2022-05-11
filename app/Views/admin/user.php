<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto px-6">

    <div class="bg-black bg-opacity-50 fixed inset-0 hidden justify-center items-center z-30 w-full h-sceen" id="overlay2">
        <div class="bg-white py-2 px-3 rounded shadow-xl text-gray-800 absolute top-1/4 z-20">
            <div class="flex justify-between items-center p-3">
                <h4 class="font-bold">Confirmation</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-deactive" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>

            <div class="mt-5 md:mt-0">
                <form id="deactive_user" action="/Admin/User/deactive/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_surat" id="idSurat">
                    <div class="shadow overflow-y-auto sm:rounded-md">
                        <div class="bg-white py-4 px-6">
                            <div class="">
                                <p>Apakah Anda yakin akan mengubah status akun ini?</p>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div id="close-modal2-deactive" class="cursor-pointer inline-flex justify-center closeBtn py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-gray-400 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </div>
                            <?= csrf_field(); ?>
                            <button type="submit" class="inline-flex justify-center deactiveBtn ml-1 py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Ubah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="text-2xl py-5">All User</div>
    <!-- Alert jika data berhasil ditambahkan -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="bg-green-200 text-green-600 text-sm py-3 px-6 rounded-lg mb-5">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <!-- Tombol Tambah User Baru -->
    <a href="/Admin/user/create" class="mb-5 bg-blue-500 hover:bg-blue-600 rounded text-sm text-white px-3 py-1">+ Tambah User Baru</a>

    <div class="mt-5">
        <table id="myTable" class="display text-sm" width="100%">
            <thead>
                <tr>
                    <th class="w-1/12">No</th>
                    <th class="w-4/12">Email</th>
                    <th class="w-3/12">Role</th>
                    <th class="w-1/12">Action</th>
                    <th class="w-1/12">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($users as $u) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $u['email']; ?></td>
                        <!-- <td><?= $u['fullname']; ?></td> -->
                        <td><?= $u['description']; ?></td>
                        <td class="text-center justify content-center items-center justify-center justify-content-center align-items-center">
                            <div class="flex-auto bg-yellow-500 hover:bg-yellow-600 text-xs rounded-lg cursor-pointer text-white px-1 py-1"><a href="/Admin/User/edit/<?= $u['id']; ?>">Edit</a></div>
                        </td>
                        <td class="text-center justify content-center items-center justify-center justify-content-center align-items-center">
                            <!-- <td class="text-center justify content-center items-center justify-center justify-content-center align-items-center"> -->
                            <?php if ($u['status_active'] == 1) : ?>
                                <div id="deactive-btn<?= $u['id']; ?>" onclick="deactiveUser('<?= $u['id']; ?>')" class="px-2 py-1 cursor-pointer text-center flex-auto justify-center justify-content-center bg-red-500 hover:bg-red-400 text-gray-100 rounded-lg shadow text-xs">
                                    Deactive
                                </div>
                            <?php else : ?>
                                <div id="deactive-btn<?= $u['id']; ?>" onclick="deactiveUser('<?= $u['id']; ?>')" class="px-2 py-1 cursor-pointer text-center flex-auto justify-center justify-content-center bg-green-500 hover:bg-green-400 text-gray-100 rounded-lg shadow text-xs">
                                    Active
                                </div>
                            <?php endif; ?>
                            <!-- </td> -->
                        </td>
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