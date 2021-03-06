<?php
class Guru extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('Administrator');
			redirect($url);
		};
		$this->load->model('m_guru');
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index()
	{
		$x['data'] = $this->m_guru->get_all_guru();
		$y['title'] = 'Admin | Data Guru';
		$this->load->view('admin/v_header', $y);
		$this->load->view('admin/v_sidebar', ["side" => 8]);
		$this->load->view('admin/v_guru', $x);
	}

	function simpan_guru()
	{
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		// $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {

			if (($_FILES["filefoto"]["size"] < 20000)) {
				$photo = "user_blank.png";
				$nip = strip_tags($this->input->post('xnip'));
				$nama = strip_tags($this->input->post('xnama'));
				$jenkel = strip_tags($this->input->post('xjenkel'));
				$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
				$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
				$jenis_gtk = strip_tags($this->input->post('xjgtk'));
				$mapel = strip_tags($this->input->post('xmapel'));
				$this->m_guru->simpan_guru($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
				echo $this->session->set_flashdata('msg', 'warning');
				$this->session->set_flashdata('pesan', 'Gambar yang diupload untuk guru (' . $nama . ') memiliki resolusi < 20KB. Upload gambar gagal.');
				redirect('Admin/Guru');
			} else if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$photo = $gbr['file_name'];
				$nip = strip_tags($this->input->post('xnip'));
				$nama = strip_tags($this->input->post('xnama'));
				$jenkel = strip_tags($this->input->post('xjenkel'));
				$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
				$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
				$jenis_gtk = strip_tags($this->input->post('xjgtk'));
				$mapel = strip_tags($this->input->post('xmapel'));
				$this->m_guru->simpan_guru($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
				echo $this->session->set_flashdata('msg', 'success');
				redirect('Admin/Guru');
			} else {
				$photo = "user_blank.png";
				$nip = strip_tags($this->input->post('xnip'));
				$nama = strip_tags($this->input->post('xnama'));
				$jenkel = strip_tags($this->input->post('xjenkel'));
				$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
				$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
				$jenis_gtk = strip_tags($this->input->post('xjgtk'));
				$mapel = strip_tags($this->input->post('xmapel'));
				$this->m_guru->simpan_guru($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
				echo $this->session->set_flashdata('msg', 'warning');
				$this->session->set_flashdata('pesan', 'Upload gambar gagal. Mohon update data.');
				redirect('Admin/Guru');
			}
		} else {
			$photo = "user_blank.png";
			$nip = strip_tags($this->input->post('xnip'));
			$nama = strip_tags($this->input->post('xnama'));
			$jenkel = strip_tags($this->input->post('xjenkel'));
			$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
			$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
			$jenis_gtk = strip_tags($this->input->post('xjgtk'));
			$mapel = strip_tags($this->input->post('xmapel'));
			$this->m_guru->simpan_guru($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
			echo $this->session->set_flashdata('msg', 'warning');
			$this->session->set_flashdata('pesan', 'Tidak ada gambar yang dipilih. Upload gambar gagal.');
			redirect('Admin/Guru');
		}
	}

	function update_guru()
	{

		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		// $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {

			if (($_FILES["filefoto"]["size"] < 20000)) {
				$gambar = $this->input->post('gambar');
				// $path = './assets/images/' . $gambar;
				// unlink($path);

				$photo = $gambar;
				$kode = $this->input->post('kode');
				$nip = strip_tags($this->input->post('xnip'));
				$nama = strip_tags($this->input->post('xnama'));
				$jenkel = strip_tags($this->input->post('xjenkel'));
				$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
				$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
				$jenis_gtk = strip_tags($this->input->post('xjgtk'));
				$mapel = strip_tags($this->input->post('xmapel'));
				$this->m_guru->update_guru($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
				echo $this->session->set_flashdata('msg', 'warning2');
				$this->session->set_flashdata('pesan', 'Gambar yang diupload untuk guru (' . $nama . ') memiliki resolusi < 20KB. Update gambar gagal.');
				redirect('Admin/Guru');

				redirect('Admin/Guru');
			} else if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar = $this->input->post('gambar');
				$path = './assets/images/' . $gambar;
				if ($gambar != 'user_blank.png')
					unlink($path);
				$photo = $gbr['file_name'];
				$kode = $this->input->post('kode');
				$nip = strip_tags($this->input->post('xnip'));
				$nama = strip_tags($this->input->post('xnama'));
				$jenkel = strip_tags($this->input->post('xjenkel'));
				$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
				$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
				$jenis_gtk = strip_tags($this->input->post('xjgtk'));
				$mapel = strip_tags($this->input->post('xmapel'));

				$this->m_guru->update_guru($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
				echo $this->session->set_flashdata('msg', 'info');
				redirect('Admin/Guru');
			} else {
				$gambar = $this->input->post('gambar');
				// $path = './assets/images/' . $gambar;
				// unlink($path);

				$photo = $gambar;
				$kode = $this->input->post('kode');
				$nip = strip_tags($this->input->post('xnip'));
				$nama = strip_tags($this->input->post('xnama'));
				$jenkel = strip_tags($this->input->post('xjenkel'));
				$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
				$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
				$jenis_gtk = strip_tags($this->input->post('xjgtk'));
				$mapel = strip_tags($this->input->post('xmapel'));
				$this->m_guru->update_guru($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
				echo $this->session->set_flashdata('msg', 'warning2');
				$this->session->set_flashdata('pesan', 'Update gambar gagal. Mohon pilih file lain.');
				redirect('Admin/Guru');
			}
		} else {
			$gambar = $this->input->post('gambar');
			// $path = './assets/images/' . $gambar;
			// unlink($path);

			$photo = $gambar;
			$kode = $this->input->post('kode');
			$nip = strip_tags($this->input->post('xnip'));
			$nama = strip_tags($this->input->post('xnama'));
			$jenkel = strip_tags($this->input->post('xjenkel'));
			$tmp_lahir = strip_tags($this->input->post('xtmp_lahir'));
			$tgl_lahir = strip_tags($this->input->post('xtgl_lahir'));
			$jenis_gtk = strip_tags($this->input->post('xjgtk'));
			$mapel = strip_tags($this->input->post('xmapel'));
			$this->m_guru->update_guru($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $jenis_gtk, $mapel, $photo);
			echo $this->session->set_flashdata('msg', 'info');
			redirect('Admin/Guru');
		}
	}

	function hapus_guru()
	{
		$kode = $this->input->post('kode');
		$gambar = $this->input->post('gambar');
		$path = './assets/images/' . $gambar;
		if ($gambar != "user_blank.png")
			unlink($path);
		$this->m_guru->hapus_guru($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('Admin/Guru');
	}
}
