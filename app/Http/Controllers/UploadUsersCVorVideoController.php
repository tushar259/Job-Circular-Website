<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Usercvvideos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Owenoj\LaravelGetId3\GetId3;

class UploadUsersCVorVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
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
        //$request->file; //file going to store
        //$_FILES['file']['tmp_name']; //file going to store
        //$_FILES['file']['size'];  //file size
        //$_FILES['file']['type'];  //file type(image, application/pdf, etc)

        if(!array_key_exists('file', $_FILES)){
            return "please select a file error";
        }
        else{
            if(!array_key_exists('tmp_name', $_FILES['file'])){
                return "please select a file error";
            }
            
        }

        if($_FILES['file']['size'] <= 0){
            return "file is too small to upload error";
        }

        $cvOrVideoFileName = "";

        if($request->sendingFileType == "cv"){
            if($_FILES['file']['type'] == "application/pdf"){
                if($_FILES['file']['size'] > 2097152){
                    return "cv cannot be more than 2MB error";
                }
                else{
                    $cvOrVideoFileName = "user_uploads/".$request->session()->get('userId')."/CV-(User_id-".$request->session()->get('userId').")-".$request->userName.".pdf";
                }
            }
            else{
                return "please select a pdf file error";
            }
        }
        else if($request->sendingFileType == "introVideo"){
            $videoType = "";
            $track = new GetId3(request()->file('file'));
            // $track = GetId3::fromUploadedFile(request()->file('anyfile'));
            $videoDuration = $track->getPlaytimeSeconds();

            if($videoDuration > 60.00){
                return "video cannot be more than 1 minute error";
            }
            
            if($_FILES['file']['size'] > 209715200){
                return "video cannot be more than 200MB error";
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
            $cvOrVideoFileName = "user_uploads/".$request->session()->get('userId')."/Introduction_Video-(User_id-".$request->session()->get('userId').")-".$request->userName.$videoType;
        }
        else{
            return "file format error";
        }
        
        if(!File::exists("user_uploads/".$request->session()->get('userId'))) {
            $path = public_path()."/user_uploads/".$request->session()->get('userId');
            if(File::makeDirectory($path, $mode = 0777, true, true)){
                if(count($data = DB::table('usercvvideos')->where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->sendingFileType)->get()) == 1){

                    $updateUserCVorVideos = Usercvvideos::where('userid', $request->session()->get('userId'))->where('upload_file_type', $request->sendingFileType)->first();
                    if(file_exists($updateUserCVorVideos->cv_video)){
                        if(unlink($updateUserCVorVideos->cv_video)){
                            if(move_uploaded_file($_FILES['file']['tmp_name'], $cvOrVideoFileName)){
                                
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
                        $insertUserCVorVideos = new Usercvvideos();
                        $insertUserCVorVideos->userid = $request->session()->get('userId');
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
                    $insertUserCVorVideos = new Usercvvideos();
                    $insertUserCVorVideos->userid = $request->session()->get('userId');
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
        
        if($request->gettingFileType == "cv" || $request->gettingFileType == "introVideo" || $request->gettingFileType == "skillOne" || $request->gettingFileType == "skillTwo" || $request->gettingFileType == "skillThree"){
            if(count($data = Usercvvideos::select('id','userid','name','cv_video','upload_file_type')->where('userid', $id)->where('upload_file_type', $request->gettingFileType)->get()) > 0 ){
                if($request->gettingFileType != "cv"){
                    // mail('zahidulislamtushar259@gmail.com', 'My Subject', 'My Message');
                    $source_file = public_path()."/".$data[0]->cv_video;
                    
                    $filesize = (string)(filesize($source_file));
                    $fileName = explode("/".$data[0]->userid."/", $data[0]->cv_video);
                    $originalFileName = $fileName[1];
                    // header("X-Sendfile: $source_file");

                    $videoExtention = explode(".", $data[0]->cv_video);
                    $videoType = "";

                    if($videoExtention[1] == "avi"){
                        $videoType = "video/avi";
                    }
                    else if($videoExtention[1] == "mp4"){
                        $videoType = "video/mp4";
                    }
                    else if($videoExtention[1] == "mkv"){
                        $videoType = "video/x-matroska";
                    }
                    else if($videoExtention[1] == "mov"){
                        $videoType = "video/quicktime";
                    }
                    else if($videoExtention[1] == "mpg"){
                        $videoType = "video/mpeg";
                    }
                    else if($videoExtention[1] == "webm"){
                        $videoType = "video/webm";
                    }

                    $range = false;
                    $range_length = 0;
                    $range_start = 0;
                    $range_end = 0;
                    if(isset($_SERVER['HTTP_RANGE'])){
                        $range = $_SERVER['HTTP_RANGE'];
                        list($param,$range) = explode('=',$range);
                        if(strtolower(trim($param)) != 'bytes'){
                            /* Range must be provided in bytes */
                            http_status_code(400);
                            die();
                        }
                        $range = explode(',',$range);
                        $range = explode('-',$range[0]); // We only deal with the first requested range
                        if(count($range) != 2){
                            http_status_code(400);
                            die();
                        }
                        if($range[0] === ""){
                            $range_end = $filesize - 1;
                            $range_start = $range_end - (int) $range[0];
                        }
                        elseif($range[1] === ""){
                            $range_start = (int) $range[0];
                            $range_end = $filesize - 1;
                        }
                        else{
                            $range_start = (int) $range[0];
                            $range_end = (int) $range[1];
                            if ($range_end >= $filesize || (!$range_start && (!$range_end || $range_end == ($filesize - 1)))){
                                $range = false;
                            }
                        }
                        $range_length = $range_end - $range_start + 1;
                        http_status_code(206);
                        header("Content-Range: bytes $range_start-$range_end/$filesize");
                    }
                    
                    header('Content-Type: '. $videoType);
                    header('Content-Length: ' . $filesize);
                    header('Content-Disposition: attachment; filename="' . $originalFileName . '"');
                    header('Accept-Ranges: bytes');
                    return readfile($source_file);
                }
                else{
                    $source_file = public_path()."/".$data[0]->cv_video;
                    $filesize = (string)(filesize($source_file));
                    $fileName = explode("/".$data[0]->userid."/", $data[0]->cv_video);
                    $originalFileName = $fileName[1];
                    header("Content-Length: " . $filesize ); 
                    header("Content-type: application/octet-stream"); 
                    header("Content-disposition: attachment; filename=".$originalFileName);
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    ob_clean();
                    flush();
                    return readfile($source_file);
                }

            }
            else{
                // return "no data found";
                if($request->gettingFileType != "cv"){
                    return readfile("");
                }
                else{
                    // return "no data found";
                    return readfile("");
                }
            }
        }
    }

    public function returnFile($data){
        $block_size = (1024 * 1024);
        $source_file = public_path()."/".$data[0]->cv_video;
        $filesize = filesize($source_file);
        $range = false;
        $range_length = 0;
        $range_start = 0;
        $range_end = 0;
        if(isset($_SERVER['HTTP_RANGE'])){
            $range = $_SERVER['HTTP_RANGE'];
        }
        elseif(function_exists("apache_request_headers") && $apache_headers = apache_request_headers()){
            /* This applies to some Apache servers */
            $headers = array();
            
            foreach($apache_headers as $header => $val)
            {
                $headers[strtolower($header)] = $val;
            }
            
            if(isset($headers['range']))
            {
                $range = $headers['range'];
            }
        }

        if($range !== false){
            /* Process range data provided */
            list($param,$range) = explode('=',$range);
            
            if(strtolower(trim($param)) != 'bytes'){
                /* Range must be provided in bytes */
                http_status_code(400);
                die();
            }
            
            $range = explode(',',$range);
            $range = explode('-',$range[0]); // We only deal with the first requested range
            
            if(count($range) != 2){
                http_status_code(400);
                die();
            }
            
            if($range[0] === ""){
                $range_end = $filesize - 1;
                $range_start = $range_end - (int) $range[0];
            }
            elseif($range[1] === ""){
                $range_start = (int) $range[0];
                $range_end = $filesize - 1;
            }
            else{
                $range_start = (int) $range[0];
                $range_end = (int) $range[1];
                
                if ($range_end >= $filesize || (!$range_start && (!$range_end || $range_end == ($filesize - 1)))){
                    $range = false;
                }
            }
            
            $range_length = $range_end - $range_start + 1;
            
            http_status_code(206);
            header("Content-Range: bytes $range_start-$range_end/$filesize");
        }
        else{
            $range_length = $filesize;
            $range_start = 0;
            $range_end = $filesize - 1;
        }
        $fileName = explode("/".$data[0]->userid."/", $data[0]->cv_video);
        $originalFileName = $fileName[1];
        
        http_status_code(206);
        header("Content-Range: bytes $range_start-$range_end/$filesize");
        header("Content-Type: video/mp4");
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"{$originalFileName}\""); 
        header("Accept-Ranges: bytes");
        
        if($range === false && false /* Temporary workaround for lighttpd memory leak */){
            
            header("Content-Length: {$filesize}");
            $offset = 0;
            readfile($source_file);
        }
        else{
            $handle = fopen($source_file, "rb");
            // return "we reached";
            $block = "";
            $length = $block_size;
            $block_count = ceil($filesize / $block_size);
            
            header("Content-Length: {$range_length}");
            
            $offset  = $range_start;
            
            if($range_length < $block_size){
                $length = $range_length;
            }
            
            for($i = 0; $i < $block_count; $i++){
                if(connection_aborted()){
                    /* The request was cancelled; most likely in order to make a subsequent range request. */
                    die();
                }
                
                $block = stream_get_contents($handle, $length, $offset);
                // echo($block);
                
                $next_offset = $offset + $length;
                
                if($next_offset > $range_end){
                    /* We're done here. */
                    break;
                }
                
                if($next_offset + $length > $range_end){
                    /*The next block contains the range end. We don't want to serve beyond
                    * that point, so we change the length to end at the range end. */
                    $length = $range_end - $next_offset + 1;
                }
                
                $offset = $next_offset;
                
                /* Ensure that script execution doesn't time out. */
                set_time_limit(0);
            }

            fclose($handle);
        }
        die();
        return $data;
        
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
