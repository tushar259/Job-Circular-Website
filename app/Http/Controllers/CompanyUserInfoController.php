<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use Illuminate\Support\Facades\DB;

class CompanyUserInfoController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('userId')){
            if($request->session()->get('userId') != ""){
                if(count($data = DB::table('companyaccount')->where('id', $request->session()->get('userId'))->get()) == 1){
                    $data[0]->userIdS = $request->session()->get('userId');
                    return $data;
                }
                else{
                    return "not authorized user";
                }
            }
            else{
                return "not authorized user";
            }
        }
        else{
            return "not authorized user";
        }
    }

    public function show($id, Request $request){
        
        if($request->session()->has('userId')){
            if($request->session()->get('userId') != "" && $request->session()->get('userType') == "companyUser"){
                
                if(count($data = DB::table('companyaccount')
                ->leftJoin('circular', 'circular.company_id', '=', 'companyaccount.id')
                ->leftJoin('appliedforjobuserlist', 'circular.id', '=', 'appliedforjobuserlist.circular_id')
                ->select('circular.id as circular_id',
                    DB::raw('
                        GROUP_CONCAT(DISTINCT(companyaccount.id)) as id, GROUP_CONCAT(DISTINCT(companyaccount.email)) as email, 
                        GROUP_CONCAT(DISTINCT(companyaccount.phone)) as phone, GROUP_CONCAT(DISTINCT(companyaccount.company_name)) as company_name, 
                        GROUP_CONCAT(DISTINCT(companyaccount.company_address)) as company_address, GROUP_CONCAT(DISTINCT(circular.job_name)) as job_name, 
                        GROUP_CONCAT(DISTINCT(circular.job_name)) as circular_job_name,
                        GROUP_CONCAT(DISTINCT(circular.company_id)) as circular_company_id,
                        GROUP_CONCAT(DISTINCT(circular.company_name)) as circular_company_name, GROUP_CONCAT(DISTINCT(circular.employment_status)) as circular_employment_status,
                        GROUP_CONCAT(DISTINCT(circular.job_type_id)) as circular_job_type_id, GROUP_CONCAT(DISTINCT(circular.education_req)) as circular_education_req,
                        GROUP_CONCAT(DISTINCT(circular.experience_req)) as circular_experience_req, GROUP_CONCAT(DISTINCT(circular.job_responsibility)) as circular_job_responsibility,
                        GROUP_CONCAT(DISTINCT(circular.more_req)) as circular_more_req, GROUP_CONCAT(DISTINCT(circular.salary)) as circular_salary,
                        GROUP_CONCAT(DISTINCT(circular.other_benefits)) as circular_other_benefits, GROUP_CONCAT(DISTINCT(circular.read_before_apply)) as circular_read_before_apply,
                        GROUP_CONCAT(DISTINCT(circular.vacancy)) as circular_vacancy, GROUP_CONCAT(DISTINCT(circular.job_location)) as circular_job_location,
                        GROUP_CONCAT(DISTINCT(circular.deadline)) as circular_deadline 
                    '),
                    DB::raw('COUNT(appliedforjobuserlist.circular_id) as appliedUsersCount')
                )
                ->where('companyaccount.id', $id)
                ->groupBy('circular.id')
                ->orderBy('circular.created_at', 'DESC')
                ->get()) > 0){
                    $data[0]->userIdS = $request->session()->get('userId');
                    return $data;
                }
                
                
                // DO NOT DELETE
                // Previous way to get circular

                // if(count($data = DB::table('companyaccount')
                // ->leftJoin('circular', 'circular.company_id', '=', 'companyaccount.id')
                // ->select('companyaccount.id as id','companyaccount.email as email',
                //     'companyaccount.phone as phone','companyaccount.company_name as company_name',
                //     'companyaccount.company_address as company_address','circular.id as circular_id',
                //     'circular.job_name as circular_job_name','circular.company_name as circular_company_name',
                //     'circular.employment_status as circular_employment_status',
                //     'circular.job_type_id as circular_job_type_id','circular.education_req as circular_education_req',
                //     'circular.experience_req as circular_experience_req',
                //     'circular.job_responsibility as circular_job_responsibility',
                //     'circular.more_req as circular_more_req','circular.salary as circular_salary',
                //     'circular.other_benefits as circular_other_benefits','circular.read_before_apply as circular_read_before_apply',
                //     'circular.vacancy as circular_vacancy','circular.job_location as circular_job_location',
                //     'circular.deadline as circular_deadline')
                // ->where('companyaccount.id', $id)->get()) > 0){
                //     $data[0]->userIdS = $request->session()->get('userId');
                //     return $data;
                // }
                
            }
            else if($request->session()->get('userId') != "" && $request->session()->get('userType') == "user"){
                if(count($data = DB::table('companyaccount')
                ->leftJoin('circular', 'circular.company_id', '=', 'companyaccount.id')
                ->select('companyaccount.id as id','companyaccount.email as email','companyaccount.phone as phone','companyaccount.company_name as company_name','companyaccount.company_address as company_address','circular.id as circular_id','circular.job_name as circular_job_name','circular.company_name as circular_company_name','circular.employment_status as circular_employment_status','circular.job_type_id as circular_job_type_id','circular.education_req as circular_education_req','circular.experience_req as circular_experience_req','circular.job_responsibility as circular_job_responsibility','circular.more_req as circular_more_req','circular.salary as circular_salary','circular.other_benefits as circular_other_benefits','circular.read_before_apply as circular_read_before_apply','circular.vacancy as circular_vacancy','circular.job_location as circular_job_location','circular.deadline as circular_deadline')
                ->where('companyaccount.id', $id)->get()) > 0){
                    $data[0]->userIdS = "normal user";
                    return $data;
                }
                
            }
            else{
                if(count($data = DB::table('companyaccount')
                ->leftJoin('circular', 'circular.company_id', '=', 'companyaccount.id')
                ->select('companyaccount.id as id','companyaccount.email as email','companyaccount.phone as phone','companyaccount.company_name as company_name','companyaccount.company_address as company_address','circular.id as circular_id','circular.job_name as circular_job_name','circular.company_name as circular_company_name','circular.employment_status as circular_employment_status','circular.job_type_id as circular_job_type_id','circular.education_req as circular_education_req','circular.experience_req as circular_experience_req','circular.job_responsibility as circular_job_responsibility','circular.more_req as circular_more_req','circular.salary as circular_salary','circular.other_benefits as circular_other_benefits','circular.read_before_apply as circular_read_before_apply','circular.vacancy as circular_vacancy','circular.job_location as circular_job_location','circular.deadline as circular_deadline')
                ->where('companyaccount.id', $id)->get()) > 0){
                    $data[0]->userIdS = "not signed/logged in user";
                    return $data;
                }
                
            }
        }
        else{
            if(count($data = DB::table('companyaccount')
                ->leftJoin('circular', 'circular.company_id', '=', 'companyaccount.id')
                ->select('companyaccount.id as id','companyaccount.email as email','companyaccount.phone as phone','companyaccount.company_name as company_name','companyaccount.company_address as company_address','circular.id as circular_id','circular.job_name as circular_job_name','circular.company_name as circular_company_name','circular.employment_status as circular_employment_status','circular.job_type_id as circular_job_type_id','circular.education_req as circular_education_req','circular.experience_req as circular_experience_req','circular.job_responsibility as circular_job_responsibility','circular.more_req as circular_more_req','circular.salary as circular_salary','circular.other_benefits as circular_other_benefits','circular.read_before_apply as circular_read_before_apply','circular.vacancy as circular_vacancy','circular.job_location as circular_job_location','circular.deadline as circular_deadline')
                ->where('companyaccount.id', $id)->get()) > 0){
                    $data[0]->userIdS = "not signed/logged in user";
                    return $data;
            }
            
        }
    }

    public function update($id, Request $request){
        $checkCompanyNameValidity = "";
        $checkCompanyAddressValidity = "";
        $checkEmailValidity = "";
        $checkPhoneValidity = "";
        $checkPasswordValidity = "";
        

        $validPhone = filter_var($request->newPhone, FILTER_SANITIZE_NUMBER_INT);
        if($request->session()->has('userId') && $request->session()->get('userId') == $id){
            if($request->newCompanyName == "" || $request->newCompanyName == null){
                return "company name cannot be empty";
            }
            else{
                $checkCompanyNameValidity = "clear";
            }

            if($request->newCompanyAddress == "" || $request->newCompanyAddress == null){
                return "company address cannot be empty";
            }
            else{
                $checkCompanyAddressValidity = "clear";
            }

            if($request->newEmail == "" || $request->newEmail == null){
                return "email cannot be empty";
            }
            else{
                $checkEmailValidity = "clear";
            }

            if($request->newPhone == "" || $request->newPhone == null){
                
                return "phone cannot be empty";
            }
            else{
                $checkPhoneValidity = "clear";
            }

            
            if($request->newEmail != "" || $request->newEmail != null){
                if(filter_var($request->newEmail, FILTER_VALIDATE_EMAIL)) {
                    if(count(DB::table('useraccount')->where('email',$request->newEmail)->get()) > 0){
                        return "email used error";
                    }
                    else{
                        if(count(DB::table('companyaccount')->where('email',$request->newEmail)->whereNotIn('id', [$id])->get()) > 0){
                            return "email used error";
                        }
                        else{
                            $checkEmailValidity = "clear";
                        }
                    }
                }
                else{
                    return "not a valid email error";
                }
            }
            else{
                return "email cannot be empty";
            }

            if($request->newPhone != "" || $request->newPhone != null){
                if($validPhone != "" || $validPhone != null){
                    if(count(DB::table('companyaccount')->where('phone',$validPhone)->whereNotIn('id', [$id])->get()) > 0){
                        return "phone used error";
                    }
                    else{
                        if(count(DB::table('useraccount')->where('phone',$validPhone)->get()) > 0){
                            return "phone used error";
                        }
                        else{
                            $checkPhoneValidity = "clear";
                        }
                    }
                }
                else{
                    return "not a valid phone error";
                }
            }
            else{
                return "phone cannot be empty";
            }
            
            if($request->oldUserPassword != md5($request->userPassword."&*@js!)A5$#1KLI&(*#o^%$")){
                return "password did not match error";
            }
            else{
                $checkPasswordValidity = "clear";
            }
        }
        else{
            return "this user cannot update";
        }

        if($checkCompanyNameValidity == "clear" && $checkCompanyAddressValidity == "clear" && $checkEmailValidity == "clear" && $checkPhoneValidity == "clear" && $checkPasswordValidity == "clear"){
            $goingToUpdate = Companyaccount::where('id', $id)->first();
            $goingToUpdate->company_name = $request->newCompanyName;
            $goingToUpdate->company_address = $request->newCompanyAddress;
            $goingToUpdate->email = $request->newEmail;
            $goingToUpdate->phone = $validPhone;

            if($goingToUpdate->save()){
                $request->session()->put('email', $request->newUserEmail);
                $request->session()->put('phone', $validPhone);
                return "success";
            }
            else{
                return "server error";
            }
            
        }
        else{
            return "server error";
        }
    }

    public function store(Request $request){

        $checkCurrentPasswordValidity = "";
        $checkNewPasswordValidity = "";
        $checkRetypeNewPasswordValidity = "";
        $checkCombinedPasswordValidity = "";
        if($request->currentPassword != "" || $request->currentPassword != null){
            $checkCurrentPasswordValidity = "clear";
        }
        else{
            return "current password cannot be empty error";
        }

        if($request->newPassword != "" || $request->newPassword != null){
            $checkNewPasswordValidity = "clear";
        }
        else{
            return "new password cannot be empty error";
        }

        if($request->retypeNewPassword != "" || $request->retypeNewPassword != null){
            $checkRetypeNewPasswordValidity = "clear";
        }
        else{
            return "retype password cannot be empty error";
        }

        if(($request->newPassword != "" || $request->newPassword != null) && ($request->retypeNewPassword != "" || $request->retypeNewPassword != null) && 
        ($request->newPassword == $request->retypeNewPassword)){
            $checkCombinedPasswordValidity = "clear";
        }
        else{
            return "retype password did not match error";
        }

        if($checkCurrentPasswordValidity == "clear" && $checkNewPasswordValidity == "clear" && $checkRetypeNewPasswordValidity == "clear" && $checkCombinedPasswordValidity == "clear"){

            if($request->session()->has('userId')){
                if($request->session()->get('userId') != ""){
                    if(count($data = DB::table('companyaccount')->where('id', $request->session()->get('userId'))->where('password', md5($request->currentPassword."&*@js!)A5$#1KLI&(*#o^%$"))->get()) == 1){
                        $updatePasswordDone = Companyaccount::where('id', $request->session()->get('userId'))->first();
                        $updatePasswordDone->password = md5($request->newPassword."&*@js!)A5$#1KLI&(*#o^%$");
                        $updatePasswordDone->retype_password = md5($request->newPassword."&*@js!)A5$#1KLI&(*#o^%$");

                        if($updatePasswordDone->save()){
                            return "success";
                        }
                        else{
                            return "server error";
                        }
                    }
                    else{
                        return "current password did not match error";
                    }
                }
                else{
                    return "not authorized user";
                }
            }
            else{
                return "not authorized user";
            }

        }
        else{
            return "server error";
        }
    }
}
