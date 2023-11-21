<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_produk extends CI_Model {

	private $_table = "produk";

    public $id_produk;
    public $nama_produk;
    public $harga;
    public $kategori_id;
    public $status_id;

    public function rules()
    {
        return [
            ['field' => 'nama_produk',
            'label' => 'Nama Produk',
            'rules' => 'required'],

            ['field' => 'harga',
            'label' => 'Harga',
            'rules' => 'numeric']
        ];
    }

	public function get_produk()
	{
		$this->db->select('id_produk, nama_produk, harga, id_kategori, nama_kategori, id_status, nama_status')
			->from('produk')
			->join('kategori', 'kategori_id = id_kategori')
			->join('status', 'status_id = id_status')
			->where('nama_status', 'bisa dijual');
			
		return $this->db->get()->result_array();
	}

	public function get_all_kategori()
	{
		$this->db->select('id_kategori, nama_kategori')
			->from('kategori');
			
		return $this->db->get()->result_array();
	}

	public function get_all_status()
	{
		$this->db->select('id_status, nama_status')
			->from('status');
			
		return $this->db->get()->result_array();
	}

	public function get_produk_by_id($id)
	{	$this->db->select('id_produk, nama_produk, harga, id_kategori, nama_kategori, id_status, nama_status')
			->from('produk')
			->join('kategori', 'kategori_id = id_kategori')
			->join('status', 'status_id = id_status')
			->where('id_produk', $id);
		return $this->db->get()->row();
	}

	public function save()
    {
        $post = $this->input->post();
        $this->nama_produk = $post['nama_produk'];
        $this->harga = $post['harga'];
        $this->kategori_id = $post['kategori_id'];
        $this->status_id = $post['status_id'];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_produk = $post['id_produk'];
        $this->nama_produk = $post['nama_produk'];
        $this->harga = $post['harga'];
        $this->kategori_id = $post['kategori_id'];
        $this->status_id = $post['status_id'];
        $this->db->update($this->_table, $this, array('id_produk' => $post['id_produk']));
        // var_dump($this->db->last_query());die;
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('id_produk' => $id));
    }
}