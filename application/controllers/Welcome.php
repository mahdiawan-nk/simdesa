<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	protected $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/Berita_model', 'news');
		$this->load->model('admin/Kategori_model', 'kategori');
		$this->load->model('admin/Perangkatdesa_model', 'perangkat');
	}

	public function index($offset = 0)
	{
		$this->data['pages'] = 'sites/home';
		$this->db->select('a.*,b.nama_kategori');
		$this->db->join('berita_kategori b', 'a.kategori_id=b.id_kategori', 'inner');
		$this->db->where('a.status', 'active');
		$this->db->order_by('a.id', 'desc');
		$this->data['news'] = $this->db->get('data_berita a', 4)->result();
		$this->load->view('sites/index', $this->data);
	}

	public function halaman($slug)
	{
		$this->data['pages'] = 'sites/halaman';
		$halamanData = $this->db->get_where('halaman', ['slug_name' => $slug])->row();

		switch ($halamanData ? $halamanData->template : 'default') {
			case 'card_profile':
				$this->data['detail'] = $halamanData;
				$this->data['profile'] =	$this->perangkat->read()->result();
				$this->data['halaman'] = 'sites/template/card_profile';
				break;
			case 'news':
				$this->data['detail'] = $halamanData;
				$this->data['news'] = $this->news->read()->result();
				$this->data['halaman'] = 'sites/template/news';
				break;
			case 'row_text':
				$this->data['detail'] = $halamanData;
				$this->data['halaman'] = 'sites/template/row_text';
				break;
			default:
				$this->data['detail'] = (object)['title_halaman' => $slug . 'tess'];
				$this->data['halaman'] = 'sites/template/row_text';
				break;
		}

		$this->load->view('sites/index', $this->data);
	}

	public function berita($offset = 0)
	{
		$halamanData = $this->db->get_where('halaman', ['slug_name' => 'berita'])->row();
		$this->data['detail'] = $halamanData;
		$this->data['pages'] = 'sites/halaman';
		$this->data['halaman'] = 'sites/template/news';

		$this->load->library('pagination');
		$config['attributes'] = array('class' => 'page-link');
		$config['base_url'] = base_url('berita');
		$config['total_rows'] = $this->db->count_all('data_berita');
		$config['per_page'] = 10;
		$config['uri_segment'] = 2;

		$config['full_tag_open'] = '<nav class="blog-pagination justify-content-center d-flex"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';

		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="ti-angle-left"></i>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '<i class="ti-angle-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$this->data['in_kategori']  = $this->beritaKategori();
		$this->data['links'] = $this->pagination->create_links();
		$this->data['news'] = $this->db->get('data_berita', $config['per_page'], $offset)->result();

		$this->load->view('sites/index', $this->data);
	}

	public function detailberita($slug)
	{
		$this->data['pages'] = 'sites/berita_detail';

		$this->data['in_kategori']  = $this->beritaKategori();
		$this->data['news'] = $this->db->get_where('data_berita', ['slug' => $slug])->row();

		$this->load->view('sites/index', $this->data);
	}

	public function surat($args)
	{
		$halamanData = $this->db->get_where('surat_jenis', ['slug' => $args])->row();
		$this->data['pages'] = 'sites/halaman';
		$this->data['detail'] = (object)['title_halaman' => $halamanData->nama_surat, 'isi_halaman' => $halamanData->deskripsi, 'url_' => true];
		$this->data['halaman'] = 'sites/template/surat';
		$this->load->view('sites/index', $this->data);
	}

	function beritaKategori()
	{
		$this->db->select('a.*');
		$this->db->select('(SELECT count(kategori_id) FROM data_berita b WHERE a.id_kategori=b.kategori_id)as jml');
		return $this->db->get('berita_kategori a')->result();
	}
}
