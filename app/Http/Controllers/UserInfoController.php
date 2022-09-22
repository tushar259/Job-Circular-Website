<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use App\Models\Usercvvideos;
use Illuminate\Support\Facades\DB;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('userType') && $request->session()->get('userType') == "user"){
            if($request->session()->has('userId')){
                if($request->session()->get('userId') != ""){
                    if(count($data = DB::table('useraccount')->where('id', $request->session()->get('userId'))->get()) == 1){
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
        else if($request->session()->has('userType') && $request->session()->get('userType') == "companyUser"){
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
        else{
            $request->session()->put('userType', 'notAuthorizedUser');
            return "not authorized user";
        }
    }

    public function show($id, Request $request){
        
        if($request->session()->has('userId')){
            if($request->session()->get('userId') != "" && $request->session()->get('userType') == "user"){
                if(count($data = DB::table('useraccount')
                    ->select('id','name','gender','job_type_id','email','phone','place_of_birth','user_type','premium_or_not')
                    ->where('id', $id)->get()) == 1){
                    $data[0]->userIdS = $request->session()->get('userId');
                    return $data;
                }
                
            }
            else if($request->session()->get('userId') != "" && $request->session()->get('userType') == "companyUser"){
                if(count($data = DB::table('useraccount')
                    ->select('id','name','gender','job_type_id','email','phone','place_of_birth','user_type','premium_or_not')
                    ->where('id', $id)->get()) == 1){
                    $data[0]->userIdS = "companyUser";
                    return $data;
                }
                
            }
            else{
                if(count($data = DB::table('useraccount')
                    ->select('id','name','gender','job_type_id','email','phone','place_of_birth','user_type','premium_or_not')
                    ->where('id', $id)->get()) == 1){
                    $data[0]->userIdS = "not signed/logged in user";
                    return $data;
                }
                
            }
        }
        else{
            if(count($data = DB::table('useraccount')
                ->select('id','name','gender','job_type_id','email','phone','place_of_birth','user_type','premium_or_not')
                ->where('id', $id)->get()) == 1){
                $data[0]->userIdS = "not signed/logged in user";
                return $data;
            }
            
        }
    }

    public function update($id, Request $request){
        $checkNameValidity = "";
        $checkGenderValidity = "";
        $checkJobTypeValidity = "";
        $checkPasswordValidity = "";
        $checkEmailValidity = "";
        $checkPhoneValidity = "";
        $validPhone = filter_var($request->newUserPhone, FILTER_SANITIZE_NUMBER_INT);
        if($request->session()->has('userId') && $request->session()->get('userId') == $id){
            if($request->newUserName == "" || $request->newUserName == null){
                return "name cannot be empty";
            }
            else{
                $checkNameValidity = "clear";
            }
            if($request->newUserGender == "" || $request->newUserGender == null){
                return "gender cannot be empty";
            }
            else{
                $checkGenderValidity = "clear";
            }
            if($request->newUserJobTypeId == "" || $request->newUserJobTypeId == null){
                return "skill cannot be empty";
            }
            else{
                $checkJobTypeValidity = "clear";
            }
            if(($request->newUserEmail == "" || $request->newUserEmail == null) && ($request->newUserPhone == "" || $request->newUserPhone == null)){
                $checkEmailValidity = "";
                $checkPhoneValidity = "";
                return "email and phone both cannot be empty";
            }
            else{
                if($request->newUserEmail != "" || $request->newUserEmail != null){
                    if(filter_var($request->newUserEmail, FILTER_VALIDATE_EMAIL)) {
                        if(count(DB::table('useraccount')->where('email',$request->newUserEmail)->whereNotIn('id', [$id])->get()) > 0){
                            return "email used error";
                        }
                        else{
                            if(count(DB::table('companyaccount')->where('email',$request->newUserEmail)->get()) > 0){
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
                if($request->newUserPhone != "" || $request->newUserPhone != null){
                    if($validPhone != "" || $validPhone != null){
                        if(count(DB::table('companyaccount')->where('phone',$validPhone)->get()) > 0){
                            return "phone used error";
                        }
                        else{
                            if(count(DB::table('useraccount')->where('phone',$validPhone)->whereNotIn('id', [$id])->get()) > 0){
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

        if(($checkNameValidity == "clear" && $checkGenderValidity == "clear" && $checkJobTypeValidity == "clear" && $checkPasswordValidity == "clear") && 
        ($checkEmailValidity == "clear" || $checkPhoneValidity == "clear")){
            $goingToUpdate = Useraccount::where('id', $id)->first();
            $goingToUpdate->name = $request->newUserName;
            $goingToUpdate->gender = $request->newUserGender;
            $goingToUpdate->job_type_id = $request->newUserJobTypeId;
            $goingToUpdate->email = $request->newUserEmail;
            $goingToUpdate->phone = $validPhone;
            $goingToUpdate->place_of_birth = $request->userBirthPlace;

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
                    if(count($data = DB::table('useraccount')->where('id', $request->session()->get('userId'))->where('password', md5($request->currentPassword."&*@js!)A5$#1KLI&(*#o^%$"))->get()) == 1){
                        $updatePasswordDone = Useraccount::where('id', $request->session()->get('userId'))->first();
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

    public function getNamesofVideos(Request $request){
        if($request->fileType == "skillOne" || $request->fileType == "skillTwo" || $request->fileType == "skillThree"){
            if(count($getCVorVideoName = Usercvvideos::where('userid', $request->userId)->where('upload_file_type', $request->fileType)->get()) > 0){
                return $getCVorVideoName[0]->name;
            }
            else{
                return "not found";
            }
        }
        else{
            return "not found";
        }
    }
}
