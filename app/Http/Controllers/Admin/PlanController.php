<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePlanRequest;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(MembershipPlan::all());
    }

    public function store(StorePlanRequest $request)
    {
        $plan = MembershipPlan::create($request->validated());

        return response()->json([
            'message' => 'Membership plan created successfully',
            'data' => $plan
        ], 201);
    }

    public function update(StorePlanRequest $request, MembershipPlan $plan)
    {
        $plan->update($request->validated());

        return response()->json([
            'message' => 'Membership plan updated successfully',
            'data' => $plan
        ]);
    }

    public function destroy(MembershipPlan $plan)
    {
        $plan->delete();

        return response()->json([
            'message' => 'Membership plan deleted'
        ]);
    }
}
