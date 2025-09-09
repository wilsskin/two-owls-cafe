<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Ensures header is at top of the screen */
        body, html {
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px; 
            background-color: #f7e7ce; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #ddd;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 50px;
            margin-right: 15px;
        }

        .logo h1 {
            font-size: 24px;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        /* Center align order button */
        .menu-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .menu {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-right: 60px;
        }

        .menu-item {
            font-size: 20px;
            font-family: 'Arial', sans-serif;
            cursor: pointer;
            border: 2px solid black; 
            border-radius: 8px;
            padding: 5px 10px;
        }

        .menu-header {
            padding-top: 20px;
        }

        .hours {
            font-size: 14px;
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body>
    <header>
        <!-- Logo on the left -->
        <div class="logo">
            <img src="logo.jpg" alt="Two Owls Café Logo">
            <h1>Two Owls Café</h1>
        </div>

        <!-- Order now in the center -->
        <div class="menu-container">
            <div class="menu">
            <div class="menu-header">
                <div class="menu-item order-now">Order Now</div>
            </div>
            </div>
        </div>

        <!-- Hours on the right -->
        <div class="hours">
            <p>Hours: 11am - 10pm</p>
        </div>
    </header>
</body>
</html>
