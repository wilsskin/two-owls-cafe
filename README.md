# Two Owls Café – Online Ordering Platform

### Overview
Two Owls Café is a fictional café ordering site built for my CS 20 Web Programming course. 
The plaform serves as an online ordering system that integrates PHP for form processing and validation, JavaScript for client-side interactivity, and a MySQL database for storing and retrieving menu items.  

Customers browse menu items, place an order, and view a calculated summary with totals and pickup time. 

---

### Built With
- **PHP** – server-side scripting for form processing and dynamic page rendering  
- **MySQL** – database to store menu items (name, description, price, image filename) and, optionally, order history  
- **JavaScript** – form validation and dynamic pickup time calculation  
- **HTML/CSS** – layout, styling, and structure  
- **phpMyAdmin** – database management and screenshots  

---

### Core Features
- **Menu Integration**  
  Menu items are stored in a MySQL table with fields for name, description, price, and image filename. The PHP order form dynamically reads directly from the database.

- **Order Form**  
  Users can select quantities of menu items, enter their name, add special instructions, and submit orders. JavaScript ensures at least one item is ordered and both first and last names are provided.

- **Pickup Time Calculation**  
  JavaScript automatically calculates a pickup time 20 minutes after the order is placed and passes it into a hidden form field.

- **Order Processing**  
  On submission, `process_order.php` lists each item ordered with quantity, price, and subtotal. It then displays tax, final total, pickup time, and customer information.

- **Reusable Header**  
  A separate `header.php` file (with café name, hours of operation, and admin link) is included across pages.
