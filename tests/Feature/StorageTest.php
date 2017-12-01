<?php

namespace Tests\Feature;

use App\Sensanoma\DataPoint;
use App\Sensanoma\Storage\Reader\InfluxReader;
use App\Sensanoma\Storage\Writer\InfluxWriter;
use Illuminate\Support\Collection;
use Tests\TestCase;

class StorageTest extends TestCase
{

    public $dataPoint;
    public $dataPoints;
    public $influxWriter;
    public $influxReader;

    public function setUp()
    {
        parent::setUp();

        // Make dataPoint
        $this->dataPoint = new DataPoint();
        $this->dataPoint->setMeasurement('air_temp');
        $this->dataPoint->setValue(random_int(1, 17));
        $this->dataPoint->setArea('area1');
        $this->dataPoint->setZone('zone1');
        $this->dataPoint->setAccountId(random_int(1, 15));
        $this->dataPoint->setSensornodeId(random_int(1, 100));
        $this->dataPoint->setCrop('carrot');
        $this->dataPoint->setTimestamp(time());

        // Make Collection dataPoints
        $this->dataPoints = new Collection();
        $this->dataPoints->push($this->dataPoint);
        $this->influxWriter = new InfluxWriter($this->dataPoints);
        // Drop influx database
        $this->influxWriter->drop();

        $this->influxReader = new InfluxReader();
    }

    /** @test */
    public function it_should_store_in_influx()
    {
        $result = $this->influxWriter->store();

        $this->assertTrue($result);
    }

    /** @test */
    public function it_should_read_influx_data()
    {
        $this->influxWriter->store();

        $result = $this->influxReader->read([
            'select'    => ['mean(value)'],
            'from'      => ['air_temp'],
            'where'     => 'time > now() - 1d',
            'groupBy'   => 'time(10m)',
            'fill'      => 'linear',
            'limit'     => 0

        ]);
        $this->assertInstanceOf('Illuminate\Support\Collection', $result);
    }

    /** @test */
    public function it_should_throw_error_when_reading()
    {
        $this->influxWriter->store();

        $result = $this->influxReader->read([
            'select'    => ['mean(value)'],
            'from'      => ['a'],
            'where'     => '',
            'groupBy'   => '',
            'fill'      => '',
            'limit'     => 0
        ]);

        $this->assertRegexp('/error/', $result['error']);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_measurement()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setMeasurement(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_timeStamp()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setTimestamp('test!');
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_accountId()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setAccountId('Test');
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_area()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setArea(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_zone()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setZone(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_crop()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setCrop(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_value()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setValue('Test!');
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_sensorNodeId()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setSensornodeId('Test');
    }
}
