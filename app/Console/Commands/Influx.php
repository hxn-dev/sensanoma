<?php

namespace App\Console\Commands;

use App\Sensanoma\DataPoint;
use App\Sensanoma\Storage\Writer\InfluxWriter;
use Illuminate\Console\Command;
use Faker\Factory as Faker;
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
                                {--measurement= : Seed influx with special measurement}
                                {--crop= : Seed influx with special crop}
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
        $measurements = $this->initializeMeasurements($options);

        $dataPoints = new Collection();

        $storage = new InfluxWriter($dataPoints);

        if (isset($options['wipe'])) {
            $this->info('Erasing data..');
            $storage->drop();
        }

        $times = ($this->option('test')) ? 10 : 10000;

        $this->createDataPoint($measurements, $times, $options, $dataPoints);

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

    /**
     * @param array $options
     * @return array
     */
    private function initializeMeasurements(array $options)
    {
        $measurements = [
            'air_temp', 'air_humidity',
            'soil_temp', 'soil_humidity',
            'sun_lumen', 'intern_temp'
        ];

        if (isset($options['measurement'])) {
            $measurements = [];
            foreach ($options['measurement'] as $measurement) {
                array_push($measurements, $measurement);
            }
        }

        return $measurements;
    }

    /**
     * @param array $options
     * @return array
     */
    private function initializeCrops(array $options)
    {
        $crops = [
            'Tomato', 'Broccoli',
            'Avocado', 'Brussels sprout',
            'Carrot', 'Grape'
        ];

        if (isset($options['crop'])) {
            $crops = [];
            foreach ($options['crop'] as $crop) {
                array_push($crops, $crop);
            }
        }

        return $crops;
    }

    private function createDataPoint($measurements, $times, $options, $dataPoints)
    {
        $faker = Faker::create();
        $carbon = Carbon::create();
        $crops = $this->initializeCrops($options);

        $area = $faker->city;
        $zone = $faker->streetName;

        foreach ($measurements as $measurement) {
            $now = $carbon->now();
            for ($i = 1; $i < $times; $i++) {
                $now->subMinutes(10);
                $dataPoint = new DataPoint();
                $dataPoint->setMeasurement($measurement);
                $dataPoint->setValue(random_int(8, 15));
                $dataPoint->setArea($area);
                $dataPoint->setZone($zone);
                $dataPoint->setAccountId(1);
                $dataPoint->setSensornodeId(1);
                $dataPoint->setCrop(array_random($crops));
                $dataPoint->setTimestamp($now->timestamp);
                $dataPoints->push($dataPoint);
            }
        }
    }
}
