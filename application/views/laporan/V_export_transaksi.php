<!doctype html>
<html>
    <head>
        <title>Report Transaksi</title>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <style>

    #ad thead tr th {
      vertical-align: middle;
      text-align: center;
    }

    th, td {
      padding: 5px;
      font-size: 10px;
    }

    th {
      text-align: center;
    }

    tr th {
      background-color: #122E5D; color: white;
    }
    .a tr td {
      font-weight: bold;
    }
    /* body {
      margin: 20px 20px 20px 20px;
      color: black;
    } */
    h5, h6 {
      font-weight: bold;
      text-align: center;
      font-size: 15px;
    }
    #d th {
      background-color: #122E5D; color: white;
    }
    #tot {
      background-color: #d2e0f7; font-weight: bold;
    }
    #tot_1 {
      font-weight: bold;
    }
    </style>
</head>
<body>

<h6 style="font-weight: bold; margin: 5px;">Report Transaksi</h6>
<?php if ($tgl_awal != '' && $tgl_akhir != ''): ?>
  <h6 style="font-weight: bold; margin: 5px;"><?= date("d F Y", strtotime($tgl_awal)) ?> s/d <?= date("d F Y", strtotime($tgl_akhir)) ?></h6>
<?php endif; ?>
<h6>Transaksi: <?= $tot_transaksi ?> | Pendapatan: Rp. <?= number_format($tot_pendapatan, 0,'.','.') ?> | Pengunjung: <?= $tot_pengunjung ?></h6><br>

  <table border="1" cellspacing="0" width="100%" align="center">
      <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Kode Transaksi</th>
            <th>Jumlah Pengunjung</th>
            <th>Total Transaksi</th>
            <th>Total Diskon</th>
        </tr>
    </thead>
      <tbody>
        <?php 

        $i=1; 
        $tot_dis = 0;

        foreach ($trn as $t): ?>
          <tr>
            <td align="center"><?= $i ?>.</td>
            <td align="left"><?= date("d-m-Y", strtotime($t['created_at'])) ?></td>
            <td align="left"><?= $t['kode_transaksi'] ?></td>
            <td align="center"><?= $t['jml_pengunjung'] ?></td>
            <td align="right">Rp. <?= number_format($t['total_transaksi'], 0,'.','.') ?></td>
            <td align="right">Rp. <?= number_format($t['total_discount'], 0,'.','.') ?></td>
          </tr>
        <?php $i++; endforeach; ?>
      </tbody>
  </table>
  <br>

</body>

</html>