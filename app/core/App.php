<?php

namespace App\core;
use Symfony\Component\Yaml\Yaml; // Ajoute cette ligne
use \App\core\Database;

class App{
    private $instance=null;
    private static $dependencies = [];

    // Ajoute cette méthode pour charger le YAML
    public static function loadDependenciesFromYaml($filepath){
        if (file_exists($filepath)) {
            $config = Yaml::parseFile($filepath);
            if (isset($config['dependencies'])) {
                self::$dependencies = $config['dependencies'];
            }
        }
    }

    public static function getDependency($key){
        if(array_key_exists($key, self::$dependencies)){
            $class = self::$dependencies[$key];
            if(class_exists($class) && method_exists($class, 'getInstance')){
                return $class::getInstance();
            }
            return new $class();
        }
        throw new \Exception("class ".$key." not found ");
    }
}