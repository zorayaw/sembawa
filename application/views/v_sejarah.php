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

	<br><br><br>
  <section class="content-holder b-none inner_content" style="margin-top: 50px;">
  
  	<section class="container container-fluid">

	          <section class="row-fluid">

		<h2 class="heading">Profil</h2>
		<span class="border-line m-bottom" style="margin-top: 1px;margin-left: -19px;" ></span>

	<section class="page_content" style="margin-top: -30px;">
		<section class="span9 first">
			<article class="blog_detail_wrapper">
				<?php 
					$b=$portofolio->row_array();
					$isi = $b['port_deskripsi'];
					$views = $b['tulisan_views'];
					$date = $b['port_tanggal'];
					$author = $b['port_author'];
					$img=base_url().'assets/images/'.$b['port_image'];
				?>
				
				<figure class="post_meta"> 
				
				<span> Posted by:  <a href="#"> <?php echo $author;?> </a> </span> 
				<span> Dilihat: <a href="#"><?php echo $views;?></a></span>
				<span> Tanggal: <a href="#"><?php echo $date;?></a></span>  
				</figure>
				<figure class="post_description">
        <h2>Sejarah</h2>
          
        <p>Sekolah Menengah Kejuruan Pertanian Pembangunan (SMK PP) Negeri Sembawa Palembang adalah Unit Pelaksana Teknis Kementerian Pertanian di bawah koordinasi Pusat Pendidikan, Standardisasi dan Sertifikasi Profesi (Pusdikdarkasi)  Pertanian, Badan Penyuluhan dan Pengembangan Sumberdaya Manusia Pertanian.
