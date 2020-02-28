<?php

class Database {

    private static $settings;
    private static $configMode = 'dev';
  
    // Return value of configuration's settings
    public static function get($name, $defaultValue = null) {
      if (isset(self::getSettings()[$name])) {
        $value = self::getSettings()[$name];
      }
      else {
        $value = $defaultValue;
      }
      return $value;
    }
  
    // Return array with settings and load it in case
    private static function getSettings() {
      if (self::$settings == null) {
        
        if (self::$configMode === 'dev') {
            $configFile = 'Config/dev.ini';
        } else if (self::$configMode === 'prod') {
            $configFile = "Config/prod.ini";
        }

        if (!file_exists($configFile)) {
          $configFile = "Config/dev.ini";
          if (!file_exists($configFile)) {
            throw new \Exception("Aucun fichier de configuration trouvé");
          }
        } else {
          self::$settings = parse_ini_file($configFile);
        }
      }
      return self::$settings;
    }
  }