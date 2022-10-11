<?php

namespace Lidmo\WP\Database\Capsule;

use Illuminate\Database\Capsule\Manager as BaseManager;
use Lidmo\WP\Database\Connection;

/**
 * Manager.php
 * @author Lídmo <suporte@lidmo.com.br>
 */
class Manager extends BaseManager
{
    protected function setupWP($useWpConnection=true){
        if($useWpConnection) {
            $this->addConnection([], 'wp');
            $this->getDatabaseManager()->extend('wp', function () {
                return Connection::instance();
            });
            $this->getDatabaseManager()->setDefaultConnection('wp');
        }else{
            global $wpdb;
            $dbuser     = defined( 'DB_USER' ) ? DB_USER : '';
            $dbpassword = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : '';
            $dbname     = defined( 'DB_NAME' ) ? DB_NAME : '';
            $dbhost     = defined( 'DB_HOST' ) ? DB_HOST : '';

            $this->addConnection([
                'driver'    => 'mysql',
                'host'      => $dbhost,
                'database'  => $dbname,
                'username'  => $dbuser,
                'password'  => $dbpassword,
                'charset'   => $wpdb->charset,
                'collation' => $wpdb->collate,
                'prefix'    => $wpdb->base_prefix,
            ], 'wp');
        }
    }

    public static function bootWP($useWpConnection=true){
        if(!static::$instance){
            static::$instance=new static();
            static::$instance->setupWp($useWpConnection);
            static::$instance->bootEloquent();
        }
        return static::$instance;
    }
}