<?php
    $src_content = [
        "assets/js/jquery.js",
        "https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js",
        "assets/js/bootstrap.min.js",
        "assets/js/bootsnav.js",
        "assets/js/jquery.filterizr.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js",
        "assets/js/jquery-ui.min.js",
        "assets/js/jquery.counterup.min.js",
        "assets/js/waypoints.min.js",
        "assets/js/owl.carousel.min.js",
        "assets/js/jquery.sticky.js",
        "assets/js/datepicker.js",
        "assets/js/custom.js"
    ];

    foreach ($src_content as $item) {
        echo '<script src="' . $item . '"></script>
      ';
    }
?>

