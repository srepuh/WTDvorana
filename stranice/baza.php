<?php
class Baza
{
    private static $dbName = 'wt' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'Sitim12';
     
    private static $con  = null;
     
    public static function connect()
    {
       if ( null == self::$con )
       {     
        try
        {
          self::$con =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e)
        {
			exit($e->getMessage());
        }
       }
       return self::$con;
    }
     
    public static function disconnect()
    {
        self::$con = null;
    }
}
?>