<?php

namespace tours;

class Hotels
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function updateHotel($id, $hotel_name, $stars, $id_service)
    {
        $sql = "UPDATE hotels 
                SET hotel_name = :hotel_name, stars = :stars, id_service = :id_service
                WHERE id = :id";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('hotel_name', 'stars', 'id_service', 'id'));
    }

    public function insertHotel($hotel_name, $stars, $food_choice)
    {
        $sql = "INSERT INTO hotels (hotel_name, stars, id_service) 
                VALUES (:hotel_name, :stars, :food_choice)";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('hotel_name', 'stars', 'food_choice'));
    }
}
?>
