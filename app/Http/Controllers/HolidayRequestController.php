<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HolidayRequest;

class HolidayRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return redirect ('/home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('holiday_request_views.create');
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
        if($this->validate_request()){
            $holiday_request= new HolidayRequest();

            $holiday_request->fkUserId= $request->user_id;
            $holiday_request->started_at= $request->date_from;
            $holiday_request->finished_at= $request->date_to;
            $holiday_request->notes= $request->notes;
            
            $holiday_request->save();
            return redirect()->route('home');
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
        $data['holiday_request']= HolidayRequest::where('id', $id)->first();
        if(!$data['holiday_request']){
            abort(404);
        }
        else{
            return  view('holiday_request_views.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($get_data)
    {
        //
        if(! $get_data ){
            abort(404);
        }
        else{
            $data['holiday_request']= HolidayRequest::where('id', $get_data)->first();
            return  view('holiday_request_views.edit', $data);
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
        if($this->validate_request()){
            $holiday_request= HolidayRequest::find($id);
            
            $holiday_request->started_at= $request->date_from;
            $holiday_request->finished_at= $request->date_to;
            $holiday_request->notes= $request->notes;
            
            if($request->sumbit_to_manager){
                $holiday_request->submit_to_manager= 'yes';
                $holiday_request->submit_to_manager_at= date("Y-m-d H:i:s");
            }
            
            $holiday_request->save();
            return redirect()->route('home');
        }
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

    public function validate_request(){
        return  request()->validate([
            'date_from'  => 'required|date|after:now -1day', 
            'date_to' => 'required|date|after:date_from',
            'notes'  =>  'required',
        ]);
    }
}
