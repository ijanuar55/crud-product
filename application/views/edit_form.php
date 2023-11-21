<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h3>Merubah Data Produk</h3>
<a href="<?php echo site_url('produk/') ?>"><i class="fas fa-arrow-left"></i> Back</a>

<div>
  <form action="" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_produk" value="<?php echo $produk->id_produk?>" />

    <label for="nama_produk">Nama Produk</label>
    <input type="text" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?php echo $produk->nama_produk ?>" required>

    <label for="harga">Harga</label>
    <input type="number" id="harga" name="harga" placeholder="Harga" value="<?php echo $produk->harga ?>" required>

    <label for="kategori_id">Kategori</label>
    <select id="kategori_id" name="kategori_id">
    	<?php $this->load->model('Model_produk'); $all_kategori = $this->Model_produk->get_all_kategori(); foreach ($all_kategori as $value) { ?>
    		<option value=<?php echo $value['id_kategori']; ?>><?php echo $value['nama_kategori']; ?></option>
    	<?php } ?>
      <option selected="selected">
      <?php echo $produk->nama_kategori ?>
      </option>
    </select>

    <label for="status_id">Status</label>
    <select id="status_id" name="status_id">
    	<?php $all_status = $this->Model_produk->get_all_status(); foreach ($all_status as $value) { ?>
    		<option value=<?php echo $value['id_status']; ?>><?php echo $value['nama_status']; ?></option>
    	<?php } ?>
      <option selected="selected">
      <?php echo $produk->nama_status ?>
      </option>
    </select>
  
    <input type="submit" value="Submit">
  </form>
</div>
<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success" role="alert">
	<?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

</body>
</html>


