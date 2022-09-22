<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use Illuminate\Support\Facades\DB;
use App\Models\Appliedforjobuserlist;
use App\Models\Circular;

class PaginationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->getDataType == "pagination" && $request->fromTable == "userAndCompany" && $request->selectedJobTypeIdForSearch == ""){
            $skip = ($id - 1) * $request->getNumberOfData;
            $take = $request->getNumberOfData;
            if($request->userType == "user" || $request->userType == "notAuthorizedUser"){
                if(($count = Companyaccount::where("id", "<>", 1)->count()) > 0){
                    if(count($data = DB::table('companyaccount')->where("id", "<>", 1)->skip($skip)->take($take)->orderBy('company_name')->get()) > 0 ){
                        $totalProfilePages = $count / $request->getNumberOfData;
                        $data[0]->totalProfilePages = ceil($totalProfilePages);
                        $data[0]->totalProfilesFound = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }
                }
                else{
                    return "no data found";
                }
            }
            else if($request->userType == "companyUser"){
                if(($count = Useraccount::count()) > 0){
                    if(count($data = DB::table('useraccount')->skip($skip)->take($take)->orderBy('name')->get()) > 0 ){
                        $totalProfilePages = $count / $request->getNumberOfData;
                        $data[0]->totalProfilePages = ceil($totalProfilePages);
                        $data[0]->totalProfilesFound = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }
                }
                else{
                    return "no data found";
                }
            }

        }
        else if($request->getDataType == "pagination" && $request->fromTable == "userAndCompany" && $request->selectedJobTypeIdForSearch != ""){
            $skip = ($id - 1) * $request->getNumberOfData;
            $take = $request->getNumberOfData;
            if($request->userType == "companyUser"){
                if(($count = Useraccount::where('job_type_id', $request->selectedJobTypeIdForSearch)->count()) > 0){
                    if(count($data = DB::table('useraccount')->skip($skip)->take($take)->where('job_type_id', $request->selectedJobTypeIdForSearch)->orderBy('created_at', 'DESC')->get()) > 0 ){
                        $totalProfilePages = $count / $request->getNumberOfData;
                        $data[0]->totalProfilePages = ceil($totalProfilePages);
                        $data[0]->totalProfilesFound = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }
                }
                else{
                    return "no data found";
                }
            }

        }
        
        if($request->getDataType == "pagination" && $request->fromTable == "circular" && $request->selectedJobTypeIdForSearch == ""){
            if($request->session()->has("userType") && $request->session()->get("userType") == "companyUser"){
                $skip = ($id - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = Circular::count()) > 0){

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
                    ->skip($skip)->take($take)
                    ->get()) > 0){
                        $totalPages = $count / $request->getNumberOfData;
                        $data[0]->totalPages = ceil($totalPages);
                        $data[0]->totalResults = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }

                    // DO NOT DELETE
                    // Previous way to get circular

                    // if(count($data = DB::table('circular')->skip($skip)->take($take)->orderBy('deadline', 'DESC')->get()) > 0 ){
                    //     $totalPages = $count / $request->getNumberOfData;
                    //     $data[0]->totalPages = ceil($totalPages);
                    //     $data[0]->totalResults = $count;
                    //     return $data;
                    // }
                    // else{
                    //     return "no data found";
                    // }
                }
                else{
                    return "no data found";
                }
            }
            else{
                $skip = ($id - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = Circular::whereDate('deadline', '>=', date('Y-m-d'))->count()) > 0){
                    if(count($data = DB::table('circular')->skip($skip)->take($take)->whereDate('deadline', '>=', date('Y-m-d'))->orderBy('deadline', 'DESC')->get()) > 0 ){
                        $totalPages = $count / $request->getNumberOfData;
                        $data[0]->totalPages = ceil($totalPages);
                        $data[0]->totalResults = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }
                }
                else{
                    return "no data found";
                }
            }
        }
        else if($request->getDataType == "pagination" && $request->fromTable == "circular" && $request->selectedJobTypeIdForSearch != ""){
            if($request->session()->has("userType") && $request->session()->get("userType") == "companyUser"){
                $skip = ($id - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = Circular::where('job_type_id', $request->selectedJobTypeIdForSearch)->count()) > 0){
                    
                    
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
                    ->where('circular.job_type_id', $request->selectedJobTypeIdForSearch)
                    ->groupBy('circular.id')
                    ->orderBy('circular.deadline','DESC')
                    ->skip($skip)->take($take)
                    ->get()) > 0){
                        $totalPages = $count / $request->getNumberOfData;
                        $data[0]->totalPages = ceil($totalPages);
                        $data[0]->totalResults = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }
                    
                    
                    // DO NOT DELETE
                    // Previous way to get circular
                    
                    // if(count($data = DB::table('circular')->skip($skip)->take($take)->where('job_type_id', $request->selectedJobTypeIdForSearch)->orderBy('deadline', 'DESC')->get()) > 0 ){
                    //     $totalPages = $count / $request->getNumberOfData;
                    //     $data[0]->totalPages = ceil($totalPages);
                    //     $data[0]->totalResults = $count;
                    //     return $data;
                    // }
                    // else{
                    //     return "no data found";
                    // }
                }
                else{
                    return "no data found";
                }
            }
            else{
                $skip = ($id - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = Circular::where('job_type_id', $request->selectedJobTypeIdForSearch)->whereDate('deadline', '>=', date('Y-m-d'))->count()) > 0){
                    if(count($data = DB::table('circular')->skip($skip)->take($take)->where('job_type_id', $request->selectedJobTypeIdForSearch)->whereDate('deadline', '>=', date('Y-m-d'))->orderBy('deadline', 'DESC')->get()) > 0 ){
                        $totalPages = $count / $request->getNumberOfData;
                        $data[0]->totalPages = ceil($totalPages);
                        $data[0]->totalResults = $count;
                        return $data;
                    }
                    else{
                        return "no data found";
                    }
                }
                else{
                    return "no data found";
                }
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
