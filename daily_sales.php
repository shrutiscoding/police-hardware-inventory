<?php
  $page_title = 'Daily Sales';
  require_once('includes/load.php');
  
  // Check what level user has permission to view this page
  page_require_level(3);

  $year  = date('Y');
  $month = date('m');

  $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
  $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

  $sales = dailySales($start_date, $end_date);
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
          <span>Daily Sales Report</span>
        </strong>
        <!-- Date Selection Form -->
        <form method="GET" action="daily_sales.php" class="form-inline pull-right">
          <label for="start_date">From:</label>
          <input type="date" name="start_date" value="<?php echo $start_date; ?>" required class="form-control">
          <label for="end_date">To:</label>
          <input type="date" name="end_date" value="<?php echo $end_date; ?>" required class="form-control">
          <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <!-- Download Button -->
        <a href="download_daily_sales.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>" class="btn btn-success pull-right">
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
              <th class="text-center" style="width: 15%;"> Date </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr>
              <td class="text-center"><?php echo count_id(); ?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk(number_format($sale['total_price'], 2)); ?></td>
              <td class="text-center"><?php echo $sale['date']; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
