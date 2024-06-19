<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rfid' => 'required|string',
        ]);

        Rfid::create([
            'rfid' => $request->rfid,
        ]);

        return response()->json(['success' => true]);
    }

    public function nokartu()
    {
        $data = Rfid::all();
        $cek = Rfid::all()->toArray();

        return view('nokartu', compact('data', 'cek'));
    }
}
