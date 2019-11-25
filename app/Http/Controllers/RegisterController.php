<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Patient;

class RegisterController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'validacion' => true,
            'messaje' => 'Estacionamiento creado'
        ]);
        
    }
}
