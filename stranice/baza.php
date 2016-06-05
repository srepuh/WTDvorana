<?php
class Baza
{
    private static $dbName = 'sandr' ;
    private static $dbHost = 'sandr-etermini.rhcloud.com/' ;
    private static $dbUsername = 'adminclpfv8k';
    private static $dbUserPassword = 'lieqYRia1PW2';
    
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