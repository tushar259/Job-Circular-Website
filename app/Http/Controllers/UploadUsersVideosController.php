<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usercvvideos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Owenoj\LaravelGetId3\GetId3;

class UploadUsersVideosController extends Controller
{
    public function uploadVideoFiles(Request $request){
        if($request->session()->has("userType") && $request->session()->get("userType") == "user"){

            
            $file = $request->file('file');

            if($request->whichFile == "introVideo" || $request->whichFile == "skillOne" || $request->whichFile == "skillTwo" || $request->whichFile == "skillThree"){
                $track = new GetId3(request()->file('originalFile'));
                $videoDuration = $track->getPlaytimeSeconds();

                if($_FILES['originalFile']['type'] == "video/avi" ||
                   $_FILES['originalFile']['type'] == "video/mp4" ||
                   $_FILES['originalFile']['type'] == "video/x-matroska" ||
                   $_FILES['originalFile']['type'] == "video/quicktime" ||
                   $_FILES['originalFile']['type'] == "video/mpeg" ||
                   $_FILES['originalFile']['type'] == "video/webm"
                ){
                    // video selected
                }
                else{
                    return response()->json(['message' => 'error occurred', 'error_message' => 'video format does not support error', 'uploaded' => 'failed']);
                }

                if($request->whichFile == "introVideo"){
                    if($videoDuration > 60.00){
                        return response()->json(['message' => 'error occurred', 'error_message' => 'video cannot be more than 1 minute error', 'uploaded' => 'failed']);
                    }
                    
                    if($_FILES['originalFile']['size'] > 209715200){
                        return response()->json(['message' => 'error occurred', 'error_message' => 'video cannot be more than 200MB error', 'uploaded' => 'failed']);
                    }
                }
                else{
                    if($request->IfPremiumOrNot == "yes"){
                        if($videoDuration > 300.00){
                            return response()->json(['message' => 'error occurred', 'error_message' => 'video cannot be more than 5 minutes error', 'uploaded' => 'failed']);
                        }
                        
                        if($_FILES['originalFile']['size'] > 1073741824){
                            return response()->json(['message' => 'error occurred', 'error_message' => 'video cannot be more than 1GB error', 'uploaded' => 'failed']);
                        }
                    }
                    else if($request->IfPremiumOrNot == "no"){
                        if($videoDuration > 180.00){
                            return response()->json(['message' => 'error occurred', 'error_message' => 'video cannot be more than 3 minutes error', 'uploaded' => 'failed']);
                        }
                        
                        if($_FILES['originalFile']['size'] > 524288000){
                            return response()->json(['message' => 'error occurred', 'error_message' => 'video cannot be more than 500MB error', 'uploaded' => 'failed']);
                        }
                    }
                }
            }
            else{
                return response()->json(['message' => 'error occurred', 'error_message' => 'cannot upload video error', 'uploaded' => 'failed']);
            }

            $fileName = "";
            if($request->whichFile == "introVideo"){
                $fileName = $request->session()->get('userId')."-introVideo-".$file->getClientOriginalName();
            }
            else if($request->whichFile == "skillOne"){
                if($request->fileName == ""){
                    $request->fileName = "skillOne";
                }
                $fileName = $request->session()->get('userId')."-skillOne-".$file->getClientOriginalName();
            }
            else if($request->whichFile == "skillTwo"){
                if($request->fileName == ""){
                    $request->fileName = "skillTwo";
                }
                $fileName = $request->session()->get('userId')."-skillTwo-".$file->getClientOriginalName();
            }
            else if($request->whichFile == "skillThree"){
                if($request->fileName == ""){
                    $request->fileName = "skillThree";
                }
                $fileName = $request->session()->get('userId')."-skillThree-".$file->getClientOriginalName();
            }

            

            if(!File::exists("user_uploads/".$request->session()->get('userId'))){
                $createFolderPath = public_path()."/user_uploads/".$request->session()->get('userId');
                if(File::makeDirectory($createFolderPath, $mode = 0777, true, true)){

                }
                else{
                    return response()->json(['message' => 'error occurred', 'error_message' => 'folder counld not be created']);
                }
            }

            $path = public_path()."/user_uploads/".$request->session()->get('userId')."/".$fileName;
            // $path = Storage::disk('local')->path("chunks/{$file->getClientOriginalName()}");

            File::append($path, $file->get());
            // Storage::append($path, $file->get());

            if ($request->has('is_last') && $request->boolean('is_last')) {
                $name = basename($path, '.part');
                $nameOfFullPath = public_path()."/user_uploads/".$request->session()->get('userId')."/".$name;

                $existFile = $this->checkIfFileExist($request->session()->get('userId'), $request->whichFile);
                if($existFile == "file could not be deleted"){
                    if(unlink("user_uploads/".$request->session()->get('userId')."/".$name.".part")){
                        return response()->json(['message' => 'error occurred', 'error_message' => 'previous file exist in storage, current and previous file could not be deleted', 'uploaded' => 'failed']);
                    }
                    else{
                        return response()->json(['message' => 'error occurred', 'error_message' => 'previous file exist in storage and could not be deleted', 'uploaded' => 'failed']);
                    }
                }

                $currentUploadedFile = $this->checkIfUploadedFileAlreadyExist("user_uploads/".$request->session()->get('userId')."/".$name);
                if($currentUploadedFile == "file exist"){
                    if(unlink("user_uploads/".$request->session()->get('userId')."/".$name.".part")){
                        return response()->json(['message' => 'error occurred', 'error_message' => 'previous file exist in storage, current and previous file could not be deleted', 'uploaded' => 'failed']);
                    }
                    else{
                        return response()->json(['message' => 'error occurred', 'error_message' => 'previous file exist in storage and could not be deleted', 'uploaded' => 'failed']);
                    }
                }

                if(File::move($path, "{$nameOfFullPath}")){
                    
                    if($existFile == "file exist in database"){
                        $data = Usercvvideos::select('id','userid','name','cv_video','upload_file_type')->where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->whichFile)->first();
                        $data->userid = $request->session()->get('userId');
                        $data->name = $request->fileName;
                        $data->cv_video = "user_uploads/".$request->session()->get('userId')."/".$name;
                        $data->upload_file_type = $request->whichFile;
                        if($data->save()){
                            return response()->json(['message' => 'success', 'uploaded' => true]);
                        }
                        else{
                            return response()->json(['message' => 'error occurred', 'error_message' => 'could not update server', 'uploaded' => true]);
                        }
                    }
                    else{
                        $data = new Usercvvideos();
                        $data->userid = $request->session()->get('userId');
                        $data->name = $request->fileName;
                        $data->cv_video = "user_uploads/".$request->session()->get('userId')."/".$name;
                        $data->upload_file_type = $request->whichFile;
                        if($data->save()){
                            return response()->json(['message' => 'success', 'uploaded' => true]);
                        }
                        else{
                            return response()->json(['message' => 'error occurred', 'error_message' => 'could not store in server', 'uploaded' => true]);
                        }
                    }
                }
            }

            return response()->json(['message' => 'not completed yet','uploaded' => true]);
        }
    }

    public function checkIfFileExist($id, $whichFile){
        if(count($data = Usercvvideos::select('id','userid','name','cv_video','upload_file_type')->where('userid', $id)->where('upload_file_type', $whichFile)->get()) > 0 ){
            if(file_exists($data[0]->cv_video)){
                if(unlink($data[0]->cv_video)){
                    return "file exist in database";
                }
                else{
                    return "file could not be deleted";
                }
            }
            else{
                return "file exist in database";
            }
        }
        else{
            return "success";
        }
    }

    public function checkIfUploadedFileAlreadyExist($currentUploadedFilePath){
        if(file_exists($currentUploadedFilePath)){
            if(unlink($currentUploadedFilePath)){
                return "success";
            }
            else{
                return "file exist";
            }
        }
        else{
            return "success";
        }
    }
}
