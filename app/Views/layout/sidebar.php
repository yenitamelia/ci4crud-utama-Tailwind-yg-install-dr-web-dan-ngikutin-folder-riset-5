<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/tailwind1.css">
    <!-- <link rel="stylesheet" href="/css/sb-admin-2.min.css"> -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/datatables/datatables.css">
    <link rel="stylesheet" type="text/css" href="/css/tags.css">
    <script type="text/javascript" charset="utf8" src="/datatables/datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="/js/selectize.js"></script>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        tr.none td {
            /* border-collapse: collapse; */
            border: none;

        }

        @media print {

            @page {
                margin-top: 30px;
                margin-bottom: 10px;
            }

            /* Hide every other elemet */
            body {
                margin: 0;
                position: relative;
            }

            .sidebar,
            .open {
                display: none;
                visibility: hidden;
            }

            body * {
                margin: 0;
                visibility: hidden;
            }

            /* Then displaying print container elements */
            .print-container,
            .print-container * {
                visibility: visible;
            }

            /* Adjusting the postition to always start from top left */
            .print-container {
                position: absolute;
                top: 0px;
                left: 0px;
            }
        }
    </style>
</head>

<body id="page-top">
    <div class="sidebar open">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus icon'></i>
            <div class="logo_name">SIMRAT</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            <li>
                <?php if (in_array(session()->auth_groups_id, [1, 2, 3, 4, 5, 6, 7, 8, 9])) : ?>
                    <a href="/Kasubag/Home">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                <?php endif; ?>
            </li>
            <li>
                <?php if (session('auth_groups_id') == 9) : ?>
                    <a href="/Admin/Role">
                        <i class='bx bx-user'></i>
                        <span class="links_name">Role</span>
                    </a>
                <?php endif; ?>
            </li>
            <li>
                <?php if (session('auth_groups_id') == 9) : ?>
                    <a href="/Admin/User">
                        <i class='bx bx-group'></i>
                        <span class="links_name">All User</span>
                    </a>
                <?php endif; ?>
            </li>
            <!-- <li>
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li> -->
            <li>
                <?php if (session('auth_groups_id') == 1) : ?>
                    <a href="/kepala/surat">
                        <i class='bx bx-archive-in'></i>
                        <span class="links_name">Surat Masuk</span>
                    <?php elseif (session('auth_groups_id') == 2) : ?>
                        <a href="/kasubag/surat">
                            <i class='bx bx-archive-in'></i>
                            <span class="links_name">Surat Masuk</span>
                        <?php elseif (in_array(session()->auth_groups_id, [3, 4, 5, 6, 7])) : ?>
                            <a href="/tim/surat/">
                                <i class='bx bx-archive-in'></i>
                                <span class="links_name">Surat Masuk</span>
                            <?php elseif (session('auth_groups_id') == 8) : ?>
                                <a href="/anggotaTim/surat/">
                                    <i class='bx bx-archive-in'></i>
                                    <span class="links_name">Surat Masuk</span>
                                <?php elseif (session('auth_groups_id') == 10) : ?>
                                    <a href="/operator/surat/">
                                        <i class='bx bx-archive-in'></i>
                                        <span class="links_name">Surat Masuk</span>
                                    </a>
                                </a>
                            </a>
                        </a>
                    </a>
                <?php endif; ?>
            </li>
            <li>
                <?php if (session('auth_groups_id') == 2) : ?>
                    <a href="/Kasubag/Surat/indexx">
                        <i class='bx bx-archive'></i>
                        <span class="links_name">Menerima Disposisi</span>
                    </a>
                <?php endif; ?>
            </li>
            <li>
                <?php if (session('auth_groups_id') == 1) : ?>
                    <a href="/Kepala/SuratKeluar">
                        <i class='bx bx-archive-out'></i>
                        <span class="links_name">Surat Keluar</span>
                    <?php elseif (session('auth_groups_id') == 2) : ?>
                        <a href="/Kasubag/SuratKeluar">
                            <i class='bx bx-archive-in'></i>
                            <span class="links_name">Surat Keluar</span>
                        <?php elseif (in_array(session()->auth_groups_id, [3, 4, 5, 6, 7])) : ?>
                            <a href="/Tim/SuratKeluar/">
                                <i class='bx bx-archive-in'></i>
                                <span class="links_name">Surat Keluar</span>
                            <?php elseif (session('auth_groups_id') == 10) : ?>
                                <a href="/Operator/SuratKeluar/">
                                    <i class='bx bx-archive-out'></i>
                                    <span class="links_name">Surat Keluar</span>
                                </a>
                            </a>
                        </a>
                    <?php endif; ?>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <!--<img src="profile.jpg" alt="profileImg">-->
                    <div class="name_job">
                        <div class="name text-xs"><?php echo session('email') ?></div>
                        <div class="job text-base"><?php echo session('role_name') ?></div>
                    </div>
                </div>
                <a href="<?= base_url('Logout'); ?>">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="home-section">
        <?= $this->renderSection('content'); ?>
    </div>
