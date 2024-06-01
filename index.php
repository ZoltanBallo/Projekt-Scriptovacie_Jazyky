<!-- PHP projekt: cestovná kancelária, Zoltán Bálló -->
<!doctype html>
<html class="no-js" lang="en">

<?php
    include_once "parts/head.php";
    include_once "functions.php";

    use tours\Functions;

    $tours = new Functions();
    $location = $tours->getData("SELECT id, destination FROM destination order by destination asc");
    $topDestinations = $tours->getData("SELECT destination, col_md, img_path FROM destination where top=1");
    include_once "parts/header.php";
?>

<body>
<!--about-us start -->
<section id="home" class="about-us">
    <?php
        $class = ["container", "about-us-content", "row", "col-sm-12", "single-about-us", "about-us-txt"];
        $tours->divClassGenerator($class);
    ?>
    <h2>
        Explore the Beauty of the Beautiful World

    </h2>
    <div class="about-btn">
        <button class="about-view">
            explore now
        </button>
        <?php
            $tours->divCloser(4);
            $tours->divClassGenerator(["col-sm-0", "single-about-us"]);
            $tours->divCloser(5);
        ?>

</section>
<!--travel-box start-->
<section class="travel-box">
    <?php
        $tours->divClassGenerator(["container", "row", "col-md-12", "single-travel-boxes"]);
    ?>

    <div id="desc-tabs" class="desc-tabs">
        <ul class="nav nav-tabs" role="tablist">
            <?php
                $class = ["active", ""];
                $href = ["#tours", "#hotels"];
                $text = ["tours", "hotels (soon)"];
                $picture = ["fa fa-tree", "fa fa-building"];
                for ($i = 0; $i < 2; $i++) {
                    echo '<li role="presentation" class="' . $class[$i] . '">';
                    echo '<a href="' . $href[$i] . '" aria-controls="' . substr(
                            $href[$i],
                            1
                        ) . '" role="tab" data-toggle="tab">';
                    echo '<i class="' . $picture[$i] . '"></i>';
                    echo $text[$i];
                    echo '</a>';
                    echo '</li>';
                }

            ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="tours">
                <?php
                    $tours->divClassGenerator(
                        ["tab-para", "row", "col-lg-4 col-md-4 col-sm-12", "single-tab-select-box"]
                    );
                ?>

                <h2>destination</h2>

                <div class="travel-select-icon">
                    <select class="form-control">
                        <option value="default">enter your destination location</option>
                        <!-- /.option-->
                        <?php
                            foreach ($location as $item) {
                                echo '<option value="' . $item["id"] . '">' . $item['destination'] . '</option>';
                            }
                        ?>
                    </select><!-- /.select-->
                    <?php
                        $tours->divCloser(3);
                        $tours->divClassGenerator(["col-lg-2 col-md-1 col-sm-4", "single-tab-select-box"]);
                    ?>

                    <h2>duration</h2>
                    <div class="travel-select-icon">
                        <select class="form-control ">
                            <?php
                                $days = [2, 3, 5, 8, 10, 15];

                                for ($i = 0; $i < count($days); $i++) {
                                    echo '<option value="' . $days[$i] . '">' . $days[$i] . '</option>';
                                }

                            ?>

                        </select><!-- /.select-->
                        <?php
                            $tours->divCloser(3);
                            $tours->divClassGenerator(["col-lg-2 col-md-1 col-sm-4", "single-tab-select-box"]);
                        ?>
                        <h2>members</h2>
                        <div class="travel-select-icon">
                            <select class="form-control ">
                                <?php
                                    $members = [1, 2, 4, 8, 10];

                                    for ($i = 0; $i < count($members); $i++) {
                                        echo '<option value="' . $members[$i] . '">' . $members[$i] . '</option>';
                                    }

                                ?>

                            </select><!-- /.select-->
                            <?php
                                $tours->divCloser(3);
                                $tours->divClassGenerator(["col-lg-2 col-md-1 col-sm-4", "single-tab-select-box"]);
                            ?>
                            <h2>month</h2>
                            <div class="travel-select-icon">
                                <select class="form-control ">
                                    <?php
                                        $months = ["march", "april", "may", "june", "jul", "august"];

                                        for ($i = 0; $i < count($months); $i++) {
                                            echo '<option value="' . ($i + 1) . '">' . $months[$i] . '</option>';
                                        }

                                    ?>
                                </select><!-- /.select-->

                                <?php
                                    $tours->divCloser(4);
                                    $heading = ["budget min", "budget max"];
                                    for ($i = 0; $i < 2; $i++) {
                                        echo '<div class="travel-budget">
															<div class="row">
															<div class="col-md-2 col-sm-4">';
                                        echo '<h3 style="padding-top:12px;">' . $heading[$i] . '</h3></div>';
                                        echo '<div class="col-sm-2"> 
																<input type="text" class="form-control" placeholder="eur" style="border-radius: 0; height: 48px">
																</div><!--/.col-->
																</div><!--/.row-->
															</div><!--/.travel-budget-->';
                                    }
                                    $tours->divClassGenerator(["row", "col-sm-5"]);
                                    $tours->divCloser(1);
                                    $tours->divClassGenerator(["clo-sm-7", "about-btn travel-mrt-0 pull-right"]);
                                ?>

                                <button class="about-view travel-btn">
                                    search
                                </button><!--/.travel-btn-->
                                <?php
                                    $tours->divCloser(11);
                                ?>

</section><!--/.travel-box-->
<!--travel-box end-->

<!--service start-->
<section id="service" class="service">
    <?php
        $tours->divClassGenerator(["container", "service-counter text-center"]);
        $a = ['Choose amazing tour packages', 'book top class hotel', 'online flight booking'];
        $p = [
            'Must use our tour Planner for breathtaking tour packages!',
            'This amazing site helps you book the best hotels all around the world!',
            'Book your flight instantly using TourNest!'
        ];
        for ($i = 0; $i < 3; $i++) {
            echo '<div class="col-md-4 col-sm-4"><div class="single-service-box"><div class="service-img">';
            echo '<img src="assets/images/service/s' . $i + 1 . '.png" alt="service-icon" />';
            echo '</div><!--/.service-img--><div class="service-content"><h2><a href="#">' . $a[$i] . '</a></h2>';
            echo '<p>' . $p[$i] . '</p></div></div></div>';
        }
        $tours->divCloser(2);
    ?>

</section><!--/.service-->
<!--service end-->
<!--galley start-->
<section id="gallery" class="gallery">
    <?php
        $class = ["container", "gallery-details", "gallary-header text-center"];
        $tours->divClassGenerator($class);
    ?>
    <h2>
        top destination
    </h2>
    <p>
        Where do you wanna go? How much you wanna explore?
    </p>
    </div><!--/.gallery-header-->
    <?php
        $class = ["gallery-box", "gallery-content", "filtr-container", "row"];
        $tours->divClassGenerator($class);

        foreach ($topDestinations as $item) {
            echo '<div class="col-md-' . $tours->checkMD($item['col_md']) . '">';
            echo '<div class="filtr-item">';
            echo '<img src="' . $item['img_path'] . '" alt="portfolio image"/>';
            echo '<div class="item-title"><a href="#">';
            echo $item['destination'];
            echo '</a></div><!-- /.item-title --></div><!-- /.filtr-item --></div><!-- /.col -->';
        }
        $tours->divCloser(6);
    ?>

</section><!--/.gallery-->
<!--gallery end-->

<?php
    include_once "parts/footer.php";
    include_once "parts/script.php";
?>
<!-- footer-copyright end -->
</body>

</html>