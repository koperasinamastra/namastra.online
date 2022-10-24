<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 5pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #000000;
        }

        td {
            vertical-align: top;
        }

        table thead tr {
            background-color: #3B9AE1;
            text-align: center;
            font-variant: small-caps;
        }

        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        table thead td {
            background-color: #FFFFFF;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #000000;
            background-color: #FFFFFF;
            border: 0mm none #000000;
            border-top: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #000000;
        }

        .items td.cost {
            text-align: "."center;
        }
    </style>
</head>

<body>
    <table width="100%" style="font-family: serif;" cellpadding="10">
        <tr>
            <td width="45%"><span style="font-size: 7pt; color: #555555; font-family: sans;">Date cetak: <?php echo date('d M Y'); ?></span><br /><br /></td>
            <td width="10%">&nbsp;</td>
            <td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br /><br />345 Anotherstreet<br />Little Village<br />Their City<br />CB22 6SO</td>
        </tr>
    </table>
    <br />
    <table class="items" width="100%" style="font-size: 6pt; border-collapse: collapse; " cellpadding="8">
        <thead>
            <tr style="font-size: 7pt; color: #3B9AE1; font-family: sans;">
                <td>No</td>
                <td>Tanggal Prospek</thclass=>
                <td>TL Funding</td>
                <td>Funding Officer</td>
                <td>Pipeline</td>
                <td>Estimasi Closing</td>
                <td>Closing</td>
                <td>Status</td>
                <td>Note PC</td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            <?php
            $no = 1;
            foreach ($pipeline as $p) {
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($p->tgl_prospek)); ?></td>
                    <td><?php echo $p->tl_funding; ?></td>
                    <td><?php echo $p->funding_officer; ?></td>
                    <td><?php echo $p->pipline ?></td>
                    <td><?php
                        if ($p->id_status == 1) {
                            echo '<span class="badge badge-warning">On Progress</span>';
                        } else if ($p->id_status == 2) {
                            echo '<span class="badge badge-success">approve</span>';
                        } else if ($p->id_status == 3) {
                            echo '<span class="badge badge-primary">tolak</span>';
                        } else {
                            echo '<span class="badge badge-warning">Pending</span>';
                        }
                        ?>
                    </td>
                    <td><?php echo $p->NotePC; ?></td>
                    <td><?php echo number_format($p->estimasi_close, '0', '', '.'); ?></td>
                    <td><?php echo number_format($p->closing, '0', '', '.'); ?></td>
                </tr>
            <?php
                $no++;
            } ?>
            <!-- END ITEMS HERE -->
            <!-- <tr>
                <td class="blanktotal" colspan="7" rowspan="6"></td>
                <td class="totals">Subtotal:</td>
                <td class="totals cost">&pound;<</td>
            </tr>
            <tr>
                <td class="totals">Tax:</td>
                <td class="totals cost">&pound;18.25</td>
            </tr> -->
        </tbody>
    </table>
</body>

</html>