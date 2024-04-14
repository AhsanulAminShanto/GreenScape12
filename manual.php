<?php
// Include database configuration
include 'db_config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $soilType = $_POST["soil_type"];
    $light = $_POST["light"];
    $waterLevel = $_POST["water_level"];
    $maxLevelAvailable = $_POST["max_level_available"];
    $totalArea = $_POST["total_area"];
    $treeType = $_POST["tree_type"];
    $soilPH = $_POST["soil_ph"];
    $nutrients = $_POST["nutrients"];
    $maintenanceFrequency = $_POST["maintenance_frequency"];
    $alternative = $_POST["alternative"];
    $address = $_POST["address"];

    // Prepare and execute SQL query to insert data into table
    $sql = "INSERT INTO outdoor_info (soil_type, light, water_level, max_level_available, total_area, tree_type, soil_ph, nutrients, maintenance_frequency, alternative, address) VALUES ('$soilType', '$light', '$waterLevel', '$maxLevelAvailable', '$totalArea', '$treeType', '$soilPH', '$nutrients', '$maintenanceFrequency', '$alternative', '$address')";
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
        // Create an array with the form data
        $formData = array(
            'soil_type' => $soilType,
            'light' => $light,
            'water_level' => $waterLevel,
            'max_level_available' => $maxLevelAvailable,
            'total_area' => $totalArea,
            'tree_type' => $treeType,
            'soil_ph' => $soilPH,
            'nutrients' => $nutrients,
            'maintenance_frequency' => $maintenanceFrequency,
            'alternative' => $alternative,
            'address' => $address
        );
        
        // Convert array to JSON format
        $jsonData = json_encode($formData);
        
        // Write JSON data to file
        file_put_contents('ab.json', $jsonData);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outdoor Improvement - Manual Mode</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="indoor.php">Indoor Improvement</a></li>
        <li><a href="outdoor.php">Outdoor Improvement</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
    <h2>Outdoor Improvement - Manual Mode</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="soil_type">Soil Type:</label>
        <input type="text" id="soil_type" name="soil_type" required><br><br>
        
        <label for="light">Light:</label>
        <input type="text" id="light" name="light" required><br><br>
        
        <label for="water_level">Water Level:</label>
        <input type="text" id="water_level" name="water_level" required><br><br>
        
        <label for="max_level_available">Maximum Level Available:</label>
        <input type="text" id="max_level_available" name="max_level_available" required><br><br>
        
        <label for="total_area">Total Area:</label>
        <input type="text" id="total_area" name="total_area" required><br><br>
        
        <label for="tree_type">Tree Type:</label>
        <input type="text" id="tree_type" name="tree_type" required><br><br>
        
        <label for="soil_ph">Soil pH:</label>
        <input type="text" id="soil_ph" name="soil_ph" required><br><br>
        
        <label for="nutrients">Nutrients:</label>
        <input type="text" id="nutrients" name="nutrients" required><br><br>
        
        <label for="maintenance_frequency">Maintenance Frequency:</label>
        <input type="text" id="maintenance_frequency" name="maintenance_frequency" required><br><br>
        
        <label for="alternative">Alternative:</label>
        <input type="text" id="alternative" name="alternative" required><br><br>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
// Include database configuration
include 'db_config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $soilType = $_POST["soil_type"];
    $waterLevel = $_POST["water_level"];

    // Initialize an array to store matching results
    $matchingResults = array();

    // Prepare and execute SQL query to retrieve data from the local database
    $sql = "SELECT soil_type, water_level FROM outdoor_info WHERE soil_type = '$soilType' AND water_level = '$waterLevel'";
    $result = mysqli_query($conn, $sql);

    // Check if the SQL query was successful
    if ($result) {
        // Check if there are any matching rows
        if (mysqli_num_rows($result) > 0) {
            // Loop through the database results
            while ($row = mysqli_fetch_assoc($result)) {
                // Add the row to the matching results array
                $matchingResults[] = $row;
            }
        } else {
            echo "No matching rows found in the database.";
        }
    } else {
        // If there's an error with the SQL query, display the error message
        echo "Error: " . mysqli_error($conn);
    }

    // Display matching results
    // Display matching results
if (!empty($matchingResults)) {
    echo "<h2>Matching Results:</h2>";
    echo "<ul>";
    foreach ($matchingResults as $result) {
        echo "<li>";
        echo "<strong>Name:</strong> " . $result['name'] . "<br>";
        echo "<strong>Scientific Name:</strong> " . $result['scientific_name'] . "<br>";
        echo "<strong>Family:</strong> " . $result['family'] . "<br>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No matching results found.";
}

}
?>





