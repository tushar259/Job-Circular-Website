<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use App\Models\Changepassword;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class NoneUserController extends Controller
{
    public function findUserByEmailOrPhone(Request $request){
        $foundData = array();
        if(strlen($request->searchByEmailOrPhone) <= 0){
            return "please enter a email or a phone";
        }
        else{
            if(count($data = DB::table("useraccount")
                ->where("email", $request->searchByEmailOrPhone)
                ->orWhere("phone", $request->searchByEmailOrPhone)
                ->get()) == 1){
                    array_push($foundData, "success");
                    array_push($foundData, $data[0]->name);
                    array_push($foundData, "ut");
                    return $foundData;
                    // return gettype($data);
            }
            else{
                if(count($data = DB::table("companyaccount")
                    ->where("email", $request->searchByEmailOrPhone)
                    ->orWhere("phone", $request->searchByEmailOrPhone)
                    ->get()) == 1){
                        array_push($foundData, "success");
                        array_push($foundData, $data[0]->company_name);
                        array_push($foundData, "ct");
                        return $foundData;
                }
                else{
                    return "no data found";
                }
            }
            
        }
    }

    public function verifyTeachersName(Request $request){
        
        // company table
        // DB::beginTransaction();

        // $changeTable = Changepassword::first();
        // $todayDate = date('Y-m-d H:i:s');
        // ->whereDate('date', '<=', '2014-07-10')
        // ->where('date', '<=', '2014-07-10 23:59:59')
        // ->where('date', '<', '2014-07-11')
        // $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
        // return $dayAfter;
        $getDataFromDeleteMethod = $this->deleteRowsMoreThanOneDay($request);
        
        $emailOrPhone = $request->searchByEmailOrPhone;

        $data = DB::table("companyaccount")
                ->where("first_teacher_name", $request->verifyByTeacherName)
                ->where(function ($query) use ($emailOrPhone) {
                    $query->where("email", $emailOrPhone)
                          ->orWhere("phone", $emailOrPhone);
                });
                
        // $data->where("company_address", $request->verifyByBirth);
        
        $userDataTable = DB::table("useraccount")
                ->where("first_teacher_name", $request->verifyByTeacherName)
                ->where(function ($query) use ($emailOrPhone) {
                    $query->where("email", $emailOrPhone)
                          ->orWhere("phone", $emailOrPhone);
                });
                
        if(count($getData = $data->get()) == 1){
            // return $getData;
            $macAddr = exec('getmac');
            $macAddr = strtok($macAddr, ' ');

            if(count(DB::table("changepassword")->where("mac_address", $macAddr)->get()) == 1){
                $changeTable = Changepassword::where("mac_address", $macAddr)->first();
                if($changeTable->treid_number_of_time >= 10){
                    return "day limit over";
                }
                else{
                    $changeTable->mac_address = $macAddr;
                    $changeTable->treid_number_of_time = 0;
                    $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                    $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                    $changeTable->row_will_be_deleted_at = $dayAfter;
                    if($changeTable->save()){
                        return "success";
                    }
                    else{
                        return "server error";
                    }
                }
            }
            else if(count(DB::table("changepassword")->where("mac_address", $macAddr)->get()) > 1){
                $changeTable = Changepassword::where("mac_address", $macAddr)->first();
                if($changeTable->treid_number_of_time >= 10){
                    return "day limit over";
                }
                else{
                    $changeTable->mac_address = $macAddr;
                    $changeTable->treid_number_of_time = 0;
                    $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                    $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                    $changeTable->row_will_be_deleted_at = $dayAfter;
                    if($changeTable->save()){
                        return "success";
                    }
                    else{
                        return "server error";
                    }
                }
            }
            else{
                $changeTable = new Changepassword();
                $changeTable->mac_address = $macAddr;
                $changeTable->treid_number_of_time = 0;
                $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                $changeTable->row_will_be_deleted_at = $dayAfter;
                if($changeTable->save()){
                    return "success";
                }
                else{
                    return "server error";
                }
            }
        }
        else if(count($getData = $userDataTable->get()) == 1){
            $macAddr = exec('getmac');
            $macAddr = strtok($macAddr, ' ');

            if(count(DB::table("changepassword")->where("mac_address", $macAddr)->get()) == 1){
                $changeTable = Changepassword::where("mac_address", $macAddr)->first();
                if($changeTable->treid_number_of_time >= 10){
                    return "day limit over";
                }
                else{
                    $changeTable->mac_address = $macAddr;
                    $changeTable->treid_number_of_time = 0;
                    $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                    $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                    $changeTable->row_will_be_deleted_at = $dayAfter;
                    if($changeTable->save()){
                        return "success";
                    }
                    else{
                        return "server error";
                    }
                }
            }
            else if(count(DB::table("changepassword")->where("mac_address", $macAddr)->get()) > 1){
                $changeTable = Changepassword::where("mac_address", $macAddr)->first();
                if($changeTable->treid_number_of_time >= 10){
                    return "day limit over";
                }
                else{
                    $changeTable->mac_address = $macAddr;
                    $changeTable->treid_number_of_time = 0;
                    $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                    $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                    $changeTable->row_will_be_deleted_at = $dayAfter;
                    if($changeTable->save()){
                        return "success";
                    }
                    else{
                        return "server error";
                    }
                }
            }
            else{
                $changeTable = new Changepassword();
                $changeTable->mac_address = $macAddr;
                $changeTable->treid_number_of_time = 0;
                $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                $changeTable->row_will_be_deleted_at = $dayAfter;
                if($changeTable->save()){
                    return "success";
                }
                else{
                    return "server error";
                }
            }
        }
        else{
            $macAddr = exec('getmac');
            $macAddr = strtok($macAddr, ' ');

            if(count(DB::table("changepassword")->where("mac_address", $macAddr)->get()) == 1){
                $changeTable = Changepassword::where("mac_address", $macAddr)->first();
                $changeTable->mac_address = $macAddr;
                $changeTable->treid_number_of_time = (int)$changeTable->treid_number_of_time + 1;
                $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                $changeTable->row_will_be_deleted_at = $dayAfter;
                if($changeTable->treid_number_of_time >= 11){
                    return "day limit over";
                }
                else{
                    if($changeTable->save()){
                        return "did not match";
                    }
                    else{
                        return "server error";
                    }
                }
            }
            else if(count(DB::table("changepassword")->where("mac_address", $macAddr)->get()) > 1){
                $changeTable = Changepassword::where("mac_address", $macAddr)->first();
                $changeTable->mac_address = $macAddr;
                $changeTable->treid_number_of_time = (int)$changeTable->treid_number_of_time + 1;
                $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                $changeTable->row_will_be_deleted_at = $dayAfter;
                if($changeTable->treid_number_of_time >= 11){
                    return "day limit over";
                }
                else{
                    if($changeTable->save()){
                        return "did not match";
                    }
                    else{
                        return "server error";
                    }
                }
            }
            else{
                $changeTable = new Changepassword();
                $changeTable->mac_address = $macAddr;
                $changeTable->treid_number_of_time = 1;
                $changeTable->tried_to_change_password_date_and_time = date('Y-m-d H:i:s');
                $dayAfter = (new DateTime($changeTable->tried_to_change_password_date_and_time))->modify('+1 day')->format('Y-m-d H:i:s');
                $changeTable->row_will_be_deleted_at = $dayAfter;
                if($changeTable->save()){
                    return "did not match";
                }
                else{
                    return "server error";
                }
                
            }

        }
        
        
    }

    public function deleteRowsMoreThanOneDay($request){
        if(count($data = Changepassword::whereDate('row_will_be_deleted_at', '<=', date('Y-m-d H:i:s'))->get()) > 0){
            $ids = array();
            foreach($data as $value){
                array_push($ids, $value->id);
            }
            if(Changepassword::whereIn('id', $ids)->delete()){
                return "success";
            }
            else{
                return "could not delete";
            }
            // return $ids;
        }
        else{
            return "no data found";
        }
    }

    public function changePasswordCalled(Request $request){
        if($request->searchByEmailOrPhone == "" || 
           $request->entNewPassword == "" || 
           $request->entRetypePassword == "" || 
           ($request->entNewPassword != $request->entRetypePassword) ||
           strlen($request->entNewPassword) <= 4 ||
           strlen($request->entNewPassword) > 20 ||
           $request->allVerified != "locationVerified"){
            
            if($request->searchByEmailOrPhone == ""){
                return "cheating used";
            }
            else if($request->entNewPassword == ""){
                return "enter a password";
            }
            else if($request->entRetypePassword == ""){
                return "enter a repassword";
            }
            else if($request->entNewPassword != $request->entRetypePassword){
                return "password did not match";
            }
            else if(strlen($request->entNewPassword) <= 4){
                return "password is small";
            }
            else if(strlen($request->entNewPassword) > 20){
                return "password is big";
            }
            else if($request->allVerified != "locationVerified"){
                return "cheating used";
            }
        }
        else{
            if($request->getDataFrom == "ut"){
                $upData = Useraccount::where("email", $request->searchByEmailOrPhone)
                                    ->orWhere("phone", $request->searchByEmailOrPhone)
                                    ->first();

                $upData->password = md5($request->entNewPassword."&*@js!)A5$#1KLI&(*#o^%$");
                $upData->retype_password = md5($request->entNewPassword."&*@js!)A5$#1KLI&(*#o^%$");

                if($upData->save()){
                    return "success";
                }
                else{
                    return "could not change password";
                }
            }
            else if($request->getDataFrom == "ct"){
                $upData = Companyaccount::where("email", $request->searchByEmailOrPhone)
                                    ->orWhere("phone", $request->searchByEmailOrPhone)
                                    ->first();
                if($upData->id != 1){
                    $upData->password = md5($request->entNewPassword."&*@js!)A5$#1KLI&(*#o^%$");
                    $upData->retype_password = md5($request->entNewPassword."&*@js!)A5$#1KLI&(*#o^%$");

                    if($upData->save()){
                        return "success";
                    }
                    else{
                        return "could not change password";
                    }
                }
                else{
                    return "could not change password";
                }
            }
            else{
                
                return "could not change password";
                
            }
        }
    }

}
