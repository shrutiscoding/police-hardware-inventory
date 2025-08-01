<?php
  $page_title = 'Monthly Sales';
  require_once('includes/load.php');
  
  // Check what level user has permission to view this page
  page_require_level(3);

  $year = date('Y');
  $sales = monthlySales($year);
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Monthly Sales (<?php echo $year; ?>)</span>
        </strong>
        <!-- Download Button -->
        <a href="download_monthly_sales.php" class="btn btn-success pull-right">
          <span class="glyphicon glyphicon-download"></span> Download Report
        </a>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Product Name </th>
              <th class="text-center" style="width: 15%;"> Quantity Sold </th>
              <th class="text-center" style="width: 15%;"> Total Sales </th>
              <th class="text-center" style="width: 15%;"> Month </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr>
              <td class="text-center"><?php echo count_id(); ?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk(number_format($sale['total_price'], 2)); ?></td>
              <td class="text-center"><?php echo date('F', strtotime($sale['date'])); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
