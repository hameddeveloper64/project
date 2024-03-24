<?php
namespace Magnet\App\Library;
use PDO;

class Database {
    private $host;
    private $username;
    private $password;
	private $port;
    private $database;
    private $pdo;
	private array $data = [];

    public function __construct($host, $username, $password, $database, $port) {
        $this->host = 		$host;
        $this->username = 	$username;
        $this->password = 	$password;
        $this->database = 	$database;
		$this->port = 		$port;
        $this->connect();
    }

	private function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->database};port={$this->port};charset=utf8";
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->exec("SET NAMES 'utf8'");
			$this->pdo->exec("SET CHARACTER SET utf8");
			$this->pdo->exec("SET CHARACTER_SET_CONNECTION=utf8");
			$this->pdo->exec("SET SQL_MODE = ''");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
	
	public function ping() {
        try {
            $this->pdo->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function query($query, $params = []) {
        try {
		$this->data = [];
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($params);
			$this->data = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
				$result = new \stdClass();
				$result->row = isset($this->data[0]) ? $this->data[0] : [];
				$result->rows = $this->data;
				$result->num_rows = count($this->data);
					return $result;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
	
	public function superQuery($query, $params = []) {
        try {
            $this->stmt = $this->pdo->prepare($query);
            $this->stmt->execute($params);
            return $this->stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
	
	
    public function numRows($stmt) {
        return $stmt->rowCount();
    }

    public function escape($value)
    {
        return str_replace(array("\\", "\0", "\n", "\r", "\x1a", "'", '"'), array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"'), $value);
    }
	
	public function affectedRows() {
        return $this->stmt->rowCount();
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
	
	public function numFields($stmt) {
        return $stmt->columnCount();
    }
	
	public function fetch($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function fetchRow($stmt) {
        return $stmt->fetch();
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}

/*
// Example usage:
$database = new Database("localhost", "username", "password", "mydatabase");

// Insert data
$insertQuery = "INSERT INTO users (name, email) VALUES (:name, :email)";
$insertParams = [':name' => 'John Doe', ':email' => 'john@example.com'];
$database->executeQuery($insertQuery, $insertParams);

// Select data
$selectQuery = "SELECT * FROM users WHERE id = :id";
$selectParams = [':id' => 1];
$user = $database->fetchArray($selectQuery, $selectParams);

// Output the result
print_r($user);

// Get the number of affected rows
$affectedRows = $database->affectedRows();
echo "Number of affected rows: $affectedRows\n";

// Get the last inserted ID
$lastInsertedId = $database->lastInsertId();
echo "Last Inserted ID: $lastInsertedId\n";

// Check if the database connection is alive
if ($database->ping()) {
    echo "Database connection is alive!\n";
} else {
    echo "Database connection is not alive.\n";
}



// Example SELECT query
$selectQuery = "SELECT * FROM users WHERE id = :id";
$selectParams = [':id' => 1];

// Get the number of fields (columns) in the result set
$numFields = $database->numFields($selectQuery, $selectParams);
echo "Number of fields: $numFields\n";



//------------------------

// Example SELECT query
$selectQuery = "SELECT * FROM users WHERE id = :id";
$selectParams = [':id' => 1];

// Fetch a specific field value
$userName = $database->fetchField($selectQuery, $selectParams, 'name');
echo "User Name: $userName\n";

// Fetch all fields as an associative array
$userFields = $database->fetchFields($selectQuery, $selectParams);
print_r($userFields);

// Fetch a row as a numeric array
$userRow = $database->fetchRow($selectQuery, $selectParams);
print_r($userRow);

//------------------------

/ Insert data
$insertQuery = "INSERT INTO users (name, email) VALUES (:name, :email)";
$insertParams = [':name' => 'John Doe', ':email' => 'john@example.com'];
$insertStmt = $database->executeQuery($insertQuery, $insertParams);

// Get the number of inserted rows
$insertedRows = $database->numRows($insertStmt);
echo "Number of inserted rows: $insertedRows";

// Select data
$selectQuery = "SELECT * FROM users";
$selectStmt = $database->executeQuery($selectQuery);

// Get the number of selected rows
$selectedRows = $database->numRows($selectStmt);
echo "Number of selected rows: $selectedRows";

//------------------------
// Example multi-query
$multiQueries = [
    "INSERT INTO users (name, email) VALUES ('User1', 'user1@example.com');",
    "INSERT INTO users (name, email) VALUES ('User2', 'user2@example.com');"
];

// Execute multiple queries
$database->multiQuery($multiQueries);


// Example string to be escaped
$unescapedString = "John's example";

// Escape the string
$escapedString = $database->realEscapeString($unescapedString);

// Close connection
$database->closeConnection();

*/
?>