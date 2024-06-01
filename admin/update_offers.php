<!doctype html>
<html class="no-js" lang="en">
<?php
    include_once "../parts/head.php";
    include_once "../functions.php";

    use tours\Functions;

    $tours = new Functions();
    $success_path = 'Location: ../admin.php?set=offers&offer=';
    $error_path = 'Location: error.html';

    $destination = $tours->getData("SELECT id, destination from destination;");

    if (isset($_POST['update'])) {
        $update = $tours->updateOffers(
            $_POST['id_number'],
            $_POST['destination_choice'],
            $_POST['discount'],
            $_POST['description_text']
        );
        if ($update) {
            header($success_path . urlencode($_POST['destination_choice']));
        } else {
            header($error_path);
        }
    }

    if (isset($_POST['create'])) {
        $add = $tours->addOffers(
            $_POST['destination_choice'],
            $_POST['discount'],
            $_POST['dsc']
        );
        if ($add) {
            header($success_path . urlencode($_POST['destination_choice']));
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
                    "SELECT offers.id, offers.id_destination, offers.discount, offers.description from offers where offers.id='" . $_GET['id'] . "'"
                ); ?>
                <form action="update_offers.php" method="post">
                    <div class="form-group">
                        <label for="destination_choice">Destination</label><br>
                        <select class="form-control" name="destination_choice">
                            <?php
                                foreach ($destination as $item) {
                                    if ($data['id_destination'] == $item['id']) {
                                        echo '<option value="' . $item["id"] . '" selected>' . $item["destination"] . '</option>';
                                    } else {
                                        echo '<option value="' . $item["id"] . '">' . $item["destination"] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount (in %)</label>
                        <input type="text" class="form-control" id="discount" name="discount" value="<?php
                            echo $data['discount'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description about the city</label>
                        <textarea class="form-control" name="description_text" id="description_text" rows="8"><?php
                                echo $data['description'] ?></textarea>
                    </div>

                    <input type="hidden" name="id_number" value="<?php
                        echo $data['id']; ?>">
                    <button type="submit" id="update" name="update" class="btn btn-default">Submit</button>
                </form>

                <?php
            } else { ?>
                <form action="update_offers.php" method="post">
                    <div class="form-group">
                        <label for="destination_choice">Destination</label><br>
                        <select class="form-control" name="destination_choice">
                            <?php
                                foreach ($destination as $item) {
                                    echo '<option value="' . $item["id"] . '" >' . $item["destination"] . '</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount (in %)</label>
                        <input type="text" class="form-control" name="discount" id="discount" required>
                    </div>

                    <div class="form-group">
                        <label for="dsc">Description about the city</label>
                        <textarea class="form-control" name="dsc" id="dsc" rows="8"></textarea>
                    </div>

                    <button type="submit" id="update" name="create" class="btn btn-default">Submit</button>
                </form>
                <?php
            } ?>

        <?php
            $tours->divCloser(2); ?>
</body>
</html>