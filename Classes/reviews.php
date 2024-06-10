<?php

namespace tours;

class Reviews
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function addReview($name, $mail, $message, $datum)
    {
        $sql = "INSERT INTO client_review (name, mail, message, datum) 
                VALUES (:name, :mail, :message, :datum)";
        $statement = $this->db->prepare($sql);
        return $statement->execute(compact('name', 'mail', 'message', 'datum'));
    }
}
?>
