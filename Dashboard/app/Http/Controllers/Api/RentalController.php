<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $rentals = Rental::all();
        return response()->json([
            'success' => true,
            'data' => $rentals,
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'driver_id' => 'required|exists:drivers,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
            'total_amount' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['pending', 'confirmed', 'active', 'completed', 'cancelled'])],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $rental = Rental::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Rental has been registered succesfully.',
            'data' => $rental
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Rental not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $rental
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Rental not found.'
                ], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'car_id' => 'sometimes|exists:cars,id',
            'driver_id' => 'sometimes|exists:drivers,id',
            'pickup_date' => 'sometimes|date',
            'return_date' => 'sometimes|date|after:pickup_date',
            'status' => ['sometimes', Rule::in(['pending', 'confirmed', 'active', 'completed', 'cancelled'])],
            'total_amount' => 'sometimes|integer|min:0',
        ]);
        if (empty($request->all())) {
        return response()->json([
            'success' => false,
            'message' => 'No change applied.'
        ], 200);
        }
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        $rental->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Rental has been updated successfully',
            'data' => $rental
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Rental not found.'
                ], 404);
        }
        $rental->delete();
        return response()->json([
            'success' => true,
            'message' => 'Rental has been deleted successfully'
        ], 200);
    }

    /**
     * UPDATE STATUS.
     */
    public function updateStatus(Request $request, string $id)
    {
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Rental not found.'
                ], 404);
        }
        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in(['pending', 'confirmed', 'active', 'completed', 'cancelled'])]
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
        $rental->update([
            'status' => $request->status
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Rental status has been updated successfully',
            'data' => $rental
        ], 200);
    }

}