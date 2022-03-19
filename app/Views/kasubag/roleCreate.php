<?= $this->extend('layout/sidebar'); ?>

<?= $this->section('content'); ?>

<div class="container py-10">
    <div class="mx-auto w-3/5 shadow-inner rounded-2xl py-6 px-8 bg-gray-100">
        <div class="text-xl text-center mb-8">Form Tambah Role</div>
        <!-- Nampilin pesan error di view -->
        <!-- <h1>$validation->ListErrors();</h1> -->
        <form action="/Kasubag/Role/save" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Menyimpan file file_masuk lama biar ga bermasalah waktu yg diganti cuman judulnya aja, dst -->
            <div class="grid grid-cols-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="col-span-2 border-2 <?= ($validation->hasError('name')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('name'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('name'); ?>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <label for="description">Deskripsi Role</label>
                <input type="text" id="description" name="description" class="col-span-2 border-2 <?= ($validation->hasError('description')) ? 'border-red-500' : 'border-blue-500'; ?> rounded-lg focus:outline-none focus:ring focus:border-blue-300 px-2" value="<?= old('description'); ?>">
            </div>
            <div class="mb-3 grid grid-cols-3">
                <div></div>
                <div class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    <?= $validation->getError('description'); ?>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-400 transition-colors duration-300 rounded-xl text-sm text-white px-3 py-1">Submit</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>