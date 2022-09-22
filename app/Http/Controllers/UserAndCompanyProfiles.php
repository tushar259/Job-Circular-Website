<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Useraccount;
use App\Models\Companyaccount;
use Illuminate\Support\Facades\DB;

class UserAndCompanyProfiles extends Controller
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
        if($request->getDataType == "showUserAndCompanyProfile"){
            if($request->userType == "user"){
                //return company list
                if(($count = Companyaccount::where("id", "<>", 1)->count()) > 0){
                    if(count($data = DB::table('companyaccount')->where("id", "<>", 1)->skip(0)->take(20)->orderBy('company_name')->get()) > 0){
                        $totalProfilePages = $count / 20;
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
                    if(count($data = DB::table('useraccount')->skip(0)->take(20)->orderBy('name')->get()) > 0){
                        $totalProfilePages = $count / 20;
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
            else{
                return "no data found";
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
