<?php

/*
Classe abstract effectuant la connexion à la base de données, liée au Manager.
*/


abstract class Model
{

    // à compléter avec les infos de votre base de données
    private const HOST = 'localhost';
    private const DB = 'mvc';
    private const USER = 'root';
    private const PWD = '';

    /* singleton */
    private static $database; //on le met en static pour qu'il soit partagé avec toutes les instances des
    // classes qui heriteront de la class Model (classes filles de Model)

    /**
     * Cette fonction sera appellée par getDatabase() la premiere fois pour
     * initialiser la connexion avec la base de données
     */
    private static function initDatabase(){
            self::$database = new Medoo\Medoo([
                'database_type' => 'mysql',
                'database_name' => self::DB,
                'server' => self::HOST,
                'username' => self::USER,
                'password' => self::PWD,
                "charset" => "utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
    }

    //design pattern singleton
    protected function getDatabase()
    {
        // la premiere fois on initialise self::$database
        if (self::$database === null) {
            self::initDatabase();
        }
        // et on renvoie l'objet qui sert à effectuer les requêtes
        return self::$database;
    }
}
