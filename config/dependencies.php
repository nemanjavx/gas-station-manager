<?php


    use Psr\Container\ContainerInterface;

    return [

        "Config" => require_once "config.php",

        "DatabaseConfig" => require_once "db.php",

        /** Business Logic - User */
        "LoginUser" => function () {
            return new GSManager\BLogic\User\LoginUser();
        },

        "RegisterUser" => function (ContainerInterface $c) {
            return new GSManager\BLogic\User\RegisterUser(
                $c->get("User"), 
                $c->get("UserDataAccess"), 
                $c->get("UserValidator"));
        },

        "UserValidator" => function () {
            return new GSManager\BLogic\User\UserValidator();
        },

        /** Entity */
        "User" => function () {
            return new GSManager\Domain\Entity\User();
        },

        /** Database */
        "DatabaseConnection" => function (ContainerInterface $c) {
            return new GSManager\Database\DatabaseConnection($c->get("DatabaseConfig"));
        },

        /** Data Access - User */
        "UserDataAccess" => function (ContainerInterface $c) {
            return new GSManager\Database\User\UserDataAccess($c->get("DatabaseConnection"));
        }

        
    ];