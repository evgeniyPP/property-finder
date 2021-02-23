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
        return Property::all();
    }
}
