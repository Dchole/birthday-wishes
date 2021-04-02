<?php
include_once "../utils/sanitize.php";

class Member
{
    private $conn;
    private $table = "members";

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $dob;
    public $confirmed;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Read query
        $query = "SELECT id, firstName, lastName, email, dob, confirmed FROM $this->table";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT firstName, lastName, email, dob FROM $this->table WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->firstName = $row["firstName"];
        $this->lastName = $row["lastName"];
        $this->email = $row["email"];
        $this->dob = $row["dob"];
    }

    public function createOne()
    {
        $query = "INSERT INTO $this->table(firstName, lastName, email, dob) VALUES(:firstName, :lastName, :email, :dob)";

        $stmt = $this->conn->prepare($query);

        $this->firstName = sanitize_input($this->firstName);
        $this->lastName = sanitize_input($this->lastName);
        $this->email = sanitize_input($this->email);
        $this->dob = sanitize_input($this->dob);

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":dob", $this->dob);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function updateOne()
    {
        $query = "UPDATE $this->table SET firstName = :firstName, lastName = :lastName, email = :email, dob = :dob WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->firstName = sanitize_input($this->firstName);
        $this->lastName = sanitize_input($this->lastName);
        $this->email = sanitize_input($this->email);
        $this->dob = sanitize_input($this->dob);
        $this->id = sanitize_input($this->id);

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function deleteOne()
    {
        $query = "DELETE FROM $this->table WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
