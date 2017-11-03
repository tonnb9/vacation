<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacation = new Vacation();

        $user = Auth::guard('api')->user();
        if($user->is_admin){
            $result = $vacation->all();
        }else{
            $result = $user->vacation;
        }

        return response()->json($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacationRequest $request)
    {
        $result = Vacation::create([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'user_id' => Auth::guard('api')->id(),
            'approved' => 0
        ]);

        return response()->json($result, 201);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VacationRequest $request, $id)
    {
        $vacation = new Vacation();
        $vacation = $vacation->find($id);
        if($vacation->user_id == Auth::guard('api')->id()){
            $vacation->from_date = $request->from_date;
            $vacation->to_date = $request->to_date;
            $vacation->save();
            return response()->json($vacation, 200);
        }else{
            return response()->json(['error' => 'Unauthorized to perform this action'], 401);
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
        $vacation = new Vacation();
        $vacation = $vacation->find($id);
        if($vacation->user_id == Auth::guard('api')->id()){
            $vacation->delete();
            return response()->json(null, 204);
        }
        return response()->json(['error' => 'Unauthorized to perform this action'], 401);
    }

    public function approveVacation($id){
        $user = Auth::guard('api')->user();
        if($user->is_admin){
            $vacation = new Vacation();
            $vacation = $vacation->find($id);
            $vacation->approved = 1;
            $vacation->save();
            return response()->json(null, 204);
        }
        return response()->json(['error' => 'Unauthorized to perform this action'], 401);
    }
}
