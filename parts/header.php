<?php
    include_once "Classes/database.php";
    include_once "Classes/helpers.php";
    include_once "Classes/tour.php";

    use tours\Database;
    use tours\Helpers;
    use tours\Tour;

    $tours = new Tour();

    $menuQuery = "SELECT path, name FROM menu";
    $menuResult = Database::getData($menuQuery);
    $menu = $menuResult->fetch_all(MYSQLI_ASSOC);

?>
<!-- main-menu Start -->
<header class="top-area">
    <?php
        $class = ["header-area", "container", "row", "col-sm-2", "logo"];
        Helpers::divClassGenerator($class);
    ?>

    <a href="index.php">Bálló<span>Tour</span></a>

    <?php
        Helpers::divCloser(2);
        $class = ["col-sm-10", "main-menu", "navbar-header"];
        Helpers::divClassGenerator($class);
    ?>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <i class="fa fa-bars"></i>
    </button><!-- / button-->
    </div><!-- /.navbar-header-->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <?php
                foreach ($menu as $item) {
                    echo '<li class="smooth-menu"><a href="' . $item["path"] . '">' . $item["name"] . '</a></li>';
                }
            ?>
            <li>
                <button class="book-btn"><a href="index.php" class="booknow">book now</a></button>
            </li>
        </ul>
        <?php
            Helpers::divCloser(4);
        ?>
        <div class="home-border">
        <?php
           Helpers::divCloser(3);
        ?>
</header><!-- /.top-area-->
