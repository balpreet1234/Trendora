<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;

class UserSellerController extends Controller
{
     //index page of users
     public function user_index()
     {
         $data = User::orderBy('id','desc')->where('role','user')->get();
         return view('admin.pages.user.index', compact('data'));
     }

      //index page of seller
      public function seller_index()
      {
          $data = User::orderBy('id','desc')->where('role','merchant')->get();
          return view('admin.pages.seller.index', compact('data'));
      }

       //create page of seller
      public function seller_create()
      {
          $countries = DB::table('countries')->get();

          return view('admin.pages.seller.create', compact('countries'));
      }

      //view page for user
      public function user_view(Request $request,$id){
        $user = User::find($id);
        return view('admin.pages.user.view',compact('user'));

      }

      //get states
      public function getStates($countryId)
      {
          $states = DB::table('states')->where('country_id', $countryId)->get();
          return response()->json($states);
      }

      //get cities
      public function getCities($stateId)
      {
          $cities = DB::table('cities')->where('state_id', $stateId)->get();
          return response()->json($cities);
      }

      //store seller details
      public function seller_store(Request $request)
      {

          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email',
              'password' => 'required|string|min:8',
              'phone' => 'nullable|string|max:255',
              'address' => 'nullable|string|max:255',
              'country_id' => 'required|exists:countries,id',
              'state_id' => 'required|exists:states,id',
              'city_id' => 'required|exists:cities,id',
              'zipcode' => 'nullable|string|max:15',
              'status' => 'required|in:active,inactive',
          ]);


          $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => bcrypt($request->password),
              'phone' => $request->phone,
              'address' => $request->address,
              'country_id' => $request->country_id,
              'state_id' => $request->state_id,
              'city_id' => $request->city_id,
              'zipcode' => $request->zipcode,
              'role' =>$request->role,
              'status' => $request->status,
          ]);

          return redirect()->route('seller.index')->with('success', 'Seller created successfully.');
      }


     public function seller_edit(Request $request, $id)
     {
        $countries = DB::table('countries')->get();
        $seller=User::find($id);
         return view('admin.pages.seller.create', compact('seller','countries'));
     }

     public function seller_update(Request $request, $id)
     {
         $seller = User::findOrFail($id);

         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'zipcode' => 'nullable|string|max:15',
            'status' => 'required|in:active,inactive',
        ]);


         $seller->name = $request->name;
         $seller->email = $request->email;


         if ($request->password) {
             $seller->password = Hash::make($request->password);
         }

         $seller->phone = $request->phone;
         $seller->address = $request->address;
         $seller->country_id = $request->country_id;
         $seller->state_id = $request->state_id;
         $seller->city_id = $request->city_id;
         $seller->zipcode = $request->zipcode;
         $seller->status = $request->status;

         $seller->save();

         return redirect()->route('seller.index')->with('success', 'Seller updated successfully.');
     }

//seller delete
     public function seller_destroy($id)
     {
         $seller = User::findOrFail($id);
         $seller->delete();

         return redirect()->route('seller.index')->with('success', 'Seller deleted successfully.');
     }

     //user delete
     public function user_destroy($id)
     {
         $seller = User::findOrFail($id);
         $seller->delete();

         return redirect()->route('user.index')->with('success', 'Seller deleted successfully.');
     }


     public function admin_profile($id)
    {

        // $user = Auth::user() ?? 1;
        $user= User::find($id);


        return view('admin.pages.admin_profile', compact('user'));
    }

     // Show the edit form for the admin
     public function admin_edit($id)
     {
         $admin = User::findOrFail($id);
         $countries = DB::table('countries')->get();
         return view('admin.pages.admin_edit', compact('admin', 'countries'));
     }

     // Update the admin details
     public function admin_update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users,email,' . $id,
             'password' => 'nullable|string|min:8',
             'phone' => 'nullable|string|max:15',
             'address' => 'nullable|string|max:255',
             'country_id' => 'nullable|exists:countries,id',
             'state_id' => 'nullable|exists:states,id',
             'city_id' => 'nullable|exists:cities,id',
             'zipcode' => 'nullable|string|max:10',
             'status' => 'required|in:active,inactive',
         ]);

         $admin = User::findOrFail($id);
         $admin->name = $request->name;
         $admin->email = $request->email;
         if ($request->password) {
             $admin->password = bcrypt($request->password); // Hash the password
         }
         $admin->phone = $request->phone;
         $admin->address = $request->address;
         $admin->country_id = $request->country_id;
         $admin->state_id = $request->state_id;
         $admin->city_id = $request->city_id;
         $admin->zipcode = $request->zipcode;
         $admin->status = $request->status;
         $admin->save();

         return redirect()->route('dashboard')->with('success', 'Admin updated successfully!');
     }
}
