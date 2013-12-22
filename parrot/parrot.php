<?php

class Parrot
{
    /**
     * @var Parrot
     */
    protected static $instance = null;

    /**
     * @var Config
     */
    protected $config = null;

    /**
     * @var Database
     */
    protected $database = null;

    /**
     * @param Config $config
     */
    protected function __construct(Config $config)
    {
        $this->config = $config;
        $this->database = new Database($this->config->getConfig("database"));
        //TODO: handle database connection failure
    }

    /**
     * @param Config $config
     */
    public static function initialise(Config $config)
    {
        self::$instance = new self($config);
    }

    /**
     * @return Parrot
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * @return Config
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @return Database
     */
    public function database()
    {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->config->getConfig("app/baseurl") . rtrim($this->config->getConfig("app/basepath"), "/");
    }

    /**
     * @param string $path
     * @return string
     */
    public function getUrl($path = "")
    {
        return $this->getBaseUrl() . "/" . $path;
    }
}
