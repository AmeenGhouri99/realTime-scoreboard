<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Events\ItemAdded;

class ItemController extends Controller
{
    /**
     * Show the list of items.
     */
    public function index()
    {
        return view('items.index');
    }
    public function checkLiveItems()
    {
        event(new ItemAdded());

        return view('items.check_live_items');
    }

    /**
     * Store a new item and broadcast the event.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new item
        $item = Item::create([
            'name' => $request->name,
        ]);

        // Broadcast the item added event
        event(new ItemAdded($item));

        return redirect()->back()->with('success', 'Item added successfully!');
    }
    public function sseForDashboard()
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        $data = Item::first('name');

        $eventData = [
            'testData' => $data->name,
        ];

        // error_log(print_r(headers_list(), true)); // Log the headers to the PHP error log

        echo "data: " . json_encode($eventData) . "\n\n";
        ob_flush();
        flush();
    }
}
