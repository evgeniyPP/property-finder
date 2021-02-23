<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Поиск по данным.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->has('name') && $request->name) {
            $properties = Property::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $properties = Property::all();
        }

        if ($request->has('bedrooms') && $request->bedrooms) {
            $properties = $properties->where('bedrooms', $request->bedrooms);
        }

        if ($request->has('bathrooms') && $request->bathrooms) {
            $properties = $properties->where('bathrooms', $request->bathrooms);
        }

        if ($request->has('storeys') && $request->storeys) {
            $properties = $properties->where('storeys', $request->storeys);
        }

        if ($request->has('garages') && $request->garages) {
            $properties = $properties->where('garages', $request->garages);
        }

        if ($request->has('price') && $request->price && $request->price[0] && $request->price[1]) {
            $properties = $properties->whereBetween('price', $request->price);
        }

        return response()->json($properties->values());
    }
}
