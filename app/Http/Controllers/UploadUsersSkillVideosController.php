<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usercvvideos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
// use Illuminate\Http\File;
use Owenoj\LaravelGetId3\GetId3;

class UploadUsersSkillVideosController extends Controller
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
        if(!array_key_exists('file', $_FILES)){
            return "please select a file error";
        }
        else{
            if(!array_key_exists('tmp_name', $_FILES['file'])){
                return "please select a file error";
            }
            
        }

        if($_FILES['file']['size'] == 0){
            return "file is too small to upload error";
        }

        $cvOrVideoFileName = "";

        if($request->sendingFileType == "skillOne" || $request->sendingFileType == "skillTwo" || $request->sendingFileType == "skillThree"){
            $videoType = "";
            $track = new GetId3(request()->file('file'));
            // $track = GetId3::fromUploadedFile(request()->file('anyfile'));
            $videoDuration = $track->getPlaytimeSeconds();

            if($request->IfPremiumOrNot == "no"){
                if($videoDuration > 180.00){
                    return "video cannot be more than 3 minutes error";
                }
                
                if($_FILES['file']['size'] > 524288000){
                    return "video cannot be more than 500MB error";
                }
            }
            else if($request->IfPremiumOrNot == "yes"){
                if($videoDuration > 300.00){
                    return "video cannot be more than 5 minutes error";
                }
                
                if($_FILES['file']['size'] > 1073741824){
                    return "video cannot be more than 1GB error";
                }
            }
            else{
                return "something went wrong error";
            }
            

            if($_FILES['file']['type'] == "video/avi"){
                $videoType = ".avi";
            }
            else if($_FILES['file']['type'] == "video/mp4"){
                $videoType = ".mp4";
            }
            else if($_FILES['file']['type'] == "video/x-matroska"){
                $videoType = ".mkv";
            }
            else if($_FILES['file']['type'] == "video/quicktime"){
                $videoType = ".mov";
            }
            else if($_FILES['file']['type'] == "video/mpeg"){
                $videoType = ".mpg";
            }
            else if($_FILES['file']['type'] == "video/webm"){
                $videoType = ".webm";
            }
            else{
                return "video format does not support error";
            }
            $cvOrVideoFileName = "user_uploads/".$request->session()->get('userId')."/".$request->skillName."-".$request->sendingFileType."-(User_id-".$request->session()->get('userId').")-".$request->userName.$videoType;
            // $cvOrVideoFileName = $request->skillName."-".$request->sendingFileType."-(User_id-".$request->session()->get('userId').")-".$request->userName.$videoType;
        }
        else{
            return "cannot upload video error";
        }
        
        if(!File::exists("user_uploads/".$request->session()->get('userId'))) {
            $path = public_path()."/user_uploads/".$request->session()->get('userId');
            if(File::makeDirectory($path, $mode = 0777, true, true)){
                if(count($data = DB::table('usercvvideos')->where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->sendingFileType)->get()) == 1){

                    $updateUserCVorVideos = Usercvvideos::where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->sendingFileType)->first();
                    if(file_exists($updateUserCVorVideos->cv_video)){
                        if(unlink($updateUserCVorVideos->cv_video)){
                            
                            if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                            // if(Storage::disk('s3')->put("user_uploads/".$request->session()->get('userId'), fopen($_FILES['file']['tmp_name'], 'r+'))){
                            // if(Storage::putFileAs("user_uploads/".$request->session()->get('userId'), $_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                                $updateUserCVorVideos->name = $request->skillName;
                                $updateUserCVorVideos->cv_video = $cvOrVideoFileName;
            
                                if($updateUserCVorVideos->save()){
                                    return "success";
                                }
                                else{
                                    return "server error";
                                }
                                
                            }
                            else{
                                return "file uploading problem error";
                            }
                        }
                        else{
                            return "could not update error";
                        }
                    }
                    else{
                        if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                            // if(Storage::disk('s3')->put("user_uploads/".$request->session()->get('userId'), fopen($_FILES['file']['tmp_name'], 'r+'))){
                        // if(Storage::putFileAs("user_uploads/".$request->session()->get('userId'), $_FILES['file']['tmp_name'], $cvOrVideoFileName)){    
                            $updateUserCVorVideos->name = $request->skillName;
                            $updateUserCVorVideos->cv_video = $cvOrVideoFileName;
        
                            if($updateUserCVorVideos->save()){
                                return "success";
                            }
                            else{
                                return "server error";
                            }
                            
                        }
                        else{
                            return "file uploading problem error";
                        }
                    }
                }
                else{
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                    // if(Storage::disk('s3')->put("user_uploads/".$request->session()->get('userId'), fopen($_FILES['file']['tmp_name'], 'r+'))){
                    // if(Storage::putFileAs("user_uploads/".$request->session()->get('userId'), $_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                        $insertUserCVorVideos = new Usercvvideos();
                        $insertUserCVorVideos->userid = $request->session()->get('userId');
                        $insertUserCVorVideos->name = $request->skillName;
                        $insertUserCVorVideos->cv_video = $cvOrVideoFileName;
                        $insertUserCVorVideos->upload_file_type = $request->sendingFileType;
                        
                        if($insertUserCVorVideos->save()){
                            return "success";
                        }
                        else{
                            return "server error";
                        }
                    }
                    else{
                        return "file uploading problem error";
                    }
                    
                }

            }
            else{
            	return "folder could not be created error";
            }
        }
        else{
            if(count($data = DB::table('usercvvideos')->where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->sendingFileType)->get()) == 1){
                $updateUserCVorVideos = Usercvvideos::where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->sendingFileType)->first();

                if(file_exists($updateUserCVorVideos->cv_video)){
                    if(unlink($updateUserCVorVideos->cv_video)){
                        if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                        // if(Storage::disk('s3')->put("user_uploads/".$request->session()->get('userId'), fopen($_FILES['file']['tmp_name'], 'r+'))){
                        // if(Storage::putFileAs("user_uploads/".$request->session()->get('userId'), $_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                            $updateUserCVorVideos->name = $request->skillName;
                            $updateUserCVorVideos->cv_video = $cvOrVideoFileName;
        
                            if($updateUserCVorVideos->save()){
                                return "success";
                            }
                            else{
                                return "server error";
                            }
                            
                        }
                        else{
                            return "file uploading problem error";
                        }
                    }
                    else{
                        return "could not update error";
                    }
                }
                else{
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                    // if(Storage::disk('s3')->put("user_uploads/".$request->session()->get('userId'), fopen($_FILES['file']['tmp_name'], 'r+'))){
                    // if(Storage::putFileAs("user_uploads/".$request->session()->get('userId'), $_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                        $updateUserCVorVideos->name = $request->skillName;  
                        $updateUserCVorVideos->cv_video = $cvOrVideoFileName;
    
                        if($updateUserCVorVideos->save()){
                            return "success";
                        }
                        else{
                            return "server error";
                        }
                        
                    }
                    else{
                        return "file uploading problem error";
                    }
                }
            }
            else{
                // if(Storage::putFileAs("user_uploads/".$request->session()->get('userId'), $_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                // if(Storage::disk('s3')->put("user_uploads/".$request->session()->get('userId'), fopen($_FILES['file']['tmp_name'], 'r+'))){
                if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                    $insertUserCVorVideos = new Usercvvideos();
                    $insertUserCVorVideos->userid = $request->session()->get('userId');
                    $insertUserCVorVideos->name = $request->skillName;
                    $insertUserCVorVideos->cv_video = $cvOrVideoFileName;
                    $insertUserCVorVideos->upload_file_type = $request->sendingFileType;
                    
                    if($insertUserCVorVideos->save()){
                        return "success";
                    }
                    else{
                        return "server error";
                    }
                }
                else{
                    return "file uploading problem error";
                }
                
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
        if($id == $request->session()->get('userId')){
            if($request->skillType == "skillOne" || $request->skillType == "skillTwo" || $request->skillType == "skillThree"){
                $updateUserCVorVideos = Usercvvideos::where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->skillType)->first();
                $updateUserCVorVideos->name = $request->skillName;
                
                if($updateUserCVorVideos->save()){
                    return "success";
                }
                else{
                    return "server error";
                }
            }
            else{
                return "cannot update error";
            }
        }
        else{
            return "user is not authorized to update error";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
    }
}
