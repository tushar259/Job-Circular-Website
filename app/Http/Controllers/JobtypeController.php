<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobtype;
use App\Models\Circular;
use Illuminate\Support\Facades\DB;


class JobtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return DB::table('jobtype')->orderBy('jobtype_name')->get();
        if(count($data = Jobtype::select('id','jobtype_name')->orderBy('jobtype_name')->get()) > 0){
            return $data;
        }
        else{
            return "data not found";
        }
        //$jobtype = Jobtype::all();
        //echo $jobtype;
		//return $jobtype;
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
        $data = new Circular();
		$data->job_name = $request->jobName;
        $data->company_id = $request->session()->get('userId');
		$data->company_name = $request->companyName;
		$data->employment_status = $request->employmentStatus;
        $data->job_type_id = $request->jobType;
        $data->education_req = $request->educationReq;
        $data->experience_req = $request->experienceReq;
        $data->job_responsibility = $request->jobResponsibility;
        $data->more_req = $request->moreReq;
        $data->job_location = $request->jobLocation;
        $data->salary = $request->salary;
        $data->other_benefits = $request->otherBenefits;
        $data->read_before_apply = $request->readBeforeApply;
        $data->vacancy = $request->vacancy;
        $data->deadline = $request->deadline;

		if($data->save ()){
            return "success";
        }
        else{
            return "something went wrong";
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
        if(count($data = DB::table('jobtype')->where('id',$id)->get()) > 0){
            return $data;
        }
        else{
            return "no data found";
        }
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
