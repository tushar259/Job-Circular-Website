<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobtype;
use App\Models\Circular;
use App\Models\Appliedforjobuserlist;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class CircularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return DB::table('circular')
        // ->join('jobtype', 'jobtype.id', '=', 'circular.job_type_id')
        // ->select('circular.id','circular.job_name','circular.company_name','circular.employment_status','circular.job_type_id','jobtype.jobtype_name','circular.education_req','circular.experience_req','circular.job_responsibility','circular.more_req','circular.salary','circular.other_benefits','circular.read_before_apply','circular.vacancy','circular.job_location','circular.deadline')
        // ->orderBy('circular.deadline', 'DESC')
        // ->get();
        // ->skip(5)->take(10)
        $deletedCircularData = $this->deleteCircularDataCalled($request);

        if($request->session()->has("userType") && $request->session()->get("userType") == "companyUser"){
            if(($count = Circular::count()) > 0){
                // return $count;
                // $users = Circular::orderBy('deadline','DESC')->simplePaginate(5);
                // return $users;



                if(count($data = DB::table('circular')
                ->leftJoin('appliedforjobuserlist', 'circular.id', '=', 'appliedforjobuserlist.circular_id')
                ->select('circular.id as id',
                        DB::raw('
                            GROUP_CONCAT(DISTINCT(circular.job_name)) as job_name, GROUP_CONCAT(DISTINCT(circular.company_id)) as company_id,
                            GROUP_CONCAT(DISTINCT(circular.company_name)) as company_name, GROUP_CONCAT(DISTINCT(circular.employment_status)) as employment_status,
                            GROUP_CONCAT(DISTINCT(circular.job_type_id)) as job_type_id, GROUP_CONCAT(DISTINCT(circular.education_req)) as education_req,
                            GROUP_CONCAT(DISTINCT(circular.experience_req)) as experience_req, GROUP_CONCAT(DISTINCT(circular.job_responsibility)) as job_responsibility,
                            GROUP_CONCAT(DISTINCT(circular.more_req)) as more_req, GROUP_CONCAT(DISTINCT(circular.salary)) as salary,
                            GROUP_CONCAT(DISTINCT(circular.other_benefits)) as other_benefits, GROUP_CONCAT(DISTINCT(circular.read_before_apply)) as read_before_apply,
                            GROUP_CONCAT(DISTINCT(circular.vacancy)) as vacancy, GROUP_CONCAT(DISTINCT(circular.job_location)) as job_location,
                            GROUP_CONCAT(DISTINCT(circular.deadline)) as deadline
                        '),
                        DB::raw('COUNT(appliedforjobuserlist.circular_id) as appliedUsersCount')
                )
                ->groupBy('circular.id')
                ->orderBy('circular.deadline','DESC')
                ->skip(0)->take(20)
                ->get()) > 0){
                    $totalPages = $count / 20;
                    $data[0]->totalPages = ceil($totalPages);
                    $data[0]->totalResults = $count;

                    return $data;
                }
                else{
                    return "no circular data found";
                }


                // DO NOT DELETE
                // Previous way to get circular

                // if(count($data = DB::table('circular')
                // ->select('circular.id as id','circular.job_name as job_name',
                //     'circular.company_id as company_id','circular.company_name as company_name',
                //     'circular.employment_status as employment_status','circular.job_type_id as job_type_id',
                //     'circular.education_req as education_req','circular.experience_req as experience_req',
                //     'circular.job_responsibility as job_responsibility','circular.more_req as more_req',
                //     'circular.salary as salary','circular.other_benefits as other_benefits',
                //     'circular.read_before_apply as read_before_apply','circular.vacancy as vacancy',
                //     'circular.job_location as job_location','circular.deadline as deadline',
                // )
                // ->orderBy('circular.deadline','DESC')
                // ->skip(0)->take(20)
                // ->get()) > 0){
                //     $totalPages = $count / 20;
                //     $data[0]->totalPages = ceil($totalPages);
                //     $data[0]->totalResults = $count;

                //     return $data;
                // }
                // else{
                //     return "no circular data found";
                // }
            }
            else{
                return "no circular data found";
            }
        }
        else{
            if(($count = Circular::whereDate('deadline', '>=', date('Y-m-d'))->count()) > 0){
                // return $count;
                // $users = Circular::orderBy('deadline','DESC')->simplePaginate(5);
                // return $users;

                if(count($data = Circular::select('id','job_name','company_id','company_name','employment_status','job_type_id','education_req','experience_req','job_responsibility','more_req','salary','other_benefits','read_before_apply','vacancy','job_location','deadline')
                        ->skip(0)->take(20)->whereDate('deadline', '>=', date('Y-m-d'))->orderBy('deadline','DESC')->get()) > 0){
                    $totalPages = $count / 20;
                    $data[0]->totalPages = ceil($totalPages);
                    $data[0]->totalResults = $count;
                    return $data;
                }
                else{
                    return "no circular data found";
                }
            }
            else{
                return "no circular data found";
            }
        }
    }

    public function deleteCircularDataCalled($request){
        if(count($deleteData = Circular::whereDate('will_be_deleted_at', '<', date('Y-m-d'))->get()) > 0){
            $idsOfRows = array();
            foreach($deleteData as $value){
                array_push($idsOfRows, $value->id);
            }
            if(Circular::whereIn('id', $idsOfRows)->delete()){
                if(Appliedforjobuserlist::whereIn('circular_id', $idsOfRows)->delete()){
                    return "success";
                }
                else{
                    return "could not delete";
                }
            }
            else{
                return "could not delete";
            }
        }
        else{
            return "no data left to delete";
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
        if($request->jobName == ""){
            return "Job position cannot be empty";
        }
        else if($request->companyName == ""){
            return "Company name cannot be empty";
        }
        else if($request->jobType == ""){
            return "Select any option";
        }
        else if($request->jobLocation == ""){
            return "Location cannot be empty";
        }
        else if($request->salary == ""){
            return "Write a amount with currency";
        }
        else if($request->deadline == ""){
            return "Please select a deadline";
        }
        else if($request->jobName != "" &&
                $request->companyName != "" &&
                $request->jobType != "" &&
                $request->jobLocation != "" &&
                $request->salary != "" &&
                $request->deadline != ""
                ){
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
                    $dayAfter = (new DateTime($request->deadline))->modify('+40 day')->format('Y-m-d H:i:s');
                    $data->will_be_deleted_at = $dayAfter;

                    if($data->save ()){
                        return "success";
                    }
                    else{
                        return "something went wrong";
                    }
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
    public function show($id, Request $request)
    {
        if($request->session()->has("userType") && $request->session()->get("userType") == "companyUser"){
            if(count($data = DB::table('circular')->where('id',$id)->get()) > 0){
                return $data;
            }
            else{
                return "data not found";
            }
        }
        else{
            if(count($data = DB::table('circular')->where('id',$id)->whereDate('deadline', '>=', date('Y-m-d'))->get()) > 0){
                return $data;
            }
            else{
                return "data not found";
            }
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
        if($request->job_name == ""){
            return "Job position cannot be empty";
        }
        else if($request->company_name == ""){
            return "Company name cannot be empty";
        }
        else if($request->job_type_id == ""){
            return "Select any option";
        }
        else if($request->job_location == ""){
            return "Location cannot be empty";
        }
        else if($request->salary == ""){
            return "Write a amount with currency";
        }
        else if($request->deadline == ""){
            return "Please select a deadline";
        }
        else if($request->job_name != "" &&
                $request->company_name != "" &&
                $request->job_type_id != "" &&
                $request->job_location != "" &&
                $request->salary != "" &&
                $request->deadline != ""
                ){

                    $data = Circular::where('id', $id)->first();
                    $data->job_name = $request->job_name;
                    $data->company_name = $request->company_name;
                    $data->employment_status = $request->employment_status;
                    $data->education_req = $request->education_req;
                    $data->experience_req = $request->experience_req;
                    $data->job_responsibility = $request->job_responsibility;
                    $data->more_req = $request->more_req;
                    $data->job_location = $request->job_location;
                    $data->salary = $request->salary;
                    $data->other_benefits = $request->other_benefits;
                    $data->read_before_apply = $request->read_before_apply;
                    $data->vacancy = $request->vacancy;
                    $data->deadline = $request->deadline;

                    if((isset($request->jobType)) && $request->jobType != null){
                        $data->job_type_id = $request->jobType;
                    }
                    else{
                        $data->job_type_id = $request->job_type_id;
                    }

                    if($data->save()){
                        return "success";
                    }
                    else{
                        return "something went wrong";
                    }
        }
        else{
            return "something went wrong";
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
        if(Circular::find( $id )->delete()){
            return "success";
        }
        else{
            return "could not delete";
        }
    }
}
