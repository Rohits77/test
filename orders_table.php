<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Details</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>

<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT o.orderid, o.phonenum, o.tablenum,o.order_datetime, GROUP_CONCAT(f.foodname) AS foodnames, SUM(f.price) AS totalprice
FROM orders o
JOIN orderitems oi ON o.orderid = oi.orderid
JOIN fooditems f ON oi.foodid = f.foodid
GROUP BY o.orderid;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Order ID</th><th>Phone Number</th><th>Table Number</th><th>Date & time</th>  <th>Food Items Ordered</th><th>Total Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["orderid"]."</td>";
        echo "<td>".$row["phonenum"]."</td>";
        echo "<td>".$row["tablenum"]."</td>  ";
        echo "<td>".$row["order_datetime"]."</td>";
        echo "<td>".$row["foodnames"]."</td>";
        echo "<td>".$row["totalprice"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
