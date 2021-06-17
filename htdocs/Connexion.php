<?php

class Connexion
{
    public static function instance()
    {
        $user = 'root';
        $pass = 'password';
        $host = 'mysql';
        $dbname = 'eurovent';

        return new PDO('mysql:host='. $host .';dbname='. $dbname .'', $user, $pass);
    }
}