<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Check permission level
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>

<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title', 'product-quantity', 'product-categorie', 'buy-date', 'expire-date', 'price');
   validate_fields($req_fields);

   if(empty($errors)){
     $p_name    = remove_junk($db->escape($_POST['product-title']));
     $p_qty     = remove_junk($db->escape($_POST['product-quantity']));
     $p_cat     = remove_junk($db->escape($_POST['product-categorie']));
     $p_buy_date = remove_junk($db->escape($_POST['buy-date']));
     $p_exp_date = remove_junk($db->escape($_POST['expire-date']));
     $p_price   = remove_junk($db->escape($_POST['price']));

     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }

     $date    = make_date();
     $query  = "INSERT INTO products (name, quantity, buy_date, expire_date, categorie_id, media_id, date, price)";
     $query .= " VALUES ('{$p_name}', '{$p_qty}', '{$p_buy_date}', '{$p_exp_date}', '{$p_cat}', '{$media_id}', '{$date}', '{$p_price}')";
     $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";

     if($db->query($query)){
       $session->msg('s', "Product added successfully");
       redirect('add_product.php', false);
     } else {
       $session->msg('d', 'Failed to add product!');
       redirect('add_product.php', false);
     }

   } else {
     $session->msg("d", $errors);
     redirect('add_product.php', false);
   }
}
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Product</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
          
          <!-- Product Name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
              <input type="text" class="form-control" name="product-title" placeholder="Product Title">
            </div>
          </div>

          <!-- Category & Photo -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <select class="form-control" name="product-categorie">
                  <option value="">Select Product Category</option>
                  <?php foreach ($all_categories as $cat): ?>
                    <option value="<?php echo (int)$cat['id'] ?>"><?php echo $cat['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-control" name="product-photo">
                  <option value="">Select Product Photo</option>
                  <?php foreach ($all_photo as $photo): ?>
                    <option value="<?php echo (int)$photo['id'] ?>"><?php echo $photo['file_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <!-- Quantity -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
              <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
            </div>
          </div>

          <!-- Buy Date & Expiry Date -->
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input type="date" class="form-control" name="buy-date">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input type="date" class="form-control" name="expire-date">
                </div>
              </div>
            </div>
          </div>

          <!-- Price -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number" step="0.01" class="form-control" name="price" placeholder="Price">
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" name="add_product" class="btn btn-danger">Add Product</button>

        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
