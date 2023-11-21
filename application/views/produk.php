<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html>
<head>
<style>
#produk {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#produk td, #produk th {
  border: 1px solid #ddd;
  padding: 8px;
}

#produk tr:nth-child(even){background-color: #f2f2f2;}

#produk tr:hover {background-color: #ddd;}

#produk th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1><a href="<?php echo site_url('produk/add') ?>"><button>Add</button></a></h1>

<table id="produk">
  <tr>
    <th>Nama Produk</th>
    <th>Harga</th>
    <th>Kategori</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  	<?php
  		if (isset($produk)) {
  			foreach ($produk as $value) { ?>
  <tr>
    <td><?php echo $value['nama_produk']; ?></td>
    <td><?php echo $value['harga']; ?></td>
    <td><?php echo $value['nama_kategori']; ?></td>
    <td><?php echo $value['nama_status']; ?></td>
    <td><a href="<?php echo site_url('produk/edit/'.$value['id_produk']) ?>"><button>Edit</button></a><a onclick="deleteConfirm('<?php echo site_url('produk/delete/'.$value['id_produk']) ?>')"><button>Delete</button></a></td>
  </tr>
  	<?php		}
  		} ?>
</table>
<script>
function deleteConfirm(url){
	$('#btn-delete').attr('href', url);
	$('#deleteModal').modal();
}
</script>
</body>

<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>
</html>