<?php

namespace tours;
use PDO; //PHP Data Objects

class Functions
{

    private $connection;
    //pripojenie do DB
    //konstruktor
    public function __construct($host = "localhost", $port = 3306, $username = "root", $pass = "", $db = "testovanie")
    {
        try {
            $this->connection = new PDO('mysql:charset=utf8;host=' . $host . ';dbname=' . $db . ";port=" . $port, $username, $pass);
        } catch (PDOException $exception) {
            echo "Chyba! Podrobnejsie: " . $exception->getMessage();
            die();
        }
    }

    public function getData($sql)
    {
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getItem($sql)
    {
        try {
            $sql = "$sql";
            $query = $this->connection->query($sql);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            return $data;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public function updateTours($id, $destination, $days, $transportation, $hotel_choice, $price, $image_url, $top)
    {
        $sql = "UPDATE destination 
                SET destination = '" . $destination . "', days = '" . $days . "', transportation = '" . $transportation . "', hotel_id = '" . $hotel_choice . "', price_per_day = '" . $price . "', img_path = '" . $image_url . "', top = '" . $top . "' 
                WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }

    }

    public function insertTour($destination, $days, $transportation, $hotel_choice, $price, $image_url, $top)
    {
        $sql = "INSERT  INTO destination (destination, days, transportation, hotel_id, price_per_day, img_path, top) 
                VALUE ( '" . $destination . "',  '" . $days . "',  '" . $transportation . "',  '" . $hotel_choice . "',  '" . $price . "',  '" . $image_url . "',  '" . $top . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function updateHotels($id, $hotel_name, $starts, $id_service)
    {
        $sql = "UPDATE hotels 
                SET hotel_name = '" . $hotel_name . "', starts = '" . $starts . "', id_service = '" . $id_service . "'
                WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }

    }

    public function addReview($name, $mail, $message, $datum)
    {
        $sql = "INSERT  INTO client_review (name,mail,message,datum) 
                VALUE ( '" . $name . "',  '" . $mail . "',  '" . $message . "',  '" . $datum . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }
	
	public function addHotel($hotel_name, $stars, $food_choice)
    {
        $sql = "INSERT  INTO hotels (hotel_name,starts,id_service) 
                VALUE ( '" . $hotel_name . "',  '" . $stars . "',  '" . $food_choice . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function addOffers($destination_choice, $discount, $description_text){
        $sql = "INSERT INTO offers (id_destination, discount, description) 
                VALUE ( '" . $destination_choice . "',  '" . $discount . "',  '" . $description_text . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function updateOffers($id, $destination_choice, $discount, $description){
        $sql = "UPDATE offers 
                SET id_destination = '" . $destination_choice . "', discount = '" . $discount . "', description = '" . $description . "'
                WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }
    }

	public function deleteItem($id, $table)
    {
        $sql = "DELETE FROM $table WHERE id = ".$id;
        $statement = $this->connection->prepare($sql);
        try {
            $delete = $statement->execute();
            return $delete;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function checkMD($data)
    {
        $data = (int)$data;
        if ($data > 0) {
            return $data;
        } else {
            return 4;
        }
    }

    public function starGenerator($n)
    {
        $output = "";
        for ($i = 0; $i < $n; $i++) {
            $output .= '<i class="fa fa-star"></i>';
        }
        return $output;
    }

    public function checker($value)
    {
        $value = (int)$value;
        if ($value == 1) {
            return "✅";
        } else {
            return "❌";
        }
    }
	
	public function divClassGenerator($list){
		foreach ($list as $item) {
			echo '<div class="' . $item . '">
			';
		}
	}
	
	public function divCloser($n){
	    for($i=0; $i<$n; $i++){
		echo "</div>
			";
		}
	}

}
?>