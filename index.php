<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="main.css">-->
    <link rel="stylesheet" href="https://classless.de/classless.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <select name="school"><option value="None" name="none" selected>None</option>
    <option value="acending" name="acending">Ascending</option>
    <option value="descending" name="descending">Descending</option>
    <option value="Date" name="date">Date</option>
    </select>
    <input type="submit" value="Filter">
    </form>
<?php
$sort = (isset($_POST['school'])) ? $_POST['school'] : "default_value";


$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "practice";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select data from the "products" table
switch ($sort) {
    case "None":
        $sql = "SELECT ProductCode,ProductName,ProductDate FROM products ORDER BY ProductCode ASC";
        break;
    case "ascending":
        $sql = "SELECT ProductCode,ProductName,ProductDate FROM products ORDER BY ProductName ASC";
        break;
    case "descending":
        $sql = "SELECT ProductCode,ProductName,ProductDate FROM products ORDER BY ProductName DESC";
        break;
    case "Date":
        $sql = "SELECT ProductCode,ProductName,ProductDate FROM products ORDER BY ProductDate ASC";
        break;
    default:
        $sql = "SELECT ProductCode,ProductName,ProductDate FROM products";
}
$result = mysqli_query($conn, $sql);



// Check if the query was successful
if (mysqli_num_rows($result) >= 0) {
    echo "<table id='procuct-table'><tr><th>ProductCode</th><th>ProductName</th><th>ProductDate</th><th>";
    // Output data for each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["ProductCode"]. "</td><td>" . $row["ProductName"]. "</td><td>" . $row["ProductDate"]. "</td><td>" ;
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
mysqli_close($conn);


?>
</body>
</html>