<!doctype html>
<html class="no-js" lang="en">
<?php
include_once "../parts/head.php";
include_once "../functions.php";

use tours\Functions;

$tours = new Functions();
$hotels = $tours->getData("SELECT id, hotel_name FROM hotels");


if (isset($_POST['add'])) {
    $insert = $tours->insertTour($_POST['destination'], $_POST['days'], $_POST['transportation'], $_POST['hotel_choice'], $_POST['price'], $_POST['image_url'], $_POST['top']);
    if ($insert) {
        header('Location: ../admin.php');
    } else {
        header('Location: error.html');
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
                <input type="text" class="form-control" id="destination" name="destination">
            </div>
            <div class="form-group">
                <label for="days">How many days?</label>
                <input type="text" class="form-control" id="days" name="days">
            </div>
            <div class="form-group">
                <b>Includes transportation</b><br>
                <input type="radio" id="yes" name="transportation" value="1">
                <label for="yes">Yes</label><br>
                <input type="radio" id="no" name="transportation" value="0">
                <label for="no">No</label><br>
            </div>
            <div class="form-group">
                <label for="hotel">Which hotel?</label><br>
                <select class="form-control" name="hotel_choice">
                    <?php
                    foreach ($hotels as $item) {
                            echo '<option value="' . $item["id"] . '">' . $item['hotel_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price/day in euros</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="image">URL for image (image path)</label>
                <input type="text" class="form-control" id="image" name="image_url">
            </div>
            <div class="form-group">
                <b>It is a top destination?</b><br>
                <input type="radio" id="yes2" name="top" value="1">
                <label for="yes2">Yes</label><br>
                <input type="radio" id="no2" name="top" value="0">
                <label for="no2">No</label><br>
            </div>
            <button type="submit" id="update" name="add" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
</body>
</html>