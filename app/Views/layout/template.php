<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/tailwind1.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <?= $this->include('layout/sidebar'); ?>

    <?= $this->renderSection('content'); ?>

    <script>
        $('#lampiran').change(function() {
            $(this).next().next().text(this.files[0].name)
        });


        //add new aktivitas
        $('#saveDisposisi').submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            $("#isi_disposisi").load("<?= base_url('User/getIsiDisposisi') ?>", function(responseTxt, statusTxt, xhr) {
                                if (statusTxt == "success")
                                    responseTxt;
                                if (statusTxt == "error")
                                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                            });
                        } else {
                            alert(data.msg);
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        })
                    }
                }
            });
        });

        $(document).ready(function() {
            $("#isi_disposisi").load("<?= base_url('User/getIsiDisposisi') ?>", function(responseTxt, statusTxt, xhr) {
                if (statusTxt == "success")
                    responseTxt;
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
            });
        });
    </script>
    <script>
        function label() {
            const lampiran = document.querySelector('#lampiran');
            const lampiranLabel = document.querySelector('.customLabel');
            lampiranLabel.textContent = lampiran.files[0].name;
        }

        function label2() {
            const gambar = document.querySelector('#gambar');
            const gambarLabel = document.querySelector('.customLabel');
            gambarLabel.textContent = gambar.files[0].name;
        }
    </script>
</body>

</html>