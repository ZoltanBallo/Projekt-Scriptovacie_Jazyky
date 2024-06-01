<?php

    include_once "functions.php";

    use tours\Functions;

    $tours = new Functions();
    $menu = $tours->getData("SELECT path,name FROM menu");
    $popularDestinations = $tours->getData("SELECT destination FROM destination where top=1 limit 6");
?>

<footer class="footer-copyright">
    <?php
        $class = ["container", "footer-content", "row", "col-sm-3", "single-footer-item", "footer-logo"];
        $tours->divClassGenerator($class);
    ?>
    <a href="index.php">
        Bálló<span>Tour</span>
    </a>
    <p>
        best travel agency
    </p>
    <?php
        $tours->divCloser(3);
        $tours->divClassGenerator(["col-sm-3", "single-footer-item"]);
    ?>
    <h2>link</h2>
    <div class="single-footer-txt">
        <?php
            foreach ($menu as $item) {
                echo '<p><a href="' . $item['path'] . '">' . $item['name'] . '</a></p>';
            }
            $tours->divCloser(3);
            $tours->divClassGenerator(["col-sm-3", "single-footer-item"]);
        ?>
        <h2>popular destination</h2>
        <div class="single-footer-txt">
            <?php
                foreach ($popularDestinations as $item) {
                    echo '<p><a href="index.php#gallery">' . $item['destination'] . '</a></p>';
                }

                $tours->divCloser(3);
                $tours->divClassGenerator(["col-sm-3", "single-footer-item text-center"]);
            ?>
            <h2 class="text-left">contact</h2>
            <div class="single-footer-txt text-left">
                <?php
                    $text = ["Trieda Andreja Hlinku 603/1, 949 74", "Nitra, Slovakia", "+421 915 968 744"];
                    foreach ($text as $item) {
                        echo '<p>' . $item . '</p>';
                    }
                ?>
                <p class="foot-email"><a href="mailto:ballozoltan23@gmail.com">ballozoltan23@gmail.com</a></p>


                <?php
                    $tours->divCloser(5);
                ?>
                <hr>
                <div class="foot-icons ">
                    <ul class="footer-social-links list-inline list-unstyled">
                        <?php
                            $class = ['fa fa-facebook', 'fa fa-twitter', 'fa fa-instagram'];
                            $links = [
                                'https://www.facebook.com',
                                'https://www.twitter.com',
                                'https://www.instagram.com/'
                            ];
                            for ($i = 0; $i < 3; $i++) {
                                echo '<li><a href="' . $links[$i] . '" target="_blank" class="foot-icon-bg-' . ($i + 1) . '"><i class="' . $class[$i] . '"></i></a></li>';
                            }
                        ?>
                    </ul>
                    <p>&copy; 2024 <a href="mailto:ballozoltan23@gmail.com">Created by: Zoltán Bálló</a>.
                        All Right
                        Reserved</p>
                    <p><a href="admin.php">Manage the website</a></p>
                </div><!--/.foot-icons-->
                <div id="scroll-Top">
                    <i class="fa fa-angle-double-up return-to-top" id="scroll-top"
                       data-toggle="tooltip"
                       data-placement="top" title="" data-original-title="Back to Top"
                       aria-hidden="true"></i>
                    <?php
                        $tours->divCloser(3);
                    ?>
</footer><!-- /.footer-copyright-->