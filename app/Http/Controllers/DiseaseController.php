<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\DataTables\DiseaseDataTable;
use App\Models\Disease;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DiseaseDataTable $dataTable)
    {
        //
        $breadcrumbs = [
            ['link' => url(""), 'name' => 'Dashboard'],
            ['link' => url("panel/gsetting/diseases"), 'name' => 'Disease'],
            ['name' => __('Disease')],
        ];
        return $dataTable->render('generalsetting.disease', ['breadcrumbs' => $breadcrumbs]);
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
        // return 'ss';

        try{

            $request->validate([
                
                'status' => 'required'
            ]);
            // return 'ss';

            // return $request->id;
            if($request->id){
                // return 'ss';
                $disease = Disease::find($request->id);
                if($request->name != $disease->name){
                    $request->validate([
                        'name'  => 'required|max:255|unique:diseases,name,',
                        
                    ]); 
                }
                $messsage = "Disease Successfull Udated";
                $data = $request->except('_token');
                
                $disease->name = $request->name;
                $disease->status = $request->status;
                $disease->save();
            }else{
                $request->validate([
                'name'  => 'required|max:255|unique:diseases,name,',
                    
                ]);
                $data = $request->except('_token');
                $user = Disease::Create($data);
                $messsage = "New Disease Successfull Created";

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

            $data = Disease::find($id);
           
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
    }
}
