<?php
class Pengguna extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('Administrator');
			redirect($url);
		};
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index()
	{
		$kode = $this->session->userdata('idadmin');
		$x['user'] = $this->m_pengguna->get_pengguna_login($kode);
		$x['data'] = $this->m_pengguna->get_all_pengguna();
		$y['title'] = 'SMK Negeri PP Sembawa | Pengguna';
		$this->load->view('admin/v_header', $y);
		$this->load->view('admin/v_sidebar', ["side" => 3]);
		$this->load->view('admin/v_pengguna', $x);
	}

	function simpan_pengguna()
	{
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if (($_FILES["filefoto"]["size"] < 20000)) {
				$gambar = "user_blank.png";
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('Admin/Pengguna');
				} else {
					$this->m_pengguna->simpan_pengguna($nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					$this->session->set_flashdata('pesan', 'Gambar yang diupload untuk pengguna (' . $nama . ') memiliki resolusi < 20KB. Upload gambar gagal.');
					echo $this->session->set_flashdata('msg', 'warning');
					redirect('Admin/Pengguna');
				}
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

				$gambar = $gbr['file_name'];
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('Admin/Pengguna');
				} else {
					$this->m_pengguna->simpan_pengguna($nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'success');
					redirect('Admin/Pengguna');
				}
			} else {
				$gambar = "user_blank.png";
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('Admin/Pengguna');
				} else {
					$this->m_pengguna->simpan_pengguna($nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					$this->session->set_flashdata('pesan', 'Upload gambar gagal. Mohon update data.');
					echo $this->session->set_flashdata('msg', 'warning');
					redirect('Admin/Pengguna');
				}
			}
		} else {
			$gambar = "user_blank.png";
			$nama = $this->input->post('xnama');
			$jenkel = $this->input->post('xjenkel');
			$username = $this->input->post('xusername');
			$password = $this->input->post('xpassword');
			$konfirm_password = $this->input->post('xpassword2');
			$email = $this->input->post('xemail');
			$nohp = $this->input->post('xkontak');
			$level = $this->input->post('xlevel');
			if ($password <> $konfirm_password) {
				echo $this->session->set_flashdata('msg', 'error');
				redirect('Admin/Pengguna');
			} else {
				$this->m_pengguna->simpan_pengguna($nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
				$this->session->set_flashdata('pesan', 'Tidak ada gambar yang dipilih. Upload gambar gagal.');
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('Admin/Pengguna');
			}
		}
	}

	function update_pengguna()
	{

		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if (($_FILES["filefoto"]["size"] < 20000)) {

				$image = $this->input->post('gambar');
				$gambar = $image;
				$kode = $this->input->post('kode');
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if (empty($password) && empty($konfirm_password)) {
					$this->m_pengguna->update_pengguna_tanpa_pass($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'warning2');
					$this->session->set_flashdata('pesan', 'Gambar yang diupload untuk pengguna (' . $nama . ') memiliki resolusi < 20KB. Update gambar gagal.');
					redirect('Admin/Pengguna');
				} elseif ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('Admin/Pengguna');
				} else {
					$this->m_pengguna->update_pengguna($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					$this->session->set_flashdata('pesan', 'Gambar yang diupload untuk pengguna (' . $nama . ') memiliki resolusi < 20KB. Update gambar gagal.');
					echo $this->session->set_flashdata('msg', 'warning2');
					redirect('Admin/Pengguna');
				}
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
				$image = $this->input->post('gambar');
				$path = './assets/images/' . $image;
				if ($image != 'user_blank.png')
					unlink($path);
				$gambar = $gbr['file_name'];
				$kode = $this->input->post('kode');
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if (empty($password) && empty($konfirm_password)) {
					$this->m_pengguna->update_pengguna_tanpa_pass($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('Admin/Pengguna');
				} elseif ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('Admin/Pengguna');
				} else {
					$this->m_pengguna->update_pengguna($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('Admin/Pengguna');
				}
			} else {
				$image = $this->input->post('gambar');
				$gambar = $image;
				$kode = $this->input->post('kode');
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if (empty($password) && empty($konfirm_password)) {
					$this->m_pengguna->update_pengguna_tanpa_pass($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'warning2');
					$this->session->set_flashdata('pesan', 'Update gambar gagal. Mohon pilih gambar lain.');
					redirect('Admin/Pengguna');
				} elseif ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('Admin/Pengguna');
				} else {
					$this->m_pengguna->update_pengguna($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
					$this->session->set_flashdata('pesan', 'Update gambar gagal. Mohon pilih gambar lain');
					echo $this->session->set_flashdata('msg', 'warning2');
					redirect('Admin/Pengguna');
				}
			}
		} else {
			$image = $this->input->post('gambar');
			$gambar = $image;
			$kode = $this->input->post('kode');
			$nama = $this->input->post('xnama');
			$jenkel = $this->input->post('xjenkel');
			$username = $this->input->post('xusername');
			$password = $this->input->post('xpassword');
			$konfirm_password = $this->input->post('xpassword2');
			$email = $this->input->post('xemail');
			$nohp = $this->input->post('xkontak');
			$level = $this->input->post('xlevel');
			if (empty($password) && empty($konfirm_password)) {
				$this->m_pengguna->update_pengguna_tanpa_pass($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
				echo $this->session->set_flashdata('msg', 'warning2');
				$this->session->set_flashdata('pesan', 'Tidak ada gambar yang dipilih. Update gambar gagal.');
				redirect('Admin/Pengguna');
			} elseif ($password <> $konfirm_password) {
				echo $this->session->set_flashdata('msg', 'error');
				redirect('Admin/Pengguna');
			} else {
				$this->m_pengguna->update_pengguna($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
				$this->session->set_flashdata('pesan', 'Tidak ada gambar yang dipilih. Update gambar gagal.');
				echo $this->session->set_flashdata('msg', 'warning2');
				redirect('Admin/Pengguna');
			}
		}
	}

	function hapus_pengguna()
	{
		$kode = $this->input->post('kode');
		$data = $this->m_pengguna->get_pengguna_login($kode);
		$q = $data->row_array();
		$p = $q['pengguna_photo'];
		$path = base_url() . 'assets/images/' . $p;
		if ($p != "user_blank.png")
			delete_files($path);
		$this->m_pengguna->hapus_pengguna($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('Admin/Pengguna');
	}

	function reset_password()
	{

		$id = $this->uri->segment(4);
		$get = $this->m_pengguna->getusername($id);
		if ($get->num_rows() > 0) {
			$a = $get->row_array();
			$b = $a['pengguna_username'];
		}
		$pass = rand(123456, 999999);
		$this->m_pengguna->resetpass($id, $pass);
		echo $this->session->set_flashdata('msg', 'show-modal');
		echo $this->session->set_flashdata('uname', $b);
		echo $this->session->set_flashdata('upass', $pass);
		redirect('Admin/Pengguna');
	}
}
