<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Item;
use App\Models\User;
use App\Models\item_pic;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function listing(Request $request) {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'location' => 'required',
            'check' => 'required|',
            'images' => 'required|array',
        ]);
        $item = Item::create([
            'title' => $request->name,
            'description' => $request->description,
            'condition' => $request->condition,
            'points_required' => $request->price,
            'category' => $request->category,
            'location' => $request->location,
            'user_id' => Auth::id()
        ]);
        foreach ($request->images as $image) {
            $path = $image->store('image','public');
            item_pic::create([
                'item_id' => $item->id,
                'image' => $path
            ]);
        }
        // $request->session()->flash('success', 'Item created successfully');
        return redirect()->route('home')->with([
            'success'=> 'Item created successfully'
        ]);

    }

    public function product($id) {
        $user_id = Auth::check()?Auth::id():null;
        $products = Item::with(['user','item_pics'])->find($id);
        $items = Item::where('category', $products->category)->where('status', '=', 'Available')->where('user_id', '!=', $user_id)->get();
        $cart_count = cart::where('user_id', '=', $user_id)->count();
        // return $cart_count;
        // return $products;
        return view('product',compact(['products','items','cart_count']));
    }

    public function category($id) {
        $id = Auth::check()?Auth::id():null;
        $items = Item::with(['user','item_pics'])->where('category','=',$id)->where('status', '=', 'Available')->where('id', '!=', $id)->paginate(20);
        
        // return $items;
        return view('home',compact('items'));
    }

    public function add_cart($id) {
        cart::create([
            'user_id' => Auth::id(),
            'item_id' => $id,
        ]);
        return redirect()->route('cart_list');
    }

    public function cart_list() {
        $carts = cart::with(['item','item_pics'])->get();
        // return $carts;
        return view('cart',compact('carts'));
    }

    public function remove_cart($id) {
        cart::find($id)->delete();
        return redirect()->back();
    }

    public function notification() {
        $authUserId = Auth::id();
        // For sender
        // Subquery to get the first notification id per item_id ordered by created_at ascending
        $firstNotifications = Notification::select(DB::raw('MIN(id) as first_id'))
            ->groupBy('item_id');

        // Join with notifications to get the first notification details
        $firstNotificationDetails = Notification::joinSub($firstNotifications, 'first_notif', function ($join) {
            $join->on('notifications.id', '=', 'first_notif.first_id');
        })
        ->where('notifications.sender_id', $authUserId)
        ->pluck('item_id');

        // Get notifications where item_id in those with first notification sender = auth user
        $senders = Notification::with(['sender', 'reciever', 'item', 'item_pics'])
            ->whereIn('item_id', $firstNotificationDetails)
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('item_id')
            ->sortKeysDesc();

            // For reciever
        $firstNotifications = Notification::select(DB::raw('MIN(id) as first_id'))
            ->groupBy('item_id');
        $firstNotificationDetails = Notification::joinSub($firstNotifications, 'first_notif', function ($join) {
                $join->on('notifications.id', '=', 'first_notif.first_id');
            })
        ->where('notifications.reciever_id', $authUserId)
        ->pluck('item_id');
        $recievers = Notification::with(['sender', 'reciever', 'item', 'item_pics'])
            ->whereIn('item_id', $firstNotificationDetails)
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('item_id')
            ->sortKeysDesc();

        // // Sort the grouped collection by item_id descending (biggest id at top)
        // $reciever = collect($reciever->sortKeysDesc()->all());

// return $recievers;
        return view('notification',compact('senders','recievers'));
    }

    public function set_notification($id) {
        $item = Item::find($id);
        // return $item;
        Notification::create([
            'sender_id' => Auth::id(),
            'reciever_id' => $item->user_id,
            'item_id' => $id,
            'message'=> 'Hi, I want to buy this item.',
            'is_read' => 0
        ]);
        Item::where('id', '=', $id)->update([
            'status' => 'Reserved'
        ]);
        return redirect()->route('notification');
    }
    
    public function send_notification(Request $request) {
        Notification::create([
            'sender_id' => Auth::id(),
            'reciever_id' => $request->user,
            'item_id' => $request->item,
            'message'=> $request->message,
        ]);
        return redirect()->route('notification');
    }

    public function send_time(Request $request) {
        Notification::create([
            'sender_id' => Auth::id(),
            'reciever_id' => $request->user,
            'item_id' => $request->item,
            'message'=> 'can we meet at '.$request->pickup_time.'?',
        ]);
        return redirect()->route('notification');
    }

    public function delete_notification($id){
        $user = Item::find($id);
        $user_id = $user->user_id;
        User::where('id', '=', $user_id)->update([
            'points_balance' => User::find($user_id)->points_balance + $user->points_required,
        ]);
        User::where('id', '=', Auth::id())->update([
            'points_balance' => Auth::user()->points_balance - $user->points_required,
        ]);
        Notification::create([
            'sender_id' => Auth::id(),
            'reciever_id' => $user_id,
            'item_id' => $id,
            'message'=> 'I am recieved this item.',
        ]);
        Notification::where('item_id', '=', $id)->update([
            'closed' => 1
        ]);
        Item::where('id', '=', $id)->update([
            'status' => 'Completed'
        ]);
        return redirect()->route('notification');
    }
    public function cancel_notice($id){
        Notification::where('item_id', '=', $id)->update([
            'closed' => 1
        ]);
        Item::where('id', '=', $id)->update([
            'status' => 'Available'
        ]);
        return redirect()->route('notification');
    }
}