</body>




<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
        }
    }
</script>
<script>
    $('#lampiran').change(function() {
        $(this).next().next().text(this.files[0].name)
    });
</script>

<script>
    function label() {
        const lampiran = document.querySelector('#lampiran');
        const lampiranLabel = document.querySelector('.customLabel');
        lampiranLabel.textContent = lampiran.files[0].name;
    }

    function label_masuk() {
        const file_masuk = document.querySelector('#file_masuk');
        const file_masukLabel = document.querySelector('.customLabel');
        file_masukLabel.textContent = file_masuk.files[0].name;
    }

    function label_keluar() {
        const file_keluar = document.querySelector('#file_keluar');
        const file_keluarLabel = document.querySelector('.customLabel');
        file_keluarLabel.textContent = file_keluar.files[0].name;
    }

    function label2() {
        const gambar = document.querySelector('#gambar');
        const gambarLabel = document.querySelector('.customLabel');
        gambarLabel.textContent = gambar.files[0].name;
    }
</script>

<script>
    function deleteKasubag(id) {
        const overlay = document.querySelector('#overlayy')
        const deleteBtn = document.querySelector('#delete-btn' + id)
        const closeBtn = document.querySelector('#close-modal-delete')
        const closeBtn2 = document.querySelector('#close-modal2-delete')


        // When the user clicks the button, open the modal 
        deleteBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $('#delete_kasubag').attr('action', '/Kasubag/Surat/delete/' + id);

    }
</script>

<script>
    function deactiveUser(id) {
        const overlay = document.querySelector('#overlay2')
        const deactiveBtn = document.querySelector('#deactive-btn' + id)
        const closeBtn = document.querySelector('#close-modal-deactive')
        const closeBtn2 = document.querySelector('#close-modal2-deactive')

        // When the user clicks the button, open the modal 
        deactiveBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $('#deactive_user').attr('action', '/Admin/User/deactive/' + id);

    }
</script>

<script>
    function deleteRole(id) {
        const overlay = document.querySelector('#overlay2')
        const deleteBtn = document.querySelector('#delete-btn' + id)
        const closeBtn = document.querySelector('#close-modal-delete')
        const closeBtn2 = document.querySelector('#close-modal2-delete')

        // When the user clicks the button, open the modal 
        deleteBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $('#delete_role').attr('action', '/Admin/Role/delete/' + id);

    }
</script>

<script>
    function deleteKasubagKeluar(id) {
        const overlay = document.querySelector('#overlayy2')
        const deleteBtn = document.querySelector('#delete-btn' + id)
        const closeBtn = document.querySelector('#close-modal-delete2')
        const closeBtn2 = document.querySelector('#close-modal2-delete2')


        // When the user clicks the button, open the modal 
        deleteBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $('#delete_kasubag_keluar').attr('action', '/Kasubag/SuratKeluar/delete/' + id);

    }
