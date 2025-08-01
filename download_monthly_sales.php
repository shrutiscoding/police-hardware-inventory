<?php
require_once('includes/load.php');
page_require_level(3);

$year = date('Y');
$sales = monthlySales($year);

// Set headers to force download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=monthly_sales_report_'.$year.'.csv');

$output = fopen('php://output', 'w');

// CSV Column Headers
fputcsv($output, array('Month', 'Product Name', 'Quantity Sold', 'Total Sales'));

// Write data to CSV
foreach ($sales as $sale) {
    fputcsv($output, array(
        date('F', strtotime($sale['date'])),
        $sale['name'],
        $sale['qty'],
        number_format($sale['total_price'], 2)
    ));
}

fclose($output);
exit;
?>
