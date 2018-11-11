# tidb-laravel
Better TiDb support for Laravel

### Install the latest version of the library:
```
composer require evvo/tidb-laravel:0.1
```
Laravel 5.5+ should be able to autodiscover the package's service provider.

Set the database driver for your database connection to be 'tidb' in config/database.php - for example:
```
'mysql' => [
            'driver' => 'tidb',
            'host' => env('DB_HOST', '127.0.0.1'),
            ...
```
### Notes on some of the differences between MySQL and TiDb

TiDb does not support multiple column updates in a single command - for example, this is not supported:
```
Schema::table('users', function (Blueprint $table) {
    $table->boolean('verified')->default(false);
    $table->string('name')->nullable();
});
```
but this will work fine:
```
Schema::table('users', function (Blueprint $table) {
    $table->boolean('verified')->default(false);
});

Schema::table('users', function (Blueprint $table) {
    $table->string('name')->nullable();
});
```
