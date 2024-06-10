<!doctype html>
<html class="no-js" lang="en">
<?php
if (isset($_GET['what'])) {

	echo '<div class="alert">
         <span class="closebtn" onclick="window.location.href = \'admin.php\';">&times;</span>
        <strong>Success</strong>, '.$_GET['what'].' <i>'.$_GET['data'].' </i> has been deleted!
    </div>';
}

include_once "parts/head.php";
include_once "Classes/helpers.php";
include_once "Classes/tour.php";
use tours\Helpers;

$tours = new Helpers();
$destinations = $tours->getData("SELECT destination.id, destination.destination, destination.top, destination.days, destination.transportation, hotels.hotel_name as hotel, destination.price_per_day, SUBSTRING(destination.img_path, 1, 40) as img_path FROM destination inner join hotels on hotels.id=destination.hotel_id;");
$hotels = $tours->getData("SELECT hotels.id, hotels.hotel_name as hotel_name, hotels.starts as starts, food.type as food from hotels inner join food on hotels.id_service=food.id;");
$comments = $tours->getData("SELECT * from client_review;");
$discounts = $tours->getData("SELECT offers.id, destination.destination, destination.id as destid, offers.discount, SUBSTRING(offers.description, 1, 70) as description from offers inner join destination on id_destination=destination.id;");
?>
<style>
   body {
	  position: relative;
	}

	body::before {
	  content: "";
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  background-image: url(assets/images/admin_bg_31.jpg);
	  opacity: 0.71;
	  z-index: -1;
	  background-repeat: no-repeat;
	  background-size: cover;
	}

    h1 {
        font-size: 100px;
		padding-bottom: 20px;
    }

    a:hover, a:focus {
        text-decoration: none !important;
        outline: none !important;

    }

    .panel-group .panel {
        background-color: #fff;
        border: none;
        box-shadow: none;
        border-radius: 10px;
        margin-bottom: 11px;
    }

    .panel .panel-heading {
        padding: 0;
        border-radius: 10px;
        border: none;
    }

    .panel-heading a {
        color: #fff !important;
        display: block;
        border: none;
        padding: 20px 35px 20px;
        font-size: 20px;
        background-color: rgb(236, 87, 102);
        font-weight: 600;
        position: relative;
        color: #fff;
        box-shadow: none;
        transition: all 0.1s ease 0;
    }

    .panel-heading a:after, .panel-heading a.collapsed:after {
        content: "\f068";
        font-family: fontawesome;
        text-align: center;
        position: absolute;
        left: -20px;
        top: 10px;
        color: #fff;
        background-color: rgb(236, 87, 102);
        border: 5px solid #fff;
        font-size: 15px;
        width: 40px;
        height: 40px;
        line-height: 30px;
        border-radius: 50%;
        transition: all 0.3s ease 0s;
    }

    .panel-heading:hover a:after,
    .panel-heading:hover a.collapsed:after {
        transform: rotate(360deg);
    }

    .panel-heading a.collapsed:after {
        content: "\f067";
    }

    #accordion .panel-body {
        background-color: #Fff;
        color: #8C8C8C;
        line-height: 25px;
        padding: 10px 25px 20px 35px;
        border-top: none;
        font-size: 14px;
        position: relative;
    }

    .col-md-offset-3 {
        margin-left: 0%;
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
    }

    td, th {
        text-align: center;
    }

    .tooltip {
        position: relative;
        display: inline-block;
        font-size: 16px;
        color: blue;
        opacity: 1;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        top: 100%;
        left: 50%;
        margin-left: -60px;
    }

    .tooltip:hover .tooltiptext {
        font-size: 14px;
        visibility: visible;
    }

	.update-icon{
		background-image: url('https://cdn-icons-png.flaticon.com/512/6052/6052010.png');
		background-size: cover;
		width: 32px;
	    height: 32px;
	}
	
	.delete-icon{
		background-image: url('https://cdn-icons-png.flaticon.com/512/3687/3687412.png');
		background-size: cover;
		width: 32px;
	    height: 32px;
	}
</style>

<body>

<div style="text-align: right; margin-top: 30px; margin-right: 20px;">
<a href="index.php" style="font-size: 20px; background-color: hsla(0, 100%, 90%, 0.7)">Main page</a>
</div>


