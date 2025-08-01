<?php
require_once 'C:/Hello/xampp/htdocs/InventorySystem_PHP/includes/load.php';


require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


// Get the current date
$today = date('Y-m-d');
$next_week = date('Y-m-d', strtotime('+7 days'));

// Fetch products expiring in the next 7 days
$sql = "SELECT name, expire_date FROM products WHERE expire_date BETWEEN '$today' AND '$next_week'";
$result = $db->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $db->error);
}

if ($result->num_rows > 0) {
    $productList = "";
    while ($row = $result->fetch_assoc()) {
        $productList .= "Product: " . htmlspecialchars($row['name']) . " | Expiry Date: " . $row['expire_date'] . "\n";
    }

    // Send email notification
    sendExpiryNotification($productList);
} 
// else {
//     sendExpiryNotification("No products are expiring within the next 7 days.");
// }


function sendExpiryNotification($productList) {
    $mail = new PHPMailer(true);
    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'acc@gmail.com'; // Change to your email
        $mail->Password = 'igfw pbgc zoqi ugod'; // Use App Password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Content
        $mail->setFrom('acc@gmail.com', 'Name');
        $mail->addAddress('acc@gmail.com', 'Admin'); // Change to admin's email
        $mail->Subject = 'Product Expiry Alert';
        $mail->Body = "The following products are expiring soon:\n\n" . $productList;

        $mail->send();
      
    } catch (Exception $e) {
        
    }
}
?>
