<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loyalty_level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoyaltyLevelController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $levels = Loyalty_level::all();
        return response()->json([
            'success' => true,
            'data' => $levels
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:loyalty_levels,name',
            'min_points' => 'required|integer|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'free_extra_hours' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $level = Loyalty_level::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Level has been created successfully.',
            'data' => $level
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $level = Loyalty_level::find($id);
        if (!$level) {
            return response()->json([
                'success' => false,
                'message' => 'Level not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $level
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $level = Loyalty_level::find($id);
        if (!$level) {
            return response()->json([
                'success' => false,
                'message' => 'Level not found.'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|unique:loyalty_levels,name,' . $id,
            'min_points' => 'sometimes|integer|min:0',
            'discount_percentage' => 'sometimes|integer|min:0|max:100',
            'free_extra_hours' => 'sometimes|integer|min:0',
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
        $level->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Level has been updated successfully',
            'data' => $level
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $level = Loyalty_level::find($id);
        if (!$level) {
            return response()->json([
                'success' => false,
                'message' => 'Level not found.'
            ], 404);
        }
        $level->delete();
        return response()->json([
            'success' => true,
            'message' => 'Level has been deleted successfully.'
        ], 200);
    }
}