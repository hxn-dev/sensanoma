<?php

namespace App\Sensanoma\Storage\Reader;


use App\Sensanoma\Storage\QueryBuilder\InfluxQueryBuilder;
use App\Sensanoma\Storage\StorageReaderInterface;
use Illuminate\Support\Collection;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class InfluxReader implements StorageReaderInterface
{

    /**
     * @param $query
     * @return array|Collection
     * @throws \InfluxDB\Exception
     * @throws \TrayLabs\InfluxDB\Facades\Exception
     */
    public function read($query)
    {
        try{
            $query = InfluxDB::query($query);
        } catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }
        return new Collection($query->getSeries());
    }
}