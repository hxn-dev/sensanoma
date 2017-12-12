<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/12/17
 * Time: 16:32
 */

namespace App\Http\Controllers;


use Illuminate\Support\Collection;

class DashboardController
{
    public function index()
    {

        $sensorNodes = Auth()->user()->account->sensorNodes;

        $sensors = new Collection();

        foreach ($sensorNodes as $sensorNode) {

            foreach ($sensorNode->sensors() as $sensor)
                $sensors->push($sensor);

        }


        return view('dashboard', compact('sensors'));

    }
}