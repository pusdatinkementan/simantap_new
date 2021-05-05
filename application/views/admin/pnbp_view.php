<table class="table" >
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nomor_kwitansi</th>
      <th scope="col">Tanggal_kwitansi</th>
      <th scope="col">UPT</th>
      <th scope="col">Wilker</th>
      <th scope="col">Nama_pemohon</th>
      <th scope="col">Alamat_pemohon</th>
      <th scope="col">Kode_billing</th>
      <th scope="col">Tanggal_billing</th>
      <th scope="col">Tanggal_setor</th>
      <th scope="col">NTPN</th>
      <th scope="col">Total_pnbp</th>
    </tr>
  </thead>
  <tbody>
  <?php             
            $source = file_get_contents('https://karantina.pertanian.go.id/api/publik/index.php/pnbpbarantan?key=3ac753bedb31742&karantina='.$q.'&d1='.$d1.'&d2='.$d2);
            $x = json_decode($source, true);  
            $x = $x['data'];            
            $no = 1;
            foreach($x as $row):       
            ?>
                <tr>
                <th scope="row"><?=$no++;?></th>
                <td><?php echo $row["Nomor_kwitansi"];?></td>
                <td><?php echo $row["Tanggal_kwitansi"];?></td>
                <td><?php echo $row["UPT"];?></td>
                <td><?php echo $row["Wilker"];?></td>
                <td><?php echo $row["Nama_pemohon"];?></td>
                <td><?php echo $row["Alamat_pemohon"];?></td>
                <td><?php echo $row["Kode_billing"];?></td>
                <td><?php echo $row["Tanggal_billing"];?></td>
                <td><?php echo $row["Tanggal_setor"];?></td>
                <td><?php echo $row["NTPN"];?></td>
                <td><?php echo $row["Total_pnbp"];?></td>
                </tr>
    <?php endforeach;?>
  </tbody>
</table>
