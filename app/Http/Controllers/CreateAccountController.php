<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobtype;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use Illuminate\Support\Facades\DB;

class CreateAccountController extends Controller
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
        if($request->selectedRegistrationForm == "userRegistration"){

            $data = new Useraccount();
            $validPhone = filter_var($request->phone, FILTER_SANITIZE_NUMBER_INT);


            if(strlen($request->firstTeacherName) < 4 || $request->firstTeacherName == ""){
                return "Teacher's name minimum 4 characters requiured";
            }
            else{
                $data->first_teacher_name = $request->firstTeacherName;
            }

            if(strlen($request->placeOfBirth) <= 14){
                return "place of birth is too small";
            }
            else if(strlen($request->placeOfBirth) > 100){
                return "place of birth is too big";
            }
            else if(strlen($request->placeOfBirth) > 14 && strlen($request->placeOfBirth) <= 100){
                $data->place_of_birth = $request->placeOfBirth;
            }

            if($request->email == "" && $validPhone == ""){
                return "email or phone anyone required error";
            }
            else{
                if($request->email != ""){
                    if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                        if(count(DB::table('useraccount')->where('email',$request->email)->get()) > 0){
                            return "email used error";
                        }
                        else{
                            if(count(DB::table('companyaccount')->where('email',$request->email)->get()) > 0){
                                return "email used error";
                            }
                            else{
                                $data->email = $request->email;
                            }
                        }
                    }
                    else{
                        return "not a valid email error";
                    }
                    
                }

                if($validPhone != ""){
                    if(count(DB::table('useraccount')->where('phone',$validPhone)->get()) > 0){
                        return "phone used error";
                    }
                    else{
                        if(count(DB::table('companyaccount')->where('phone',$validPhone)->get()) > 0){
                            return "phone used error";
                        }
                        else{
                            $data->phone = $validPhone;
                        }
                    }
                }
            }

            if(strlen($request->password) < 5){
                return "password is too small";
            }
            else if(strlen($request->password) > 100){
                return "password is too big";
            }
            else if($request->password == $request->rePassword && strlen($request->password) >= 5 && strlen($request->password) <= 100){
                
                $data->name = $request->name;
                $data->gender = $request->gender;
                $data->job_type_id = $request->jobtypeid;

                $data->password = md5($request->password."&*@js!)A5$#1KLI&(*#o^%$");
                $data->retype_password = md5($request->rePassword."&*@js!)A5$#1KLI&(*#o^%$");
                $data->user_type = "user";
                
            }
            else{
                return "password did not match error";
            }


            if($data->save()){
                return "success";
            }
            else{
                return "server error";
            }
            
        }
        else if($request->selectedRegistrationForm == "companyRegistration"){
            
            $data = new Companyaccount();
            $validPhone = filter_var($request->phone, FILTER_SANITIZE_NUMBER_INT);

            if(strlen($request->firstTeacherName) < 4 || $request->firstTeacherName == ""){
                return "Teacher's name minimum 4 characters requiured";
            }
            else{
                $data->first_teacher_name = $request->firstTeacherName;
            }

            if(strlen($request->companyAddress) <= 14){
                return "address is too small";
            }
            else if(strlen($request->companyAddress) > 100){
                return "address is too big";
            }
            else if(strlen($request->companyAddress) > 14 && strlen($request->companyAddress) <= 100){
                $data->company_address = $request->companyAddress;
            }

            if($request->email == "" || $validPhone == ""){
                return "email and phone required error";
            }
            else{
                if($request->email != ""){
                    if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                        if(count(DB::table('companyaccount')->where('email',$request->email)->get()) > 0){
                            return "email used error";
                        }
                        else{
                            if(count(DB::table('useraccount')->where('email',$request->email)->get()) > 0){
                                return "email used error";
                            }
                            else{
                                $data->email = $request->email;
                            }
                        }
                    }
                    else{
                        return "not a valid email error";
                    }
                    
                }

                if($validPhone != ""){
                    if(count(DB::table('companyaccount')->where('phone',$validPhone)->get()) > 0){
                        return "phone used error";
                    }
                    else{
                        if(count(DB::table('useraccount')->where('phone',$validPhone)->get()) > 0){
                            return "phone used error";
                        }
                        else{
                            $data->phone = $validPhone;
                        }
                    }
                }
            }

            if(strlen($request->password) < 5){
                return "password is too small";
            }
            else if(strlen($request->password) > 100){
                return "password is too big";
            }
            else if($request->password == $request->rePassword && strlen($request->password) >= 5 && strlen($request->password) <= 100){
                
                $data->company_name = $request->companyName;
                $data->password = md5($request->password."&*@js!)A5$#1KLI&(*#o^%$");
                $data->retype_password = md5($request->rePassword."&*@js!)A5$#1KLI&(*#o^%$");
                $data->user_type = "companyUser";

            }
            else{
                return "password did not match error";
            }


            if($data->save()){
                return "success";
            }
            else{
                return "server error";
            }
        }



        //only for Login or Signin
        if($request->submitType == "signIn_logIn"){
            
            //$request->session()->flush();
            if($request->email_phone == ""){
                return "email or phone cannot be empty error";
            }
            if($request->password == ""){
                return "password cannot be empty error";
            }

            $validPhone = filter_var($request->email_phone, FILTER_SANITIZE_NUMBER_INT);

            if($request->email_phone != "" && $request->password != ""){
                if (filter_var($request->email_phone, FILTER_VALIDATE_EMAIL)){
                    //check email
                    if(count($data = DB::table('useraccount')->where('email',$request->email_phone)->where('password',md5($request->password."&*@js!)A5$#1KLI&(*#o^%$"))->get()) == 1){
                        //$userId = "<script>document.write(localStorage.getItem('lastname'))</script>";
                        //echo "<script>document.write(localStorage.setItem('auth_Token', '".$userId."'))</script>";
                        
                        $request->session()->flush();
                        $request->session()->put('usersName', $data[0]->name);
                        $request->session()->put('userId', $data[0]->id);
                        $request->session()->put('email', $data[0]->email);
                        $request->session()->put('phone', "");
                        $request->session()->put('userType', $data[0]->user_type);
                        
                        return $data;
                    }
                    else{
                        if(count($data = DB::table('companyaccount')->where('email',$request->email_phone)->where('password',md5($request->password."&*@js!)A5$#1KLI&(*#o^%$"))->get()) == 1){
                            
                            $request->session()->flush();
                            $request->session()->put('usersName', $data[0]->company_name);
                            $request->session()->put('userId', $data[0]->id);
                            $request->session()->put('email', $data[0]->email);
                            $request->session()->put('phone', $data[0]->phone);
                            $request->session()->put('userType', $data[0]->user_type);

                            return $data;
                        }
                        else{
                            return "email or password not found error";
                        }
                    }
                }
                else{
                    //check phone
                    if(count($data = DB::table('useraccount')->where('phone',$validPhone)->where('password',md5($request->password."&*@js!)A5$#1KLI&(*#o^%$"))->get()) == 1){
                        
                        $request->session()->flush();
                        $request->session()->put('usersName', $data[0]->name);
                        $request->session()->put('userId', $data[0]->id);
                        $request->session()->put('email', "");
                        $request->session()->put('phone', $data[0]->phone);
                        $request->session()->put('userType', $data[0]->user_type);

                        return $data;
                    }
                    else{
                        if(count($data = DB::table('companyaccount')->where('phone',$validPhone)->where('password',md5($request->password."&*@js!)A5$#1KLI&(*#o^%$"))->get()) == 1){
                            
                            $request->session()->flush();
                            $request->session()->put('usersName', $data[0]->company_name);
                            $request->session()->put('userId', $data[0]->id);
                            $request->session()->put('email', $data[0]->email);
                            $request->session()->put('phone', $data[0]->phone);
                            $request->session()->put('userType', $data[0]->user_type);
                            return $data;
                        }
                        else{
                            return "email or password not found error";
                        }
                    }
                }
            }
            else{
                return "Fill all the fields error";
            }
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
