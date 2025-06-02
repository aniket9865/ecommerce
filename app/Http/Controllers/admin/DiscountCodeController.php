<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    // Display a listing of the discount codes
    public function index(Request $request)
    {
        $search = $request->input('search');
        $coupons = DiscountCoupon::when($search, function ($query, $search) {
            return $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        })->latest()->paginate(10);
        return view('admin.coupon.list', compact('coupons'));

    }

    // Show the form for creating a new discount code
    public function create()
    {
        return view('admin.coupon.create');
    }

    // Store a new discount code
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:discount_coupons,code|max:255',
            'name' => 'nullable|max:255',
            'description' => 'nullable|string',
            'max_users' => 'nullable|integer|min:0',
            'max_uses_users' => 'nullable|integer|min:0',
            'type' => 'required|in:percentage,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:0,1',
            'starts_at' => 'nullable|date|after_or_equal:today',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        if ($validator->passes()) {
            // Validate that `starts_at` is in the future
            if (!empty($request->starts_at)) {
                $now = now();
                $startAt = Carbon::parse($request->starts_at);

                if ($startAt->lte($now)) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['starts_at' => 'The start date must be a future date.'],
                    ]);
                }
            }

            // Validate that `expires_at` is in the future and after `starts_at`
            if (!empty($request->expires_at)) {
                $now = now();
                $expiresAt = Carbon::parse($request->expires_at);

                // Ensure the expiration date is in the future
                if ($expiresAt->lte($now)) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'The expiration date must be a future date.'],
                    ]);
                }

                // Ensure the expiration date is after the start date
                if (!empty($request->starts_at)) {
                    $startAt = Carbon::parse($request->starts_at);
                    if ($expiresAt->lte($startAt)) {
                        return response()->json([
                            'status' => false,
                            'errors' => ['expires_at' => 'The expiration date must be after the start date.'],
                        ]);
                    }
                }
            }

            // Create the new discount code
            $discountCode = new DiscountCoupon();
            $discountCode->code = $request->input('code');
            $discountCode->name = $request->input('name');
            $discountCode->description = $request->input('description');
            $discountCode->max_users = $request->input('max_users');
            $discountCode->max_uses_users = $request->input('max_uses_users');
            $discountCode->type = $request->input('type');
            $discountCode->discount_amount = $request->input('discount_amount');
            $discountCode->min_amount = $request->input('min_amount');
            $discountCode->status = $request->input('status');
            $discountCode->starts_at = $request->input('starts_at');
            $discountCode->expires_at = $request->input('expires_at');

            $discountCode->save();

            return response()->json([
                'status' => true,
                'message' => 'Discount code has been created successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    // Show the form for editing the specified discount code
    public function edit($id)
    {
        $coupon = DiscountCoupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    // Update the specified discount code in storage
    public function update(Request $request, $id)
    {
        $discountCode = DiscountCoupon::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:discount_coupons,code,' . $discountCode->id . '|max:255',
            'name' => 'nullable|max:255',
            'description' => 'nullable|string',
            'max_users' => 'nullable|integer|min:0',
            'max_uses_users' => 'nullable|integer|min:0',
            'type' => 'required|in:percentage,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:0,1',
            'starts_at' => 'nullable|date|after_or_equal:today',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        if ($validator->passes()) {

            // Update the discount code fields
            $discountCode->code = $request->input('code');
            $discountCode->name = $request->input('name');
            $discountCode->description = $request->input('description');
            $discountCode->max_users = $request->input('max_users');
            $discountCode->max_uses_users = $request->input('max_uses_users');
            $discountCode->type = $request->input('type');
            $discountCode->discount_amount = $request->input('discount_amount');
            $discountCode->min_amount = $request->input('min_amount');
            $discountCode->status = $request->input('status');
            $discountCode->starts_at = $request->input('starts_at');
            $discountCode->expires_at = $request->input('expires_at');

            $discountCode->save();

            return response()->json([
                'status' => true,
                'message' => 'Discount code has been updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    // Remove the specified discount code from storage
    public function destroy($id)
    {
        $discountCode = DiscountCoupon::findOrFail($id);
        $discountCode->delete();

        return response()->json([
            'status' => true,
            'message' => 'Discount code has been deleted successfully',
        ]);
    }
}
