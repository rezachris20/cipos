<?php defined('BASEPATH')OR exit();

class Penjualanv2 extends CI_Controller
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

	public function index()
	{
		$kode = $_GET['kodepj'];

		$data['kustomer'] = $this->db->query("SELECT * FROM tb_kustomer ORDER BY nama ASC")->result();
		$data['barang'] = $this->db->query("SELECT * FROM tb_barang ORDER by nama_barang ASC")->result();
		$data['penjualan'] = $this->db->query("SELECT * FROM tb_penjualan,tb_barang WHERE tb_barang.kode_barcode = tb_penjualan.kode_barcode AND kode_penjualan = '$kode'")->result();

		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/penjualan/v_penjualanv2',$data);
		$this->load->view('admin/footer');
	}

	function get_data_barang(){
        $barcode=$this->input->post('barcode');
        $data=$this->m->get_data_barcode_bykode($barcode);
        echo json_encode($data);
    }

	function ambilid()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$databarang = $this->m->ambilid('tb_barang',$where)->result();

		echo json_encode($databarang);
	}

	function tambahdata()
	{

		$kode_penjualan = $this->input->post('kode_penjualan');
		$kode_barcode = $this->input->post('kode_barcode');
		$hargajual = $this->input->post('hargajual');
		$profit = $this->input->post('profit');
		$stok = $this->input->post('stok');
		$diskon = $this->input->post('diskon');
		$qty = $this->input->post('qty');

		$subtotal = $qty*$hargajual;
		$total = $subtotal-$diskon;
		$totalprofit = $profit*$qty-$diskon;

		if ($kode_penjualan == '')
		{
			$result['pesan'] = "Qty penjualan Harus di isiaaa";
		}
		else
		{
			$result['pesan'] = "";
		
			$data = array (
				'kode_penjualan' => $kode_penjualan,
				'kode_barcode' => $kode_barcode,
				'jumlah' => $qty,
				'diskon' => $diskon,
				'total' => $total,
				'subtotal' => $subtotal,
				'tgl_penjualan' => date('Y-m-d'),
				'profit_penjualan' => $totalprofit
			);

			$this->m->tambahdata($data,'tb_penjualan');
		}
		echo json_encode($result);
	}

	function tambah_data_by_barcode()
	{

		$barcode = $this->input->post('barcode');
		$barcode_stok = $this->input->post('barcode_stok');
		$barcode_kode_penjualan = $this->input->post('barcode_kode_penjualan');
		$barcode_hargajual = $this->input->post('barcode_hargajual');
		$barcode_profit = $this->input->post('barcode_profit');
		$barcode_qty = $this->input->post('barcode_qty');
		$barcode_diskon = $this->input->post('barcode_diskon');

		$subtotal = $barcode_qty*$barcode_hargajual;
		$total = $subtotal-$barcode_diskon;
		$totalprofit = $barcode_profit*$barcode_qty-$barcode_diskon;

		if ($barcode == '')
		{
			$result['pesan'] = "Barcode Harus di isi";
		}
		else
		{
			$result['pesan'] = "";
		
			$data = array (
				'kode_penjualan' => $barcode_kode_penjualan,
				'kode_barcode' => $barcode,
				'jumlah' => $barcode_qty,
				'diskon' => $barcode_diskon,
				'total' => $total,
				'subtotal' => $subtotal,
				'tgl_penjualan' => date('Y-m-d'),
				'profit_penjualan' => $totalprofit
			);

			$this->m->tambahdata($data,'tb_penjualan');
		}
		echo json_encode($result);
	}

	function simpan()
	{

		$kodepenjualan = $this->input->post('kodepenjualan');
		$subtotal = $this->input->post('subtotal');
		$totaldiskon = $this->input->post('totaldiskon');
		$totalsemua = $this->input->post('totalsemua');
		$bayar = $this->input->post('bayar');
		$kembali = $this->input->post('kembali');

		if ($kodepenjualan == '')
		{
			$result['pesan'] = "Kode penjualan Harus di isi";
		}
		elseif ($subtotal == '')
		{
			$result['pesan'] = "Sub Total Harus di isi";
		}
		elseif ($totaldiskon == '')
		{
			$result['pesan'] = "Diskon Harus di isi";
		}
		elseif ($totalsemua == '')
		{
			$result['pesan'] = "Total Harus di isi";
		}
		elseif ($bayar == '')
		{
			$result['pesan'] = "Total bayar Harus di isi";
		}
		elseif ($kembali == '')
		{
			$result['pesan'] = "Kembali Harus di isi";
		}
		else
		{

			$result['pesan'] = "";
		
			$data = array (
				'kode_penjualan' => $kodepenjualan,
				'sub_total' => $subtotal,
				'total_diskon' => $totaldiskon,
				'total_all' => $totalsemua,
				'total_bayar' => $bayar,
				'total_kembali' => $kembali
			);

			$where = array (
				'kode_penjualan' => $kodepenjualan
			);
			$data1 = array (
				'status' => 1
			);

			$this->m->tambahdata($data,'tb_penjualan_detail');
			$this->m->updatedata($where,$data1,'tb_penjualan');
		}
		
		echo json_encode($result);
	}

	function struk()
	{
		$kodepenjualan = $this->input->get('kodepj');

		$data['struk'] = $this->db->query("SELECT * FROM tb_penjualan,tb_kustomer,tb_barang,tb_penjualan_detail WHERE tb_barang.kode_barcode = tb_penjualan.kode_barcode AND tb_penjualan.kode_penjualan = tb_penjualan_detail.kode_penjualan AND tb_penjualan.kode_penjualan='$kodepenjualan'")->result();
		$this->load->view('admin/penjualan/v_struk',$data);
	}

	function hapusdata()
	{
		$id = $this->input->post('id');
		$kode_barcode = $this->input->post('kode_barcode');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->input->post('stok');
		$result = $jumlah+$stok;

		$where = array (
			'id_penjualan' => $id
		);

		$where1 = array (
			'kode_barcode' =>$kode_barcode
		);

		$data = array (
			'stok' => $result
		);

		

		$this->m->updatedata($where1,$data,'tb_barang');
		$this->m->hapusdata($where,'tb_penjualan');
	}

	function tambahqty()
	{
		$id = $this->input->post('id');
		$kode_barcode = $this->input->post('kode_barcode');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->input->post('stok');
		$harga_jual = $this->input->post('harga_jual');
		$subtotal = $this->input->post('subtotal');
		$profit = $this->input->post('profit');
		$profit_penjualan = $this->input->post('profit_penjualan');
		$diskon = $this->input->post('diskon');

		$result = $jumlah+1;
		$tambahstok = $stok-1;
		$update_subtotal = $harga_jual + $subtotal;
		$update_total = $harga_jual + $subtotal - $diskon;
		$update_profit_penjualan = $profit_penjualan + $profit; 
		

		$where = array (
			'id_penjualan' => $id
		);

		$where1 = array (
			'kode_barcode' =>$kode_barcode
		);

		$data = array (
			'jumlah' => $result,
			'subtotal' => $update_subtotal,
			'total' => $update_total,
			'profit_penjualan' => $update_profit_penjualan
		);

		$data1 = array (
			'stok' => $tambahstok
		);

		$this->m->updatedata($where,$data,'tb_penjualan');
		$this->m->updatedata($where1,$data1,'tb_barang');
	}

	function kurangqty()
	{
		$id = $this->input->post('id');
		$kode_barcode = $this->input->post('kode_barcode');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->input->post('stok');
		$harga_jual = $this->input->post('harga_jual');
		$subtotal = $this->input->post('subtotal');
		$profit = $this->input->post('profit');
		$profit_penjualan = $this->input->post('profit_penjualan');
		$diskon = $this->input->post('diskon');

		$result = $jumlah-1;
		$tambahstok = $stok+1;
		$update_subtotal = $subtotal - $harga_jual;
		$update_total = $subtotal - $harga_jual - $diskon;
		$update_profit_penjualan = $profit_penjualan - $profit; 

		$where = array (
			'id_penjualan' => $id
		);

		$where1 = array (
			'kode_barcode' =>$kode_barcode
		);

		$data = array (
			'jumlah' => $result,
			'subtotal' => $update_subtotal,
			'total' => $update_total,
			'profit_penjualan' => $update_profit_penjualan
		);

		$data1 = array (
			'stok' => $tambahstok
		);

		$this->m->updatedata($where,$data,'tb_penjualan');
		$this->m->updatedata($where1,$data1,'tb_barang');
	}

	function inputdiskon()
	{
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$profit= $this->input->post("profit");
		$modul= $this->input->post("modul");
		$total= $this->input->post("total");
		$subtotal= $this->input->post("subtotal");
		$diskon= $this->input->post("diskon");

		$update_profit = $profit - $value;
		$update_total = $total - $value;
		
		$this->m->update($id,$value,$modul,$update_profit,$update_total,$subtotal,$profit,$diskon);
		echo "{}";
	}

	
}
