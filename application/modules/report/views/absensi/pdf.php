<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        thead {
            background-color: #f2f2f2;
            color: #333;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #b71c1c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            word-wrap: break-word;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3 class="text-center"><?= $title; ?></h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" width="40">No.</th>
                <th width="100">Tanggal</th>
                <th>Nama</th>
                <th class="text-center" width="100">Masuk</th>
                <th class="text-center" width="100">Pulang</th>
                <th width="120">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($listData)):
                $number = 1;
                foreach ($listData as $data):
            ?>
                    <tr>
                        <td class="text-center"><?= $number++; ?></td>
                        <td><?= date('d-m-Y', strtotime($data->tanggal)); ?></td>
                        <td><?= $data->fullname; ?></td>
                        <td class="text-center">
                            <?php if ($data->masuk) : ?>
                                <?= date('H:i:s', strtotime($data->masuk)); ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($data->pulang) : ?>
                                <?= date('H:i:s', strtotime($data->pulang)); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= ucfirst($data->flag ?? 'Tanpa Keterangan'); ?>
                        </td>
                    </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
</body>

</html>