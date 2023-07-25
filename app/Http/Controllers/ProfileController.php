<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    //

    public function adminProfile(){
        
        $breadcrumbs = [
           
            ['link' => url("/panel"), 'name' =>'Dashboard'],
            ['link' => url("panel/profile"), 'name' => 'profile'],
            ['name' => __('profile')],
        ];

        $user = auth()->user();
        // $countries = Country::get();

        return view('profile.profile-index',compact('user','breadcrumbs'));
    }

    public function adminProfileUpdate(Request $request){
        // return $request->all();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'state' => 'required',
            'phone_number' => 'required',  
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
        ]);

        $user = User::find(auth()->id());

        if($user->email != $request->email){
            $request->validate([
            'email' => 'required|email|unique:users', 
                
            ]);
            $user->email = $request->email;
        }
        if($request->password){
            $request->validate([
            'password' => 'required|confirmed|min:6'  

            ]);

            $user->password = Hash::make($request->password);
        }

        if($request->file('img')){
            $image_path = 'user-img'.$request->img;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $file= $request->file('img');
            $avatar= date('YmdHi').'.'.$file->extension();
            $file->move(public_path('user-img'), $avatar);
            $user->avatar = $avatar;
        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->countrie_id = $request->country;
        $user->state_id = $request->state; 
        $user->citie_id = $request->city;
        $user->save();

        return redirect()->back()->with('success','Profile Successfully Updated');

    }
}
