<?php
defined('BASEPATH')OR exit();
/**
* 
*/
class Laporan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'login')
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');

	}

	function index()
	{				
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$this->form_validation->set_rules('dari','Dari','required');
		$this->form_validation->set_rules('sampai','Sampai','required');

		if ($this->form_validation->run()!= false)
		{
			$data['laporan'] = $this->db->query ("SELECT tb_penjualan.tgl_penjualan,tb_penjualan.kode_penjualan,tb_barang.nama_barang,tb_penjualan.jumlah, tb_penjualan.subtotal, tb_penjualan.diskon, tb_penjualan.total, tb_penjualan.profit_penjualan as profitt, tb_penjualan.status  FROM tb_penjualan, tb_barang WHERE tb_penjualan.kode_barcode = tb_barang.kode_barcode  AND status='1' AND date (tgl_penjualan) BETWEEN '$dari' AND '$sampai' ")->result();

			$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
			$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

			$this->load->view('admin/header',$data1);
			$this->load->view('admin/laporan/v_laporan_filter',$data);
			$this->load->view('admin/footer');
		}
		else
		{
			$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
			$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

			$this->load->view('admin/header',$data1);
			$this->load->view('admin/laporan/v_laporan');
			$this->load->view('admin/footer');
		}		
	}

	function laporan_pdf()
	{
		$this->load->library('dompdf_gen');
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		$data['laporan'] = $this->db->query ("SELECT tb_penjualan.tgl_penjualan,tb_penjualan.kode_penjualan, tb_barang.nama_barang,tb_penjualan.jumlah, tb_penjualan.subtotal, tb_penjualan.diskon, tb_penjualan.total, tb_penjualan.profit_penjualan as profitt, tb_penjualan.status  FROM tb_penjualan, tb_barang WHERE tb_penjualan.kode_barcode = tb_barang.kode_barcode AND status='1' AND date (tgl_penjualan) BETWEEN '$dari' AND '$sampai' ")->result();

		$this->load->view('admin/laporan/v_laporan_pdf',$data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper_size,$orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_harian_cozyvape ".$dari.'__'.$sampai, array('Attachment' => 0));
	}
	
}
