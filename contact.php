<?php
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$message = $_POST['message'];

$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $st = $conn->prepare("INSERT INTO contact (name, number, email, message) VALUES (?, ?, ?, ?)");
    $st->bind_param("ssss", $name, $number, $email, $message);
    $st->execute();
    $st->close();
    $conn->close();
    $confirmationMessage = "Thank you for contacting us!";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            margin-top: 50px;
        }
        .message {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .button {
            background-color: #008CBA;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #005f7b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <?php echo $confirmationMessage; ?>
        </div>
        <button class="button" onclick="window.location.href = 'index.html';">Back to Home</button>
    </div>
</body>
</html>
