<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    public function store(SubscriptionRequest $request)
    {
        DB::beginTransaction();
        $subscription = new Subscription;
        $subscription->name =  $request->name;
        $subscription->slug = Str::slug($request->name);
        $subscription->save();
        DB::commit();

        return response()->json($subscription);
    }
}
