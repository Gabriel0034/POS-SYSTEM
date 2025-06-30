<?php
// reports.php
// Displays a list of available reports for the POS system.

include 'connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Reports</title></head>
<body>
<h2>Reports</h2>
<ul>
    <li><a href="daily_sales_report.php">Daily Sales Report</a></li>
    <li><a href="monthly_sales_report.php">Monthly Sales Report</a></li>
    <li><a href="yearly_sales_report.php">Yearly Sales Report</a></li>
    <li><a href="product_sales_report.php">Product Sales Report</a></li>
    <li><a href="category_sales_report.php">Category Sales Report</a></li>
    <li><a href="sales_by_user_report.php">Sales by User</a></li>
    <li><a href="sales_by_customer_report.php">Sales by Customer</a></li>
    <li><a href="profit_loss_report.php">Profit & Loss</a></li>
    <li><a href="inventory_value_report.php">Inventory Value</a></li>
    <li><a href="low_stock_report.php">Low Stock</a></li>
    <li><a href="top_selling_products.php">Top Selling Products</a></li>
</ul>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>