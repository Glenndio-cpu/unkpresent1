<?php 
class Database {
    private $server_name = HOST_DB;
    private $db_name = NAME_DB;
    private $user_name = USER_DB;
    private $password = PASS_DB;

    private $con;

    public function __construct() {
        try {
            $this->con = $this->db_connection($this->server_name, $this->user_name, $this->password, $this->db_name);
            echo "Database connected successfully.";
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    private function db_connection($srvr_nm, $usr_nm, $psswrd, $db_nm) {
        $conn = new mysqli($srvr_nm, $usr_nm, $psswrd, $db_nm);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function query($sql) {
        if (!$this->con) {
            throw new Exception("Database connection is not established.");
        }
        $result = $this->con->query($sql);
        if (!$result) {
            throw new Exception("Query failed: " . $this->con->error);
        }
        return $result;
    }

    public function db_close() {
        if ($this->con) {
            $this->con->close();
        }
    }
}
?>
