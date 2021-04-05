<?php
include_once "../utils/sanitize.php";

class Member
{
    private $conn;
    private $table = "members";

    public $id;
    public $firstName;
    public $lastName;
    public $account;
    public $channel;
    public $dob;
    public $confirmed;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Read query
        $query = "SELECT id, firstName, lastName, account, channel, dob, confirmed FROM $this->table";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function readOne()
    {
        $query = "SELECT id, firstName, lastName, account, channel, dob, confirmed FROM $this->table WHERE account = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->account);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row["id"];
        $this->firstName = $row["firstName"];
        $this->lastName = $row["lastName"];
        $this->account = $row["account"];
        $this->channel = $row["channel"];
        $this->dob = $row["dob"];
    }

    public function createOne()
    {
        $query = "INSERT INTO $this->table(firstName, lastName, account, channel, dob) VALUES(:firstName, :lastName, :account, :channel, :dob)";

        $stmt = $this->conn->prepare($query);

        $this->firstName = sanitize_input($this->firstName);
        $this->lastName = sanitize_input($this->lastName);
        $this->account = sanitize_input($this->account);
        $this->channel = sanitize_input($this->channel);
        $this->dob = sanitize_input($this->dob);

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":account", $this->account);
        $stmt->bindParam(":channel", $this->channel);
        $stmt->bindParam(":dob", $this->dob);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function updateOne()
    {
        $query = "UPDATE $this->table SET firstName = :firstName, lastName = :lastName, account = :account, channel = :channel, dob = :dob WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->firstName = sanitize_input($this->firstName);
        $this->lastName = sanitize_input($this->lastName);
        $this->account = sanitize_input($this->account);
        $this->channel = sanitize_input($this->channel);
        $this->dob = sanitize_input($this->dob);
        $this->id = sanitize_input($this->id);

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":account", $this->account);
        $stmt->bindParam(":channel", $this->channel);
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
