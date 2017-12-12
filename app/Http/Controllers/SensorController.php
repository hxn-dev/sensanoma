<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/12/17
 * Time: 16:54
 */

namespace App\Http\Controllers;


use App\Models\SensorNode;
use App\Sensanoma\Transformer\ConsoleTvChartTransformer;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;

class SensorController
{
    public function show($id, $sensor)
    {

        $sensor = SensorNode::find($id)->sensor($sensor);

        $data = $sensor->getData('2w', '2h', new ConsoleTvChartTransformer());

        $chart = Charts::multi('line', 'highcharts');

        $chart->labels($data['labels']);
        $chart->dataset($sensor->getName(), $data['values']);

        return view('sensor.show', compact(['sensor', 'chart']));
    }

}