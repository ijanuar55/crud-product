<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Model_produk');
        $this->load->library('form_validation');
    }

	public function insert()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		    CURLOPT_URL => 'https://recruitment.fastprint.co.id/tes/api_tes_programmer',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => '',
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 0,
		    CURLOPT_FOLLOWLOCATION => true,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => 'POST',
		    CURLOPT_POSTFIELDS => array('username' => 'tesprogrammer211123C01','password' => '47965933fdd6c19bae8c57dea2ac06b7'),
		    CURLOPT_HTTPHEADER => array(
		        'Cookie: ci_session=00lbrh5kgdfo5pvd9vc81q0p656a9jse'
		    ),
		));

		$res = curl_exec($curl);

		$response = json_decode($res, true);

		$data_produk = $data_kategori = $data_status = [];
		foreach ($response['data'] as $value) {
			$this->db->where('nama_kategori', $value['kategori']);
   			$kategori = $this->db->get('kategori')->row_array();
			if (empty($kategori)) {
				$this->db->insert('kategori', array('nama_kategori' => $value['kategori']));
				$data_kategori[$this->db->insert_id()] = $value['kategori'];
			}
			$this->db->where('nama_status', $value['status']);
   			$status = $this->db->get('status')->row_array();
			if (empty($status)) {
				$this->db->insert('status', array('nama_status' => $value['status']));
				$data_status[$this->db->insert_id()] = $value['status'];
			}
			$this->db->where('id_produk', $value['id_produk']);
   			$produk = $this->db->get('produk')->row_array();
   			if (empty($produk)) {
				$data_produk = [
					'id_produk' => $value['id_produk'],
					'nama_produk' => $value['nama_produk'],
					'harga' => $value['harga'],
					'kategori_id' => array_search($value['kategori'], $data_kategori),
					'status_id' => array_search($value['status'], $data_status)
				];
				$this->db->insert('produk', $data_produk);
   			}
		}

		return $this->output
	    ->set_content_type('application/json')
	    ->set_status_header(200)
	    ->set_output(json_encode($response));
	}

	public function index()
	{
		$data['produk'] = $this->Model_produk->get_produk();
		
		$this->load->view('produk', $data);
	}

	public function add()
    {
        $produk = $this->Model_produk;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view('new_form');
    }

    public function edit($id = null)
    {
        if (!isset($id)){
        	$data['produk'] = $this->Model_produk->get_produk();
		
			$this->load->view('produk', $data);
        }
       
        $produk = $this->Model_produk;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data['produk'] = $produk->get_produk_by_id($id);
        if (!$data['produk']) show_404();
        $this->load->view('edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Model_produk->delete($id)) {
            $data['produk'] = $this->Model_produk->get_produk();
		
			$this->load->view('produk', $data);
        }
    }
}
