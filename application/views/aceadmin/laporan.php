<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan</title>
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
</head>
<body>

</center>
 <table width="100%">
<tr>
<!-- <td width="25" align="center"><img src="assets/login/images/new/logologin.png" width="60%"></td> -->
<td ><br></td>
<!-- <td width="25" align="center"><img src="Logo DN.jpg" width="100%"></td> -->
</tr>
</table>



<hr>

  <br>
  <h1 width="50" align="center">Laporan Data Peserta Magang</h1>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th><center>Nama Ketua Peserta Magang</center></th>
      <th><center>Dinas</center></th>
      <th><center>Jumlah Peserta Magang</center></th>
      <th><center>Tanggal Mulai Magang</center></th>
      <th><center>Tanggal Selesai Magang</center></th>
      <th><center>Status Magang</center></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $key): ?>
      <tr>
        <td><?php echo $key['nama_user'] ?></td>
        <td><?php echo $key['nama_divisi']; ?></td>
        <td><?php echo $key['jml_pkl']; ?></td>
        <td><?php echo $key['tgl_mulai']; ?></td>
        <td><?php echo $key['tgl_selesai']; ?></td>
        <td><?php echo $key['status']; ?></td>
        
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>
<br><br>
<!-- <img src="Assets/gambar/footsurat.jpg" style="position: absolute; width: 800px; height: auto;"> -->
</body>
</html>