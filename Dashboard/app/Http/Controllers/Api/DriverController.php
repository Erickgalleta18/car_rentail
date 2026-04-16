<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $drivers = Driver::all();
        return response()->json([
            'success' => true,
            'data' => $drivers
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id|unique:drivers,user_id',
            'licence_number' => 'required|integer|unique:drivers,licence_number',
            'licence_img' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $driver = Driver::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Driver has been created successfully.',
            'data' => $driver
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $driver
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver not found.'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id|unique:drivers,user_id,' . $id,
            'licence_number' => 'sometimes|integer|unique:drivers,licence_number,' . $id,
            'licence_img' => 'sometimes|string|max:255',
        ]);
        if (empty($request->all())) {
        return response()->json([
            'success' => false,
            'message' => 'No change applied.'
        ], 200);
        }
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $driver->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Driver has been updated successfully',
            'data' => $driver
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver not found.'
            ], 404);
        }
        $driver->delete();
        return response()->json([
            'success' => true,
            'message' => 'Driver has been deleted successfully.'
        ], 200);
    }
}