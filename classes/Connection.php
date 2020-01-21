<?php

    class Connection
    {
        private function __construct()
        {}

        static function connect()
        {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

            $link = new PDO(
                'mysql:host=localhost;dbname=gdm',
                'root',
                '',
                $options
            );
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $link;
        }
    }