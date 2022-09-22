<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobtype;
use App\Models\Circular;
use App\Models\Companyaccount;
use App\Models\Useraccount;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
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
        if($id != ""){
            if(count($data = Circular::select('id','job_name','company_id','company_name','employment_status','job_type_id','education_req','experience_req','job_responsibility','more_req','salary','other_benefits','read_before_apply','vacancy','job_location','deadline')->where('job_type_id', $id)->orderBy('deadline','DESC')->get()) > 0){
                return $data;
            }
            else{
                return "no data found error";
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
        if($id != "" && $request->getDataType == "pagination" && $request->fromTable == "circular"){
            if($request->session()->has("userType") && $request->session()->get("userType") == "companyUser"){
                $skip = ($request->currentPage - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = Circular::where('job_type_id', $id)->count()) > 0){
                    if(count($data = Circular::select('id','job_name','company_id','company_name','employment_status','job_type_id','education_req','experience_req','job_responsibility','more_req','salary','other_benefits','read_before_apply','vacancy','job_location','deadline')->skip($skip)->take($take)->where('job_type_id', $id)->orderBy('deadline','DESC')->get()) > 0){
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
            else{
                $skip = ($request->currentPage - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = Circular::where('job_type_id', $id)->whereDate('deadline', '>=', date('Y-m-d'))->count()) > 0){
                    if(count($data = Circular::select('id','job_name','company_id','company_name','employment_status','job_type_id','education_req','experience_req','job_responsibility','more_req','salary','other_benefits','read_before_apply','vacancy','job_location','deadline')
                                    ->skip($skip)->take($take)->where('job_type_id', $id)->whereDate('deadline', '>=', date('Y-m-d'))->orderBy('deadline','DESC')->get()) > 0){
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
        if($request->whatToDo == "search"){
            if($request->whatToSearch == "circular"){
                if($request->session()->has("userType") && $request->session()->get("userType") == "companyUser"){
                    $skip = ($id - 1) * $request->getNumberOfData;
                    $take = $request->getNumberOfData;
                    // return Circular::select('id','job_name','company_id','company_name','employment_status','job_type_id','education_req','experience_req','job_responsibility','more_req','salary','other_benefits','read_before_apply','vacancy','job_location','deadline')->orderBy('deadline','DESC')->get();
                    if(($count = DB::table('circular')
                        ->leftJoin('jobtype', 'jobtype.id', '=', 'circular.job_type_id')
                        ->select('circular.id as id','circular.job_name as job_name','circular.company_id as company_id',
                        'circular.company_name as company_name','circular.employment_status as employment_status',
                        'circular.job_type_id as job_type_id','jobtype.jobtype_name as jobtype_jobtype_name',
                        'circular.education_req as education_req','circular.experience_req as experience_req',
                        'circular.job_responsibility as job_responsibility','circular.more_req as more_req','circular.salary as salary',
                        'circular.other_benefits as other_benefits','circular.read_before_apply as read_before_apply',
                        'circular.vacancy as vacancy','circular.job_location as job_location','circular.deadline as deadline')
                        ->where('circular.id', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.job_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.company_id', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.company_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.employment_status', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('jobtype.jobtype_name', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.education_req', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.experience_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_responsibility', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.more_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.salary', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.other_benefits', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.read_before_apply', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.vacancy', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_location', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.deadline', 'LIKE', '%'.$request->searchBy.'%')
                        ->orderBy('circular.deadline','DESC')->count()) > 0){



                            if(count($data = DB::table('circular')
                                ->leftJoin('jobtype', 'jobtype.id', '=', 'circular.job_type_id')
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
                                            GROUP_CONCAT(DISTINCT(circular.deadline)) as deadline, GROUP_CONCAT(DISTINCT(jobtype.jobtype_name)) as jobtype_name
                                        '),
                                        DB::raw('COUNT(appliedforjobuserlist.circular_id) as appliedUsersCount')
                                )
                            
                            ->where('circular.id', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.job_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.company_id', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.company_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.employment_status', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('jobtype.jobtype_name', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.education_req', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.experience_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_responsibility', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.more_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.salary', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.other_benefits', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.read_before_apply', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.vacancy', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_location', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('circular.deadline', 'LIKE', '%'.$request->searchBy.'%')
                            ->groupBy('circular.id')
                            // ->orderBy('circular.id')
                            ->orderBy('circular.job_name')
                            // ->orderBy('circular.deadline','DESC')
                            ->skip($skip)->take($take)
                            ->get()) > 0){
                    
                                $totalPages = $count / $request->getNumberOfData;
                                $data = $data->sortBy($request->searchBy);
                                $data[0]->totalPages = ceil($totalPages);
                                $data[0]->totalResults = $count;
                                return $data;
                            }
                            else{
                                return "no results found";
                            }


                            // DO NOT DELETE
                            // Previous way to get circular

                            // if(count($data = DB::table('circular')
                            //     ->leftJoin('jobtype', 'jobtype.id', '=', 'circular.job_type_id')
                            //     ->select('circular.id as id','circular.job_name as job_name','circular.company_id as company_id',
                            //     'circular.company_name as company_name','circular.employment_status as employment_status',
                            //     'circular.job_type_id as job_type_id','jobtype.jobtype_name as jobtype_jobtype_name',
                            //     'circular.education_req as education_req','circular.experience_req as experience_req',
                            //     'circular.job_responsibility as job_responsibility','circular.more_req as more_req','circular.salary as salary',
                            //     'circular.other_benefits as other_benefits','circular.read_before_apply as read_before_apply',
                            //     'circular.vacancy as vacancy','circular.job_location as job_location','circular.deadline as deadline')
                            //     ->skip($skip)->take($take)
                            //     ->where('circular.id', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.job_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.company_id', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.company_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.employment_status', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('jobtype.jobtype_name', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.education_req', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.experience_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_responsibility', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.more_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.salary', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.other_benefits', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.read_before_apply', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.vacancy', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_location', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orWhere('circular.deadline', 'LIKE', '%'.$request->searchBy.'%')
                            //     ->orderBy('circular.deadline','DESC')->get()) > 0){
                        
                            //         $totalPages = $count / $request->getNumberOfData;
                            //         $data[0]->totalPages = ceil($totalPages);
                            //         $data[0]->totalResults = $count;
                            //         return $data;
                            // }
                            // else{
                            //     return "no results found";
                            // }  
                    }
                    else{
                        return "no results found";
                    }
                }
                else{
                    $skip = ($id - 1) * $request->getNumberOfData;
                    $take = $request->getNumberOfData;
                    // return Circular::select('id','job_name','company_id','company_name','employment_status','job_type_id','education_req','experience_req','job_responsibility','more_req','salary','other_benefits','read_before_apply','vacancy','job_location','deadline')->orderBy('deadline','DESC')->get();
                    $searchDataFirst = DB::table('circular')
                        ->leftJoin('jobtype', 'jobtype.id', '=', 'circular.job_type_id')
                        ->select('circular.id as id','circular.job_name as job_name','circular.company_id as company_id',
                        'circular.company_name as company_name','circular.employment_status as employment_status',
                        'circular.job_type_id as job_type_id','jobtype.jobtype_name as jobtype_jobtype_name',
                        'circular.education_req as education_req','circular.experience_req as experience_req',
                        'circular.job_responsibility as job_responsibility','circular.more_req as more_req','circular.salary as salary',
                        'circular.other_benefits as other_benefits','circular.read_before_apply as read_before_apply',
                        'circular.vacancy as vacancy','circular.job_location as job_location','circular.deadline as deadline')
                        ->where('circular.id', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.job_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.company_id', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.company_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.employment_status', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('jobtype.jobtype_name', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.education_req', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.experience_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_responsibility', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.more_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.salary', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.other_benefits', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.read_before_apply', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.vacancy', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_location', 'LIKE', '%'.$request->searchBy.'%')
                        ->orWhere('circular.deadline', 'LIKE', '%'.$request->searchBy.'%')
                        ->orderBy('circular.deadline','DESC')->get();
                        
                        $dataFirst = array();
                        foreach($searchDataFirst as $value){
                            if($value->deadline >= date('Y-m-d')){
                                array_push($dataFirst, $value);
                            }
                        }
                        if(($count = count($dataFirst)) > 0){
                            
                            $searchData = DB::table('circular')
                                ->leftJoin('jobtype', 'jobtype.id', '=', 'circular.job_type_id')
                                ->select('circular.id as id','circular.job_name as job_name','circular.company_id as company_id',
                                'circular.company_name as company_name','circular.employment_status as employment_status',
                                'circular.job_type_id as job_type_id','jobtype.jobtype_name as jobtype_jobtype_name',
                                'circular.education_req as education_req','circular.experience_req as experience_req',
                                'circular.job_responsibility as job_responsibility','circular.more_req as more_req','circular.salary as salary',
                                'circular.other_benefits as other_benefits','circular.read_before_apply as read_before_apply',
                                'circular.vacancy as vacancy','circular.job_location as job_location','circular.deadline as deadline')
                                ->skip($skip)->take($take)
                                ->where('circular.id', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.job_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.company_id', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.company_name', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.employment_status', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('jobtype.jobtype_name', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.education_req', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.experience_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_responsibility', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.more_req', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.salary', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.other_benefits', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.read_before_apply', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.vacancy', 'LIKE', '%'.$request->searchBy.'%')->orWhere('circular.job_location', 'LIKE', '%'.$request->searchBy.'%')
                                ->orWhere('circular.deadline', 'LIKE', '%'.$request->searchBy.'%')
                                ->orderBy('circular.deadline','DESC')
                                ->get();
                                
                                $data = array();
                                foreach($searchData as $value){
                                    if($value->deadline >= date('Y-m-d')){
                                        array_push($data, $value);
                                    }
                                }
                                
                                if(count($data) > 0){
                                    $totalPages = $count / $request->getNumberOfData;
                                    $data[0]->totalPages = ceil($totalPages);
                                    $data[0]->totalResults = $count;
                                    return $data;
                            }
                            else{
                                return "no results found";
                            }  
                    }
                    else{
                        return "no results found";
                    }
                }
            }
            if($request->whatToSearch == "company" && ($request->userType == "user" || $request->userType == "notAuthorizedUser")){
                $skip = ($id - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                $searchByValueFromRequest = $request->searchBy;
                if(($count = DB::table('companyaccount')
                    ->select('id','company_name','company_address','email','phone')
                    ->where("id", '<>', 1)
                    ->where(function ($query) use ($searchByValueFromRequest) {
                        $query->where('id', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                ->orWhere('email', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                ->orWhere('phone', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                ->orWhere('company_name', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                ->orWhere('company_address', 'LIKE', '%'.$searchByValueFromRequest.'%');
                    })
                    ->orderBy('company_name')->count()) > 0){
                        if(count($data = DB::table('companyaccount')
                            ->select('id','company_name','company_address','email','phone')
                            ->skip($skip)->take($take)
                            ->where("id", '<>', 1)
                            ->where(function ($query) use ($searchByValueFromRequest) {
                                $query->where('id', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                        ->orWhere('email', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                        ->orWhere('phone', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                        ->orWhere('company_name', 'LIKE', '%'.$searchByValueFromRequest.'%')
                                        ->orWhere('company_address', 'LIKE', '%'.$searchByValueFromRequest.'%');
                            })
                            ->orderBy('company_name')->get()) > 0){
                                $totalProfilePages = $count / $request->getNumberOfData;
                                $data[0]->totalProfilePages = ceil($totalProfilePages);
                                $data[0]->totalProfilesFound = $count;
                                return $data;
                        }
                        else{
                            return "no results found";
                        }
                }
                else{
                    return "no results found";
                }
            }
            else if($request->whatToSearch == "user" && $request->userType == "companyUser"){
                $skip = ($id - 1) * $request->getNumberOfData;
                $take = $request->getNumberOfData;
                if(($count = DB::table('useraccount')
                    ->leftJoin('jobtype', 'jobtype.id', '=', 'useraccount.job_type_id')
                    ->select('useraccount.id as id','jobtype.jobtype_name as jobtype_jobtype_name','useraccount.name as name','useraccount.gender as gender','useraccount.email as email','useraccount.phone as phone')
                    ->where('useraccount.id', 'LIKE', '%'.$request->searchBy.'%')
                    ->orWhere('useraccount.name', 'LIKE', '%'.$request->searchBy.'%')
                    ->orWhere('useraccount.gender', 'LIKE', '%'.$request->searchBy.'%')
                    ->orWhere('useraccount.job_type_id', 'LIKE', '%'.$request->searchBy.'%')
                    ->orWhere('useraccount.email', 'LIKE', '%'.$request->searchBy.'%')
                    ->orWhere('useraccount.phone', 'LIKE', '%'.$request->searchBy.'%')
                    ->orderBy('useraccount.name')->count()) > 0){
                        if(count($data = DB::table('useraccount')
                            ->leftJoin('jobtype', 'jobtype.id', '=', 'useraccount.job_type_id')
                            ->select('useraccount.id as id','jobtype.jobtype_name as jobtype_jobtype_name','useraccount.name as name','useraccount.gender as gender','useraccount.email as email','useraccount.phone as phone')
                            ->skip($skip)->take($take)
                            ->where('useraccount.id', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('useraccount.name', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('useraccount.gender', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('useraccount.job_type_id', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('useraccount.email', 'LIKE', '%'.$request->searchBy.'%')
                            ->orWhere('useraccount.phone', 'LIKE', '%'.$request->searchBy.'%')
                            ->orderBy('useraccount.name')->get()) > 0){
                                $totalProfilePages = $count / $request->getNumberOfData;
                                $data[0]->totalProfilePages = ceil($totalProfilePages);
                                $data[0]->totalProfilesFound = $count;
                                return $data;
                        }
                        else{
                            return "no results found";
                        }
                }
                else{
                    return "no results found";
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
