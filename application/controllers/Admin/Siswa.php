<?php
class Siswa extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('Administrator');
            redirect($url);
        };
		$this->load->model('m_siswa');
		$this->load->model('m_pengguna');
		$this->load->model('m_kelas');
		$this->load->library('upload');
	}


	function index(){
		$x['kelas']=$this->m_kelas->get_all_kelas();
		$x['data']=$this->m_siswa->get_all_siswa();
		$y['title'] = 'SMK Negeri PP Sembawa | Data Siswa';
		$this->load->view('admin/v_header',$y);
		$this->load->view('admin/v_sidebar',["side" => 9]);
		$this->load->view('admin/v_siswa',$x);
	}
	
	function simpan_siswa(){
				$config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
	            if(!empty($_FILES['filefoto']['name']))
	            {

					if (($_FILES["filefoto"]["size"] < 150000)) {
						$this->session->set_flashdata('pesan','Gambar Memiliki Resolusi Gambar lebih kecil dari 150KB Mungkin Akan Muncul Buram');

						redirect('Admin/Siswa'); 
					}

	                else if ($this->upload->do_upload('filefoto'))
	                {
	                        $gbr = $this->upload->data();
	                        //Compress Image
	                        $config['image_library']='gd2';
	                        $config['source_image']='./assets/images/'.$gbr['file_name'];
	                        $config['create_thumb']= FALSE;
	                        $config['maintain_ratio']= FALSE;
	                        $config['quality']= '60%';
	                        $config['width']= 300;
	                        $config['height']= 300;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();

	                        $photo=$gbr['file_name'];
							$nis=strip_tags($this->input->post('xnis'));
							$nama=strip_tags($this->input->post('xnama'));
							$jenkel=strip_tags($this->input->post('xjenkel'));
							$kelas=strip_tags($this->input->post('xkelas'));

							$this->m_siswa->simpan_siswa($nis,$nama,$jenkel,$kelas,$photo);
							echo $this->session->set_flashdata('msg','success');
							redirect('Admin/Siswa');
					}else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('Admin/Siswa');
	                }
	                 
	            }else{
	            	$nis=strip_tags($this->input->post('xnis'));
					$nama=strip_tags($this->input->post('xnama'));
					$jenkel=strip_tags($this->input->post('xjenkel'));
					$kelas=strip_tags($this->input->post('xkelas'));

					$this->m_siswa->simpan_siswa_tanpa_img($nis,$nama,$jenkel,$kelas);
					echo $this->session->set_flashdata('msg','success');
					redirect('Admin/Siswa');
				}
				
	}
	
	function update_siswa(){
				
	            $config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
	            if(!empty($_FILES['filefoto']['name']))
	            {

					if (($_FILES["filefoto"]["size"] < 150000)) {
						$this->session->set_flashdata('pesan','Gambar Memiliki Resolusi Gambar lebih kecil dari 150KB Mungkin Akan Muncul Buram');

						redirect('Admin/Siswa'); 
					}

	                else if ($this->upload->do_upload('filefoto'))
	                {
						
	                        $gbr = $this->upload->data();
	                        //Compress Image
	                        $config['image_library']='gd2';
	                        $config['source_image']='./assets/images/'.$gbr['file_name'];
	                        $config['create_thumb']= FALSE;
	                        $config['maintain_ratio']= FALSE;
	                        $config['quality']= '60%';
	                        $config['width']= 300;
	                        $config['height']= 300;
	                        $config['new_image']= './assets/images/'.$gbr['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();
	                        $gambar=$this->input->post('gambar');
							$path='./assets/images/'.$gambar;
							unlink($path);

	                        $photo=$gbr['file_name'];
	                        $kode=$this->input->post('kode');
							$nis=strip_tags($this->input->post('xnis'));
							$nama=strip_tags($this->input->post('xnama'));
							$jenkel=strip_tags($this->input->post('xjenkel'));
							$kelas=strip_tags($this->input->post('xkelas'));

							$this->m_siswa->update_siswa($kode,$nis,$nama,$jenkel,$kelas,$photo);
							echo $this->session->set_flashdata('msg','info');
							redirect('Admin/Siswa');
	                    
	                }else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('Admin/Siswa');
	                }
	                
	            }else{
							$kode=$this->input->post('kode');
							$nis=strip_tags($this->input->post('xnis'));
							$nama=strip_tags($this->input->post('xnama'));
							$jenkel=strip_tags($this->input->post('xjenkel'));
							$kelas=strip_tags($this->input->post('xkelas'));

							$this->m_siswa->update_siswa_tanpa_img($kode,$nis,$nama,$jenkel,$kelas);
							echo $this->session->set_flashdata('msg','info');
							redirect('Admin/Siswa');
	            } 

	}

	function hapus_siswa(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_siswa->hapus_siswa($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('Admin/Siswa');
	}

}