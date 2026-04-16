<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $cars = Car::all();
        return response()->json([
            'sucess' => true,
            'data' => $cars
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:100',
            'license_plate' => 'required|string|max:100|unique:cars,license_plate',
            'mileage' => 'required|integer|min:0',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
            'is_premium' => 'required|boolean',
            'rental_count' => 'nullable|integer|min:0',
            'daily_rate' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance', 'retired'])],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $data = $request->all();
        $data['rental_count'] = $request->input('rental_count', 0);
        $car = Car::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Car has been registered successfully.',
            'data' => $car
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $car
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found.'
                ], 404);
        }
        $validator = Validator::make($request->all(), [
            'brand_id' => 'sometimes|exists:brands,id',
            'model' => 'sometimes|string|max:100',
            'year' => 'sometimes|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'sometimes|string|max:100|unique:cars,license_plate,' . $id,
            'lat' => 'sometimes|numeric|between:-90,90',
            'lng' => 'sometimes|numeric|between:-180,180',
            'status' => ['sometimes', Rule::in(['available', 'rented', 'maintenance', 'retired'])],
            'is_premium' => 'sometimes|boolean',
            'daily_rate' => 'sometimes|integer|min:0',
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
        $car->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Car has been updated successfully',
            'data' => $car
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found.'
                ], 404);
        }
        $car->delete();
        return response()->json([
            'success' => true,
            'message' => 'Car has been deleted successfully.'
        ], 200);
    }

    /**
     * UPDATE STATUS.
     */
    public function updateStatus(Request $request, string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json([
                'success' => false,
                'message' => 'Car not found.'
                ], 404);
        }
        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance', 'retired'])]
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
        $car->update([
            'status' => $request->status
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Car status has been updated successfully',
            'data' => $car
        ], 200);
    }
}