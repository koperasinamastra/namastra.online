<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11pt;
        }

        img {
            width: 200px;
            height: 200px;
        }

        table,
        th,
        td {
            border: 0px solid black;
            border-collapse: collapse;
            height: 50px;
        }
    </style>
</head>

<body>
    <h2>LAPORAN PIPELINE FUNDING</h2>
    <hr />
    <table width="100%" style="font-family: serif;" cellpadding="10">
        <tr>
            <td width="30%"><span style="font-size: 7pt; color: #555555; font-family: sans;">Tanggal cetak: <?php echo date('d M Y'); ?></span><br /><br /></td>
            <td width="40%"><span style="font-size: 7pt; color: #555555; font-family: sans;">Kode Cabang : <?php echo $pipeline['kode_cabang'] ?></span></td>
            <td width="30%"><span style="font-size: 7pt; color: #555555; font-family: sans;">Tanggal Input :<?php echo date("d M Y", strtotime($pipeline['tgl_prospek'])); ?></span><br /><br /></td>
        </tr>
    </table>
    <table style="width:70%">
        <tr>
            <td colspan="2"><img src="<?php echo base_url('./uploads/prospek/') . $pipeline['upload_img']; ?>" alt=""></td>
        </tr>
    </table>
    <br />
    <br />
    <table style="width:60%">
        <tr>
            <td>TL Funding</td>
            <td>:</td>
            <td><?php echo $pipeline['tl_funding']; ?></td>
        </tr>
        <tr>
            <td>Funding Officer</td>
            <td>:</td>
            <td><?php echo $pipeline['funding_officer']; ?></td>
        </tr>
        <tr>
            <td>Nama Prospek</td>
            <td>:</td>
            <td><?php echo $pipeline['nama_prospek']; ?></td>
        </tr>
        <tr>
            <td>Alamat Prospek</td>
            <td>:</td>
            <td><?php echo $pipeline['alamat']; ?></td>
        </tr>
        <tr>
            <td>Nomor HP</td>
            <td>:</td>
            <td><?php echo $pipeline['nohp']; ?></td>
        </tr>
        <tr>
            <td>Estimasi Closing</td>
            <td>:</td>
            <td>Rp. <?php echo number_format($pipeline['estimasi_close'], '0', '', '.'); ?></td>
        </tr>
        <tr>
            <td>Closing</td>
            <td>:</td>
            <td>Rp. <?php number_format($pipeline['closing'], '0', '', '.'); ?></td>
        </tr>
        <tr>
            <td>Note Pimpinan Cabang</td>
            <td>:</td>
            <td width="45%"><?php echo $pipeline['NotePC']; ?></td>
        </tr>
        <tr>
            <td>Status Pipeline</td>
            <td>:</td>
            <td><?php
                if ($pipeline['id_status'] == 1) {
                    echo '<span class="badge badge-warning">On Progress</span>';
                } else if ($pipeline['id_status'] == 2) {
                    echo '<span class="badge badge-success">approve</span>';
                } else if ($pipeline['id_status'] == 3) {
                    echo '<span class="badge badge-primary">tolak</span>';
                } else {
                    echo '<span class="badge badge-warning">Pending</span>';
                }

                ?></td>
        </tr>
    </table>
</body>

</html>