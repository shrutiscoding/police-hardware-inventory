<?php
require_once('includes/load.php');
page_require_level(3);

// Get date range from GET parameters
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

$sales = dailySales($start_date, $end_date);

// Set headers to force CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=daily_sales_report_'.$start_date.'_to_'.$end_date.'.csv');

$output = fopen('php://output', 'w');

// CSV Column Headers
fputcsv($output, array('Date', 'Product Name', 'Quantity Sold', 'Total Sales'));

// Write data to CSV
foreach ($sales as $sale) {
    fputcsv($output, array(
        $sale['date'],
        $sale['name'],
        $sale['qty'],
        number_format($sale['total_price'], 2)
    ));
}

fclose($output);
exit;
?>
