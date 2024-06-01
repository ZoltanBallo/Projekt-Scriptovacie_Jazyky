<!doctype html>
<html class="no-js" lang="en">
<?php
    include_once "../parts/head.php";
    include_once "../functions.php";

    use tours\Functions;

    $tours = new Functions();
    $food = $tours->getData("SELECT id, type from food;");
    $success_path = 'Location: ../admin.php?set=hotels&hotel=';
    $error_path = 'Location: error.html';

    if (isset($_POST['update'])) {
        $update = $tours->updateHotels(
            $_POST['id_number'],
            $_POST['hotel_name'],
            $_POST['stars'],
            $_POST['food_choice']
        );
        if ($update) {
            header($success_path . urlencode($_POST['hotel_name']));
        } else {
            header($error_path);
        }
    }

    if (isset($_POST['create'])) {
        $add = $tours->addHotel($_POST['hotel_name'], $_POST['stars'], $_POST['food_choice']);
        if ($add) {
            header($success_path . urlencode($_POST['hotel_name']));
        } else {
            header($error_path);
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
        <?php
            if (isset($_GET['id'])) {
                $data = $tours->getItem(
                    "SELECT id, hotel_name, starts, id_service from hotels where id='" . $_GET['id'] . "'"
                ); ?>
                <form action="update_hotels.php" method="post">
                    <?php
                        $label_for = ["hotel_name", "starts"];
                        $name = ["Hotel name:", "Stars (1-5)"];
                        $id_name = ["hotel_name", "stars"];
                        for ($i = 0; $i < 2; $i++) {
                            echo '<div class="form-group">';
                            echo '<label for="' . $label_for[$i] . '">' . $name[$i] . '</label>';
                            echo '<input type="text" class="form-control" id="' . $id_name[$i] . '" name="' . $id_name[$i] . '" value="' . $data[$label_for[$i]] . '">';
                            echo '</div>';
                        }
                    ?>

                    <div class="form-group">
                        <label for="food">Food</label><br>
                        <select class="form-control" name="food_choice">
                            <?php
                                foreach ($food as $item) {
                                    if ($item['id'] == $data['id_service']) {
                                        echo '<option value="' . $item["id"] . '" selected>' . $item['type'] . '</option>';
                                    } else {
                                        echo '<option value="' . $item["id"] . '">' . $item['type'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="id_number" value="<?php
                        echo $data['id']; ?>">
                    <button type="submit" id="update" name="update" class="btn btn-default">Submit</button>
                </form>

                <?php
            } else { ?>
                <form action="update_hotels.php" method="post">
                    <?php
                        $label_for = ["hotel_name", "starts"];
                        $name = ["Hotel name:", "Stars (1-5)"];
                        $id_name = ["hotel_name", "stars"];
                        for ($i = 0; $i < 2; $i++) {
                            echo '<div class="form-group">';
                            echo '<label for="' . $label_for[$i] . '">' . $name[$i] . '</label>';
                            echo '<input type="text" class="form-control" id="' . $id_name[$i] . '" name="' . $id_name[$i] . '" required>';
                            echo '</div>';
                        }
                    ?>

                    <div class="form-group">
                        <label for="food">Food</label><br>
                        <select class="form-control" name="food_choice">
                            <?php
                                foreach ($food as $item) {
                                    echo '<option value="' . $item["id"] . '">' . $item['type'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" id="create" name="create" class="btn btn-default">Submit</button>
                </form>
            <?php
            } ?>

        <?php
            $tours->divCloser(2); ?>
</body>
</html>