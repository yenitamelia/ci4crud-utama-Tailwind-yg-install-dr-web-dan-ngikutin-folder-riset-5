<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="py-5 px-6">

    <div class="text-2xl bold">Dashboard</div>
    <div class="py-4">
        <div class="w-full border-t border-gray-400"></div>
    </div>
    <div class="mb-6">Selamat Datang,</div>
    <div class="grid grid-cols-4 gap-4">
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-green-400 h-4"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/suratmasuk.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-green-500 text-right"><?= $suratMasuk; ?></div>
                                <div class="text-right">Surat Masuk</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-red-400 h-4"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/suratkeluar.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-red-400 text-right"><?= $suratKeluar; ?></div>
                                <div class="text-right">Surat Keluar</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-blue-400 h-3"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/disposisi.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-right text-blue-400">33</div>
                                <div class="text-right">Surat Terdisposisi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-indigo-400 h-3"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/menunggu_disposisi.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-right text-indigo-400">40</div>
                                <div class="text-right">Menunggu Disposisi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-yellow-400 h-3"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/menunggu_terkirim.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-right text-yellow-400">40</div>
                                <div class="text-right">Menunggu Dikirim</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-gray-400 h-4"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/user.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-right text-gray-400"><?= $user; ?></div>
                                <div class="text-right">User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg rounded bg-gray-100">
            <div class="grid grid-rows-6">
                <div class="bg-gray-400 h-4"></div>
                <div class="p-4 row-span-full">
                    <div class="grid grid-cols-2 gap-7 items-center ">
                        <div>
                            <img src="/img/user.png" alt="">
                        </div>
                        <div>
                            <div class="grid grid-rows-2 items-center gap-4">
                                <div class="text-3xl text-right text-gray-400"><?= $role; ?></div>
                                <div class="text-right">Role</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>