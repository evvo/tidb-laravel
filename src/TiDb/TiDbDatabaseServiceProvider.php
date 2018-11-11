<?php

namespace Evvo\TiDb;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\MySqlConnector;

class TiDbDatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Connection::resolverFor('tidb', function ($connection, $database, $prefix, $config) {
            $connector = new MySqlConnector();
            $connection = $connector->connect($config);
            return new TiDb($connection, $database, $prefix, $config);
        });
    }
}
