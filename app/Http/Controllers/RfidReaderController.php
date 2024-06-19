<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RfidReaderController extends Controller
{
    public function read(Request $request)
    {
        // Validasi request
        $request->validate([
            'rfid_data' => 'required|string',
        ]);

        // Simpan data RFID ke sesi
        session(['rfid' => $request->rfid_data]);

        return response()->json(['success' => true, 'rfid' => $request->rfid_data]);
    }

    public function getRfid()
    {
        $rfid = session('rfid', '');
        return response()->json(['success' => true, 'rfid' => $rfid]);
    }
}
