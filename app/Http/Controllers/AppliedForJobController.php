<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use Illuminate\Support\Facades\DB;
use App\Models\Appliedforjobuserlist;

class AppliedForJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(($count = count($data = DB::table('appliedforjobuserlist')
            ->leftJoin('useraccount', 'useraccount.id', '=', 'appliedforjobuserlist.applied_user_id')
            ->leftJoin('circular', 'circular.id', '=', 'appliedforjobuserlist.circular_id')
            ->select('appliedforjobuserlist.id as id', 'appliedforjobuserlist.circular_id as circular_id',
                     'appliedforjobuserlist.company_id as company_id', 'appliedforjobuserlist.applied_user_id as applied_user_id',
                     'appliedforjobuserlist.company_checked_notification', 'appliedforjobuserlist.created_at as appliedForCircularAt', 'useraccount.name as name',
                     'circular.job_name as circular_name')
            ->where('appliedforjobuserlist.company_id', $request->session()->get('userId'))
            ->orderBy('appliedforjobuserlist.created_at', 'DESC')->skip(0)->take(15)->get())) > 0){
                if(($countChecked = count($dataChecked = DB::table('appliedforjobuserlist')
                    ->leftJoin('useraccount', 'useraccount.id', '=', 'appliedforjobuserlist.applied_user_id')
                    ->leftJoin('circular', 'circular.id', '=', 'appliedforjobuserlist.circular_id')
                    ->select('appliedforjobuserlist.id as id', 'appliedforjobuserlist.circular_id as circular_id',
                            'appliedforjobuserlist.company_id as company_id', 'appliedforjobuserlist.applied_user_id as applied_user_id',
                            'appliedforjobuserlist.company_checked_notification', 'useraccount.name as name',
                            'circular.job_name as circular_name')
                    ->where('appliedforjobuserlist.company_id', $request->session()->get('userId'))
                    ->where('appliedforjobuserlist.company_checked_notification', 'no')->get())) > 0){
                    $data[0]->count = $countChecked;
                    return $data;
                }
                else{
                    $data[0]->count = "";
                    return $data;
                }
            // $data[0]->count = $count;
            // return $data;
        }
        else{
            return "nobody applied yet";
        }
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
        
        if($request->session()->has('userType') && $request->session()->get('userType') == "user" && $request->session()->has('userId') && $request->session()->get('userId') != "" && $request->userId != "" && $request->circularId != ""){
            $data = new Appliedforjobuserlist();
            $data->circular_id = $request->circularId;
            $data->company_id = $request->companyId;
            $data->applied_user_id = $request->userId;
            $data->company_checked_notification = "no";
            if($data->save()){
                return "success";
            }
            else{
                return "failed";
            }
        }
        else{
            return "not authorized user";
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
        if(Appliedforjobuserlist::where('company_id', '=', $id)->where('company_checked_notification', '=', 'no')->update(['company_checked_notification' => 'yes'])){
            return "success";
        }
        else{
            return "notification change could not take place";
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
        if($request->userType == "user"){
            if(count($data = DB::table('appliedforjobuserlist')->where('circular_id', $id)->where('applied_user_id', $request->session()->get('userId'))->get()) == 1){
                return "applied";
            }
            else{
                return "not applied";
            }
        }
        else if($request->userType == "companyUser" && $request->userId == $request->session()->get('userId')){
            
            if(count($data = DB::table('circular')->where('id', $id)->where('company_id', $request->userId)->get()) == 1){
                if(count($getAppliedCircularData = DB::table('appliedforjobuserlist')
                ->leftJoin('useraccount', 'useraccount.id', '=', 'appliedforjobuserlist.applied_user_id')
                ->select('appliedforjobuserlist.id as id', 'appliedforjobuserlist.circular_id as circular_id', 'appliedforjobuserlist.applied_user_id as applied_user_id', 'useraccount.name as name')
                ->where('appliedforjobuserlist.circular_id', $id)
                ->get()) > 0){
                    return $getAppliedCircularData;
                }
                else{
                    return "nobody applied yet";
                }
            }
            else{
                return "this user did not upload the circular";
            }
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
}
