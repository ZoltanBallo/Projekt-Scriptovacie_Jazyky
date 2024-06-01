<head>
    <!-- META DATA -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>BalloTour</title>

    <?php
        $href = [
            "https://fonts.googleapis.com/css?family=Rufina:400,700",
            "https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900"
        ];

        foreach ($href as $item) {
            echo '<link href="' . $item . '" rel="stylesheet" />';
        }
    ?>

    <link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

    <?php
        $href = [
            "assets/css/font-awesome.min.css",
            "assets/css/animate.css",
            "assets/css/hover-min.css",
            "assets/css/datepicker.css",
            "assets/css/owl.carousel.min.css",
            "assets/css/owl.theme.default.min.css",
            "assets/css/jquery-ui.min.css",
            "assets/css/bootstrap.min.css",
            "assets/css/bootsnav.css",
            "assets/css/style.css",
            "assets/css/responsive.css"
        ];

        foreach ($href as $item) {
            echo '<link rel="stylesheet" href="' . $item . '" />
		';
        }
    ?>
</head>