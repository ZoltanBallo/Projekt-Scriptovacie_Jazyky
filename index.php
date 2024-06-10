<!-- PHP projekt: cestovná kancelária, Zoltán Bálló -->
<!DOCTYPE html>
<html class="no-js" lang="en">

<?php
include_once "parts/head.php";
include_once "Classes/database.php";
include_once "Classes/helpers.php";
include_once "Classes/hotel.php";
include_once "Classes/offer.php";
include_once "Classes/reviews.php";
include_once "Classes/tour.php";

use Classes\Database;
use Classes\Helpers;
use Classes\Hotel;
use Classes\Offer;
use Classes\Reviews;
use Classes\Tour;

$database = new Database();
$helpers = new Helpers();
$hotel = new Hotel();
$offer = new Offer();
$reviews = new Reviews();
$tour = new Tour();

$location = $database->getData("SELECT id, destination FROM destination order by destination asc");
$topDestinations = $database->getData("SELECT destination, col_md, img_path FROM destination where top=1");
include_once "parts/header.php";
?>

<body>
    <!--about-us start -->
    <section id="home" class="about-us">
        <div class="container about-us-content">
            <div class="row">
                <div class="col-sm-12 single-about-us about-us-txt">
                    <h2>Explore the Beauty of the Beautiful World</h2>
                    <div class="about-btn">
                        <button class="about-view">explore now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--travel-box start-->
    <section class="travel-box">
        <div class="container">
            <div id="desc-tabs" class="desc-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tours" aria-controls="tours" role="tab" data-toggle="tab">
                            <i class="fa fa-tree"></i>tours
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">
                            <i class="fa fa-building"></i>hotels (soon)
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fade in" id="tours">
                        <div class="tab-para row">
                            <div class="col-lg-4 col-md-4 col-sm-12 single-tab-select-box">
                                <h2>destination</h2>
                                <div class="travel-select-icon">
                                    <select class="form-control">
                                        <option value="default">enter your destination location</option>
                                        <?php
                                        foreach ($location as $item) {
                                            echo '<option value="' . $item["id"] . '">' . $item['destination'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-4 single-tab-select-box">
                                <h2>duration</h2>
                                <div class="travel-select-icon">
                                    <select class="form-control ">
                                        <?php
                                        $days = [2, 3, 5, 8, 10, 15];
                                        for ($i = 0; $i < count($days); $i++) {
                                            echo '<option value="' . $days[$i] . '">' . $days[$i] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-4 single-tab-select-box">
                                <h2>members</h2>
                                <div class="travel-select-icon">
                                    <select class="form-control ">
                                        <?php
                                        $members = [1, 2, 4, 8, 10];
                                        for ($i = 0; $i < count($members); $i++) {
                                            echo '<option value="' . $members[$i] . '">' . $members[$i] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-4 single-tab-select-box">
                                <h2>month</h2>
                                <div class="travel-select-icon">
                                    <select class="form-control ">
                                        <?php
                                        $months = ["march", "april", "may", "june", "jul", "august"];
                                        for ($i = 0; $i < count($months); $i++) {
                                            echo '<option value="' . ($i + 1) . '">' . $months[$i] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-sm-5">
                                <div class="travel-budget">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-4">
                                            <h3 style="padding-top:12px;">budget min</h3>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" placeholder="eur" style="border-radius: 0; height: 48px">
                                        </div>
                                    </div>
                                </div>
                                <div class="travel-budget">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-4">
                                            <h3 style="padding-top:12px;">budget max</h3>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" placeholder="eur" style="border-radius: 0; height: 48px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clo-sm-7 about-btn travel-mrt-0 pull-right">
                                <button class="about-view travel-btn">search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--service start-->
    <section id="service" class="service">
        <div class="container service-counter text-center">
            <?php
            $a = ['Choose amazing tour packages', 'book top class hotel', 'online flight booking'];
            $p = [
                'Must use our tour Planner for breathtaking tour packages!',
                'This amazing site helps you book the best hotels all around the world!',
                'Book your flight instantly using TourNest!'
            ];
            for ($i = 0; $i < 3; $i++) {
                echo '<div class="col-md-4 col-sm-4"><div class="single-service-box"><div class="service-img">';
                echo '<img src="assets/images/service/s' . ($i + 1) . '.png" alt="service-icon" />';
                echo '</div><div class="service-content"><h2><a href="#">' . $a[$i] . '</a></h2>';
                echo '<p>' . $p[$i] . '</p></div></div></div>';
            }
            ?>
        </div>
    </section>
    <!--service end-->
    <!--galley start-->
    <section id="gallery" class="gallery">
        <div class="container gallery-details gallary-header text-center">
            <h2>top destination</h2>
            <p>Where do you wanna go? How much you wanna explore?</p>
        </div>
        <?php
        $class = ["gallery-box", "gallery-content", "filtr-container", "row"];
        $helpers->divClassGenerator($class);
        foreach ($topDestinations as $item) {
            echo '<div class="col-md-' . $helpers->checkMD($item['col_md']) . '">';
            echo '<div class="filtr-item">';
            echo '<img src="' . $item['img_path'] . '" alt="portfolio image"/>';
            echo '<div class="item-title"><a href="#">';
            echo $item['destination'];
            echo '</a></div></div></div>';
        }
        ?>
    </section>
    <!--gallery end-->
    <?php
    include_once "parts/footer.php";
    include_once "parts/script.php";
    ?>
    <!-- footer-copyright end -->
</body>

</html>
