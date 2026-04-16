<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json([
            'success' => true,
            'data' => $brands
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:brands,name',
            'img' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $brand = Brand::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Brand has been created successfully.',
            'data' => $brand
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $brand
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found.'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100|unique:brands,name,' . $id,
            'img' => 'sometimes|string|max:255',
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
        $brand->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Brand has been updated successfully.',
            'data' => $brand
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found.'
            ], 404);
        }
        $brand->delete();
        return response()->json([
            'success' => true,
            'message' => 'Brand has been deleted successfully.'
        ], 200);
    }
}