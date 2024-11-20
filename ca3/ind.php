<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'travel_planner';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];

    $query = "SELECT * FROM flights WHERE source='$source' AND destination='$destination' AND DATE(departure_time)='$date'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Available Flights</h2><ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Flight: {$row['airline']} - ₹{$row['price']} </li>";
        }
        echo "</ul>";
    } else {
        echo "No flights found.";
    }
}
?>

<?php
$location = $_GET['location'];

$query = "SELECT * FROM attractions WHERE location='$location'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h2>Top Attractions</h2><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$row['name']} - {$row['description']}</li>";
    }
    echo "</ul>";
} else {
    echo "No attractions found.";
}
?>
