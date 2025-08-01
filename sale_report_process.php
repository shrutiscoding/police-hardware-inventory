<?php
$page_title = 'Sales Report';
require_once('includes/load.php');
page_require_level(3);

$results = '';

if (isset($_POST['submit'])) {
    $req_dates = array('start-date', 'end-date');
    validate_fields($req_dates);

    if (empty($errors)) {
        $start_date = remove_junk($db->escape($_POST['start-date']));
        $end_date = remove_junk($db->escape($_POST['end-date']));
        $results = find_sale_by_dates($start_date, $end_date);
    } else {
        $session->msg("d", "Invalid date range.");
        redirect('sales_report.php', false);
    }
} else {
    $session->msg("d", "Select dates");
    redirect('sales_report.php', false);
}
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .page-break {
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .sale-head {
            text-align: center;
            margin-bottom: 30px;
        }

        .sale-head h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            padding-bottom: 5px;
            border-bottom: 2px solid #007bff;
        }

        .sale-head strong {
            display: block;
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }

        table thead tr {
            background: #007bff;
            color: #fff;
            font-weight: bold;
        }

        table thead th {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table tbody tr {
            background: #f9f9f9;
            transition: background 0.3s ease-in-out;
        }

        table tbody tr:hover {
            background: #f1f1f1;
        }

        table tbody td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            color: #333;
        }

        .text-right {
            text-align: right;
        }

        tfoot {
            font-weight: bold;
            background: #f1f1f1;
            color: #000;
        }

        tfoot td {
            padding: 10px;
            border-top: 2px solid #007bff;
        }

        .download-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-download {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-download:hover {
            background-color: #218838;
        }

        /* Print Styles */
        @media print {
            body {
                background: none;
            }

            .page-break {
                box-shadow: none;
                border: none;
            }

            .sale-head h1 {
                color: #000;
                border-bottom: 2px solid #000;
            }

            table thead tr {
                background: #000;
                color: #fff;
            }

            table tbody tr {
                background: #fff;
            }
        }
    </style>
</head>
<body>

<?php if ($results): ?>
    <div class="page-break" id="report-content">
        <div class="sale-head">
            <h1>Inventory Management System - Sales Report</h1>
            <strong><?php if(isset($start_date)){ echo $start_date; }?> TILL DATE <?php if(isset($end_date)){ echo $end_date; }?></strong>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product Title</th>
                    <th>Selling Price</th>
                    <th>Total Qty</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo remove_junk($result['date']); ?></td>
                        <td><?php echo remove_junk(ucfirst($result['name'])); ?></td>
                        <td class="text-right">$<?php echo remove_junk($result['price']); ?></td>
                        <td class="text-right"><?php echo remove_junk($result['total_sales']); ?></td>
                        <td class="text-right">$<?php echo remove_junk($result['total_price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="text-right">
                    <td colspan="3"></td>
                    <td>Grand Total</td>
                    <td>$<?php echo number_format(total_price($results), 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Download Button -->
    <div class="download-btn">
        <button class="btn-download" onclick="downloadReport()">Download Report (PDF)</button>
    </div>

<?php else: ?>
    <div class="alert alert-danger text-center">
        <strong>Sorry, no sales found for the selected date range.</strong>
    </div>
<?php endif; ?>

<script>
    function downloadReport() {
        const element = document.getElementById('report-content');
        html2pdf(element, {
            margin: 10,
            filename: 'Sales_Report.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        });
    }
</script>

</body>
</html>

<?php if (isset($db)) { $db->db_disconnect(); } ?>
