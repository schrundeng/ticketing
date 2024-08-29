<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absenModel;

class absenController extends Controller
{
    public function tesAbsen(Request $request){
        $request->validate([
            'id_pengelola' => 'required',
        ]);

        $absen = absenModel::create([
            'id_pengelola' => $request->id_pengelola,
        ]);
    }
}