</script>

<script>
    function mintaPersetujuan(id) {
        $('#mintaPersetujuan').change(() => {
            $.get('/Kasubag/SuratKeluar/saveRevisi')
        })
    }
</script>

<script>
    function modalpdf(id, no) {
        const overlay = document.querySelector('#overlay')
        const disposisiBtn = document.querySelector('#disposisi-btn' + id)
        const lihatBtn = document.querySelector('#lihat-btn' + id)
        const closeBtn = document.querySelector('#close-modal')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        disposisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        lihatBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $("#idSurat").val(id);
        $("#perihalSurat").val(perihal);
        $("#dariSurat").val(dari);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    function modalpdfSuratKeluar(id, no) {
        const overlay = document.querySelector('#overlay')
        const disposisiBtn = document.querySelector('#disposisi-btn' + id)
        const lihatBtn = document.querySelector('#lihat-btn' + id)
        const closeBtn = document.querySelector('#close-modal-keluar')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        disposisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        lihatBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $("#idSurat").val(id);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    function modalDisposisi(id, perihal, dari, no) {

        const overlay = document.querySelector('#overlay')
        const disposisiBtn = document.querySelector('#disposisi-btn' + id)
        const closeBtn = document.querySelector('#close-modal')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        disposisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        // const toggleModal = () => {
        //     overlay.classList.toggle('hidden')
        //     overlay.classList.toggle('flex')
        // }

        // disposisiBtn.addEventListener('click', toggleModal)

        // closeBtn.addEventListener('click', toggleModal)

        $("#idSurat").val(id);
        $("#perihalSurat").val(perihal);
        $("#dariSurat").val(dari);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    function modalDisposisiKetuaTim(idDisposisi, idSurat, perihal, dari, no) {

        const overlay = document.querySelector('#overlay')
        const disposisiBtn = document.querySelector('#disposisi-btn' + idDisposisi)
        const closeBtn = document.querySelector('#close-modal')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        disposisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $("#idDisposisi").val(idDisposisi);
        $("#idSurat").val(idSurat);
        $("#perihalSurat").val(perihal);
        $("#dariSurat").val(dari);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    function modalDisposisiKasubag(id, perihal, dari, no) {

        const overlay = document.querySelector('#overlay')
        const disposisiBtn = document.querySelector('#disposisi-btn' + id)
        const closeBtn = document.querySelector('#close-modal')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        disposisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        // const toggleModal = () => {
        //     overlay.classList.toggle('hidden')
        //     overlay.classList.toggle('flex')
        // }

        // disposisiBtn.addEventListener('click', toggleModal)

        // closeBtn.addEventListener('click', toggleModal)

        $.get('/Kasubag/Surat/modaldisposisikepada', {
            surat_id: id
        }, (data) => {
            li = ''
            data.forEach(d => {
                li += `<li>${d.description}</li>`
            })
            $('#showRole').html(`<ul>${li}</ul>`)
            $("#isi-disposisi").val(data[0]['isi_disposisi']);
            $("#gambar").attr('src', '/gambar/' + data[0]['gambar']);
            console.log(data);
        })
        $("#idSurat").val(id);
        $("#perihalSurat").val(perihal);
        $("#dariSurat").val(dari);
        // $("#showRole").html('halo');
        document.getElementById("noSurat").textContent += no;
        // belum bisa ngelist KF
    }
</script>


<script>
    function modalSetujui(id, perihal, alamat, nomor_urut) {

        const overlay = document.querySelector('#overlay')
        const setujuiBtn = document.querySelector('#setujui-btn' + id)
        const closeBtn = document.querySelector('#close-modal')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        setujuiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $("#Suratid").val(id);
        $("#perihalSurat").val(perihal);
        $("#alamat").val(alamat);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    function modalRevisi(id, perihal, alamat, nomor_urut) {

        const overlay = document.querySelector('#overlay2')
        const revisiBtn = document.querySelector('#revisi-btn' + id)
        const closeBtn = document.querySelector('#close-modal-revisi')
        const closeBtn2 = document.querySelector('#close-modal2-revisi')


        // When the user clicks the button, open the modal 
        revisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $("#idSurat").val(id);
        $("#perihalSurat2").val(perihal);
        $("#alamat2").val(alamat);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    function modalUploadRevisi(id, perihal, nomor_urut) {

        const overlay = document.querySelector('#overlay')
        const revisiBtn = document.querySelector('#revisi-btn' + id)
        const closeBtn = document.querySelector('#close-modal')
        const closeBtn2 = document.querySelector('#close-modal2')


        // When the user clicks the button, open the modal 
        revisiBtn.onclick = function() {
            overlay.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn.onclick = function() {
            overlay.style.display = "none";
        }

        // When the user clicks on <span> (x), close the overlay
        closeBtn2.onclick = function() {
            overlay.style.display = "none";
        }

        $("#Suratid").val(id);
        $("#nomor_urut").val(nomor_urut);
        $("#perihalSurat").val(perihal);
        document.getElementById("noSurat").textContent += no;
    }
</script>

<script>
    document.getElementsByClassName("tablink")[0].click();

    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].classList.remove("bg-white");
            tablinks[i].classList.remove("p-3");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.classList.add("bg-white");
        evt.currentTarget.classList.add("p-3");
    }
</script>

<script>
    $('#role_1').change(() => {
        $.get('/Kasubag/Surat/getNomorAgenda', {
            role: $('#role_1').val() - 1
        }, (data) => {
            if (data == 0) {
                nomor = "001"
            } else if (data < 9) {
                nomor = parseInt(data) + 1
                nomor = "00" + nomor
            } else if (data < 99) {
                nomor = parseInt(data) + 1
                nomor = "0" + nomor
            } else {
                nomor = parseInt(data) + 1
            }

            $('#label_nomor_agenda').html(`3523${$('#role_1').val()-1}.${nomor}`)
            // $('#label_nomor_agenda').val("3523" + $('#role').val() + "." + nomor)
            $('#nomor_agenda').val(`3523${$('#role_1').val()-1}.${nomor}`)

        })
    })
</script>

<script>
    $('#bulan').change(() => {
        updateNomorUrut();
    })

    $('#role').change(() => {
        updateNomorUrut();
    })

    $('#tahun').on('keyup', () => {
        updateNomorUrut();
    })

    function updateNomorUrut() {
        if (!$('#tahun').val()) {
            return;
        }

        let now = new Date()
        let tahun = $('#tahun').val();
        let bulan = $('#bulan').val();
        let role = $('#role').val();

        <?php if (session('auth_groups_id') == 2) { ?>
            let url = '/Kasubag/SuratKeluar/getNomorUrut'
        <?php } else if ((in_array(session('auth_groups_id'), [3, 4, 5, 6, 7]))) { ?>
            let url = '/Tim/SuratKeluar/getNomorUrut'
        <?php } ?>
        $.get(url, {
            bulan: $('#bulan').val()
        }, (data) => {
            if (data == 0) {
                nomor = "001"
            } else if (data < 9) {
                nomor = parseInt(data) + 1
                nomor = "00" + nomor
            } else if (data < 99) {
                nomor = parseInt(data) + 1
                nomor = "0" + nomor
            } else {
                nomor = parseInt(data) + 1
            }

            let isLate = false;
            if (now.getYear() > tahun) {
                isLate = true;
            } else if (now.getMonth() + 1 > bulan) {
                isLate = true;
            }


            $('#label_nomor_urut').html(`B.3523.${nomor}${isLate ? '.A' : ''}/928${role}/${bulan}/${tahun}`)
            // $('#label_nomor_urut').val("3523" + $('#role').val() + "." + nomor)
            $('#nomor_urut').val(`B.3523${role}.${nomor}${isLate ? '.A' : ''}/928${role}/${bulan}/${tahun}`)
        })
    }
</script>

</script>


</html>