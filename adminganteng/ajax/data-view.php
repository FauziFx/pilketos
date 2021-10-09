<table id="tabel" class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>NIS</th>
      <th>Nama Lengkap</th>
      <th>Kelas</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
  <?php  
  $no = 1;
  foreach( dataTampil() as $data ){
  ?>
    <tr>
      <td><?=$no ?></td>
      <td><?=$data['nis']; ?></td>
      <td style="text-transform: uppercase;"><?=$data['nama']; ?></td>
      <td style="text-transform: uppercase;"><?=$data['kelas']; ?></td>
      <td>
        <?php  
          if ($data['status'] == 0) {
            echo "<span class='label label-danger'>Belum Memilih</span>";
          }else{
            echo "<span class='label label-success'>Sudah Memilih</span>";
          }
        ?>
      </td>
    </tr>
  <?php 
  $no++;
  }
  ?>
  </tbody>
</table>

<script>
  ////////// Table //////////
  $(function(){ $('#tabel').dataTable(); });
</script>