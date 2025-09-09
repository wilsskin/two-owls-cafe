<?php include 'header.php'; ?>

<?php
// Connect to database
$conn = new mysqli('localhost', 'uyclmikooocbz', '2002SKin', 'dbcmbmtpgso8ic');

// Check connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Grab menu items from database
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form - Two Owls Café</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            width: 90%;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .menu-item {
            display: flex;
            margin-bottom: 20px;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f4f4f4;
        }

        .menu-item img {
            width: 250px;
            height: 200px;
            object-fit: cover;
            margin-right: 40px;
            border-radius: 5px;
        }

        .menu-item .details {
            flex-grow: 1;
        }

        .menu-item .details h2 {
            margin: 0 0 10px;
        }

        .menu-item .details p {
            margin: 5px 0;
        }

        .menu-item .details select {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100px;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .user-details input,
        .user-details textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            max-width: 600px;
        }

        .user-details textarea {
            resize: none;
        }

        .confirmation { margin-top: 20px; 
            padding: 10px; 
            border: 1px solid green; 
            background: #e6f7e6; 
            text-align: center; display: none; }

    </style>
</head>
<body>
     <!-- Container to hold all content -->
    <div class="container">
        <h1>Two Owls Café Order Form!</h1>
        <!-- Form to display all item options -->
        <form id="orderForm" method="get" action="process_order.php">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <!-- Dispalay each menu item and associated details -->
                    <div class="menu-item">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="details">
                            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                            <label for="quantity_<?php echo $row['id']; ?>">Quantity:</label>
                            <select name="quantity_<?php echo $row['id']; ?>" id="quantity_<?php echo $row['id']; ?>">
                                <?php for ($i = 0; $i <= 10; $i++) { echo "<option value=\"$i\">$i</option>"; } ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No items available in the menu.</p>";
            }
            ?>
                        
    <!-- Area for user to enter order details -->
    <div class="user-details">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" required>
    
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" required>

    <label for="instructions">Special Instructions:</label>
    <textarea name="instructions" id="instructions" rows="3" placeholder="Enter any special instructions here..."></textarea>

    <input type="hidden" name="pickup_time" id="pickup_time">
</div>
<button type="button" id="submitOrder">Submit Order</button>

<script>
    // Ensure form was filled out correctly 
    document.getElementById('submitOrder').addEventListener('click', function () {
        let quantities = document.querySelectorAll('select[name^="quantity_"]');
        let totalItems = 0;

        // Ensure at least one item was entered
        quantities.forEach(q => totalItems += parseInt(q.value));
        if (totalItems === 0) {
            alert("Please order at least one item.");
            return;
        }

        // Ensure first and last name was entered 
        let firstName = document.getElementById('first_name').value.trim();
        let lastName = document.getElementById('last_name').value.trim();
        if (!firstName || !lastName) {
            alert("Please provide both your first and last name.");
            return;
        }

        // Calculate pickup time and set it in the hidden field
        let pickupField = document.getElementById('pickup_time');
        let now = new Date();
        now.setMinutes(now.getMinutes() + 20);
        pickupField.value = now.toTimeString().split(' ')[0];

        // Display order confirmation
        alert(`Order submitted successfully! Your pickup time is ${pickupField.value}.`);

        // Submit form 
        document.getElementById('orderForm').submit();
    });
</script>

</body>
</html>
