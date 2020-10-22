<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traviz;

class TravizController extends Controller
{
    public function index()
    {
        $traviz = new Traviz;
        $units = $traviz->get();
        $data = [
            'units' => $units
        ];
        return view('affected_units', $data);
    }
}
