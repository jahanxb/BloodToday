<?php
/*
//session_start();
try {
$handler= new PDO
    ('mysql:host=localhost;dbname=blooddbs','root','');

    $handler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
//  echo 'Caught';
echo $e->getMessage();
die('Sorry, DB Problem please Get your shit Tgether ');

}

include_once 'class.user.php';

$user =new USER($handler);


*/
?>
<?php
class Database
{
    private $host = "localhost";
    private $db_name = "blooddbs";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection()
	{

	    $this->conn = null;
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
