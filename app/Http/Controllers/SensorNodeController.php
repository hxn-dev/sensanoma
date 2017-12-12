<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorNodeRequest;
use App\Models\SensorNode;
use Illuminate\Support\Facades\Auth;

class SensorNodeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensorNodes = Auth::user()->account->sensorNodes()->get();

        return view('sensor_node.index', compact('sensorNodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Auth::user()->account->zones()->get()->pluck('name', 'id');
        $types = collect(config('sensanoma.sensor_node_types'));

        foreach ($types->keys() as $key) {
            $types[$key] = $types[$key]['name'];
        }

        return view('sensor_node.create', compact('zones', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SensorNodeRequest $request)
    {
        Auth::user()->account->sensorNodes()->create($request->toArray());

        return redirect(route('sensor_node.index'))->with('success', 'The Sensor Node has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function show(SensorNode $sensorNode)
    {
        $this->authorize('view', $sensorNode);

        return view('sensor_node.show', compact('sensorNode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorNode $sensorNode)
    {
        $this->authorize('view', $sensorNode);
        $zones = Auth::user()->account->zones()->get()->pluck('name', 'id');
        $types = collect(config('sensanoma.sensor_node_types'));

        foreach ($types->keys() as $key) {
            $types[$key] = $types[$key]['name'];
        }

        return view('sensor_node.edit', compact('sensorNode', 'zones', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function update(SensorNodeRequest $request, SensorNode $sensorNode)
    {
        $this->authorize('update', $sensorNode);
        $sensorNode->update($request->toArray());

        return redirect(route('sensor_node.index'))->with('success', 'The Sensor Node has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorNode $sensorNode)
    {
        $this->authorize('delete', $sensorNode);
        $sensorNode->destroy($sensorNode->id);

        return redirect(route('sensor_node.index'))->with('success', 'The Sensor Node has been deleted');
    }


}
