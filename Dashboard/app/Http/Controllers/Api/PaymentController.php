<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    /**
     * SELECT.
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json([
            'success' => true,
            'data' => $payments
        ], 200);
    }

    /**
     * INSERT.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rental_id' => 'required|exists:rentals,id',
            'amount' => 'required|integer|min:1',
            'payment_method' => 'required|string|max:100',
            'transaction_id' => 'required|string|max:255|unique:payments,transaction_id',
            'status' => ['required', Rule::in(['pending', 'completed', 'failed', 'refunded'])],
            'payment_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $payment = Payment::create($request->all());
        return response()->json([
            'succcess' => true,
            'message' => 'Payment has been registered successfully.',
            'data' => $payment
        ], 201);
    }

    /**
     * SELECT.
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found.'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $payment
        ], 200);
    }

    /**
     * UPDATE.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found.'
                ], 404);
        }
        $validator = Validator::make($request->all(), [
            'status' => ['sometimes', Rule::in(['pending', 'completed', 'failed', 'refunded'])],
            'transaction_id' => 'sometimes|string|unique:payments,transaction_id,' . $id,
            'payment_date' => 'sometimes|date',
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
        $payment->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Payment has been updated successfully',
            'data' => $payment
        ], 200);
    }

    /**
     * DELETE.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found.'
                ], 404);
        }
        $payment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Payment has been deleted successfully.'
        ], 200);
    }
}