<style type="text/css">

.dataTables_wrapper{
  overflow: auto;
  overflow-x: auto;
  overflow-y: auto;
}

body{
  table-layout: fixed;
}

  
</style>
  
	</section>

	
  <section class="content-holder b-none inner_content" style="margin-top: 150px;">
  
  	<section class="container container-fluid">

	          <section class="row-fluid">

		<h2 class="heading">Informasi Publik Setiap Saat</h2>
		<span class="border-line m-bottom" style="margin-top: 5px;margin-left: -19px;"></span>
<div class="container">
  <div class="row">		
	<section class="page_content">
		<section class="span12 first">

			<table class="table table-container" id="myTable">
              <thead>
                <tr>
                  <th style="width: 20px;">No</th>
                  <th>Nama File</th>
                  <th>Tanggal</th>
                  <th>Author</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
          		<?php
                        $no=0;
                        foreach ($data->result_array() as $d) :
                            $no++;
                            $id=$d['file_id'];
                            $judul=$d['file_judul'];
                            $deskripsi=$d['file_deskripsi'];
                            $oleh=$d['file_oleh'];
                            $tanggal=$d['tanggal'];
                            $download=$d['file_download'];
                            $file=$d['file_data'];
                ?>
          		<tr>
          			<td style="text-align: center;"><?php echo $no?></td>
          			<td><?php echo $judul?></td>
          			<td><?php echo $tanggal?></td>
          			<td><?php echo $oleh?></td>
          			<td style="text-align: center;"><a href="<?php echo base_url().'assets/files/'.$file?>" target="_blank">
          				<img src="<?php echo base_url().'assets/img/View.png'?>" alt="Download" style=" width:11%;margin-bottom: 0px;">
          			</a></td>
          		</tr>
          		<?php endforeach;?>
              </tbody>
            </table>
			
			

	
		</section>
	</section>
   
	</section>
 
  </section>
  