<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th style="font-size: 17px"><i class="fa fa-file-o"></i> Attribute</th>
        <th style="font-size: 17px"><i class="fa fa-clone"></i> Value</th>
    </tr>
    <tr>
        <td style="width: 15%">Nama Event</td>
        <td><?php echo $judul_event ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Nama Lengkap</td>
        <td><?php echo $nama ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Telephone</td>
        <td><?php echo $telephone ?></td>
    </tr>
    <tr>
        <td style="width: 15%">BBM</td>
        <td><?php echo $bbm ?></td>
    </tr>
    <tr>
        <td style="width: 15%">No HP</td>
        <td><?php echo $no_hp ?></td>
    </tr>
    <tr>
        <td style="width: 15%">No KTP</td>
        <td><?php echo $no_ktp ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Alamat Email</td>
        <td><?php echo $email ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Institunsi</td>
        <td><?php echo $institusi ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Jenis Kelamin</td>
        <td><?php echo $jenis_kelamin ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Alamat Rumah</td>
        <td><?php echo $alamat ?></td>
    </tr>
</table>

</body>
</html>