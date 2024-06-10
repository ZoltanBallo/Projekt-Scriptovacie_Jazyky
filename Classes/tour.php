<?php

namespace tours;

use \PDO;

class Tours
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function getTours()
    {
		$sql="SELECT * FROM tabla_neve";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTour($id)
    {
		$sql="SELECT * from tabla_neve where id=".$id;
        $query = $this->db->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTour($id, $destination, $days, $transportation, $hotel_choice, $price, $image_url, $top)
    {
        $sql = "UPDATE destination 
                SET destination = :destination, days = :days, transportation = :transportation, hotel_id = :hotel_choice, price_per_day = :price, img_path = :image_url, top = :top 
                WHERE id = :id";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('destination', 'days', 'transportation', 'hotel_choice', 'price', 'image_url', 'top', 'id'));
    }

    public function insertTour($destination, $days, $transportation, $hotel_choice, $price, $image_url, $top)
    {
        $sql = "INSERT INTO destination (destination, days, transportation, hotel_id, price_per_day, img_path, top) 
                VALUES (:destination, :days, :transportation, :hotel_choice, :price, :image_url, :top)";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('destination', 'days', 'transportation', 'hotel_choice', 'price', 'image_url', 'top'));
    }

    public function deleteTour($id)
    {
        $sql = "DELETE FROM destination WHERE id = :id";
        $statement = $this->db->prepare($sql);
        return $statement->execute(['id' => $id]);
    }
}
?>
