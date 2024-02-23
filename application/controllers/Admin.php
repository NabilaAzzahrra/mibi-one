<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
		if (!$this->session->userdata('status_login')) {
			redirect('Auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('status_login');
		$this->session->set_flashdata('logout', TRUE);
		redirect('Auth');
	}

	public function sidebar()
	{
		$data = array(
			'studio' => "",
			'film' => "",
			'user' => "",

			'index' => "close",
			'index_status' => "",
			'master' => "close",
			'master_status' => "",
			'transaksi' => "close",
			'transaksi_status' => "",
		);

		$this->session->set_userdata($data);
	}

	public function index()
	{
		$this->sidebar();
		$data = array(
			'index' => "open",
			'index_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Dashboard';

		$select = $this->db->select('*');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->where('status', '1');
		$select = $this->db->where('day', date('l'));
		$data['read'] = $this->m->Get_All('m_transaksi', $select);

		$film = $this->db->select('*');
		$data['film'] = $this->m->Get_All('film', $film);

		$penjualan = $this->db->select('*');
		$penjualan = $this->db->join('dt_pemesanan', 'dt_pemesanan.id_pemesanan=pemesanan.id_pemesanan');
		$penjualan = $this->db->where('tgl_pemesanan', date('Y-m-d'));
		// $penjualan = $this->db->where('tgl_pemesanan', date('m'));
		$data['pemesanan'] = $this->m->Get_All('pemesanan', $penjualan);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('index');
		$this->load->view('templates/script');
	}

	// STUDIO //
	public function studio()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Studio';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('studio', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('studio');
		$this->load->view('templates/script');
	}

	public function actadd_studio()
	{
		$data = array(
			'id_studio' => $this->input->post('id_studio'),
			'studio' => $this->input->post('studio'),
			'baris' => $this->input->post('row'),
			'kolom' => $this->input->post('kolom'),
		);

		$this->m->Save($data, 'studio');

		redirect('Admin/studio');
	}

	public function actadd_kursi()
	{
		$ids = $this->input->post('user_id');
		$id = $this->input->post('id_studio');

		for ($i = 0; $i < count($ids); $i++) {
			$result = $this->db->insert('kursi_studio', ['id_studio' => $id, 'seat' => $ids[$i]]);
		}

		redirect('Admin/studio');
	}

	public function actedit_studio()
	{
		$where = array(
			'id_studio' => $this->input->post('id_studio'),
		);
		$data = array(
			'studio' => $this->input->post('studio'),
			'baris' => $this->input->post('row'),
			'kolom' => $this->input->post('kolom'),
		);

		$this->m->Update($where, $data, 'studio');
		redirect('Admin/studio');
	}

	public function acthapus_studio()
	{
		$where = array(
			'id_studio' => $this->input->post('id_studio'),
		);

		$this->m->Delete($where, 'studio');
		redirect('Admin/studio');
	}

	public function hapus_studio()
	{
		$where = array(
			'id_studio' => $_GET['id_studio'],
		);

		$this->m->Delete($where, 'studio');
		redirect('Admin/studio');
	}
	// ===== // 

	// FILM //

	public function film()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Film';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('film', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('film/film');
		$this->load->view('templates/script');
	}

	public function film_add()
	{
		$this->sidebar();
		$data = array(
			'index' => "open",
			'index_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Film';

		$select = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('film/film_add');
		$this->load->view('templates/script');
	}

	public function getStudio($id)
	{
		$select = $this->db->select('*');
		$select = $this->db->where('id_studio', $id);
		$studio = $this->m->Get_All('studio', $select);
		foreach ($studio as $m) {
			echo '

                    <label for="space">Space</label>
                    <input type="text" class="form-control" name="space" value="' . $m->space . '" readonly>

            ';
		}
	}

	public function actadd_film()
	{

		$config['upload_path']          = './film/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 2048; //set max size allowed in Kilobyte

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('film_foto')) //upload and validate
		{
			echo "Gagal Tambah";
		} else {
			$foto               = $this->upload->data();
			$foto               = $foto['file_name'];
			$id_film      		= $this->input->post('id_film', TRUE);
			$judul              = $this->input->post('judul', TRUE);
			$jenis              = $this->input->post('jenis', TRUE);
			$produser           = $this->input->post('produser', TRUE);
			$sutradara          = $this->input->post('sutradara', TRUE);
			$penulis            = $this->input->post('penulis', TRUE);
			$produksi           = $this->input->post('produksi', TRUE);
			$casts              = $this->input->post('casts', TRUE);
			$sinopsis           = $this->input->post('sinopsis', TRUE);
			$data = array(
				'id_film'      => $id_film,
				'judul'        => $judul,
				'jenis'        => $jenis,
				'produser'     => $produser,
				'sutradara'    => $sutradara,
				'penulis'      => $penulis,
				'produksi'     => $produksi,
				'casts'        => $casts,
				'sinopsis'     => $sinopsis,
				'foto'         => $foto,
			);
			$this->m->Save($data, 'film');

			redirect('Admin/film');
		}

		redirect('Admin/film');
	}

	public function actedit_film()
	{
		$id = $this->input->post('id_film');

		$data = $this->m->ambil_id_film($id);
		$nama = './film/' . $data->foto;

		if (is_readable($nama) && unlink($nama)) {

			$config['upload_path']          = './film/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 500; //set max size allowed in Kilobyte

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('film_foto')) //upload and validate
			{
				echo "Gagal Tambah";
			} else {
				$foto                 = $this->upload->data();
				$foto                 = $foto['file_name'];

				$data = array(
					'judul'              => $this->input->post('judul'),
					'jenis'              => $this->input->post('jenis'),
					'produser'                   => $this->input->post('produser'),
					'sutradara'                   => $this->input->post('sutradara'),
					'penulis'                   => $this->input->post('penulis'),
					'produksi'                   => $this->input->post('produksi'),
					'casts'                   => $this->input->post('casts'),
					'sinopsis'                   => $this->input->post('sinopsis'),
					'foto' => $foto
				);
				$update = $this->m->update_film($id, $data);

				redirect('Admin/film');
			}
		}

		redirect('Admin/film');
	}

	public function acthapus_film()
	{
		$id = $this->input->post('id_film');
		$data = $this->m->ambil_id_film($id);
		//lokasi file
		$path = './film/';
		@unlink($path . $data->foto); //hapus data di folder
		if ($this->m->delete_film($id) == TRUE) {
			// $this->session->set_flashdata('pesan', 'DATA BERHASIL DIHAPUS');
		}
		redirect('Admin/film');
	}


	public function film_edit()
	{
		$this->sidebar();
		$data = array(
			'index' => "open",
			'index_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Film';

		$select = $this->db->select('*');
		$select = $this->db->where('id_film', $_GET['id_film']);
		$data['read'] = $this->m->Get_All('film', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('film/film_edit');
		$this->load->view('templates/script');
	}

	// === //	

	// MASTER TRANSAKSI //

	public function m_transaksi()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Penayangan';

		$GetP = $this->db->query('select* FROM tbl_dtm_transaksi');


		foreach ($GetP->result() as $p) {
			$tanggal = $p->tgl_show;
			$this->db->query("UPDATE tbl_dtm_transaksi SET day = '" . date('l', strtotime($tanggal)) . "' WHERE id_m_transaksi = '" . $p->id_m_transaksi . "'");
		}

		$select = $this->db->select('*');
		$select = $this->db->join('m_transaksi', 'm_transaksi.id_film=film.id_film');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('studio', 'studio.id_studio=dtm_transaksi.id_studio');
		$data['read'] = $this->m->Get_All('film', $select);


		$film = $this->db->select('*');
		$data['film'] = $this->m->Get_All('film', $film);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('m_transaksi/m_transaksi');
		$this->load->view('templates/script');
	}

	public function add_m_transaksi()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Penayangan';

		$film = $this->db->select('*');
		$data['film'] = $this->m->Get_All('film', $film);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('m_transaksi/add_m_transaksi');
		$this->load->view('templates/script');
	}

	public function actadd_m_transaksi()
	{
		$id = date('Ymdhis');

		$dataa = array(
			'id_m_transaksi' => $id,
			'id_film' => $this->input->post('id_film'),
			'id_studio' => $this->input->post('id_studio'),
			'admin' => $this->session->userdata('username')
		);
		$this->m->Save($dataa, 'm_transaksi');

		$data = array(
			'id_m_transaksi' => $id,
			'id_studio' => $this->input->post('id_studio'),
			'tgl_show' => $this->input->post('tgl_show'),
			'jam_tayang' => $this->input->post('jam_tayang'),
			'harga' => $this->input->post('harga')
		);
		$this->m->Save($data, 'dtm_transaksi');

		redirect('Admin/m_transaksi');
	}

	public function ubah_m_transaksi()
	{
		$this->sidebar();
		$data = array(
			'master' => "open",
			'master_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Penayangan';

		$select = $this->db->select('*');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->where('m_transaksi.id_m_transaksi', $_GET['id_m_transaksi']);
		$data['read'] = $this->m->Get_All('m_transaksi', $select);

		$film = $this->db->select('*');
		$data['film'] = $this->m->Get_All('film', $film);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('m_transaksi/ubah_m_transaksi');
		$this->load->view('templates/script');
	}

	public function actubah_m_transaksi()
	{
		$wheree = array(
			'id_m_transaksi' => $this->input->post('id_m_transaksi'),
		);
		$dataa = array(
			'id_film' => $this->input->post('id_film'),
			'id_studio' => $this->input->post('id_studio'),
		);
		$this->m->Update($wheree, $dataa, 'm_transaksi');

		$data = array(
			// 'day' => $this->input->post('day'),
			'id_studio' => $this->input->post('id_studio'),
			'tgl_show' => $this->input->post('tgl_show'),
			'jam_tayang' => $this->input->post('jam_tayang'),
			'harga' => $this->input->post('harga')
		);
		$this->m->Update($wheree, $data, 'dtm_transaksi');

		redirect('Admin/m_transaksi');
	}

	public function acthapus_m_transaksi()
	{
		$wheree = array(
			'id_m_transaksi' => $this->input->post('id_m_transaksi'),
		);

		$this->m->Delete($wheree, 'm_transaksi');
		$this->m->Delete($wheree, 'dtm_transaksi');

		redirect('Admin/m_transaksi');
	}

	public function pemesanan()
	{
		$this->sidebar();
		$data = array(
			'transaksi' => "open",
			'transaksi_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Pembelian';

		$select = $this->db->select('*');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->where('m_transaksi.status', 1);
		$data['read'] = $this->m->Get_All('m_transaksi', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/pemesanan');
		$this->load->view('templates/script');
	}

	public function dt_pemesanan()
	{
		$this->sidebar();
		$data = array(
			'transaksi' => "open",
			'transaksi_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Pembelian';

		$select = $this->db->select('*');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->where('m_transaksi.id_m_transaksi', $_GET['id_m_transaksi']);
		$data['read'] = $this->m->Get_All('m_transaksi', $select);

		// $studio = $this->db->select('space');
		// $data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/dt_pemesanan');
		$this->load->view('templates/script');
	}

	public function pemesanan_tiket()
	{
		$this->sidebar();
		$data = array(
			'transaksi' => "open",
			'transaksi_status' => " active",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Pembelian';

		$select = $this->db->select('*');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->where('m_transaksi.id_m_transaksi', $_GET['id_m_transaksi']);
		$data['read'] = $this->m->Get_All('m_transaksi', $select);

		// $select = $this->db->select('*');
		// $select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		// $select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		// $select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		// $select = $this->db->join('kursi_studio', 'kursi_studio.id_studio=studio.id_studio');
		// $select = $this->db->where('m_transaksi.id_m_transaksi', $_GET['id_m_transaksi']);
		// $data['kursi'] = $this->m->Get_All('m_transaksi', $select);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/pemesanan_tiket');
		$this->load->view('templates/script');
	}

	public function add_dt_pemesanan()
	{
		$user_ids = $this->input->post('user_id');
		if ($user_ids == "") {
			echo "Pilih dulu";
		} else {
			for ($i = 0; $i < count($user_ids); $i++) {
				$result = $this->db->select()
					->from('m_transaksi')
					->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi')
					->where_in('m_transaksi.id_m_transaksi', $user_ids)
					->get();
			}
			if ($result->num_rows() > 0) {
				$stu_data = $result->result();
			} else {
				$stu_data = $result->result();
			}
		}
		$data['title'] = 'Detail Pemesanan';

		$select = $this->db->select('*');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->where('m_transaksi.id_m_transaksi', $this->input->post('id_m_transaksi`'));
		$data['read'] = $this->m->Get_All('m_transaksi', $select);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/add_dt_pemesanan', ['id_m_transaksi' => $stu_data]);
		$this->load->view('templates/script');
	}

	public function actadd_dt_pemesanan()
	{
		// 	$ids = $this->input->post('user_id');
		// 	$id = date('Ymdhis');
		// 	$id_m_transaksi = $this->input->post('id_m_transaksi');
		// 	$admin = $this->session->userdata('username');

		// 	if ($ids == "") {
		// 		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		//     <strong>Pilih Kursi Terlebih dahulu</strong>
		//     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		//       <span aria-hidden="true">&times;</span>
		//     </button>
		//   </div>');
		// 		redirect('Admin/pemesanan');
		// 	} else {

		// 		for ($i = 0; $i < count($ids); $i++) {
		// 			$ih = "$id$ids[$i]";
		// 			$result = $this->db->insert('pemesanan', [
		// 				'id_pemesanan' => "$id$ids[$i]",
		// 				'seat' => $ids[$i],
		// 				'id_m_transaksi' => $id_m_transaksi,
		// 				'admin' => $admin,
		// 			]);
		// 		}


		// 		if ($ids == "") {
		// 			echo "Pilih dulu";
		// 		} else {
		// 			for ($i = 0; $i < count($ids); $i++) {
		// 				$result = $this->db->select()
		// 					->from('pemesanan')
		// 					->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi')
		// 					->join('film', 'film.id_film=m_transaksi.id_film')
		// 					->join('studio', 'studio.id_studio=m_transaksi.id_studio')
		// 					->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi')
		// 					->where_in('seat', $ids)
		// 					->get();
		// 			}
		// 			if ($result->num_rows() > 0) {
		// 				$stu_data = $result->result();
		// 			} else {
		// 				$stu_data = $result->result();
		// 			}
		// 		}
		// 		$this->load->view('pemesanan/cetak_tiket', ['id_pemesanan' => $stu_data]);
		// 	}


		$ids = $this->input->post('user_id');
		$id_m_transaksi = $this->input->post('id_m_transaksi');
		$admin = $this->session->userdata('username');

		if (empty($ids)) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Pilih Kursi Terlebih dahulu</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>');
			redirect('Admin/pemesanan');
		} else {
			$id = date('Ymdhis');

			foreach ($ids as $seat) {
				$id_pemesanan = $id . $seat;
				$data = [
					'id_pemesanan' => $id_pemesanan,
					'seat' => $seat,
					'id_m_transaksi' => $id_m_transaksi,
					'admin' => $admin,
				];
				$this->db->insert('pemesanan', $data);
			}

			$result = $this->db->select()
				->from('pemesanan')
				->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi')
				->join('film', 'film.id_film=m_transaksi.id_film')
				->join('studio', 'studio.id_studio=m_transaksi.id_studio')
				->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi')
				->where_in('seat', $ids)
				->where_in('pemesanan.id_m_transaksi', $id_m_transaksi)
				->get();

			if ($result->num_rows() > 0) {
				$stu_data = $result->result();
			} else {
				$stu_data = []; // Jika tidak ada data
			}

			$this->load->view('pemesanan/cetak_tiket', ['id_pemesanan' => $stu_data]);
		}
	}

	public function cetak_pemesanan()
	{
		$data['title'] = 'Cetak Pemesanan';

		$select = $this->db->select('*');
		$select = $this->db->join('dt_pemesanan', 'dt_pemesanan.id_pemesanan=dt_pemesanan.id_pemesanan');
		$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->where('dt_pemesanan.id_pemesanan', $_GET['id_pemesanan']);
		$select = $this->db->where('dt_pemesanan.seat', $_GET['seat']);
		$data['read'] = $this->m->Get_All('pemesanan', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('pemesanan/cetak');
	}

	public function lihat_daftar_pemesanan()
	{
		$bulan = "all";
		$film = "all";
		$tahun = "all";

		if (isset($_GET['bulan'])) {
			$bulan = $_GET['bulan'];
		}
		if (isset($_GET['film'])) {
			$film = $_GET['film'];
		}
		if (isset($_GET['tahun'])) {
			$tahun = $_GET['tahun'];
		}

		$data['title'] = 'Daftar Pemesanan';

		$select = $this->db->select('*');
		$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		$select = $this->db->order_by('tgl_data', 'DESC');
		$data['read'] = $this->m->Get_All('pemesanan', $select);

		$select = $this->db->select('*');
		$select = $this->db->join('dt_pemesanan', 'dt_pemesanan.id_pemesanan=pemesanan.id_pemesanan');
		$data['total'] = $this->m->Get_All('pemesanan', $select);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		// $studio = $this->db->select('*');
		// $studio = $this->db->group_by('tgl_pemesanan', date('Y'));
		// $data['tahun'] = $this->m->Get_All('pemesanan', $studio);

		// $select = $this->db->select('*');
		$data['tahun'] = $this->db->group_by('DATE_FORMAT(tgl_pemesanan,"%Y")')->get('pemesanan')->result();

		$studio = $this->db->select('*');
		$data['film'] = $this->m->Get_All('film', $studio);

		if ($tahun != "all" && $film != "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%Y")', $_GET['tahun']);
			$a = $this->db->where('m_transaksi.id_film', $_GET['film']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($bulan != "all" && $tahun != "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['bulan']);
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%Y")', $_GET['tahun']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($bulan != "all" && $film != "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['bulan']);
			$select = $this->db->where('m_transaksi.id_film', $_GET['film']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($bulan != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$select = $this->db->order_by('tgl_data', 'DESC');
			$select = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['bulan']);
			$data['read'] = $this->m->Get_All('pemesanan', $select);
		} elseif ($film != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$select = $this->db->where('m_transaksi.id_film', $_GET['film']);
			$select = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $select);
		} elseif ($tahun != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$select = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%Y")', $_GET['tahun']);
			$select = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $select);
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/daftar_pemesanan');
		$this->load->view('templates/script');
	}

	public function print()
	{
		if ($_GET['nm_bln'] != "all" && $_GET['nm_tahun'] == "all" && $_GET['nm_film'] == "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['nm_bln']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($_GET['nm_tahun'] != "all" && $_GET['nm_film'] != "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%Y")', $_GET['nm_tahun']);
			$a = $this->db->where('m_transaksi.id_film', $_GET['nm_film']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($_GET['nm_bln'] != "all" && $_GET['nm_tahun'] != "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['nm_bln']);
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%Y")', $_GET['nm_tahun']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($_GET['nm_bln'] != "all" && $_GET['nm_film'] != "all") {
			$a = $this->db->select('*');
			$a = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$a = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$a = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$a = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$a = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['nm_bln']);
			$select = $this->db->where('m_transaksi.id_film', $_GET['nm_film']);
			$a = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $a);
		} elseif ($_GET['nm_bln'] != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$select = $this->db->order_by('tgl_data', 'DESC');
			$select = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%m")', $_GET['nm_bln']);
			$data['read'] = $this->m->Get_All('pemesanan', $select);
		} elseif ($_GET['nm_film'] != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$select = $this->db->where('m_transaksi.id_film', $_GET['nm_film']);
			$select = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $select);
		} elseif ($_GET['nm_tahun'] != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
			$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
			$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
			$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
			$select = $this->db->where('DATE_FORMAT(tgl_pemesanan,"%Y")', $_GET['nm_tahun']);
			$select = $this->db->order_by('tgl_data', 'DESC');
			$data['read'] = $this->m->Get_All('pemesanan', $select);
		}

		// $this->load->view('templates/header', $data);
		// $this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/print', $data);
		// $this->load->view('templates/script');
	}


	public function det_pemesanan()
	{
		$data['title'] = 'Detail Pemesanan';

		$select = $this->db->select('*');
		$select = $this->db->join('m_transaksi', 'm_transaksi.id_m_transaksi=pemesanan.id_m_transaksi');
		$select = $this->db->join('dtm_transaksi', 'dtm_transaksi.id_m_transaksi=m_transaksi.id_m_transaksi');
		$select = $this->db->join('dt_pemesanan', 'dt_pemesanan.id_pemesanan=pemesanan.id_pemesanan');
		$select = $this->db->join('film', 'film.id_film=m_transaksi.id_film');
		$select = $this->db->join('studio', 'studio.id_studio=m_transaksi.id_studio');
		// $select = $this->db->join('kursi_studio', 'kursi_studio.id_kursi=dt_pemesanan.id_kursi');
		$select = $this->db->where('dt_pemesanan.id_pemesanan', $_GET['id_pemesanan']);
		$data['read'] = $this->m->Get_All('pemesanan', $select);

		$select = $this->db->select('*');
		$select = $this->db->join('dt_pemesanan', 'dt_pemesanan.id_pemesanan=pemesanan.id_pemesanan');
		$data['total'] = $this->m->Get_All('pemesanan', $select);

		$studio = $this->db->select('*');
		$data['studio'] = $this->m->Get_All('studio', $studio);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pemesanan/det_pemesanan');
		$this->load->view('templates/script');
	}

	public function actonkan_m_transaksi()
	{
		$where = array(
			'id_m_transaksi' => $this->input->post('id_m_transaksi'),
		);
		$data = array(
			'status' => '1',
		);

		$this->m->Update($where, $data, 'tbl_m_transaksi');

		redirect('Admin/m_transaksi');
	}

	public function actoffkan_m_transaksi()
	{
		$where = array(
			'id_m_transaksi' => $this->input->post('id_m_transaksi'),
		);
		$data = array(
			'status' => '2',
		);

		$this->m->Update($where, $data, 'tbl_m_transaksi');

		redirect('Admin/m_transaksi');
	}

	public function user()
	{
		$data['title'] = 'User';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('user', $select);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user');
		$this->load->view('templates/script');
	}

	public function actadd_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get();
		if ($cek->num_rows() > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Username sudah ada, silahkan ganti yang lain</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'akses' => 'admin',
			);

			$this->m->Save($data, 'user');
		}
		redirect('Admin/user');
	}

	public function actedit_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get();
		if ($cek->num_rows() > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		    <strong>Username sudah ada, silahkan ganti yang lain</strong>
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>');
		} else {
			$where = array(
				'id_user' => $this->input->post('id_user'),
			);
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
			);

			$this->m->Update($where, $data, 'user');
		}

		redirect('Admin/user');
	}

	public function acthapus_user()
	{
		$where = array(
			'username' => $this->input->post('username'),
		);

		$this->m->Delete($where, 'studio');
		redirect('Admin/user');
	}
}
