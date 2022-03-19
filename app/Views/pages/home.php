<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="py-5 px-6">

    <div class="text-2xl bold">Dashboard</div>
    <div class="py-4">
        <div class="w-full border-t border-gray-400"></div>
    </div>
    <div class="mb-6">Selamat Datang,</div>
    <div class="grid grid-cols-4 gap-4">
        <div class="p-4 shadow-lg rounded bg-blue-300">
            <div class="grid grid-cols-2 gap-7 items-center ">
                <div>
                    <img src="/img/suratmasuk.png" alt="">
                </div>
                <div>
                    <div class="grid grid-rows-2 items-center gap-4">
                        <div class="text-3xl text-right">01</div>
                        <div class="text-right">Surat Masuk</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 shadow-lg rounded bg-purple-300">
            <div class="grid grid-cols-2 gap-7 items-center ">
                <div>
                    <img src="/img/suratkeluar.png" alt="">
                </div>
                <div>
                    <div class="grid grid-rows-2 items-center gap-4">
                        <div class="text-3xl text-right">50</div>
                        <div class="text-right">Surat Keluar</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 shadow-lg rounded bg-gray-300">
            <div class="grid grid-cols-2 gap-7 items-center ">
                <div>
                    <img src="/img/disposisi.png" alt="">
                </div>
                <div>
                    <div class="grid grid-rows-2 items-center gap-4">
                        <div class="text-3xl text-right">33</div>
                        <div class="text-right">Surat Terdisposisi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 shadow-lg rounded bg-indigo-300">
            <div class="grid grid-cols-2 gap-7 items-center ">
                <div>
                    <img src="/img/menunggu_disposisi.png" alt="">
                </div>
                <div>
                    <div class="grid grid-rows-2 items-center gap-4">
                        <div class="text-3xl text-right">40</div>
                        <div class="text-right">Menunggu Disposisi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 shadow-lg rounded bg-yellow-300">
            <div class="grid grid-cols-2 gap-7 items-center ">
                <div>
                    <img src="/img/menunggu_terkirim.png" alt="">
                </div>
                <div>
                    <div class="grid grid-rows-2 items-center gap-4">
                        <div class="text-3xl text-right">40</div>
                        <div class="text-right">Menunggu Dikirim</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 shadow-lg rounded bg-green-300">
            <div class="grid grid-cols-2 gap-7 items-center ">
                <div>
                    <img src="/img/user.png" alt="">
                </div>
                <div>
                    <div class="grid grid-rows-2 items-center gap-4">
                        <div class="text-3xl text-right">7</div>
                        <div class="text-right">User</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>