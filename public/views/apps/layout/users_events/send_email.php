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
<body style="background-color: #f1f1f1;-moz-box-shadow: 1px 1px 2px 0 rgba(0,0,0,.12);webkit-box-shadow: 1px 1px 2px 0 rgba(0,0,0,.12);box-shadow: 1px 1px 2px 0 rgba(0,0,0,.12);">
        
<table>
    <tr>
        <th style="font-size: 17px"><i class="fa fa-file-o"></i> TIKET EVENT </th>
        <th style="font-size: 17px"><i class="fa fa-clone"></i> <?php echo  $judul_event  ?> </th>
    </tr>
    <tr>
        <td style="width: 15%">Nama Lengkap</td>
        <td><?php echo $nama ?></td>
    </tr>
    <tr>
        <td style="width: 15%">BBM</td>
        <td><?php echo $bbm ?></td>
    </tr>
<!--     <tr>
        <td style="width: 15%">No HP</td>
        <td><?php echo $no_telp ?></td>
    </tr> -->
    <tr>
        <td style="width: 15%">Alamat Email</td>
        <td><?php echo $email ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Institusi</td>
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
     <tr>
        <td style="width: 15%">Nama Event</td>
        <td><?php echo $judul_event ?></td>
    </tr>
     <tr>
        <td style="width: 15%">Harga Tiket</td>
        <td><?php echo $harga ?></td>
    </tr>
    <tr>
        <td style="width: 15%">Tanggal Pembelian Ticket</td>
        <td><?php echo $tgl_register ?></td>
    </tr>
</table>

</body>
</html>
