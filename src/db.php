<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tenniscollection";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$sql = "SELECT * FROM tennisitems";
// $sql = "SELECT * FROM tracks";
// $sql = "SELECT * FROM tracks WHERE id = '2'";
// $sql = "SELECT * FROM tracks WHERE user_id = '2'";
$result = $conn->query($sql);

$rows = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows);

echo "<hr>";
$areColumnsSet = false;

foreach ($rows as $index => $row) {
    if (!$areColumnsSet) {
        echo "<div class='tennisitems-cont'>";
        foreach ($row as $colname => $cell) {
            echo "<span class='col-fields'>$colname</span>";
        }
        echo "</div>";
        $areColumnsSet = true;
    }

    echo "<div class='tennisitems-cont'>";
    echo "Row: $index";
    // print_r($row);
    foreach ($row as $colname => $cell) {
        echo "<span class='tennisitems-cell'>$cell</span>";
    }
    echo "</div>";
}

// if ($result->num_rows > 0) {
//     // output data of each row
//     while ($row = $result->fetch_assoc()) {
//         echo "<div class='tracks-cont'>";
//         echo "<span class='track-cell'>id: " . $row["id"] . "</span>";
//         echo "<span class='track-cell'>name: " . $row["name"] . "</span>";
//         echo "<span class='track-cell'>album: " . $row["album"] . "</span>";
//         echo "</div>";
//     }
// } else {
//     echo "0 results";
// }
$conn->close();