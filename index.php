<?php
$host = 'localhost';
$dbname = 'test_db';
$user = 'root';
$pass = '';


$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['insert'])) {
    $value = $_POST['insert_value'];
    $stmt = $conn->query("INSERT INTO your_table (value_column) VALUES ('$value')");
    echo "Value inserted successfully!";
}

if (isset($_POST['update'])) {
    $id = $_POST['update_id'];
    $newValue = $_POST['update_value'];
    $stmt = $conn->query("UPDATE your_table SET value_column = '$newValue' WHERE id = '$id'");
    echo "Value updated successfully!";
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->query("DELETE FROM your_table WHERE id = '$id'");
    echo "Value deleted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Records</title>
</head>
<body>
    <h1>Record List</h1>
    <table >
        <tr>
            <th>ID</th>
            <th>Value</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM your_table");
        while ($row = $stmt->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['value_column']}</td>
            </tr>";
        }
        ?>
    </table>
    <hr>

    <!-- Insert Form -->
    <form method="POST">
        <label for="insert_value">Insert Value:</label>
        <input type="text" name="insert_value" required>
        <button type="submit" name="insert">Insert</button>
    </form>
    <hr>

    <!-- Update Form -->
    <form method="POST">
        <label for="update_id">ID to Update:</label>
        <input type="number" name="update_id" required>
        <label for="update_value">New Value:</label>
        <input type="text" name="update_value" required>
        <button type="submit" name="update">Update</button>
    </form>
    <hr>

    <!-- Delete Form -->
    <form method="POST">
        <label for="delete_id">ID to Delete:</label>
        <input type="number" name="delete_id" required>
        <button type="submit" name="delete">Delete</button>
    </form>
</body>
</html>
