<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TestDataTable;
use App\Models\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TestDataTable $dataTable)
    {
        //
        $breadcrumbs = [
            ['link' => url(""), 'name' => 'Dashboard'],
            ['link' => url("panel/gsetting/test"), 'name' => 'Test'],
            ['name' => __('Test')],
        ];
        return $dataTable->render('generalsetting.test', ['breadcrumbs' => $breadcrumbs]);
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
                
                'status' => 'required'
            ]);
            // return 'ss';

            // return $request->id;
            if($request->id){
                // return 'ss';
                $test = Test::find($request->id);
                if($request->name != $test->name){
                    $request->validate([
                        'name'  => 'required|max:255|unique:tests,name,',
                        
                    ]); 
                }
                $messsage = "Test Successfull Udated";
                $data = $request->except('_token');
                
                $test->name = $request->name;
                $test->status = $request->status;
                $test->save();
            }else{
                $request->validate([
                'name'  => 'required|max:255|unique:tests,name,',
                    
                ]);
                $data = $request->except('_token');
                $test = Test::Create($data);
                $messsage = "New Test Successfull Created";

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

        try{

            $data = Test::find($id);
           
            return response()->json($data);

        }catch (\Throwable $th) {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{

            $data = Test::where('id',$id)->delete();
           
            $response = [
                'status' => 'success',
                'message' => 'Test Successfully Deleted',
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
