<!doctype html>
<html class="no-js" lang="en">
<?php
include_once "../parts/head.php";
include_once "../Classes/database.php";

$pdo = getDatabaseConnection(); // Function to get DB connection from your db connection file

$food = [];
$query = "SELECT id, type FROM food";
$stmt = $pdo->prepare($query);
$stmt->execute();
$food = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $id = intval($_POST['id_number']);
    $hotel_name = htmlspecialchars($_POST['hotel_name']);
    $stars = intval($_POST['stars']);
    $food_choice = intval($_POST['food_choice']);

    $updateQuery = "UPDATE hotels SET hotel_name = ?, stars = ?, id_service = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateSuccess = $updateStmt->execute([$hotel_name, $stars, $food_choice, $id]);

    if ($updateSuccess) {
        header('Location: ../admin.php');
        exit();
    } else {
        header('Location: error.html');
        exit();
    }
}

if (isset($_POST['create'])) {
    $hotel_name = htmlspecialchars($_POST['hotel_name']);
    $stars = intval($_POST['stars']);
    $food_choice = intval($_POST['food_choice']);

    $addQuery = "INSERT INTO hotels (hotel_name, stars, id_service) VALUES (?, ?, ?)";
    $addStmt = $pdo->prepare($addQuery);
    $addSuccess = $addStmt->execute([$hotel_name, $stars, $food_choice]);

    if ($addSuccess) {
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
<body>

<div style="display: flex; justify-content: center;">
    <div id="formular">
        <?php if (isset($_GET['id'])):
            $id = intval($_GET['id']);
            $hotelQuery = "SELECT * FROM hotels WHERE id = ?";
            $hotelStmt = $pdo->prepare($hotelQuery);
            $hotelStmt->execute([$id]);
            $hotel = $hotelStmt->fetch(PDO::FETCH_ASSOC);

            if ($hotel): ?>
                <h3>Update Hotel</h3>
                <form action="update.php" method="post">
                    <input type="hidden" name="id_number" value="<?= $hotel['id'] ?>">
                    <div class="form-group">
                        <label for="hotel">Hotel name:</label>
                        <input type="text" class="form-control" id="hotel" name="hotel_name" value="<?= $hotel['hotel_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stars">Stars:</label>
                        <input type="number" class="form-control" id="stars" name="stars" value="<?= $hotel['stars'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="food">Food service:</label>
                        <select class="form-control" name="food_choice" required>
                            <?php foreach ($food as $item): ?>
                                <option value="<?= $item['id'] ?>" <?= $hotel['id_service'] == $item['id'] ? 'selected' : '' ?>><?= $item['type'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" id="update" name="update" class="btn btn-default">Submit</button>
                </form>
            <?php endif; ?>
        <?php else: ?>
            <h3>Create Hotel</h3>
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="hotel">Hotel name:</label>
                    <input type="text" class="form-control" id="hotel" name="hotel_name" required>
                </div>
                <div class="form-group">
                    <label for="stars">Stars:</label>
                    <input type="number" class="form-control" id="stars" name="stars" required>
                </div>
                <div class="form-group">
                    <label for="food">Food service:</label>
                    <select class="form-control" name="food_choice" required>
                        <?php foreach ($food as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['type'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" id="create" name="create" class="btn btn-default">Submit</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
