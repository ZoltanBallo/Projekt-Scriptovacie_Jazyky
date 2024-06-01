<!doctype html>
<html class="no-js" lang="en">

<?php
    include_once "parts/head.php";
    include_once "parts/header.php";
    include_once "functions.php";

    use tours\Functions;

    $tours = new Functions();
    $data = $tours->getData(
        "SELECT offers.discount, offers.description as text, destination.destination, destination.img_path , destination.days, destination.price_per_day, destination.transportation, hotels.starts, food.type from offers inner join destination on destination.id=offers.id_destination inner join hotels on destination.hotel_id=hotels.id inner join food on food.id=hotels.id_service;;"
    );
?>

<body>

<section id="blog" class="blog">
    <?php
        $tours->divClassGenerator(["container mb-5", "blog-details", "gallary-header text-center"]); ?>
    <h2>
        Special offers
    </h2>
    <p>
        Here you can find discounted holidays
    </p>
    <?php
        $tours->divCloser(3); ?>
</section>
<?php
    foreach ($data as $item) {
        echo '<section id="spo" class="mt-5 special-offer"  style="background: url(\'' . $item["img_path"] . '\') center; background-repeat: no-repeat; background-size: cover;">';
        $tours->divClassGenerator(
            [
                "container",
                "special-offer-content",
                "row",
                "col-sm-8",
                "single-special-offer",
                "single-special-offer-txt"
            ]
        );
        echo '		<h2>' . $item['destination'] . '</h2>				
					<div class="packages-review special-offer-review" style="">				
						<p>';
        echo $tours->starGenerator($item["starts"]);
        echo '</p>				
					</div><!--/.packages-review-->				
					<div class="packages-para special-offer-para">				
						<p>';
        $display = [$item["days"], $item["starts"], $tours->checker($item["transportation"]), $item["type"]];
        $text_to_data = ["days", "stars", "transportation", "food type"];
        $index = 0;
        for ($i = 0; $i < 2; $i++) {
            echo "<p>";
            for ($j = 0; $j < 2; $j++) {
                echo '<span><i class="fa fa-angle-right"></i>';
                echo $text_to_data[$index] . ": " . $display[$index];
                echo '</span>';
                $index++;
            }
            echo "</p>";
        }
        echo '			
			  <p class="offer-para" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size: 20px; font-weight: bolder; margin-right: 20px;">				
				' . $item['text'] . '					
			  </p>				
			  </div><!--/.packages-para-->				
			  </div><!--/.about-btn-->				
			 ';

        $tours->divCloser(2);
        $tours->divClassGenerator(["col-sm-4", "single-special-offer", "single-special-offer-bg"]);

        echo '				
        <img src="assets/images/offer/offer-shape.png" alt="offer-shape">				
        </div>				
        <div class="single-special-shape-txt">				
            <h3>special offer</h3>				
            <h4><span>' . $item['discount'] . '%</span><br>off</h4>				
            <p><span>' . ($item['price_per_day'] * $item['days']) - ($item['discount'] / 100) * ($item['price_per_day'] * $item['days']) . '€</span><br>Regular price ' . $item['price_per_day'] * $item['days'] . ' euro</p>' . "" . '<hr>				
        </section>				
        <hr>';
    }
?>

</body>
<?php
    include_once "parts/footer.php";
    include_once "parts/script.php";
?>
</html>