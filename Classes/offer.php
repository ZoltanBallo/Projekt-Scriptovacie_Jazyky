<?php

namespace tours;

class Offers
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function addOffer($destination_choice, $discount, $description_text)
    {
        $sql = "INSERT INTO offers (id_destination, discount, description) 
                VALUES (:destination_choice, :discount, :description_text)";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('destination_choice', 'discount', 'description_text'));
    }

    public function updateOffer($id, $destination_choice, $discount, $description)
    {
        $sql = "UPDATE offers 
                SET id_destination = :destination_choice, discount = :discount, description = :description
                WHERE id = :id";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('destination_choice', 'discount', 'description', 'id'));
    }
}
?>
