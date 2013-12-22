<?php

class Database
{
    /**
     * @var PDO
     */
    protected $pdo = null;

    /**
     * @var string
     */
    protected $tablePrefix = "";

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->pdo = new PDO("mysql:host=" . $config["hostname"] . ";dbname=" . $config["database"], $config["username"], $config["password"]);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->tablePrefix = $config["prefix"];
    }

    /**
     * Gets the DB instance
     *
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * @param string $query
     * @return PDOStatement
     */
    public function newStatement($query)
    {
        return $this->pdo->prepare($query);
    }

    /**
     * @return string
     */
    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getTableName($name)
    {
        return "`" . $this->tablePrefix . $name . "`";
    }
}
