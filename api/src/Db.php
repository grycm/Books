<?php

class DB
{
    static private $conn = null;

    static public function connect()
    {
        //sprawdzam, czy połączenie istnieje
        if (!is_null(self::$conn)) {
            return self::$conn;
        } else {
            self::$conn = new mysqli('localhost', 'root', 'coderslab', 'books');
            self::$conn->set_charset('utf8');
            
            if (self::$conn->connect_error) {
                die('Nie udało się połączyć ' . self::$conn->connect_errno);
            }
            
             return self::$conn;
        }
    }

    static public function disconnect()
    {
        self::$conn->close();
        self::$conn = null;
        
        return TRUE;
    }
}