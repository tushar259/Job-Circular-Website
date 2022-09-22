<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usercvvideos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Owenoj\LaravelGetId3\GetId3;

class DeleteCvOrVideoController extends Controller
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
        if($request->fileType == "cv" || $request->fileType == "introVideo" || $request->fileType == "skillOne" || $request->fileType == "skillTwo" || $request->fileType == "skillThree"){
            if($id == $request->session()->get('userId') && $request->session()->get("userType") == "user"){
                if(count($data = DB::table('usercvvideos')->where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->fileType)->get()) == 1){
                    $deleteUserCVorVideos = Usercvvideos::where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->fileType)->first();
                    if(file_exists($deleteUserCVorVideos->cv_video)){
                        if($deleteUserCVorVideos->delete() && unlink($deleteUserCVorVideos->cv_video)){
                            return "success";
                        }
                        else{
                            return "could not delete file error";
                        }
                    }
                    else{
                        if($deleteUserCVorVideos->delete()){
                            return "success";
                        }
                        else{
                            return "could not delete file error";
                        }
                    }
                }
                else{
                    return "file already deleted error";
                }
            }
            else{
                return "this user cannot delete error";
            }
        }
        else{
            return "cannot delete this type error";
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
