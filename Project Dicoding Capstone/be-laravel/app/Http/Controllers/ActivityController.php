<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();
        
        // Format created_at sebagai day untuk display
        $activities = $activities->map(function ($activity) {
            $activity->day = Carbon::parse($activity->created_at)->format('l, d M Y');
            return $activity;
        });
        
        return response()->json([
            'status' => 'success',
            'data' => $activities
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_aktivitas' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1' // durasi dalam menit
        ]);

        $activity = Activity::create([
            'nama_aktivitas' => $request->nama_aktivitas,
            'kategori' => $request->kategori,
            'durasi' => $request->durasi
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Activity created successfully',
            'data' => $activity
        ], 201);
    }

    public function show($id)
    {
        $activity = Activity::find($id);
        
        if (!$activity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Activity not found'
            ], 404);
        }

        $activity->day = Carbon::parse($activity->created_at)->format('l, d M Y');
        
        return response()->json([
            'status' => 'success',
            'data' => $activity
        ]);
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);
        
        if (!$activity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Activity not found'
            ], 404);
        }

        $this->validate($request, [
            'nama_aktivitas' => 'string|max:255',
            'kategori' => 'string|max:255',
            'durasi' => 'integer|min:1'
        ]);

        $activity->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Activity updated successfully',
            'data' => $activity
        ]);
    }

    public function destroy($id)
    {
        $activity = Activity::find($id);
        
        if (!$activity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Activity not found'
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Activity deleted successfully'
        ]);
    }
}