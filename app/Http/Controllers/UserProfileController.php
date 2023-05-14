<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Location;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();
        if($userDetail) {
            return view('profile.user', compact('user'));
        } else {
            $userDetail = UserProfile::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]);
            
            return view('profile.user', compact('user'));
        }
    }

    public function admin()
    {
        $user = Auth::user();
        return view('profile.admin', compact('user'));
    }

    public function detailUser()
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();
        $locations = Location::all();
        return view('profile.userDetail', compact('user', 'userDetail', 'locations'));
    }

    public function updateDetailUser(Request $request)
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();

        $userDetail->update([
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'location' => $request->location,
            'sname' => $request->sname,
            'semail' => $request->semail,
            'scity' => $request->scity,
            'saddress' => $request->saddress,
            'szip_code' => $request->szip_code,
            'slocation' => $request->slocation,
        ]);

        $userDetail->save();

        return view('profile.userDetail');
    }

    public function orderUser()
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();
        $locations = Location::all();
        $orders = Order::where('user_id', $user->id)->get();
        return view('profile.userOrder', compact('user', 'userDetail', 'locations', 'orders'));
    }

    public function detailOrderUser(Order $order) 
    {
        $user = Auth::user();
        $userDetail = UserProfile::where('user_id', $user->id)->first();
        $locations = Location::all();
        $carts = Cart::where('order_id', $order->id)->get();
        $order = Order::where('id', $order->id)->first();
        return view('profile.userOrderDetail', compact('userDetail', 'locations', 'carts', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