SMK PP Negeri Sembawa didirikan sesuai dengan Peraturan Menteri Pertanian No.4/55 tanggal 25 April 1955  tentang Peraturan Bagi Sekolah-Sekolah Pertanian Menengah Atas Negeri dengan nama Sekolah Pertanian Menengah Atas (SPMA) yang berlokasi di Desa Sembawa Kabupaten Banyuasin Provinsi Sumatera Selatan. Pada tahun 1975 sampai dengan 1983/1984 nama SPMA diubah menjadi Sekolah Pertanian Pembangunan. Sekolah Pertanian Menengah Atas (SPP-SPMA) Polivalen.
Pada tahun 1985 sampai dengan 2009 SPP-SPMA berubah nama menjadi Sekolah Pertanian Pembangunan (SPP).  Pada tahun 2010, sesuai dengan Peraturan Menteri Pertanian No.10 tahun 2009 maka nama SPP Negeri Sembawa berubah nama menjadi SMK SPP Negeri Sembawa. Tahun 2013 sampai sekarang, SMK SPP Negeri Sembawa berubah nama menjadi SMK PP Negeri Sembawa.
Pada tahun 2009, SMK PP Negeri Sembawa Palembang memperoleh Sertifikat ISO 9001: 2008 yang diregistrasi oleh VEDCA-IQS untuk ruang lingkup Sistem Manajemen Mutu bagi Jasa Pedidikan dan Pelatihan Kejuruan</p>
  
				</figure>
			</article>
		</section>
		<figure class="span3" style="width: 245px;margin-left: 44px;margin-top: 35px;">
			<blockquote>
  			<h2 style='border-bottom: 6px solid #3d843e; width: 243px;margin-left: -15px;'></h2>
          <!-- Carousel -->
          <?php
          $b = $portofolio1->row_array();
          $nama = $b['port_nama'];
          $deskripsi = $b['port_deskripsi'];
          $image = $b['port_image']
          ?>
            <div class="slid-holder">
              <div class="slid-holder-inner">
                    <div class="mini-slider">
                      <ul id="carousel" class="elastislide-list">
                            <li style="margin-right: 0px;"">
                              <a href="#"><img src="<?php echo base_url().'assets/images/'.$image?>" alt="Ir. Mattobi'i, MP" /></a>
                              <strong class="candidate-name"><?php echo $nama?></strong>
                            </li>
                        </ul>
                    </div>
          <strong class="title2" style="font-size: 24px;"> Kepala Sekolah</strong>
                    <p><?php echo limit_words($deskripsi,4).'...';?></p>

        </div>
                
            </div>
            </blockquote>
            <!-- Carousel End -->

            <blockquote>
                 <h2 style='border-bottom: 6px solid #3a813c;width: 243px;margin-left: -15px;'></h2>
          <!-- Carousel -->
                        <h3 style="margin-top: -1px;">Tautan</h3>
                        <span class="border-line m-bottom" style="margin-top: 5px;margin-left: -10px;"></span>
                          <ul class="nav nav-list">
                            <?php foreach($tautan->result_array() as $row):

                            $id = $row['tulisan_id'];
                            $judul = $row['tulisan_judul'];
                            $link = $row['tulisan_link'];
                            $gambar = $row['tulisan_gambar'];
                            ?>  
                           <li>
                          <a title="<?php echo $judul ?>" href="<?php echo $link; ?>" target="_blank">
                          <table>
                            <tr>
                              <td width="55px"><img src="<?php echo base_url().'assets/images/'.$gambar?>" style="width: 50px;height:50px;margin-right: 9px;"></td>
                              <td><?= $judul ?></td>
                            </tr>
                          </table>
                          </a>
                        </li>
                            <?php endforeach; ?>
                              </ul>                            
            <!-- Carousel End -->
            </blockquote>

            <blockquote style="margin-top: 35px;">
                 <h2 style='border-bottom: 6px solid #3a813c;width: 243px;margin-left: -15px;'></h2>
          <!-- Carousel -->
                        <h3 style="margin-top: -1px;">Pengunjung Hari Ini</h3>
                          <ul class="a-list">
                            <li style="margin-left: 13px;"><?php echo $visitor?></li>
                          </ul>

                        <h3 style="margin-top: 0px;">Total Pengunjung</h3>
                          <ul class="a-list">
                            <li style="margin-left: 13px;"><?php echo $total?></li>
                          </ul>      
            <!-- Carousel End -->
            </blockquote>
            <blockquote style="margin-top: 35px;">
              <h2 style='border-bottom: 6px solid #3a813c;width: 243px;margin-left: -15px;'></h2>
                      <script type="text/javascript">
                        $(function() {
                          $("#datepicker1").datepicker({
                            numberOfMonths:1
                          }); 
                        });
                      </script>
                      <div id="datepicker1"></div>
            </blockquote>
            <blockquote style="margin-top: 35px;">
                 <h2 style='border-bottom: 6px solid #3a813c;width: 243px;margin-left: -15px;'></h2>
          <!-- Carousel -->
                        <h3 style="margin-top: -7px;">Jejak Pendapat</h3>
                        <p style="margin-bottom: 6px;margin-top: -1px;">Mulai Tahun 2018, SMK PP NEGERI SEMBAWA akan berubah menjadi POLITEKNIK PEMBANGUNAN PERTANIAN ?</p>
                        <p> <?php echo $this->session->flashdata('msg');?></p>
                        <p><a href="<?php echo base_url().'Home/kirim_pendapat'?>"><button type="button" class="btn btn-success"><i class="icon-ok icon-white" style="margin-right:6px;"></i>Submit</button></a>
                          <a href="<?php echo base_url().'Home/lihat_hasil'?>"><button type="button" class="btn btn-info"><i class="icon-signal icon-white" style="margin-right:6px;"></i>Lihat Hasil</button></a></p>
            <!-- Carousel End -->
            </blockquote>
            </figure>
	</section>
   
	</section>
 
  </section>
  
 
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://malsup.github.com/jquery.media.js"></script>
        <script type="text/javascript">
            $(function () {
                $('.media').media({width: 600});
            });
</script>