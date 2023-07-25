<?php

namespace App\Http\Controllers;
use App\DataTables\UserDataTable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        
        $breadcrumbs = [
            // ['link' => url(""), 'name' => 'Dashboard'],
            ['link' => url("users"), 'name' => 'User'],
            ['name' => __('User')],
        ];

        

        $pageConfigs = ['pageHeader' => false];
        return $dataTable->render('app.user.user-index', ['breadcrumbs' => $breadcrumbs]);
        // return view('app.user.user-index', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        try{

            $request->validate([
                'name' => 'required',
                'phone_number' => 'required'
            ]);

            // return $request->id;
            if($request->id){
                $user = User::find($request->id);
                if($request->email != $user->email){
                    $request->validate([
                        'email'  => 'required|max:255|unique:users,email,',
                        
                    ]); 
                }
                $messsage = "User Successfull Udated";
                $data = $request->except('_token');
                
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->save();
            }else{
                $request->validate([
                'email'  => 'required|max:255|unique:users,email,',
                    
                ]);
                $data = $request->except('_token');
                $data['password'] = Hash::make('123456');
                $data['is_user'] = 1;
                // return $data;
                $user = User::Create($data);
                $messsage = "New User Successfull Created";

            }

         

            $response = [
                'status' => 'success',
                'message' => $messsage
            ];
    
           
            return response()->json($response);
    
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
    
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        // return $id;
        try{

            $data = User::find($id);
           
            return response()->json($data);
    
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
    
            return response()->json($response);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return  $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $data = User::where('id',$id)->delete();
           
            $response = [
                'status' => 'success',
                'message' => 'User Successfully Deleted',
            ];
            return response()->json($response);
    
        } catch (\Throwable $th) {
            $response = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
    
            return response()->json($response);
        }

    }
}
