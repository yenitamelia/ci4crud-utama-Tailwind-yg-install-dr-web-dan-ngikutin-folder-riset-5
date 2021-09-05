<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/tailwind1.css">
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

    <?= $this->include('layout/navbar'); ?>

    <?= $this->renderSection('content'); ?>

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
    </script>
</body>

</html>