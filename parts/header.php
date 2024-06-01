<?php
    include_once "functions.php";
    use tours\Functions;

    $tours = new Functions();
    $menu = $tours->getData("SELECT path, name FROM menu");
?>
<!-- main-menu Start -->
<header class="top-area">
    <?php
        $class = ["header-area", "container", "row", "col-sm-2", "logo"];
        $tours->divClassGenerator($class);
    ?>

    <a href="index.php">Bálló<span>Tour</span></a>

    <?php
        $tours->divCloser(2);
        $class = ["col-sm-10", "main-menu", "navbar-header"];
        $tours->divClassGenerator($class);
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
            $tours->divCloser(4);
        ?>
        <div class="home-border">
        <?php
           $tours->divCloser(3);
        ?>
</header><!-- /.top-area-->