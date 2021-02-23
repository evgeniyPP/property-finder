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
        if ($request->name) {
            $properties = Property::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $properties = Property::all();
        }

        if ($request->bedrooms) {
            $properties = $properties->where('bedrooms', $request->bedrooms);
        }

        if ($request->bathrooms) {
            $properties = $properties->where('bathrooms', $request->bathrooms);
        }

        if ($request->storeys) {
            $properties = $properties->where('storeys', $request->storeys);
        }

        if ($request->garages) {
            $properties = $properties->where('garages', $request->garages);
        }

        if ($request->price && ($request->price[0] || $request->price[1])) {
            $price_min = $request->price[0];
            $price_max = $request->price[1];

            if ($price_min && !$price_max) {
                $properties = $properties->where('price', '>', $price_min);
            }

            if (!$price_min && $price_max) {
                $properties = $properties->where('price', '<', $price_max);
            }

            if ($price_min && $price_max) {
                $properties = $properties->whereBetween('price', $request->price);
            }
        }

        return response()->json($properties->values());
    }
}
