<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class mypdo{
    private static $pdo='';
    
    public static function getPdo(){
        try{
            self::$pdo = new PDO("mysql:host=localhost;dbname=sat","root","123456"); 
            self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);// //禁用prepared statements的仿真效果
            self::$pdo->exec("set names 'utf8'");   
            return  self::$pdo;
    }catch(PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}


 
}

?>
