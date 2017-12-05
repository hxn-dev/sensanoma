<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Mapper;

class ZoneController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Auth::user()->account->zones()->get();

        return view('zone.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Mapper::map(0, 0, ['locate' => true,
            'eventBeforeLoad' => 'makePolygon(map);',
            'zoom' => 18]);

        $areas = Auth::user()->account->areas()->get()->pluck('name', 'id');

        return view('zone.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request)
    {
        Auth::user()->account->zones()->create($request->toArray());

        return redirect(route('zone.index'))->with('success', 'The zone has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        $this->authorize('view', $zone);

        return view('zone.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {

        $this->authorize('view', $zone);
        $areas = Auth::user()->account->areas()->get()->pluck('name', 'id');

        return view('zone.edit', compact('zone', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(ZoneRequest $request, Zone $zone)
    {
        $this->authorize('update', $zone);
        $zone->update($request->toArray());

        return redirect(route('zone.show', $zone))->with('success', 'The Zone has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        $this->authorize('delete', $zone);
        $zone->destroy($zone->id);

        return redirect(route('zone.index'))->with('success', 'The Zone has been deleted');
    }
}
