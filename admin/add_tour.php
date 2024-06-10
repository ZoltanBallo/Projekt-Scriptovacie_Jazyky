<!doctype html>
<html class="no-js" lang="en">
<?php
include_once "../parts/head.php";
include_once "../Classes/database.php"; 

$pdo = getDatabaseConnection(); // Function to get DB connection from your db connection file

$hotels = [];
$query = "SELECT id, hotel_name FROM hotels";
$stmt = $pdo->prepare($query);
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add'])) {
    $destination = htmlspecialchars($_POST['destination']);
    $days = intval($_POST['days']);
    $transportation = intval($_POST['transportation']);
    $hotel_choice = intval($_POST['hotel_choice']);
    $price = floatval($_POST['price']);
    $image_url = filter_var($_POST['image_url'], FILTER_SANITIZE_URL);
    $top = intval($_POST['top']);

    $insertQuery = "INSERT INTO tours (destination, days, transportation, hotel_id, price_per_day, img_path, top) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $pdo->prepare($insertQuery);
    $insertSuccess = $insertStmt->execute([$destination, $days, $transportation, $hotel_choice, $price, $image_url, $top]);

    if ($insertSuccess) {
        header('Location: ../admin.php');
        exit();
    } else {
        header('Location: error.html');
        exit();
    }
}
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<style>
    body {
        background-image: url(../assets/images/admin_bg_31.jpg);
        background-repeat: repeat-y;
        background-position: center;
        background-size: cover;
    }

    #formular {
        font-size: 20px;
        color: black;
        background-color: hsla(0, 100%, 90%, 0.7);
        width: 50%;
        padding: 20px;
        border: 1px solid black;
        margin-top: 20px;
    }
</style>

<div style="display: flex; justify-content: center;">
    <div id="formular">
        <form action="add_tour.php" method="post">
            <div class="form-group">
                <label for="destination">Destination:</label>
                <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
            <div class="form-group">
                <label for="days">How many days?</label>
                <input type="number" class="form-control" id="days" name="days" required>
            </div>
            <div class="form-group">
                <b>Includes transportation</b><br>
                <input type="radio" id="yes" name="transportation" value="1" required>
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="transportation" value="0" required>
                <label for="no">No</label><br>
            </div>
            <div class="form-group">
                <label for="hotel">Which hotel?</label><br>
                <select class="form-control" name="hotel_choice" required>
                    <?php foreach ($hotels as $item): ?>
                        <option value="<?= $item['id'] ?>"><?= $item['hotel_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price/day in euros</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">URL for image (image path)</label>
                <input type="text" class="form-control" id="image" name="image_url" required>
            </div>
            <div class="form-group">
                <b>It is a top destination?</b><br>
                <input type="radio" id="yes2" name="top" value="1" required>
                <label for="yes2">Yes</label><br>
                <input type="radio" id="no2" name="top" value="0" required>
                <label for="no2">No</label><br>
            </div>
            <button type="submit" id="update" name="add" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
