<?php
include 'header.php';

// Connect to database
$conn = new mysqli('localhost', 'uyclmikooocbz', '2002SKin', 'dbcmbmtpgso8ic');

// Check connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize order details
$orderItems = [];
$totalQuantity = 0;
$subtotal = 0; 

// Grab data from order page
foreach ($_GET as $key => $value) {
    if (strpos($key, 'quantity_') === 0 && intval($value) > 0) {
        // Use menu item ID to reference correct item ordered
        $menuItemId = str_replace('quantity_', '', $key);

        // Grab data order details 
        $stmt = $conn->prepare("SELECT * FROM menu WHERE id = ?");
        $stmt->bind_param("i", $menuItemId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $menuItem = $result->fetch_assoc();

            // Compile order summary
            $itemTotal = intval($value) * $menuItem['price'];
            $orderItems[] = [
                'name' => $menuItem['name'],
                'quantity' => intval($value),
                'price' => $menuItem['price'],
                'total' => $itemTotal
            ];
            $totalQuantity += intval($value);
            $subtotal += $itemTotal; 
        }
        $stmt->close();
    }
}

// Calculate tax and total
$tax = $subtotal * 0.0625; // Tax rate: 6.25%
$total = $subtotal + $tax;

// Grab user details from order page
$firstName = htmlspecialchars($_GET['first_name']);
$lastName = htmlspecialchars($_GET['last_name']);
$instructions = htmlspecialchars($_GET['instructions']);
$pickupTime = htmlspecialchars($_GET['pickup_time']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Two Owls Café</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1, h2, h3 {
            margin-bottom: 20px;
            color: #333;
        }
        .order-item {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .totals {
            font-weight: bold;
            margin-top: 20px;
            font-size: 22px;
        }
        .pickup-time, .special-notes {
            margin-top: 20px;
        }

        .menu-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        /* Remove order now button */
        .menu, .menu-item, .menu-header {
            display: none;
        }

    </style>
</head>
<body>

 <!-- Container to hold all content -->
<div class="container">
    <h1>Order Confirmation</h1>
    <p>Thank you, <?php echo $firstName . ' ' . $lastName; ?>, for your order!</p>
    <p>Your pickup time is: <strong><?php echo $pickupTime; ?></strong></p>

     <!-- Display user order -->
    <div class="order-summary">
        <h2>Order Summary:</h2>
        <?php if ($totalQuantity > 0): ?>
            <?php foreach ($orderItems as $item): ?>
                <div class="order-item">
                    <p><strong><?php echo $item['quantity'] . ' x ' . $item['name']; ?></strong></p>
                    <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                    <p>Total for item: $<?php echo number_format($item['total'], 2); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No items ordered.</p>
        <?php endif; ?>
    </div>

    <!-- Display user totals -->
    <div class="totals">
        <p>Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
        <p>Tax (6.25%): $<?php echo number_format($tax, 2); ?></p>
        <p>Total: $<?php echo number_format($total, 2); ?></p>
    </div>
        </br>

    <!-- Display pickup time and order notes -->
    <div class="pickup-time">
        <h3>Pickup Time:</h3>
        <p><?php echo htmlspecialchars($pickupTime); ?></p>
    </div>

    <div class="special-notes">
        <h3>Special Instructions:</h3>
        <p><?php echo htmlspecialchars($instructions ?: "None"); ?></p>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>
