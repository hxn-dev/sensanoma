<?php

namespace App\Console\Commands;

use App\Models\SensorNode;
use App\Sensanoma\DataPoint;
use App\Sensanoma\Storage\Writer\InfluxWriter;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;


class Influx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'influx:seed
                                {--wipe : Wipe old data}
                                {--test : Only for testing purpose}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding the influx Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->initializeOptions($this->options());

        $carbon = Carbon::create();
        $dataPoints = new Collection();
        $storage = new InfluxWriter($dataPoints);


        if (isset($options['wipe'])) {
            $this->info('Erasing data..');
            $storage->drop();
        }

        $sensorNodes = SensorNode::all(); //->take(2);

        foreach($sensorNodes as $sensorNode) {

            foreach ($sensorNode->sensors() as $sensor) {

                $times = ($this->option('test')) ? 10 : 1000;


                $now = $carbon->now();
                for ($i = 1; $i < $times; $i++) {
                    $now->subMinutes(10);
                    $dataPoint = new DataPoint();
                    $dataPoint->setMeasurement($sensor->studlyName());
                    $dataPoint->setValue(random_int(8, 15));
                    $dataPoint->setArea($sensorNode->zone->area->name);
                    $dataPoint->setZone($sensorNode->zone->name);
                    $dataPoint->setAccountId($sensorNode->account->id);
                    $dataPoint->setSensornodeId($sensorNode->id);
                    $dataPoint->setCrop($sensorNode->zone->crop);
                    $dataPoint->setTimestamp($now->timestamp);
                    $dataPoints->push($dataPoint);

                }

                $storage->store();
                $this->info("Seeded sensor {$sensor->getName()} on node {$sensorNode->name}!");

            }

        }

        $storage->store();
        $this->info('The influxDB has been seeded!');
    }

    /**
     * @param array $options
     * @return array
     */
    private function initializeOptions(array $options)
    {
        $options = [];
        foreach ($this->options() as $key => $value) {
            if ($value) {
                $options[$key] = explode(',', str_replace(' ', '', $value));
            }
        }

        return $options;
    }

}
