<!DOCTYPE html>
<html class="no-js" lang="en">

<?php
if (isset($_GET['message'])) {
    echo '          
<div class="alert">		  
	<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 			
	<strong>Success!</strong> Your review <i>' . $_GET['name'] . '</i> has been posted!			
</div>		  
';
}

date_default_timezone_set('Europe/Bratislava');
$date_time = date('Y-m-d H:i:s');

include_once "parts/head.php";
include_once "parts/header.php";
include_once "Classes/database.php";
include_once "Classes/helpers.php";
include_once "Classes/hotel.php";
include_once "Classes/offer.php";
include_once "Classes/reviews.php";
include_once "Classes/tour.php";

use tours\Functions;

$tours = new Functions();
$data = $tours->getData(
    "SELECT destination.destination, destination.days, destination.price_per_day, destination.img_path, destination.transportation, hotels.hotel_name, hotels.starts, food.type from destination inner join hotels on hotels.id=destination.hotel_id inner join food on food.id=hotels.id_service GROUP BY destination.destination;"
);
$reviews = $tours->getData("SELECT name, datum, message from client_review order by id desc;");
$skarede_slova = ["bullshit", "awful"];

if (isset($_POST['add_review'])) {
    if (in_array($_POST['message'], $skarede_slova)) {
        echo '<script>alert("Your comment does not comply with the guidelines");</script>';
    } else {
        $insert = $tours->addReview($_POST['name'], $_POST['mail'], $_POST['message'], $date_time);
        if ($insert) {
            $name = urlencode($_POST['name']);
            header("Location: tours.php?message=successful&name=$name");
        } else {
            header('Location: error.html');
        }
    }
}
?>

<body>

<section id="pack" class="packages">
    <?php
    $tours->divClassGenerator(["container", "gallary-header text-center"]); ?>
    <h2>packages</h2>
    <p>You can choose a beautiful trip from the following offer. <br>These are our basic packages. You can book a trip for more days if you wish on the MAIN page! 🏝</p>
    </div>
    <div class="packages-content">
        <div class="row">

            <?php
            foreach ($data as $item) {
                echo '	<div class="col-md-4 col-sm-6">
						<div class="single-package-item">
							<img style="height: 300px;" src="' . $item["img_path"] . '" alt="package-place">
						<div class="single-package-item-txt">
								<h3><b>' . $item["destination"] . '</b>
								<span class="pull-right">' . $item["price_per_day"] . '€/day</span></h3>
						<div class="packages-para">
								<p><span><i class="fa fa-angle-right"></i> ' . $item["days"] . ' days 📅 <br>>Total price: ' . (int)$item["days"] * (int)$item["price_per_day"] . ' euro</span></p>
						<div class="packages-review">
								<p>> ' . $tours->starGenerator($item["starts"]) . " - " . $item["starts"] . ' stars hotel</p>	
							 </div><!--/.packages-review-->
						<p><i class="fa fa-angle-right"></i> Hotel name: ' . $item["hotel_name"] . ' 🏨</p>
							  <p><span><i class="fa fa-angle-right"></i>  transportation ' . $tours->checker(
                        $item["transportation"]
                    ) . ' </span>
								<i class="fa fa-angle-right"></i>' . $item["type"] . ' 🍔</p>
							  </div><!--/.packages-para-->
						<div class="about-btn">
								<button class="about-view packages-btn">book now</button>
						';
                $tours->divCloser(4);
            }
            $tours->divCloser(3);
            ?>

        </div>
    </div>
</section><!--/.packages-->

<!-- testemonial Start -->
<section class="testemonial" id="comments">
    <?php
    $tours->divClassGenerator(["container", "gallary-header text-center"]); ?>

    <h2>clients reviews</h2>
    <p>You can read the opinions of our travellers.</p>

    </div><!--/.gallery-header-->

    <div class="owl-carousel owl-theme" id="testemonial-carousel">
        <?php
        foreach ($reviews as $item) {
            $tours->divClassGenerator(["home1-testm item", "home1-testm-single text-center", "home1-testm-img"]);

            echo '<img src="assets/images/anonym.png" alt="img"/>
		</div><!--/.home1-testm-img-->
		<div class="home1-testm-txt">
		<span class="icon section-icon">						
			<i class="fa fa-quote-left" aria-hidden="true"></i>						
		</span>																				
        <p>' . $item['message'] . '</p>
        <h3>
            <a href="#">
                ' . $item['name'] . '
            </a>
        </h3>
        <h4>' . $item['datum'] . '</h4>';
            $tours->divCloser(3);
        }
        ?>
    </div>
    <div class="gallary-header text-center">
        <h2 class="text-center" style="margin-bottom: 20px; margin-top: 80px">Tell us your opinion!</h2>
    </div>

    <form role="form" class="custom-centered" action="tours.php" method="post">

        <?php
        $label_for = ["firstname", "mail"];
        $label = ["Your name", "Your e-mail"];
        $name_id = ["name", "mail"];
        $placeholder = ["name", "enter your e-mail"];
        for ($i = 0; $i < 2; $i++) {
            echo '<div class="form-group text-center">';
            echo '<label for="' . $label_for[$i] . '">' . $label[$i] . '</label>';
            echo '<input type="text" name= "' . $name_id[$i] . '" class="form-control" id="' . $name_id[$i] . '"';
            echo 'placeholder="' . $placeholder[$i] . '" required></div>';
        }
        ?>

        <div class="form-group text-center">
            <label for="message">Your thoughts</label>
            <textarea class="form-control" name="message" id="message" rows="8" placeholder="short message..."
                      required></textarea>
        </div>

        <button type="submit" id="post" name="add_review" class="btn btn-primary custom-centered">Post</button>
    </form>

    </div><!--/.container-->
</section><!--/.testimonial-->
<!-- testemonial End -->
</body>

<?php
include_once "parts/footer.php";
include_once "parts/script.php";
?>

</html>
