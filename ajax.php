<?php
require_once('includes/load.php');

if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
}

// Auto-suggestion for products
if (isset($_POST['product_name']) && strlen($_POST['product_name'])) {
    $products = find_product_by_title($_POST['product_name']);
    $html = '';

    if ($products) {
        foreach ($products as $product) {
            $html .= "<li class='list-group-item' onclick=\"fill('" . addslashes($product['name']) . "')\">";
            $html .= $product['name'];
            $html .= "</li>";
        }
    } else {
        $html .= "<li class='list-group-item'>No product found</li>";
    }

    // Send JSON response
    echo json_encode($html);
    exit();
}

// Fetch full product details
if (isset($_POST['p_name']) && strlen($_POST['p_name'])) {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    $html = '';

    if ($results = find_all_product_info_by_title($product_title)) {
        foreach ($results as $result) {
            $html .= "<tr>";
            $html .= "<td>" . $result['name'] . "</td>";
            $html .= "<input type='hidden' name='s_id' value='{$result['id']}'>";
            $html .= "<td><input type='text' class='form-control' name='price' value='{$result['price']}'></td>";
            $html .= "<td><input type='text' class='form-control' name='quantity' value='{$result['quantity']}'></td>";
            $totalPrice = $result['price'] * $result['quantity'];

            $html .= "<td><input type='text' class='form-control total' name='total' value='{$totalPrice}' readonly></td>";

            $html .= "<td><input type='date' class='form-control' name='date' value='" . date('Y-m-d') . "' required></td>";
            $html .= "<td><button type='submit' name='add_sale' class='btn btn-primary'>Add sale</button></td>";
            $html .= "</tr>";
        }
    } else {
        $html = '<tr><td colspan="6">Product not found</td></tr>';
    }

    // Send JSON response
    echo json_encode($html);
    exit();
}
?>