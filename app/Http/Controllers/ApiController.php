<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function lists()
    {
        $data = [
            'some' => 'complex',
            'structure' => [
                'with' => 'multiple',
                'nesting' => []
            ]
        ];

        return response()->json($data);
    }
}