<h1 class="text-center pb-3">Page management</h1>


            <?php Helpers::divClassGenerator(["container","row","col-md-offset-3 col-md-6"]); ?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Edit tours
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne"
                         class="panel-collapse <?php if (isset($_GET['set']) && $_GET['set'] == "destination") {
                             echo "";
                         } else {
                             echo "collapse";
                         } ?> " role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <table class="table">
                                <tr style="background-color: rgba(255, 0, 0, 0.3);">
                                    <?php
                                    $name=["destination", "popular", "days", "transportation", "hotel", "price per day", "image"];
                                    foreach($name as $item){
                                        echo '<th>'.$item.'</th>';
                                    }
                                    ?>
                                    <th colspan="2">modification</th>
                                </tr>

                                <?php

                                foreach ($destinations as $item) {

                                    if ($item['top'] == 1) {
                                        $top = "yes";
                                    } else {
                                        $top = "no";
                                    }
                                    if ($item['transportation'] == 1) {
                                        $transp = "yes";
                                    } else {
                                        $transp = "no";
                                    }
                                    if (isset($_GET['place']) && $_GET['place'] == $item['destination']) {
                                        echo '<td>' . $item['destination'] . ' <div class="tooltip"> 🛈updated<span class="tooltiptext">You have successfully updated this row!</span></div></td>';
                                    } else {
                                        echo '<td> ' . $item['destination'] . ' </td>';
                                    }


                                  echo '
                                  <td> ' . $top . ' </td>
                                  <td> ' . $item['days'] . ' </td>
                                  <td> ' . $transp . ' </td>
                                  <td> ' . $item['hotel'] . ' </td>
                                  <td> ' . $item['price_per_day'] . '€ </td>
                                  <td> ' . $item['img_path'] . '... </td>
                                  <td> <a href="admin/update.php?id=' . $item['id'] . '"><div class="update-icon"></div></a> </td>
                                  <td> <a href="admin/delete.php?id=' . $item['id'] . '&what=destination&data=' . $item['destination'] . '" onclick="return confirm(\'Are you sure you want to delete destination ' . $item['destination'] . '?\');"><div class="delete-icon"></div></a> </td>
                                 </tr>';
                                }
                                ?>
                                <tr>
                                    <td style="background-color: rgba(255, 0, 0, 0.3);" colspan="9">
											<a href="admin/add_tour.php">➕add</a></td>      
                                </tr>
                            </table>
                        <?php  Helpers::divCloser(3); ?>


                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Edit hotels
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo"
                         class="panel-collapse <?php if (isset($_GET['set']) && $_GET['set'] == "hotels") {
                             echo "";
                         } else {
                             echo "collapse";
                         } ?>" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">

                            <table class="table">
                                <tr style="background-color: rgba(255, 0, 0, 0.3);">
                                    <?php
                                    $name=["hotel name", "stars (1-5)", "food"];
                                    foreach($name as $item){
                                        echo '<th>'.$item.'</th>';
                                    }
                                    ?>
                                    <th colspan="2">modification</th>
                                </tr>

                                <?php
                                foreach ($hotels as $item) {
                                    if (isset($_GET['hotel']) && $_GET['hotel'] == $item['hotel_name']) {
                                        echo '<td>' . $item['hotel_name'] . ' <div class="tooltip"> 🛈info<span class="tooltiptext">You have successfully updated or added this row!</span></div></td>';
                                    } else {
                                        echo '<td> ' . $item['hotel_name'] . ' </td>';
                                    }
                                    echo '
									  <td> ' . Helpers::starGenerator($item['starts']) . " " . $item['starts'] . " stars" . ' </td>
									  <td> ' . $item['food'] . ' </td>
									  <td> <a href="admin/update_hotels.php?id=' . $item['id'] . '"><div class="update-icon"></div></a> </td>
									  <td> <a href="admin/delete.php?id=' . $item['id'] . '&what=hotels&data=' . $item['hotel_name'] . '" onclick="return confirm(\'Are you sure you want to delete hotel ' . $item['hotel_name'] . '?\');"><div class="delete-icon"></div></a> </td>
									 </tr>';
                                }
                                ?>
                                <tr>
                                    <td style="background-color: rgba(255, 0, 0, 0.3);" colspan="9"><a href="admin/update_hotels.php">➕add</a>
                                    </td>
                                </tr>
                            </table>


                 <?php Helpers::divCloser(3); ?>
				
				
				<div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed last" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Add/edit discounts	
                                <span> </span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse <?php if (isset($_GET['set']) && $_GET['set'] == "offers") {
                        echo "";
                    } else {
                        echo "collapse";
                    } ?>" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            
							
							<table class="table">
                                <tr style="background-color: rgba(255, 0, 0, 0.3);">
                                    <?php
                                        $name=["destination", "discount", "text"];
                                        foreach($name as $item){
                                            echo '<th>'.$item.'</th>';
                                        }
                                    ?>
                                    <th colspan="2">modification</th>
                                </tr>

                                <?php
                                foreach ($discounts as $item) {
                                    if (isset($_GET['offer']) && $_GET['offer'] == $item['destid']) {
                                        echo '<td>' . $item['destination'] . ' <div class="tooltip"> 🛈info<span class="tooltiptext">You have successfully updated or added this row!</span></div></td>';
                                    } else {
                                        echo '<td> ' . $item['destination'] . ' </td>';
                                    }
                                    echo '
									  <td> ' . $item['discount'] . '% </td>
									  <td> ' . $item['description'] . '... </td>
									  <td> <a href="admin/update_offers.php?id=' . $item['id'] . '"><div class="update-icon"></div></a> </td>
									  <td> <a href="admin/delete.php?id=' . $item['id'] . '&what=offers&data=' . $item['destination'] . '" onclick="return confirm(\'Are you sure you want to delete discount ' . $item['destination']  . '?\');"><div class="delete-icon"></div></a> </td>
									 </tr>';
                                }
                                ?>
                                <tr>
                                    <td style="background-color: rgba(255, 0, 0, 0.3);" colspan="9"><a href="admin/update_offers.php">➕add</a>
                                    </td>
                                </tr>
                            </table>

							

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
