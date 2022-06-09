<?php

namespace app\src;

use \PDO;
use PDOStatement;

class Database
{
    private static PDO $PDO;

    /**
     * @return PDO
     */
    public static function getDatabaseInstance(): PDO
    {
        if (!isset(self::$PDO)) {
            $dbConfig = require_once '../configuration/database.php';
            $database = $dbConfig['db_name'];
            $username = $dbConfig['db_username'];
            $password = $dbConfig['db_password'];
            $servername = $dbConfig['servername'];
            $dsn = "mysql:dbname=$database;host=$servername:3307";

            self::$PDO = new PDO($dsn, $username, $password);
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$PDO;
    }

    /**
     * @param $sql
     * @return false|PDOStatement
     */
    public function prepare($sql)
    {
        $pdo = self::getDatabaseInstance();
        return $pdo->prepare($sql);
    }

    /**
     * @return mixed
     */
   public function getTableName()
    {
        if (!isset($this->tableName)) {
            throw new \Error('table name must be defined');
        }

        return $this->tableName;
    }

    /**
     * @param $tableName
     * @return array|false
     */
    public function getTableColumns($tableName)
    {
        $query = $this->prepare("DESCRIBE $tableName");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        $properties = [];
        $tableColumns = $this->getTableColumns($this->getTableName());
        foreach (get_object_vars($this) as $key => $value) {
            if (in_array($key, $tableColumns)) {
                $properties[$key] = $value;
            }
        }

        return $properties;
    }
}
