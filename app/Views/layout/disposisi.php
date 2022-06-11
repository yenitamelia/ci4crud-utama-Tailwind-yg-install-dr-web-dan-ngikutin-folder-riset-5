<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="/css/tailwind1.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?= $this->section('content'); ?>
    <div class="bg-black bg-opacity-50 fixed inset-0 hidden justify-center items-center z-30 w-full h-sceen" id="overlay">
        <div class="bg-white py-2 px-3 rounded shadow-xl text-gray-800 absolute top-12 z-20">
            <div class="flex justify-between items-center p-3">
                <h4 class="font-bold">Disposisi Surat</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="" method="post" enctype="multipart/form-data" id="saveDisposisi">
                    <?= csrf_field(); ?>
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="bg-white py-4 px-6">
                            <div class="grid gap-3">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="perihal" class="block text-sm font-medium text-gray-700">Perihal</label>
                                    <div class="text-sm">Kerjasama 2021 BPS Pusat</div>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Dari</label>
                                    <div class="text-sm">BPS Pusat</div>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Disposisi Kepada</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">



                                                <input id="comments" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <p class="text-gray-600">KF Sosial</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="candidates" name="candidates" type="checkbox" class="focus:ring-indigo-600 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <p class="text-gray-600">KF Ekonomi</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="offers" name="offers" type="checkbox" class="focus:ring-indigo-600 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <p class="text-gray-600">KF Distribusi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="dari" class="block text-sm font-medium text-gray-700">Isi Disposisi</label>
                                    <div class="text-sm mt-2"><textarea id="isi_disposisi" name="isi_disposisi" cols="60" rows="4" class="border border-gray-400 px-2" value="<?= old('isi_disposisi'); ?> rounded-md p-2 focus:ring focus:outline-none"></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-gray-400 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="inline-flex justify-center ml-1 py-2 px-4 border border-transparent shadow-sm text-sm rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kirim
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <?= $this->endSection(); ?>
</body>