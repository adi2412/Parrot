<?php

class Config
{
    /**
     * @var array
     */
    protected $config = null;

    /**
     * @param string $configFile
     * @throws InvalidArgumentException
     */
    public function __construct($configFile)
    {
        if (!file_exists($configFile)) {
            throw new InvalidArgumentException("Specified config file does not exist.");
        }
        if (!is_readable($configFile)) {
            throw new InvalidArgumentException("Unable to open specified config file.");
        }
        $this->config = require_once($configFile);
    }

    /**
     * @param string $option
     * @return mixed
     */
    public function getConfig($option = null)
    {
        if (!$option) {
            return $this->config;
        }
        $optionTree = explode("/", $option);
        $currentConfig = $this->config;
        foreach ($optionTree as $optional) {
            if (!isset($currentConfig[$optional])) {
                return null;
            }
            $currentConfig = $currentConfig[$optional];
        }
        return $currentConfig;
    }
}
