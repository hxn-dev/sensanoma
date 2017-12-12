<?php

namespace App\Models;

use App\Sensanoma\Sensor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SensorNode extends Model
{
    protected $fillable = ['name', 'type', 'zone_id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getTypeAttribute($type)
    {
        return config('sensanoma.sensor_node_types')[$type];
    }

    public function sensors()
    {
        $sensors = new Collection();

        foreach ($this->type['sensors'] as $sensor) {

            $sensorObject = new Sensor($sensor);
            $sensorObject->setSensorNodeId($this->id);

            $sensors->push($sensorObject);

        }

        return $sensors;
    }

    public function sensor($sensorName)
    {
        foreach ($this->type['sensors'] as $sensor) {

            if ($sensor['name'] == $sensorName) {
                $sensorObject = new Sensor($sensor);
                $sensorObject->setSensorNodeId($this->id);
                return $sensorObject;
            }
        }

        return null;
    }


}
