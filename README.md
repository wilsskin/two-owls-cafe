# Two Owls Café – Online Ordering Platform

### Overview
Two Owls Café is a fictional ordering site built for my CS 20 Web Programming course. The project uses PHP and MySQL to build a dynamic menu and order system, with JavaScript handling form validation and pickup time calculations.

---

### What It Does
- **Stores menu items** in a MySQL database with name, description, price, and image filename  
- **Generates an order form** in PHP that dynamically loads menu items from the database  
- **Validates input and pickup time** with JavaScript to ensure correct orders and set a 20-minute pickup window  
- **Processes orders** in PHP to display quantities, prices, tax, totals, and customer details  

---

### Built With
- **PHP** – server-side scripting for form processing and dynamic page rendering  
- **MySQL** – database to store menu items and, optionally, order history  
- **JavaScript** – client-side validation and pickup time calculation  
- **HTML/CSS** – layout, styling, and structure  
- **phpMyAdmin** – database management and food images  

---

### Under the Hood
MySQL menu table </br>
<img width="514" height="346" alt="MySQL database" src="https://github.com/user-attachments/assets/eb7c3adf-52b5-4483-81a8-245fe104210c" />

This screenshot shows the `menu` table in MySQL, where I stored each café item’s name, description, price, and image filename for the order form.
