<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
// Check user permissions
page_require_level(3);
?>

<?php
if (isset($_POST['add_sale'])) {
    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);

    if (empty($errors)) {
        $p_id = $db->escape((int)$_POST['s_id']);
        $s_qty = $db->escape((int)$_POST['quantity']);
        $s_total = $db->escape($_POST['total']);
        $date = $db->escape($_POST['date']);
        $s_date = make_date();

        $sql = "INSERT INTO sales (product_id, qty, price, date) VALUES ('{$p_id}', '{$s_qty}', '{$s_total}', '{$s_date}')";

        if ($db->query($sql)) {
            update_product_qty($s_qty, $p_id);
            $session->msg('s', "Sale added.");
            redirect('add_sale.php', false);
        } else {
            $session->msg('d', 'Sorry, failed to add!');
            redirect('add_sale.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_sale.php', false);
    }
}
?>

<?php include_once('layouts/header.php'); ?>
<script>
$(document).ready(function() {
    // Handle "Find It" button click
    $("#sug-form").submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        let query = $("#sug_input").val();
        if (query.length > 0) {
            $.ajax({
                url: "ajax.php",
                method: "POST",
                data: { product_name: query },
                dataType: "json",
                success: function(data) {
                    $("#result").html(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        } else {
            $("#result").html("<li class='list-group-item'>Enter a product name</li>");
        }
    });

    // Function to fill product details on selection
    window.fill = function(productName) {
        $("#sug_input").val(productName); // Set selected product in input
        $("#result").html(""); // Clear suggestion list

        $.ajax({
            url: "ajax.php",
            method: "POST",
            data: { p_name: productName },
            dataType: "json",
            success: function(response) {
                $("#product_info").html(response); // Populate product table
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    };
});
</script>

<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
        <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Find It</button>
                    </span>
                    <input type="text" id="sug_input" class="form-control" name="title" placeholder="Search for product name">
                </div>
                <div id="result" class="list-group"></div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Sale Add</span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="add_sale.php">
                    <table class="table table-bordered">
                        <thead>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="product_info"></tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>
