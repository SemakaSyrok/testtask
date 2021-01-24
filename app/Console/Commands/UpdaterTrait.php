<?php

namespace App\Console\Commands;

use App\Lib\RedisLib;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait UpdaterTrait
{
    /**
     * Соединение с редисом
     */
    public Connection $connection;

    /**
     * Основная логика
     */
    public function update(int $shardNumber): void
    {
        $this->connection = RedisLib::getConnectionById($shardNumber);

        while (true) {
            $data = $this->connection->zpopmax($this->key);
            [$key, $value] = $this->getKeyAndValue($data);

            if ($key and $id = $this->exists($key)) {
                $this->insertToDatabase($id, $value);
            } else {
                sleep(1);
            }
        }
    }

    /**
     * Обновление значения поля в баз
     */
    private function insertToDatabase(int $id, int $value): void
    {
        self::$model::where('id', $id)->update([
            $this->key => DB::raw($this->key . '+' . $value)
        ]);
    }

    /**
     * Проверка на существование модели в базе
     */
    private function exists(int $key): int|false
    {
        $model = self::$model::find($key);

        return $model ? $model->id : false;
    }

    /**
     * Приведение ключа и значения к адекватному виду
     */
    private function getKeyAndValue(array $data): array
    {
        [$key, $value] = Arr::divide($data);

        return [Arr::first($key), Arr::first($value)];
    }
}