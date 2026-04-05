<?php

namespace App\Http\Controllers;

use App\Models\Sleep;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SleepController extends Controller
{
    public function index()
    {
        $sleeps = Sleep::orderBy('created_at', 'desc')->get();
        
        // Format created_at sebagai day untuk display
        $sleeps = $sleeps->map(function ($sleep) {
            $sleep->day = Carbon::parse($sleep->created_at)->format('l, d M Y');
            return $sleep;
        });
        
        return response()->json([
            'status' => 'success',
            'data' => $sleeps
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jam_tidur' => 'required|date_format:H:i',
            'jam_bangun' => 'required|date_format:H:i'
        ]);

        // Hitung total durasi tidur dalam menit
        $jamTidur = Carbon::createFromFormat('H:i', $request->jam_tidur);
        $jamBangun = Carbon::createFromFormat('H:i', $request->jam_bangun);
        
        // Jika jam bangun lebih kecil dari jam tidur, berarti melewati tengah malam
        if ($jamBangun->lt($jamTidur)) {
            $jamBangun->addDay();
        }
        
        $totalMenit = $jamBangun->diffInMinutes($jamTidur);

        $sleep = Sleep::create([
            'jam_tidur' => $request->jam_tidur,
            'jam_bangun' => $request->jam_bangun,
            'total' => $totalMenit
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Sleep data created successfully',
            'data' => $sleep
        ], 201);
    }

    public function show($id)
    {
        $sleep = Sleep::find($id);
        
        if (!$sleep) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sleep data not found'
            ], 404);
        }

        $sleep->day = Carbon::parse($sleep->created_at)->format('l, d M Y');
        
        return response()->json([
            'status' => 'success',
            'data' => $sleep
        ]);
    }

    public function update(Request $request, $id)
    {
        $sleep = Sleep::find($id);
        
        if (!$sleep) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sleep data not found'
            ], 404);
        }

        $this->validate($request, [
            'jam_tidur' => 'date_format:H:i',
            'jam_bangun' => 'date_format:H:i'
        ]);

        // Recalculate total if times are updated
        if ($request->has('jam_tidur') || $request->has('jam_bangun')) {
            $jamTidur = Carbon::createFromFormat('H:i', $request->jam_tidur ?? $sleep->jam_tidur);
            $jamBangun = Carbon::createFromFormat('H:i', $request->jam_bangun ?? $sleep->jam_bangun);
            
            if ($jamBangun->lt($jamTidur)) {
                $jamBangun->addDay();
            }
            
            $request->merge(['total' => $jamBangun->diffInMinutes($jamTidur)]);
        }

        $sleep->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Sleep data updated successfully',
            'data' => $sleep
        ]);
    }

    public function destroy($id)
    {
        $sleep = Sleep::find($id);
        
        if (!$sleep) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sleep data not found'
            ], 404);
        }

        $sleep->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Sleep data deleted successfully'
        ]);
    }
}