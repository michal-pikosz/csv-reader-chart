<?php


namespace src;


use PDO;

class CsvModel
{
    private const save = "INSERT into records (first_name,last_name,email,gender,ip_address,country) values(:first_name, :last_name, :email, :gender, :ip_address, :country)";
    private const countCountries = "SELECT count(id) as count, country from records group by country;";

//DB_ROOT_PASSWORD=rootpassword
//DB_NAME=dbname
//DB_USERNAME=dbuser
//DB_PASSWORD=dbpassword
    private $connection = null;
    private $stmt = null;
    private $host = "127.0.0.1";
    private $user = "dbuser";
    private $password = "dbpassword";
    private $db = 'dbname';

    /**
     * Get connection
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * CsvModel constructor.
     */
    public function __construct()
    {
        $this->connection = new PDO("mysql:dbname=csv;host=mysql;port=3306", $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Writes a single item to the database
     * @param $params
     * @return string
     */
    public function save($params)
    {
        $this->bindParams($params);
        return $this->stmt->execute();

    }

    /**
     * Assigns tables with CSV data as query parameters
     * @param $params
     */
    public function bindParams($params)
    {
        $this->stmt = $this->connection->prepare(self::save);
        foreach ($params as $col => $val) {
            $this->stmt->bindValue(':' . $col, $val);
        }
    }

    /**
     * Saves all records to the database
     * @param $records
     */
    public function saveAll($records)
    {
        foreach ($records as $record)
        {
            $row = [
                "first_name" => $record[1],
                "last_name" => $record[2],
                "email" => $record[3],
                "gender" => $record[4],
                "ip_address" => $record[5],
                "country" => $record[6],
            ];
            $this->save($row);
        }
    }

    public function getCountiresCount()
    {
        $this->stmt = $this->connection->prepare(self::countCountries);
        $this->stmt->execute();
        header('Content-Type: application/json');
        echo json_encode($this->stmt->fetchAll(PDO::FETCH_ASSOC));

    }


}
