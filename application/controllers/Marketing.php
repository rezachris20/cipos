<?php
defined ('BASEPATH') OR exit();
/**
* 
*/
class Marketing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != "login")
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');
        $this->load->helper('form');
        $this->load->helper('url');
		

	}

	function index()
	{
		$data['marketing'] = $this->db->query("SELECT * FROM tb_marketing")->result();
		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/marketing/v_marketing',$data);
		$this->load->view('admin/footer');
	}

    function submit_data()
    {
		//// Set Variable From AJAX
		$nama 					= $_POST['nama'];
		$nik 					= $_POST['nik'];
		$alamat 				= $_POST['alamat'];
		$hp 					= $_POST['hp'];
		$email 					= $_POST['email'];
		$tmp_uploadfoto      	= $_FILES['uploadfoto']['tmp_name'];
		$name_uploadfoto      	= $_FILES['uploadfoto']['name'];
		$tmp_uploadktp      	= $_FILES['uploadktp']['tmp_name'];
		$name_uploadktp      	= $_FILES['uploadktp']['name'];


        $config['upload_path'] = './assets/images/marketing';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

		//// Jika file foto ada
		if(!empty($tmp_uploadfoto)) {
			if($this->upload->do_upload("uploadfoto")) {
				$res_uploadfoto = array ('upload_data' => $this->upload->data());
			} else {
				$res_uploadfoto = array('error' => $this->upload->display_errors());
			}
		}

		//// Jika file ktp ada
		if(!empty($tmp_uploadktp)) {
			if($this->upload->do_upload("uploadktp")) {
				$res_uploadktp = array ('upload_data' => $this->upload->data());
			} else {
				$res_uploadktp = array('error' => $this->upload->display_errors());
			}
		}

		//// Set data array
		$data = array(
			'nama' => $nama,
			'nik' => $nik,
			'alamat' => $alamat,
			'hp' => $hp,
			'email' => $email,
			'foto' => $name_uploadfoto,
			'ktp' => $name_uploadktp,
		);

		//// Insert data ke dalam table tb_marketing
		$this->m->tambahdata($data,'tb_marketing');

    }


	function ambilid()
	{
		$id = $this->input->post('id');
		$where = array(
			'id' => $id
		);
		$datakustomer = $this->m->ambilid('tb_marketing',$where)->result();
		echo json_encode($datakustomer);
	}

	function editdata()
	{

		//// Set Variable From AJAX
		$id 					= $_POST['id'];
		$nama 					= $_POST['nama'];
		$nik 					= $_POST['nik'];
		$alamat 				= $_POST['alamat'];
		$hp 					= $_POST['hp'];
		$email 					= $_POST['email'];
		$tmp_uploadfoto      	= $_FILES['uploadfoto']['tmp_name'];
		$name_uploadfoto      	= $_FILES['uploadfoto']['name'];
		$tmp_uploadktp      	= $_FILES['uploadktp']['tmp_name'];
		$name_uploadktp      	= $_FILES['uploadktp']['name'];
		$data 					= array();

		if ($nama == '')
		{
			$result['pesan'] = "Nama harus di isi";
		}
		elseif ($alamat == '')
		{
			$result['pesan'] = "Alamat harus di isi";
		}
		elseif ($hp == '')
		{
			$result['pesan'] = "No HP harus di isi";
		}
		elseif ($email == '')
		{
			$result['pesan'] = "Email harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$config['upload_path'] = './assets/images/marketing';
        	$config['allowed_types'] = 'gif|jpg|png';

			$this->load->library('upload', $config);


			//// Jika file foto ada
			if(!empty($tmp_uploadfoto)) {
				if($this->upload->do_upload("uploadfoto")) {
					$res_uploadfoto = array ('upload_data' => $this->upload->data());
				} else {
					$res_uploadfoto = array('error' => $this->upload->display_errors());
				}

				$data += array(
					'foto' => $name_uploadfoto,
				);
			}

			//// Jika file ktp ada
			if(!empty($tmp_uploadktp)) {
				if($this->upload->do_upload("uploadktp")) {
					$res_uploadktp = array ('upload_data' => $this->upload->data());
				} else {
					$res_uploadktp = array('error' => $this->upload->display_errors());
				}

				$data += array(
					'ktp' => $name_uploadktp,
				);
			}

			$where = array (
				'id' => $id
			);

			$data += array (
				'nama' => $nama,
				'nik' => $nik,
				'alamat' => $alamat,
				'hp' => $hp,
				'email' => $email
			);

			$this->m->updatedata($where,$data,'tb_marketing');
		}
		echo json_encode($result);
	}

	function hapusdata()
	{
		$id = $this->input->post('id');
		$where = array('id'=>$id);

		$this->m->hapusdata($where,'tb_marketing');
	}	
}
