<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Userpayhistory;
use Illuminate\Support\Facades\DB;

class UserPaymentSearch extends Controller
{
    public function searchByTextFields(Request $request){
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
}
