<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEventRequest;

class EventController extends Controller
{
    public function store(StoreEventRequest $request, $topic)
    {
        $subscription = Subscription::where('slug', $topic)->firstOrFail();  //find the subscription am making a request under...
        DB::beginTransaction();
        $event = new Event;
        $event->subscription_id = $subscription->id;
        $event->message = $request->message;
        $event->save();
        
        DB::commit();

        return response()->json([
            'topic' => $subscription
            'data' => $event
        ]);
    }
}
