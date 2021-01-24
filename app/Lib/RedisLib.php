<?php

namespace App\Lib;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;

/**
 * Класс который управляет подключениями
 *
 * Class RedisLib
 * @package App\Lib
 */
class RedisLib
{
    public static function getConnectionById($id): Connection
    {
        $number = $id % self::getConnectionsNumber() + 1;

        return Redis::connection('redis_' . $number);
    }

    private static function getConnectionsNumber() : int
    {
        return config('database.redis.connections');
    }
}