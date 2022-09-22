<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Userpayhistory;
use Illuminate\Support\Facades\DB;

class UserAcceptPayAgreement extends Controller
{
    public function acceptAgreement(Request $request){
        if($request->session()->has('userId') && $request->session()->has('userType') && $request->session()->get('userType') == "user"){
            if($data = Useraccount::where("id", $request->session()->get('userId'))->first()){
                $data->accept_pay_agreement = "yes";
                if($data->save()){
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
        else{
            return "server error";
        }
    }

    public function userPaidAmount(Request $request){

        if($request->transactionIdOrPhone == "" ||
           $request->amountPaid == "" ||
           $request->reference == ""
        ){
            if($request->transactionIdOrPhone == ""){
                return "transaction empty";
            }
            else if($request->amountPaid == ""){
                return "amount empty";
            }
            else if($request->reference == ""){
                return "reference empty";
            }
            else{
                return "something went wrong";
            }
        }
        else{
            if($request->session()->has('userId') && $request->session()->has('userType') && $request->session()->get('userType') == "user"){
                
                if(count($data = DB::table('userpayhistory')->where("transactionid_or_phone", $request->transactionIdOrPhone)->get()) > 0){
                    return "transaction or phone already used";
                }
                else{
                    $data = new Userpayhistory();
                    $data->userid = $request->session()->get('userId');
                    $data->amount_paid = $request->amountPaid;
                    $data->transactionid_or_phone = $request->transactionIdOrPhone;
                    $data->reference_id = $request->reference;
                    $data->paid_by_app = $request->application;

                    if($data->save()){
                        // return "success";
                        return "success";
                    }
                    else{
                        return "server error";
                    }
                }
                
            }
            else{
                return "server error";
            }
        }
    }

    public function userPaymentHistory(Request $request){
        if(count($data = DB::table("userpayhistory")->where("userid", $request->session()->get('userId'))->get()) > 0){
            return $data;
        }
        else{
            return "this user did not pay";
        }
    }

    public function getUsersPaymentListFromDatabase(Request $request){

        if($request->userId == 1 && $request->userType == "companyUser"){
            $skip = ($request->getPageData - 1) * $request->getNumberOfData;
            $take = $request->getNumberOfData;

            $query = DB::table('userpayhistory')
                ->leftJoin('useraccount', 'useraccount.id', '=', 'userpayhistory.userid')
                ->select('userpayhistory.id as id','userpayhistory.userid as userid','userpayhistory.amount_paid as amount_paid',
                        'userpayhistory.transactionid_or_phone as transactionid_or_phone','userpayhistory.reference_id as reference_id',
                        'userpayhistory.paid_by_app as paid_by_app','userpayhistory.status as status','userpayhistory.created_at as created_at',
                        'userpayhistory.updated_at as updated_at',
                        'useraccount.name as user_name','useraccount.gender as user_gender','useraccount.email as user_email',
                        'useraccount.phone as user_phone','useraccount.user_type as user_type','useraccount.premium_or_not as premium_or_not')
                // ->where('userpayhistory.id', '<>', 0)
                ->orderBy('userpayhistory.created_at', 'ASC');

            // $query->where('userpayhistory.id', '<>', 0);
            if($request->id != ""){
                $query->orWhere('userpayhistory.id', 'LIKE', '%'.$request->id.'%');
            }
            if($request->userid != ""){
                $query->orWhere('userpayhistory.userid', 'LIKE', '%'.$request->userid.'%');
            }
            if($request->amount_paid != ""){
                $query->orWhere('userpayhistory.amount_paid', 'LIKE', '%'.$request->amount_paid.'%');
            }
            if($request->transactionid_or_phone != ""){
                $query->orWhere('userpayhistory.transactionid_or_phone', 'LIKE', '%'.$request->transactionid_or_phone.'%');
            }
            if($request->reference_id != ""){
                $query->orWhere('userpayhistory.reference_id', 'LIKE', '%'.$request->reference_id.'%');
            }
            if($request->paid_by_app != ""){
                $query->orWhere('userpayhistory.paid_by_app', 'LIKE', '%'.$request->paid_by_app.'%');
            }
            if($request->status != ""){
                $query->orWhere('userpayhistory.status', 'LIKE', '%'.$request->status.'%');
            }
            if($request->name != ""){
                $query->orWhere('useraccount.name', 'LIKE', '%'.$request->name.'%');
            }
            if($request->gender != ""){
                $query->orWhere('useraccount.gender', 'LIKE', '%'.$request->gender.'%');
            }
            if($request->email != ""){
                $query->orWhere('useraccount.email', 'LIKE', '%'.$request->email.'%');
            }
            if($request->phone != ""){
                $query->orWhere('useraccount.phone', 'LIKE', '%'.$request->phone.'%');
            }
            if($request->premium != ""){
                $query->orWhere('useraccount.premium_or_not', 'LIKE', '%'.$request->premium.'%');
            }
            if($request->created_at != ""){
                $query->orWhere('userpayhistory.created_at', 'LIKE', '%'.$request->created_at.'%');
            }
            if($request->updated_at != ""){
                $query->orWhere('userpayhistory.updated_at', 'LIKE', '%'.$request->updated_at.'%');
            }

            // $query->skip($skip)->take($take);

            if(($count = $query->count()) > 0){
                if(count($data = $query->skip($skip)->take($take)->get()) > 0){
                    $totalPages = $count / $request->getNumberOfData;
                    $data[0]->totalPages = ceil($totalPages);
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

    public function userPaymentPaginatedData(Request $request){
        if($request->userId == 1 && $request->userType == "companyUser"){
            $skip = ($request->currentPage - 1) * $request->getNumberOfData;
            $take = $request->getNumberOfData;

            $query = DB::table('userpayhistory')
                ->leftJoin('useraccount', 'useraccount.id', '=', 'userpayhistory.userid')
                ->select('userpayhistory.id as id','userpayhistory.userid as userid','userpayhistory.amount_paid as amount_paid',
                        'userpayhistory.transactionid_or_phone as transactionid_or_phone','userpayhistory.reference_id as reference_id',
                        'userpayhistory.paid_by_app as paid_by_app','userpayhistory.status as status','userpayhistory.created_at as created_at',
                        'userpayhistory.updated_at as updated_at',
                        'useraccount.name as user_name','useraccount.gender as user_gender','useraccount.email as user_email',
                        'useraccount.phone as user_phone','useraccount.user_type as user_type','useraccount.premium_or_not as premium_or_not')
                // ->where('userpayhistory.id', '<>', 0)
                ->orderBy('userpayhistory.created_at', 'ASC');

            // $query->where('userpayhistory.id', '<>', 0);
            if($request->id != ""){
                $query->orWhere('userpayhistory.id', 'LIKE', '%'.$request->id.'%');
            }
            if($request->userid != ""){
                $query->orWhere('userpayhistory.userid', 'LIKE', '%'.$request->userid.'%');
            }
            if($request->amount_paid != ""){
                $query->orWhere('userpayhistory.amount_paid', 'LIKE', '%'.$request->amount_paid.'%');
            }
            if($request->transactionid_or_phone != ""){
                $query->orWhere('userpayhistory.transactionid_or_phone', 'LIKE', '%'.$request->transactionid_or_phone.'%');
            }
            if($request->reference_id != ""){
                $query->orWhere('userpayhistory.reference_id', 'LIKE', '%'.$request->reference_id.'%');
            }
            if($request->paid_by_app != ""){
                $query->orWhere('userpayhistory.paid_by_app', 'LIKE', '%'.$request->paid_by_app.'%');
            }
            if($request->status != ""){
                $query->orWhere('userpayhistory.status', 'LIKE', '%'.$request->status.'%');
            }
            if($request->name != ""){
                $query->orWhere('useraccount.name', 'LIKE', '%'.$request->name.'%');
            }
            if($request->gender != ""){
                $query->orWhere('useraccount.gender', 'LIKE', '%'.$request->gender.'%');
            }
            if($request->email != ""){
                $query->orWhere('useraccount.email', 'LIKE', '%'.$request->email.'%');
            }
            if($request->phone != ""){
                $query->orWhere('useraccount.phone', 'LIKE', '%'.$request->phone.'%');
            }
            if($request->premium != ""){
                $query->orWhere('useraccount.premium_or_not', 'LIKE', '%'.$request->premium.'%');
            }
            if($request->created_at != ""){
                $query->orWhere('userpayhistory.created_at', 'LIKE', '%'.$request->created_at.'%');
            }
            if($request->updated_at != ""){
                $query->orWhere('userpayhistory.updated_at', 'LIKE', '%'.$request->updated_at.'%');
            }

            // $query->skip($skip)->take($take);

            if(($count = $query->count()) > 0){
                if(count($data = $query->skip($skip)->take($take)->get()) > 0){
                    $totalPages = $count / $request->getNumberOfData;
                    $data[0]->totalPages = ceil($totalPages);
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

    public function updateUserPayment(Request $request){
        if($request->userId == 1 && $request->userType == "companyUser"){
            // return $request->amount;
            DB::beginTransaction();
            
            $data = Userpayhistory::where('id', $request->tableId)->where('userid', $request->updateUserId)->first();
            $userData = Useraccount::where('id', $request->updateUserId)->first();
            
            $data->amount_paid = floatval($request->amount);
            $data->status = $request->status;

            if($request->status == "approved"){
                $userData->premium_or_not = "yes";
            }
            else{
                $userData->premium_or_not = "no";
            }
            
            if($data->save()){
                if($userData->save()){
                    DB::commit();
                    return "success";
                }
                else{
                    DB::rollback();
                    return "could not update";
                }
            }
            else{
                DB::rollback();
                return "could not update";
            }
        }
    }

    public function showUsersNotification(Request $request){
        if(($count = count($data = DB::table('useraccount')->select("visited_profile")->where("id", $request->session()->get('userId'))->where("checked_notification", "no")->get())) > 0){
            $data[0]->numberOfNotification = $count;
            $data[0]->notificationChecked = "no";
            return $data;
        }
        else{
            if(($count = count($data = DB::table('useraccount')->select("visited_profile")->where("id", $request->session()->get('userId'))->where("visited_profile", ">", 0)->get())) > 0){
                $data[0]->numberOfNotification = "";
                $data[0]->notificationChecked = "yes";
                return $data;
            }
            else{
                return "no data found";
            }
        }
    }

    public function userClickedNotification(Request $request){
        if($request->userId == $request->session()->get('userId') && $request->session()->get('userType') == "user"){
            if($data = Useraccount::where("id", $request->userId)->first()){
                if($data->checked_notification == "yes"){
                    return "success";
                }
                else{
                    $data->checked_notification = "yes";
                    if($data->save()){
                        return "success";
                    }
                    else{
                        return "could not update notification check";
                    }
                }
            }
            else{
                return "could not update notification check";
            }
        }
        else{
            return "could not update notification check";
        }
    }

    public function updateUsersNumberOfVisited(Request $request){
        if($data = Useraccount::where("id", $request->userId)->first()){
            $increaseVisited = (int)$data->visited_profile;
            $data->visited_profile = $increaseVisited + 1;
            $data->checked_notification = "no";
            if($data->save()){
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
}
