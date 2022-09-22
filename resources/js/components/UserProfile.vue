<template>
    <div>

        <nav class="navbar navbar-light navbar-expand mb-4 topbar static-top">
            <div class="container-fluid">
                <div class="col-10 text-center">
                
                    <input class="bg-light border-0" type="text" placeholder="Search for ..." style="padding-left:4px;height:37px;width:135px;font-size:14px;" name="searchBox" v-model="searchField" @keyup.enter="searchData()"><button class="btn btn-primary py-0"
                        type="button" style="height: 37px;width: 36px;background-color:rgb(214, 214, 194);font-size:16px;" @click.prevent="searchData()"><i class="fas fa-search"></i></button>
                
                </div>
                <div class="col">
                <ul v-if="userType == 'companyUser'" style="font-size:20px;" class="nav navbar-nav flex-nowrap ml-auto">
                    <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" @click.prevent="notificationClicked()"><span class="badge badge-danger badge-counter">{{notificationNumber}}</span><i class="fas fa-bell fa-fw"></i></a>
                            <div style="height:250px;width:230px;overflow:auto;" class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                role="menu">
                                <h5 class="dropdown-header" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;">Notifications</h5>
                                
                                <div v-for="(appliedUserForCircular, index) in appliedUserForCirculars">
                                    <a class="d-flex align-items-center dropdown-item" style="font-size:12px;" v-bind:href="'/view-circular/'+appliedUserForCircular.circular_id" target="_blank">
                                        <div class="mr-3">
                                            <div class="bg-primary icon-circle"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                        </div>
                                        <div style="padding-left:4px;"><span class="text-gray-500" style="font-size:10px;">{{appliedUserForCircular.appliedForCircularAt | timeago}}</span>
                                            <div style="height:5px;"></div>
                                            <p><a v-bind:href="'/profile/'+appliedUserForCircular.applied_user_id+'/0a3i-15k04cn27=l103rt83-25jkx4'" target="_blank">{{appliedUserForCircular.name}}</a> applied for circular - <a v-bind:href="'/view-circular/'+appliedUserForCircular.circular_id" target="_blank">{{appliedUserForCircular.circular_name}}</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a></p>
                                            <p><a v-bind:href="'/view-circular/'+appliedUserForCircular.circular_id" target="_blank">Check circular</a></p>
                                        </div>
                                    </a>
                                </div>
                                <a class="text-center dropdown-item small text-gray-500"></a>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul v-if="userType == 'user'" style="font-size:20px;" class="nav navbar-nav flex-nowrap ml-auto">
                    <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                        <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" @click.prevent="usersNotificationClicked()"><span class="badge badge-danger badge-counter">{{usersNotificationNumber}}</span><i class="fas fa-bell fa-fw"></i></a>
                            <div style="height:250px;width:230px;overflow:auto;" class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                role="menu">
                                <h5 class="dropdown-header" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;">Notifications</h5>
                                
                                <div v-if="userCheckedNotification == 'no'" v-for="(notificationForUser, index) in notificationForUsers">
                                    <a class="d-flex align-items-center dropdown-item" href="" target="_blank" style="background-color:rgb(204, 204, 179);font-size:12px;" >
                                        <div class="mr-3">
                                            <div class="bg-primary icon-circle"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                        </div>
                                        <div style="padding-left:4px;"><span class="text-gray-500" style="opacity:0;">check notificaions</span>
                                            <p><a href="" target="_blank" style="text-decoration:none;color:black;"> Company just visited your profile. Update your CV and Skill videos. Check total visited.</a></p>
                                            
                                        </div>
                                    </a>
                                </div>
                                
                                <div v-if="userCheckedNotification == 'yes'" v-for="(notificationForUser, index) in notificationForUsers">
                                    <a class="d-flex align-items-center dropdown-item" href="" target="_blank" style="font-size:12px;">
                                        <div class="mr-3">
                                            <div class="bg-primary icon-circle"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                        </div>
                                        <div style="padding-left:4px;"><span class="text-gray-500" style="opacity:0;">check notificaions</span>
                                            <p><a href="" target="_blank" style="text-decoration:none;color:black;"> Company just visited your profile. Update your CV and Skill videos. Check total visited.</a></p>
                                            
                                        </div>
                                    </a>
                                </div>
                                <a class="text-center dropdown-item small text-gray-500"></a>
                            </div>
                        </div>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <div id="showDataTemplate">
            <div style="text-align:center;margin:0 auto;">
                <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
            </div>
            <div style="height:600px;">
            </div>
        </div>
        <div id="divWithData">
            <div class="container-fluid">
                 
            
                <!-- <div v-if="showDeleteIntroOptionData == 'hide'">
                    <label>Introduction</label> <a v-bind:href="axiosGetIntroVideo" download>download</a> | <a v-if="userIdFromLink == userId && userType == 'user'" name="intro" @click.prevent="showDeleteOption($event)" href="">Delete video</a><br>
                </div>
                <div v-else>
                    <label>Are you sure you want to delete Intoduction Video?</label><br>
                    <a v-if="userIdFromLink == userId && userType == 'user'" name="intro" @click.prevent="deleteFileOption($event)" href="">Yes, Delete</a> | <a name="intro" @click.prevent="hideDeleteOption($event)" href="">No, Cancel</a>
                </div> -->
                <div class="card shadow-lg o-hidden border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col">
                                <div class="m-auto p-5">
                                    <div class="user" style="text-align:center;">
                                        <div v-if="axiosGetIntroVideo != ''">
                                            <div style="font-size:25px;"><label>Introduction</label> <a v-bind:href="axiosGetIntroVideo" :download="'User ID_'+userIdFromLink+'-Introduction'">Download</a> 
                                            <a v-if="userIdFromLink == userId && userType == 'user' && showDeleteIntroOptionData == 'hide'" name="intro" @click.prevent="showDeleteOption($event)" href="">Delete Video</a></div>
                                            <div style="font-size:25px;" v-if="showDeleteIntroOptionData != 'hide'">
                                                <label>Are you sure you want to delete Introduction Video?</label>
                                                <a v-if="userIdFromLink == userId && userType == 'user'" name="intro" @click.prevent="deleteFileOption($event)" href="">Yes, Delete</a> | <a name="intro" @click.prevent="hideDeleteOption($event)" href="">No, Cancel</a>
                                            </div>
                                            <video style="width:100%;max-width:1000px;height:auto;max-height:350px;" controls>
                                                <source :src="axiosGetIntroVideo">
                                            </video>
                                        </div>
                                        <div v-else>
                                            <div v-if="userIdFromLink == userIdS && userType == 'user'" style="background:#666;width:100%;max-width:1000px;height:400px;margin:auto;">
                                                <div class="form-group" style="color:white;font-size:14px;width:100%;">
                                                    Upload Introduction Video (Introduce Yourself)
                                                    <div style="height:30px;"></div>
                                                    
                                                    <input type="file" id="introVideo" ref="introVideoFile" name="introVideoFile" v-on:change="readVideoURL()" style="font-size:14px;margin:auto;"/>
                                                    <!-- CHUNK way to upload file -->
                                                    <!-- <input type="file" id="introVideo" ref="introVideoFile" name="introVideoFile" v-on:change="select($event)" style="font-size:14px;margin:auto;"/> -->
                                                    <!-- CHUNK way to upload file (END) -->
                                                    <div style="height:30px;"></div>
                                                    
                                                    <button class="btn btn-primary" style="background-color:rgb(64,132,63);color:white;font-size:20px;" v-on:click="submitIntroVideo()">Upload</button>
                                                    <!-- CHUNK way to upload file -->
                                                    <!-- <button v-if="uploadButtonPressed == ''" class="btn btn-primary" name="introUploadButton" style="background-color:rgb(64,132,63);color:white;font-size:20px;" v-on:click="createChunks($event)">Upload</button>
                                                    <button v-if="uploadButtonPressed == 'pressed' && selectedVideoFile == 'introVideo'" class="btn btn-danger" name="introCancelButton" style="color:white;font-size:20px;" v-on:click="cancelUploading($event)">Cancel</button> -->
                                                    <!-- CHUNK way to upload file (END) -->
                                                    <div style="height:10px;"></div>
                                                    <p v-if="introVideoUploadPercentage != '' && introVideoUploadPercentage != 100">Uploading {{introVideoUploadPercentage}}%</p>
                                                    <p v-if="introVideoUploadPercentage == 100">
                                                        Processing...  Please Wait.
                                                    </p>
                                                    <div v-if="introVideoUploadPercentage == ''">
                                                        Video Size Maximum 1 Minute and 200 MB
                                                        <p data-toggle="tooltip" data-placement="top" title="Supported Video Formats">(mp4, avi, mkv, mov, mpg, webm)</p>
                                                    </div>
                                                    <!-- <progress v-if="selectedVideoFile == 'introVideo' && uploadButtonPressed == 'pressed'"></progress>
                                                    <div v-if="selectedVideoFile == 'introVideo' && uploadButtonPressed == 'pressed'">
                                                        <p v-if="(videoUploadedInPercntg == 99.99 || videoUploadedInPercntg == 100.00 || videoUploadedInPercntg == 100)">Processing...</p>
                                                        <p v-else>Uploading {{videoUploadedInPercntg}}%</p>
                                                    </div>
                                                    <div v-else>
                                                        Video Size Maximum 1 Minute and 17 MB
                                                        <p data-toggle="tooltip" data-placement="top" title="Supported Video Formats">(mp4, avi, mkv, mov, mpg, webm)</p>
                                                    </div> -->
                                                    <p id="introUploadError"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="font-family:Arial, Helvetica, sans-serif;font-size:30px;font-weight:bold;">{{userName}}</div>
                                        <div v-if="userGender == 'female'" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">(Female)</div>
                                        <div v-else-if="userGender == 'male'" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">(Male)</div>
                                        <div v-else style="font-family:Arial, Helvetica, sans-serif;font-size:15px;font-weight:bold;">({{userGender}})</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width:100%;max-width:1000px;margin:auto;">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col">
                                    <div class="m-auto p-5">
                                        <div style="text-align:left;">
                                            <h4 class="text-dark mb-4">About</h4>
                                        </div>
                                        <div class="user" style="text-align:left;">
                                            <table>
                                                <tr>
                                                    <td><h4 class="mb-4">Email</h4></td>
                                                    <td><div style="width:40px;"></div></td>
                                                    <td><h4 class="mb-4">{{userEmail}}</h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4 class="mb-4">Phone</h4></td>
                                                    <td><div style="width:40px;"></div></td>
                                                    <td><h4 class="mb-4">{{userPhone}}</h4></td>
                                                </tr>
                                                <tr v-if="userType == 'user'" data-toggle="tooltip" data-placement="top" title="Number of times company visited profile">
                                                    <td><h4 class="mb-4">Profile Visited</h4></td>
                                                    <td><div style="width:40px;"></div></td>
                                                    <td><h4 class="mb-4">{{numberOfVisitedProfile}} Times</h4></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width:100%;max-width:1000px;margin:auto;">
                    <div class="row">
                        <div class="col" style="min-width:230px;">
                            <div class="card shadow-lg o-hidden border-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col">
                                            <div class="m-auto p-5">
                                                <div style="text-align:left;">
                                                    <h4 class="text-dark mb-4">CV</h4>
                                                </div>
                                                <div class="user" style="text-align:left;">
                                                    <div v-if="axiosGetCV != ''">
                                                        <div v-if="showDeleteCVOptionData == 'hide'">
                                                            <h3><a v-bind:href="axiosGetCV" :download="'User ID_'+userIdFromLink+'-CV'">Download</a> <a v-if="userIdFromLink == userId && userType == 'user'" name="cv" @click.prevent="showDeleteOption($event)" href="">Delete CV</a></h3>
                                                        </div>
                                                        <div v-else>
                                                            <h3><label>Are you sure you want to delete CV?</label></h3>
                                                            <h3><a v-if="userIdFromLink == userId && userType == 'user'" name="cv" @click.prevent="deleteFileOption($event)" href="">Yes, Delete</a> | <a name="cv" @click.prevent="hideDeleteOption($event)" href="">No, Cancel</a></h3>
                                                        </div>
                                                        <div class="iWantToHideScroll" style="overflow:auto;">
                                                            <embed style="border: 3px solid #b3d9ff;" v-bind:src="axiosGetCV" type="application/pdf"  width="550px" height="300px" class="responsive">
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div style="text-align:center;">
                                                            <div v-if="userIdFromLink == userIdS && userType == 'user'" style="background:#666;width:100%;max-width:430px;height:350px;margin:auto;">
                                                                <div class="form-group" style="color:white;font-size:14px;width:100%;">
                                                                    Upload Your CV (PDF)
                                                                    <div style="height:30px;"></div>
                                                                    <input type="file" ref="cvpdf" name="cvpdf" v-on:change="readCVURL()" style="font-size:14px;margin:auto;"/>
                                                                    <div style="height:30px;"></div>
                                                                    <button class="btn btn-primary" style="background-color:rgb(64,132,63);color:white;font-size:20px;" v-on:click="submitCV()">Upload CV</button>
                                                                    <div style="height:10px;"></div>
                                                                    <p v-if="uploadPercentage != ''">Uploading {{uploadPercentage}}%</p>
                                                                    <p v-if="uploadPercentage == 100">
                                                                        Processing...  Please Wait.
                                                                    </p>
                                                                    <p v-if="uploadPercentage == ''">PDF Size Maximum 2 MB</p>
                                                                    <p id="cvUploadError"></p>
                                                                </div>
                                                            </div>
                                                            <div v-if="userType == 'companyUser'">
                                                                <div style="font-size:12px;">
                                                                    This user did not upload CV.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="min-width:230px;">
                            <div v-if="IfPremiumUser == 'no' && userType == 'user'" style="font-size:14px;">
                                To upload skill videos upto 5 minutes and 1GB, click here <a href="/pay-method">Go Premium</a>
                            </div>
                            <div class="card shadow-lg o-hidden border-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col">
                                            <div class="m-auto p-5">
                                                <div style="text-align:left;">
                                                    <h4 class="text-dark mb-4">Skill Video 1</h4>
                                                </div>
                                                <div class="user" style="text-align:left;">
                                                    <div v-if="axiosGetSkillOneVideo != ''">
                                                        <div v-if="showSkillOneData == 'show'">
                                                            <div v-if="showDeleteOneOptionData == 'hide'">
                                                                <h3><label>{{axiosGetSkillOneVideoTitle}}</label> <a v-bind:href="axiosGetSkillOneVideo" :download="'User ID_'+userIdFromLink+'-'+axiosGetSkillOneVideoTitle">Download</a> <a v-if="userIdFromLink == userId && userType == 'user'" @click.prevent="showEditSkillOne()" href="">Edit</a> <a v-if="userIdFromLink == userId && userType == 'user'" name="one" @click.prevent="showDeleteOption($event)" href="">Delete video</a></h3>
                                                            </div>
                                                            <div v-else>
                                                                <h3><label>Are you sure you want to delete this video?</label></h3>
                                                                <h3><a v-if="userIdFromLink == userId && userType == 'user'" name="one" @click.prevent="deleteFileOption($event)" href="">Yes, Delete</a> | <a name="one" @click.prevent="hideDeleteOption($event)" href="">No, Cancel</a></h3>
                                                            </div>
                                                        </div>
                                                        <div v-else>
                                                            <h3><input class="form-control" style="font-size:14px;" v-if="userIdFromLink == userId && userType == 'user'" type="text" v-model="userSkillOneName" placeholder="skill name/type of skill..." > <a v-if="userIdFromLink == userId && userType == 'user'" @click.prevent="updateEditSkillOne()" href="">Update</a> | <a @click.prevent="hideEditSkillOne()" href="">Cancel</a></h3>
                                                            <h3><p id="updateSkillOneNameError"></p></h3>
                                                        </div>
                                                        <video style="width:100%;max-width:430px;height:auto;max-height:300px;" controls>
                                                            <source :src="axiosGetSkillOneVideo">
                                                        </video>
                                                    </div>
                                                    <div v-else>
                                                        <div style="text-align:center;">
                                                            <div v-if="userIdFromLink == userIdS && userType == 'user'" style="background:#666;width:100%;max-width:430px;height:400px;margin:auto;">
                                                                <div class="form-group" style="color:white;font-size:14px;width:100%;">
                                                                    Upload Your Skill Video 1
                                                                    <div style="height:20px;"></div>
                                                                    <div style="max-width:285px;margin:auto;">
                                                                        <input type="text" class="form-control" style="font-size:14px;" v-model="userSkillOneName" placeholder="skill name/type of skill..." >
                                                                    </div>
                                                                    <div style="height:5px;"></div>
                                                                    <input type="file" id="skillOne" ref="skillOne" name="skillOne" v-on:change="readSkillOneVideoURL()" style="font-size:14px;margin:auto;"/>
                                                                    <div style="height:25px;"></div>
                                                                    <button class="btn btn-primary" style="background-color:rgb(64,132,63);color:white;font-size:20px;" v-on:click="submitSkillOneVideo()">Upload</button>
                                                                    <div style="height:8px;"></div>
                                                                    <p v-if="skillOneVideoUploadPercentage != ''">Uploading {{skillOneVideoUploadPercentage}}%</p>
                                                                    <p v-if="skillOneVideoUploadPercentage == 100">
                                                                        Processing...  Please Wait.
                                                                    </p>
                                                                    <div v-if="skillOneVideoUploadPercentage == ''">
                                                                        <p v-if="IfPremiumUser == 'yes'">Video Size Maximum 5 Minutes and 1GB</p>
                                                                        <p v-if="IfPremiumUser == 'no'">Video Size Maximum 3 Minutes and 500 MB</p>
                                                                        <p data-toggle="tooltip" data-placement="top" title="Supported Video Formats">(mp4, avi, mkv, mov, mpg, webm)</p>
                                                                    </div>
                                                                    <p id="skillOneUploadError"></p>
                                                                </div>
                                                            </div>
                                                            <div v-if="userType == 'companyUser'">
                                                                <div style="font-size:12px;">
                                                                    This user did not upload Skill Video 1.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-lg o-hidden border-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col">
                                            <div class="m-auto p-5">
                                                <div style="text-align:left;">
                                                    <h4 class="text-dark mb-4">Skill Video 2</h4>
                                                </div>
                                                <div class="user" style="text-align:left;">
                                                    <div v-if="axiosGetSkillTwoVideo != ''">
                                                        <div v-if="showSkillTwoData == 'show'">
                                                            <div v-if="showDeleteTwoOptionData == 'hide'">
                                                                <h3><label>{{axiosGetSkillTwoVideoTitle}}</label> <a v-bind:href="axiosGetSkillTwoVideo" :download="'User ID_'+userIdFromLink+'-'+axiosGetSkillTwoVideoTitle">Download</a> <a v-if="userIdFromLink == userId && userType == 'user'" @click.prevent="showEditSkillTwo()" href="">Edit</a> <a v-if="userIdFromLink == userId && userType == 'user'" name="two" @click.prevent="showDeleteOption($event)" href="">Delete video</a></h3>
                                                            </div>
                                                            <div v-else>
                                                                <h3><label>Are you sure you want to delete this video?</label></h3>
                                                                <h3><a v-if="userIdFromLink == userId && userType == 'user'" name="two" @click.prevent="deleteFileOption($event)" href="">Yes, Delete</a> | <a name="two" @click.prevent="hideDeleteOption($event)" href="">No, Cancel</a></h3>
                                                            </div>
                                                        </div>
                                                        <div v-else>
                                                            <h3><input class="form-control" style="font-size:14px;" v-if="userIdFromLink == userId && userType == 'user'" type="text" v-model="userSkillTwoName" placeholder="skill name/type of skill..." > <a v-if="userIdFromLink == userId && userType == 'user'" @click.prevent="updateEditSkillTwo()" href="">Update</a> | <a @click.prevent="hideEditSkillTwo()" href="">Cancel</a></h3>
                                                            <h3><p id="updateSkillTwoNameError"></p></h3>
                                                        </div>
                                                        <video style="width:100%;max-width:430px;height:auto;max-height:300px;" controls>
                                                            <source :src="axiosGetSkillTwoVideo">
                                                        </video>
                                                    </div>
                                                    <div v-else>
                                                        <div style="text-align:center;">
                                                            <div v-if="userIdFromLink == userIdS && userType == 'user'" style="background:#666;width:100%;max-width:430px;height:400px;margin:auto;">
                                                                <div class="form-group" style="color:white;font-size:14px;width:100%;">
                                                                    Upload Your Skill Video 2
                                                                    <div style="height:20px;"></div>
                                                                    <div style="max-width:285px;margin:auto;">
                                                                        <input type="text" class="form-control" style="font-size:14px;" v-model="userSkillTwoName" placeholder="skill name/type of skill..." >
                                                                    </div>
                                                                    <div style="height:5px;"></div>
                                                                    <input type="file" id="skillTwo" ref="skillTwo" name="skillTwo" v-on:change="readSkillTwoVideoURL()" style="font-size:14px;margin:auto;"/>
                                                                    <div style="height:25px;"></div>
                                                                    <button class="btn btn-primary" style="background-color:rgb(64,132,63);color:white;font-size:20px;" v-on:click="submitSkillTwoVideo()">Upload</button>
                                                                    <div style="height:8px;"></div>
                                                                    <p v-if="skillTwoVideoUploadPercentage != ''">Uploading {{skillTwoVideoUploadPercentage}}%</p>
                                                                    <p v-if="skillTwoVideoUploadPercentage == 100">
                                                                        Processing...  Please Wait.
                                                                    </p>
                                                                    <div v-if="skillTwoVideoUploadPercentage == ''">
                                                                        <p v-if="IfPremiumUser == 'yes'">Video Size Maximum 5 Minutes and 1GB</p>
                                                                        <p v-if="IfPremiumUser == 'no'">Video Size Maximum 3 Minutes and 500 MB</p>
                                                                        <p data-toggle="tooltip" data-placement="top" title="Supported Video Formats">(mp4, avi, mkv, mov, mpg, webm)</p>
                                                                    </div>
                                                                    <p id="skillTwoUploadError"></p>
                                                                </div>
                                                            </div>
                                                            <div v-if="userType == 'companyUser'">
                                                                <div style="font-size:12px;">
                                                                    This user did not upload Skill Video 2.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-lg o-hidden border-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col">
                                            <div class="m-auto p-5">
                                                <div style="text-align:left;">
                                                    <h4 class="text-dark mb-4">Skill Video 3</h4>
                                                </div>
                                                <div class="user" style="text-align:left;">
                                                    <div v-if="axiosGetSkillThreeVideo != ''">
                                                        <div v-if="showSkillThreeData == 'show'">
                                                            <div v-if="showDeleteThreeOptionData == 'hide'">
                                                                <h3><label>{{axiosGetSkillThreeVideoTitle}}</label> <a v-bind:href="axiosGetSkillThreeVideo" :download="'User ID_'+userIdFromLink+'-'+axiosGetSkillThreeVideoTitle">Download</a> <a v-if="userIdFromLink == userId && userType == 'user'" @click.prevent="showEditSkillThree()" href="">Edit</a> <a v-if="userIdFromLink == userId && userType == 'user'" name="three" @click.prevent="showDeleteOption($event)" href="">Delete video</a></h3>
                                                            </div>
                                                            <div v-else>
                                                                <h3><label>Are you sure you want to delete this video?</label></h3>
                                                                <h3><a v-if="userIdFromLink == userId && userType == 'user'" name="three" @click.prevent="deleteFileOption($event)" href="">Yes, Delete</a> | <a name="three" @click.prevent="hideDeleteOption($event)" href="">No, Cancel</a></h3>
                                                            </div>
                                                        </div>
                                                        <div v-else>
                                                            <h3><input class="form-control" style="font-size:14px;" v-if="userIdFromLink == userId && userType == 'user'" type="text" v-model="userSkillThreeName" placeholder="skill name/type of skill..." > <a v-if="userIdFromLink == userId && userType == 'user'" @click.prevent="updateEditSkillThree()" href="">Update</a> | <a @click.prevent="hideEditSkillThree()" href="">Cancel</a></h3>
                                                            <h3><p id="updateSkillThreeNameError"></p></h3>
                                                        </div>
                                                        <video style="width:100%;max-width:430px;height:auto;max-height:300px;" controls>
                                                            <source :src="axiosGetSkillThreeVideo">
                                                        </video>
                                                    </div>
                                                    <div v-else>
                                                        <div style="text-align:center;">
                                                            <div v-if="userIdFromLink == userIdS && userType == 'user'" style="background:#666;width:100%;max-width:430px;height:400px;margin:auto;">
                                                                <div class="form-group" style="color:white;font-size:14px;width:100%;">
                                                                    Upload Your Skill Video 3
                                                                    <div style="height:20px;"></div>
                                                                    <div style="max-width:285px;margin:auto;">
                                                                        <input type="text" class="form-control" style="font-size:14px;" v-model="userSkillThreeName" placeholder="skill name/type of skill..." >
                                                                    </div>
                                                                    <div style="height:5px;"></div>
                                                                    <input type="file" id="skillThree" ref="skillThree" name="skillThree" v-on:change="readSkillThreeVideoURL()" style="font-size:14px;margin:auto;"/>
                                                                    <div style="height:25px;"></div>
                                                                    <button class="btn btn-primary" style="background-color:rgb(64,132,63);color:white;font-size:20px;" v-on:click="submitSkillThreeVideo()">Upload</button>
                                                                    <div style="height:8px;"></div>
                                                                    <p v-if="skillThreeVideoUploadPercentage != ''">Uploading {{skillThreeVideoUploadPercentage}}%</p>
                                                                    <p v-if="skillThreeVideoUploadPercentage == 100">
                                                                        Processing...  Please Wait.
                                                                    </p>
                                                                    <div v-if="skillThreeVideoUploadPercentage == ''">
                                                                        <p v-if="IfPremiumUser == 'yes'">Video Size Maximum 5 Minutes and 1GB</p>
                                                                        <p v-if="IfPremiumUser == 'no'">Video Size Maximum 3 Minutes and 500 MB</p>
                                                                        <p data-toggle="tooltip" data-placement="top" title="Supported Video Formats">(mp4, avi, mkv, mov, mpg, webm)</p>
                                                                    </div>
                                                                    <p id="skillThreeUploadError"></p>
                                                                </div>
                                                            </div>
                                                            <div v-if="userType == 'companyUser'">
                                                                <div style="font-size:12px;">
                                                                    This user did not upload Skill Video 3.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- class="video-js vjs-default-skin vjs-big-play-centered" -->
                
                <!-- <div class="video-container">
                    <div class="c-video" id="c-video">
                        <video id="currentIntroVideo" preload="auto" class="custom-video" v-on:loadedmetadata="getIntroVideoDuration()" @timeupdate="onTimeUpdateListener($event)" >
                            <source :src="axiosGetIntroVideo">
                            Your browser doesn't support HTML5 video tag.
                        </video>
                        <div class="video-controls">
                            
                            <div id="currentIntroVideoOrange" class="orange-bar" v-on:click="introProgressBarClicked($event)">
                                <div id="currentIntroVideoOrangeJuice" class="orange-juice">

                                </div>
                            </div>
                            <div style="width:100%">
                                <div style="width:75%;float:left;">
                                    <div class="video-play-pause-buttons" style="float:left;">
                                        <button id="intro-play-pause" v-on:click="introPlayButtonClicked()"></button>
                                    </div>
                                    <i class="fa fa-volume-up introVolumeButton" style="padding-top:19px;font-size:24px;color:white;cursor:pointer;float:left;"></i>
                                    <div id="introVolumeUpDown" class="showIntoVolumUpDown" style="padding-top:24px;float:left;">
                                        <input type="range" min="0" max="100" v-on:input="SetIntroVolume($event)" v-on:change="SetIntroVolume($event)" style="width:100%;max-width:60px;font-size:24px;cursor:pointer;">
                                    </div>
                                    <h3 style="color:white;padding-top:22px;float:left;">
                                        {{introVideoLeftDur}} / {{introVideoDurMin}}:{{introVideoDurSec}}
                                    </h3>
                                </div>
                                <div style="width:25%;float:right;text-align:right;">
                                    <div style="padding-top:18px;padding-right:40px;">
                                        <div style="width:24px;float:right;" v-on:click="introFullVideoClicked()">
                                            <span id="introFullVideoScreenButton" class="iconify" data-icon="bi-fullscreen" data-inline="false" style="cursor:pointer;font-size:24px;color:white;"></span>
                                            <span id="introSmallVideoScreenButton" class="iconify" data-icon="bi:fullscreen-exit" data-inline="false" style="cursor:pointer;font-size:24px;color:white;display:none;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <i class="bi bi-fullscreen" style="color:white;"></i>
                            
                            <div style="padding-top:20px;">
                                <span class="iconify" data-icon="bi:fullscreen-exit" data-inline="false" style="cursor:pointer;font-size:24px;color:white;"></span>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <video id="randomVideoPlayer" ref="Player" class="video-js" v-on:loadedmetadata="randomVideoPlayerLoaded()" preload="auto" controls data-setup="{}">
                    <source :src="axiosGetIntroVideo" type="video/mp4">
                </video>
                
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-fullscreen" viewBox="0 0 16 16" style="cursor:pointer;">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1h-4zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zM.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5z"/>
                </svg> -->

            

            </div>
        </div>  
    </div>
</template>

<script>

    // import videojs from "video.js";
    // import videojsHLS from 'videojs-contrib-hls';
    // window.videojs = videojs;
    // import 'video.js/dist/video-js.min.css';
    // import 'video.js/dist/video.min.js';
    // const { getVideoDurationInSeconds } = require('get-video-duration');

    export default {

        data() {
            return{
                searchField: '',
                showDeleteCVOptionData: 'hide',
                showDeleteIntroOptionData: 'hide',
                showDeleteOneOptionData: 'hide',
                showDeleteTwoOptionData: 'hide',
                showDeleteThreeOptionData: 'hide',
                showSkillOneData: 'show',
                showSkillTwoData: 'show',
                showSkillThreeData: 'show',
                axiosGetCV: '',
                axiosGetIntroVideo: '',
                axiosGetSkillOneVideoTitle: '',
                axiosGetSkillOneVideo: '',
                axiosGetSkillTwoVideoTitle: '',
                axiosGetSkillTwoVideo: '',
                axiosGetSkillThreeVideoTitle: '',
                axiosGetSkillThreeVideo: '',
                cvInputFile: '',
                introVideoInputFile: '',
                userSkillOneName: '',
                userSkillOneNameInputFile: '',
                userSkillTwoName: '',
                userSkillTwoNameInputFile: '',
                userSkillThreeName: '',
                userSkillThreeNameInputFile: '',
                userIdFromLink: this.$route.params.givencircid,
                userId: '',
                userIdS: '',
                userName: '',
                userGender: '',
                userJobTypeId: '',
                userJobTypeName: '',
                userEmail: '',
                userPhone: '',
                userType: '',
                userPlaceOfBirth: '',
                IfPremiumUser: '',
                uploadPercentage: 0,
                introVideoUploadPercentage: 0,
                skillOneVideoUploadPercentage: 0,
                skillTwoVideoUploadPercentage: 0,
                skillThreeVideoUploadPercentage: 0,
                notificationForUsers: [],
                usersNotificationNumber: '',
                userCheckedNotification: 'no',
                numberOfVisitedProfile: 0,
                appliedUserForCirculars: [],
                notificationNumber: '',
                introVideoVolume: 100,
                introVideoLeftDur: '00:00',
                introVideoDurMin: '00',
                introVideoDurSec: '00',
                chunks: [],
                uploaded: 0,
                selectedVideoFile: null,
                file: null,
                previousUploadedPercntg: 0,
                totalUploadedInPer: 0,
                videoUploadedInPercntg: 0,
                uploadButtonPressed: '',
                videoUploadPercentage: 0,
            }
        },

        mounted() {
            $("#divWithData").hide();
            this.loadThispage();
            this.getUserData();
            
            // this.loadVideoWithVideoJS();
        },

        // beforeMount(){
        //     // videojs;
        // },

        watch: {
            chunks(n, o) {
                if (n.length > 0) {
                    this.previousUploadedPercntg += Number(this.totalUploadedInPer.toFixed(2));
                    this.upload();
                }
            }
        },

        computed: {
            // progress() {
            //     if(this.chunks.indexOf(0)){
            //         this.totalUploadedInPer = 0;
            //         this.totalUploadedInPer = Number((((100 * this.chunks[0].size) / this.file.size) * this.introVideoUploadPercentage) / 100);
            //         // this.totalUploadedInPer.toFixed(2);
            //         console.log(this.previousUploadedPercntg + Number(this.totalUploadedInPer.toFixed(2)));
            //         return this.previousUploadedPercntg + Number(this.totalUploadedInPer.toFixed(2));
            //         // return Math.floor((this.uploaded * 100) / this.file.size);
            //     }
            // },
            formData() {
                let formData = new FormData;

                formData.set('is_last', this.chunks.length === 1);
                formData.set('file', this.chunks[0], `${this.file.name}.part`);
                formData.set('originalFile', this.file);
                formData.set('whichFile', this.selectedVideoFile);
                formData.set('fileName', "Introduction");
                formData.set('sendingFileForNthTime', this.sendingFileFistTime);
                formData.set('IfPremiumOrNot', this.IfPremiumUser);

                return formData;
            },
            config() {
                return {
                    method: 'POST',
                    data: this.formData,
                    url: '/api/home/uploadvideofiles',
                    headers: {
                        // 'Content-Type': 'application/octet-stream'
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: event => {
                        // this.uploaded += event.loaded;
                        this.totalUploadedInPer = 0;
                        this.videoUploadPercentage = Math.round( ( event.loaded / event.total ) * 100 );
                        if(this.chunks.indexOf(0)){
                            this.totalUploadedInPer = Number((((100 * this.chunks[0].size) / this.file.size) * this.videoUploadPercentage) / 100);
                            console.log(this.previousUploadedPercntg + Number(this.totalUploadedInPer.toFixed(2)));
                            this.videoUploadedInPercntg = Number(this.previousUploadedPercntg + this.totalUploadedInPer).toFixed(2);
                        }
                    }
                };
            }
        },

        // created: function () {
        //     window.addEventListener('fullscreenchange', (event) => {
        //         if(!document.fullscreenElement){
        //             if(event.target.id == "c-video"){
        //                 this.introVideoESCbuttonPressed();
        //             }
        //         }
        //     });
        // },

        methods: {

            cancelUploading(){
                window.location.reload();
            },

            select(event) {
                this.file = event.target.files.item(0);
                if(event.target.name == "introVideoFile"){
                    $("#introUploadError").html("");
                    this.selectedVideoFile = "introVideo";
                }

                var fileSize = (this.file.size /1024 /1024).toFixed(2);
                var selectedFileType = this.file.type;

                if(this.selectedVideoFile == "introVideo"){
                    if(fileSize > 100){
                        this.file = null;
                        $("#introUploadError").append("<p style='color:#ff4d4d'>Please select a video less than 1 Minute and 100 MB</p>");
                    }
                    else{
                        $("#introUploadError").html("");
                        if(selectedFileType == "video/mp4" ||
                        selectedFileType == "video/avi" ||
                        selectedFileType == "video/x-matroska" ||
                        selectedFileType == "video/quicktime" ||
                        selectedFileType == "video/mpeg" ||
                        selectedFileType == "video/webm" 
                        ){
                            // video selected
                        }
                        else{
                            this.file = null;
                            $("#introUploadError").append("<p style='color:#ff4d4d'>This video format not supported</p>");
                        }
                    }
                }
                // this.createChunks();
            },

            upload() {
                
                axios(this.config).then(response => {
                    if(response.data.message == "success" && response.data.uploaded == true){
                        window.location.reload();
                    }
                    if(response.data.message == "error occurred"){
                        if(this.selectedVideoFile == "introVideo"){
                            $("#introUploadError").html("");
                            $("#introUploadError").append("<p style='color:#ff4d4d'>"+response.data.error_message+"</p>");
                        }
                    }
                    this.chunks.shift();
                }).catch(error => {
                    console.log(error);
                });
            },

            createChunks(event) {
                $("#introUploadError").html("");
                if(this.file == "" || this.file == null){
                    if(event.target.name == "introUploadButton"){
                        $("#introUploadError").append("<p style='color:#ff4d4d;'>Please select a file</p>");
                    }
                }
                else{
                    this.uploadButtonPressed = "pressed";
                    let size = 1048576, chunks = Math.ceil(this.file.size / size);

                    for (let i = 0; i < chunks; i++) {
                        this.chunks.push(this.file.slice(
                            i * size, Math.min(i * size + size, this.file.size), this.file.type
                        ));
                    }
                    console.log(this.file.size);
                    console.log(this.chunks);
                    console.log(chunks);
                }
            },

            loadThispage(){
                $("#theTitle").html("Profile");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavProfile']").addClass('active');
                
            },

            randomVideoPlayerLoaded(){
                var randomVideo = videojs(this.$refs.Player);
            },

            introProgressBarClicked(event){
                var video = document.querySelector('#currentIntroVideo');
                var progress = document.querySelector('#currentIntroVideoOrange');
                const progressTime = (event.offsetX / progress.offsetWidth) * video.duration;
                
                alert("Start: " + video.seekable.start(0) + " End: "  + video.seekable.end(0));
                
                video.currentTime = progressTime;
            },

            readStoredFiles(){
                var reader = new window.FileReader();
                reader.onload = function(event){
                    console.log("onload called");
                    let buffer = event.target.result;
                    let videoBlob = new Blob([new Uint8Array(buffer)], { type: 'video/mp4' });
                    let url = window.URL.createObjectURL(videoBlob);

                    video.src = url;
                }
            },

            getIntroVideoDuration(){
                var video = document.querySelector('#currentIntroVideo');
                // console.log(video.buffered.end(0));
                var videoHour = 0;
                var videoMin = 0;
                var videoSec = 0;
                if(Math.floor(video.duration) >= 3600){
                    this.introVideoLeftDur = "00:00:00";
                    videoHour = Math.floor(video.duration / 3600);
                    videoMin = Math.floor((video.duration - (videoHour * 3600)) / 60);
                    videoSec = Math.floor((video.duration - (videoHour * 3600)) - (videoMin * 60));
                    if(videoHour < 10){
                        videoHour = '0'+videoHour;
                    }
                    if(videoMin < 10){
                        videoMin = '0'+videoMin;
                    }
                    if(videoSec < 10){
                        videoSec = '0'+videoSec;
                    }
                    this.introVideoDurMin = videoHour+":"+videoMin;
                    this.introVideoDurSec = videoSec;
                }
                else{
                    this.introVideoLeftDur = "00:00";
                    videoMin = Math.floor(video.duration / 60);
                    videoSec = Math.floor(video.duration - videoMin * 60);
                    if(videoMin < 10){
                        this.introVideoDurMin = '0'+videoMin;
                    }
                    else{
                        this.introVideoDurMin = videoMin;
                    }
                    
                    if(videoSec < 10){
                        this.introVideoDurSec = '0'+videoSec;
                    }
                    else{
                        this.introVideoDurSec = videoSec;
                    }
                }
            },

            introFullVideoClicked(){
                if($("#introFullVideoScreenButton").css("display") == "inline"){
                    var element = document.getElementById("currentIntroVideo");
                    // element.parentNode.webkitRequestFullScreen();     
                    
                    if (element.requestFullscreen) {
                        element.parentNode.requestFullscreen();
                    } else if (element.mozRequestFullScreen) { /* Firefox */
                        element.parentNode.mozRequestFullScreen();
                    } else if (element.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                        element.parentNode.webkitRequestFullscreen();
                    } else if (element.msRequestFullscreen) { /* IE/Edge */
                        element.parentNode.msRequestFullscreen();
                    }
                    

                    element.style.height = screen.height;
                    element.style.width = screen.width;
                    // $("#c-video").attr('class', 'makeVideoFullScreen');
                    $("#introFullVideoScreenButton").css('display', 'none');
                    $("#introSmallVideoScreenButton").css('display', 'inline');
                }
                else if($("#introFullVideoScreenButton").css("display") == "none"){
                    // document.webkitExitFullscreen();

                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) { /* Firefox */
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) { /* IE/Edge */
                        document.msExitFullscreen();
                    }
                    // $("#c-video").attr('class', 'c-video');
                    $("#introFullVideoScreenButton").css('display', 'inline');
                    $("#introSmallVideoScreenButton").css('display', 'none');
                }
            },

            introVideoESCbuttonPressed(){
                // console.log("esc pressed");
                if($("#introFullVideoScreenButton").css("display") == "none"){
                    // document.webkitExitFullscreen();
                    $("#introFullVideoScreenButton").css('display', 'inline');
                    $("#introSmallVideoScreenButton").css('display', 'none');
                }
            },

            loadVideoWithVideoJS(){
                // videojs('currentIntroVideo', { 
                //     controls: "controls" 
                // });
                // videojs("currentIntroVideo", {}, function(){
                //     // Player (this) is initialized and ready.
                // });
                // videojs(this.$refs["Player"]);
                
            },

            SetIntroVolume(volValue){
                $("#currentIntroVideo").prop("volume", volValue.target.value/100);

            },

            onTimeUpdateListener(event){
                // var video = videojs(event.target.id);
                // console.log(Math.floor(video.currentTime / 60));
                var video = document.querySelector('#currentIntroVideo');
                var juice = document.querySelector('#currentIntroVideoOrangeJuice');
                // var btn = $("#intro-play-pause");
                var videoCurrentHour = 0;
                var videoCurrentMin = 0;
                var videoCurrentSec = 0;
                if(Math.floor(video.duration) >= 3600){
                    this.introVideoLeftDur = "00:00:00";
                    videoCurrentHour = Math.floor(video.currentTime / 3600);
                    videoCurrentMin = Math.floor((video.currentTime - (videoCurrentHour * 3600)) / 60);
                    videoCurrentSec = Math.floor((video.currentTime - (videoCurrentHour * 3600)) - (videoCurrentMin * 60));
                    if(videoCurrentHour < 10){
                        videoCurrentHour = '0'+videoCurrentHour;
                    }
                    if(videoCurrentMin < 10){
                        videoCurrentMin = '0'+videoCurrentMin;
                    }
                    if(videoCurrentSec < 10){
                        videoCurrentSec = '0'+videoCurrentSec;
                    }
                    this.introVideoLeftDur = videoCurrentHour+":"+videoCurrentMin+":"+videoCurrentSec;
                }
                else{
                    this.introVideoLeftDur = "00:00";
                    videoCurrentMin = Math.floor(video.currentTime / 60);
                    videoCurrentSec = Math.floor(video.currentTime - videoCurrentMin * 60);
                    if(videoCurrentMin < 10){
                        videoCurrentMin = '0'+videoCurrentMin;
                    }
                    if(videoCurrentSec < 10){
                        videoCurrentSec = '0'+videoCurrentSec;
                    }
                    this.introVideoLeftDur = videoCurrentMin+":"+videoCurrentSec;
                }
                var juicePosition = video.currentTime / video.duration;
                juice.style.width = juicePosition * 100 + "%";
                if(video.ended){
                    $("#intro-play-pause").attr('class', 'play');
                }
            },

            playIntoVideo(){
                var video = document.querySelector('#currentIntroVideo');
                // var juice = document.querySelector('#currentIntroVideoOrangeJuice');
                // var btn = $("#intro-play-pause");
                if(video.paused){
                    // btn.className = "pause";
                    $("#intro-play-pause").attr('class', 'pause');
                    video.play();
                }
                else{
                    // btn.className = "play";
                    $("#intro-play-pause").attr('class', 'play');
                    video.pause();
                }
            },

            introPlayButtonClicked(){
                this.playIntoVideo();
            },

            usersNotificationClicked(){
                var updateData = {
                    "userId": this.userIdS
                };
                try{
                    axios.post('/api/home/usersclickednotification',updateData).then((response) => {
                        console.log(response);
                        if(response.data == "success"){
                            this.usersNotificationNumber = "";
                        }
                        else if(response.data == "could not update notification check"){
                            // console.log();
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            notificationClicked(){
                
                try{
                    axios.get('/api/home/appliedforjob/'+this.userIdS+'/edit').then((response) => {
                        // this.jobtypes = response.data;
                        if(response.data == "success"){
                            this.notificationNumber = "";
                        }
                        else if(response.data == "notification change could not take place"){
                            // console.log();
                        }
                        // console.log(response);
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            searchData(){
                if(this.searchField != ""){
                    window.localStorage.setItem('searchBy', this.searchField);
                    this.$router.push('/search');
                }
                
            },

            showDeleteOption(event){
                if(event.target.name == "intro"){
                    this.showDeleteIntroOptionData = "show";
                }
                if(event.target.name == "cv"){
                    this.showDeleteCVOptionData = "show";
                }
                if(event.target.name == "one"){
                    this.showDeleteOneOptionData = "show";
                }
                if(event.target.name == "two"){
                    this.showDeleteTwoOptionData = "show";
                }
                if(event.target.name == "three"){
                    this.showDeleteThreeOptionData = "show";
                }
                
            },

            hideDeleteOption(event){
                if(event.target.name == "intro"){
                    this.showDeleteIntroOptionData = "hide";
                }
                if(event.target.name == "cv"){
                    this.showDeleteCVOptionData = "hide";
                }
                if(event.target.name == "one"){
                    this.showDeleteOneOptionData = "hide";
                }
                if(event.target.name == "two"){
                    this.showDeleteTwoOptionData = "hide";
                }
                if(event.target.name == "three"){
                    this.showDeleteThreeOptionData = "hide";
                }
            },

            deleteFileOption(event){
                var goingToDeleteFileType = "";
                var goingToDeleteFileLink = "";
                if(event.target.name == "intro"){
                    goingToDeleteFileType = "introVideo";
                    goingToDeleteFileLink = this.axiosGetIntroVideo;
                }
                else if(event.target.name == "cv"){
                    goingToDeleteFileType = "cv";
                    goingToDeleteFileLink = this.axiosGetCV;
                }
                else if(event.target.name == "one"){
                    goingToDeleteFileType = "skillOne";
                    goingToDeleteFileLink = this.axiosGetSkillOneVideo;
                }
                else if(event.target.name == "two"){
                    goingToDeleteFileType = "skillTwo";
                    goingToDeleteFileLink = this.axiosGetSkillTwoVideo;
                }
                else if(event.target.name == "three"){
                    goingToDeleteFileType = "skillThree";
                    goingToDeleteFileLink = this.axiosGetSkillThreeVideo;
                }

                if(goingToDeleteFileType != "" || goingToDeleteFileLink != ""){

                    var goingToDelete = {
                        'fileType': goingToDeleteFileType,
                        'fileLink': goingToDeleteFileLink
                    };
                    
                    try{
                        axios.put('/api/home/deletecvorvideo/' + this.userIdFromLink, goingToDelete)
                            .then((response) => {
                                console.log(response);
                                //response.data[0]
                                if(response.data == "success"){
                                    window.location.reload();
                                }
                                else if(response.data == "could not delete file error"){

                                }
                                else if(response.data == "file already deleted error"){
                                    
                                }
                                else if(response.data == "this user cannot delete error"){
                                    
                                }
                                else if(response.data == "cannot delete this type error"){
                                    
                                }
                                
                        });
                        
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            showEditSkillOne(){
                this.showSkillOneData = "hide";
                this.userSkillOneName = this.axiosGetSkillOneVideoTitle;
            },

            hideEditSkillOne(){
                this.showSkillOneData = "show";
                this.userSkillOneName = "";
            },

            updateEditSkillOne(){
                if(this.userSkillOneName == ""){
                    this.userSkillOneName = "Skill No.1";
                }
                var goingToUpdate = {
                    'skillName': this.userSkillOneName,
                    'skillType': 'skillOne'
                };

                $("#updateSkillOneNameError").html("");
                
                try{
                    axios.put('/api/home/uploadskillvideos/' + this.userIdFromLink, goingToUpdate)
                        .then((response) => {
                            console.log(response);
                            if(response.data == "success"){
                                this.showSkillOneData = "show";
                                this.axiosGetSkillOneVideoTitle = this.userSkillOneName;
                                this.userSkillOneName = "";
                            }
                            else if(response.data == "server error"){
                                $("#updateSkillOneNameError").append("<p style='color:#ff4d4d'>Server error</p>");
                            }
                            else if(response.data == "cannot update error"){
                                $("#updateSkillOneNameError").append("<p style='color:#ff4d4d'>Failed to update!</p>");
                            }
                            else if(response.data == "user is not authorized to update error"){
                                $("#updateSkillOneNameError").append("<p style='color:#ff4d4d'>This user cannot update!</p>");
                            }
                    });
                    
                }
                catch(e){
                    console.log(e);
                }
            },

            showEditSkillTwo(){
                this.showSkillTwoData = "hide";
                this.userSkillTwoName = this.axiosGetSkillTwoVideoTitle;
            },

            hideEditSkillTwo(){
                this.showSkillTwoData = "show";
                this.userSkillTwoName = "";
            },

            updateEditSkillTwo(){
                if(this.userSkillTwoName == ""){
                    this.userSkillTwoName = "Skill No.1";
                }
                var goingToUpdate = {
                    'skillName': this.userSkillTwoName,
                    'skillType': 'skillTwo'
                };

                $("#updateSkillTwoNameError").html("");
                
                try{
                    axios.put('/api/home/uploadskillvideos/' + this.userIdFromLink, goingToUpdate)
                        .then((response) => {
                            console.log(response);
                            if(response.data == "success"){
                                this.showSkillTwoData = "show";
                                this.axiosGetSkillTwoVideoTitle = this.userSkillTwoName;
                                this.userSkillTwoName = "";
                            }
                            else if(response.data == "server error"){
                                $("#updateSkillTwoNameError").append("<p style='color:#ff4d4d'>Server error</p>");
                            }
                            else if(response.data == "cannot update error"){
                                $("#updateSkillTwoNameError").append("<p style='color:#ff4d4d'>Failed to update!</p>");
                            }
                            else if(response.data == "user is not authorized to update error"){
                                $("#updateSkillTwoNameError").append("<p style='color:#ff4d4d'>This user cannot update!</p>");
                            }
                    });
                    
                }
                catch(e){
                    console.log(e);
                }
            },

            showEditSkillThree(){
                this.showSkillThreeData = "hide";
                this.userSkillThreeName = this.axiosGetSkillThreeVideoTitle;
            },

            hideEditSkillThree(){
                this.showSkillThreeData = "show";
                this.userSkillThreeName = "";
            },

            updateEditSkillThree(){
                if(this.userSkillThreeName == ""){
                    this.userSkillThreeName = "Skill No.1";
                }
                var goingToUpdate = {
                    'skillName': this.userSkillThreeName,
                    'skillType': 'skillThree'
                };
                
                $("#updateSkillThreeNameError").html("");

                try{
                    axios.put('/api/home/uploadskillvideos/' + this.userIdFromLink, goingToUpdate)
                        .then((response) => {
                            console.log(response);
                            if(response.data == "success"){
                                this.showSkillThreeData = "show";
                                this.axiosGetSkillThreeVideoTitle = this.userSkillThreeName;
                                this.userSkillThreeName = "";
                            }
                            else if(response.data == "server error"){
                                $("#updateSkillThreeNameError").append("<p style='color:#ff4d4d'>Server error</p>");
                            }
                            else if(response.data == "cannot update error"){
                                $("#updateSkillThreeNameError").append("<p style='color:#ff4d4d'>Failed to update!</p>");
                            }
                            else if(response.data == "user is not authorized to update error"){
                                $("#updateSkillThreeNameError").append("<p style='color:#ff4d4d'>This user cannot update!</p>");
                            }
                    });
                    
                }
                catch(e){
                    console.log(e);
                }
            },

            // loadThispage(){
            //     var refresh = window.localStorage.getItem('refreshProfile');
            //     console.log(refresh);
            //     if(refresh == null || refresh != this.userIdFromLink){
            //         window.localStorage.setItem('refreshProfile', this.userIdFromLink);
            //         window.location.reload();
            //     }
            // },

            async getUserData(){
                try{
                    await axios.get('/api/home/userinfo/' + this.userIdFromLink).then((response) => {
                        if(response.data == ""){
                            this.$router.push('*');
                        }
                        else if(response.data[0].id){
                            console.log(response);
                            
                            if(response.data[0].userIdS != "companyUser" && response.data[0].userIdS != "not signed/logged in user"){
                                //if(response.data[0].userIdS == "not signed/logged in user") 
                                this.userType = "user";
                                this.userId = response.data[0].id;
                                this.userName = response.data[0].name;
                                this.userGender = response.data[0].gender;
                                this.userJobTypeId = response.data[0].job_type_id;
                                //this.userJobTypeName = 
                                this.userEmail = response.data[0].email;
                                this.userPhone = response.data[0].phone;
                                this.userPlaceOfBirth = response.data[0].place_of_birth;
                                this.userIdS = response.data[0].userIdS;
                                this.IfPremiumUser = response.data[0].premium_or_not;
                                if(this.IfPremiumUser == "yes"){
                                    $("#addAButtonIfPremiumOrNot").append('<a class="nav-link" style="font-size:14px;"><span class="d-lg-inline small" style="color:white;">Premium User</span></a>');
                                }
                                else{
                                    $("#addAButtonIfPremiumOrNot").append('<a class="nav-link btn" style="font-size:14px;" href="/pay-method"><span class="d-lg-inline small" style="color:white;">Be Premium</span></a>');
                                }
                                
                            }
                            else if(response.data[0].userIdS == "companyUser"){
                                this.userType = "companyUser";
                                this.userId = response.data[0].id;
                                this.userName = response.data[0].name;
                                this.userGender = response.data[0].gender;
                                this.userJobTypeId = response.data[0].job_type_id;
                                this.userEmail = response.data[0].email;
                                this.userPhone = response.data[0].phone;
                                this.userIdS = response.data[0].userIdS;
                                this.usersThatAppliedForJob();
                            }
                            else if(response.data[0].userIdS == "not signed/logged in user"){
                                
                                this.userType = "";
                                this.userId = "";
                                this.userName = "";
                                this.userGender = "";
                                this.userJobTypeId = "";
                                this.userEmail = "";
                                this.userPhone = "";
                                this.userIdS = "";
                                this.IfPremiumUser = "";
                                this.$router.push('*');
                            }
                            if(this.userType == "user"){
                                if(response.data[0].userIdS != this.userIdFromLink && this.userType == "user"){
                                    this.userType = "";
                                    this.userId = "";
                                    this.userName = "";
                                    this.userGender = "";
                                    this.userJobTypeId = "";
                                    this.userEmail = "";
                                    this.userPhone = "";
                                    this.userIdS = "";
                                    this.IfPremiumUser = "";
                                    this.$router.push('*');
                                }
                                else if(response.data[0].userIdS == this.userIdFromLink && this.userType == "user"){
                                    this.notificationsForUsers();
                                }
                            }
                            axios.get('/api/home/jobtype/' + response.data[0].job_type_id ).then((responseJobtype) => {
                                if(responseJobtype.data[0].jobtype_name){
                                    this.userJobTypeName = responseJobtype.data[0].jobtype_name;
                                }
                                else if(responseJobtype.data == "no data found"){
                                    this.userJobTypeName = "";
                                }
                                
                            });
                            
                            
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }

                this.getCVData();
                this.getIntroData();
                this.getSkillOneData();
                this.getSkillTwoData();
                this.getSkillThreeData();
            },

            async usersThatAppliedForJob(){
                try{
                    await axios.get('/api/home/appliedforjob').then((response) => {
                        console.log(response);
                        if(response.data[0].id){
                            this.appliedUserForCirculars = response.data;
                            this.notificationNumber = response.data[0].count;
                        }
                        else if(response.data == "nobody applied yet"){
                            this.appliedUserForCirculars = [];
                            this.notificationNumber = "";
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            submitCV(){
                let formData = new FormData();
                formData.append('file', this.cvInputFile);
                formData.append('sendingFileType', 'cv');
                formData.append('userName', this.userName);

                $("#cvUploadError").html("");
                if(this.cvInputFile == ""){
                    $("#cvUploadError").append("<p style='color:#ff4d4d'>Please select a file</p>");
                }
                else{
                    try{
                        axios.post( '/api/home/uploadcvorvideo',
                                formData,
                                {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function( progressEvent ) {
                                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                                }.bind(this)
                                
                            }
                            ).then((response)=>{
                                
                                //console.log(response);
                                //this.getCVData();
                                if(response.data == "success"){
                                    window.location.reload();
                                }
                                else if(response.data == "please select a file error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>Please select a file</p>");
                                }
                                else if(response.data == "file is too small to upload error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>File is too small</p>");
                                }
                                else if(response.data == "cv cannot be more than 2MB error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>CV cannot be more than 2MB</p>");
                                }
                                else if(response.data == "please select a pdf file error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>Please select a pdf</p>");
                                }
                                else if(response.data == "file format error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>File format not supported</p>");
                                }
                                else if(response.data == "server error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>Server error</p>");
                                }
                                else if(response.data == "file uploading problem error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>File could not be uploaded</p>");
                                }
                                else if(response.data == "could not update error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>File could not be uploaded</p>");
                                }
                                else if(response.data == "folder could not be created error"){
                                    $("#cvUploadError").append("<p style='color:#ff4d4d'>File could not be uploaded</p>");
                                }
                                
                        })
                        .catch(()=>{
                            console.log('FAILURE!!');
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            submitIntroVideo(){
                this.introVideoUploadPercentage = '';
                let formData = new FormData();
                formData.append('file', this.introVideoInputFile);
                formData.append('sendingFileType', 'introVideo');
                formData.append('userName', this.userName);

                $("#introUploadError").html("");
                if(this.introVideoInputFile == ""){
                    $("#introUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                }
                else{
                    try{
                        axios.post( '/api/home/uploadcvorvideo',
                                formData,
                                {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function( progressEvent ) {
                                    this.introVideoUploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                                }.bind(this)
                            }
                            ).then((response)=>{
                                console.log(response);
                                //this.getIntroData();
                                if(response.data == "success"){
                                    // swal("Congrats!", ", Your account is created!", "success");
                                    window.location.reload();
                                }
                                else if(response.data == "please select a file error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                                }
                                else if(response.data == "file is too small to upload error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Video is too small</p>");
                                }
                                else if(response.data == "video cannot be more than 1 minute error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 1 Minute</p>");
                                }
                                else if(response.data == "video cannot be more than 200MB error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 200 MB</p>");
                                }
                                else if(response.data == "video format does not support error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Video format not supported!</p>");
                                }
                                else if(response.data == "file format error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Video format not supported!</p>");
                                }
                                else if(response.data == "server error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Server error! Video could not be uploaded</p>");
                                }
                                else if(response.data == "file uploading problem error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "could not update error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Server error! Video could not be uploaded</p>");
                                }
                                else if(response.data == "folder could not be created error"){
                                    $("#introUploadError").append("<p style='color:#ff4d4d'>Server error! Video could not be uploaded</p>");
                                }
                        })
                        .catch(()=>{
                            console.log('FAILURE!!');
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }

            },

            submitSkillOneVideo(){
                if(this.userSkillOneName == ""){
                    this.userSkillOneName = "Skill No.1";
                }
                let formData = new FormData();
                formData.append('file', this.userSkillOneNameInputFile);
                formData.append('skillName', this.userSkillOneName);
                formData.append('sendingFileType', 'skillOne');
                formData.append('userName', this.userName);
                formData.append('IfPremiumOrNot', this.IfPremiumUser);

                $("#skillOneUploadError").html("");

                if(this.userSkillOneNameInputFile == ""){
                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                }
                else{
                    try{
                        axios.post( '/api/home/uploadskillvideos',
                                formData,
                                {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function( progressEvent ) {
                                    this.skillOneVideoUploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                                }.bind(this)
                            }
                            ).then((response)=>{
                                console.log(response);
                                //this.getSkillOneData();
                                if(response.data == "success"){
                                    window.location.reload();
                                }
                                else if(response.data == "please select a file error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                                }
                                else if(response.data == "file is too small to upload error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video is too small</p>");
                                }
                                else if(response.data == "video cannot be more than 3 minutes error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 3 minutes</p>");
                                }
                                else if(response.data == "video cannot be more than 500MB error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 500 MB</p>");
                                }
                                else if(response.data == "video cannot be more than 5 minutes error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 5 minutes</p>");
                                }
                                else if(response.data == "video cannot be more than 1GB error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 1GB</p>");
                                }
                                else if(response.data == "something went wrong error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Server error! please report</p>");
                                }
                                else if(response.data == "video format does not support error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>File format not supported</p>");
                                }
                                else if(response.data == "cannot upload video error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Cannot upload video</p>");
                                }
                                else if(response.data == "server error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Server error</p>");
                                }
                                else if(response.data == "file uploading problem error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "could not update error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "folder could not be created error"){
                                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                
                        })
                        .catch(()=>{
                            console.log('FAILURE!!');
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            submitSkillTwoVideo(){
                if(this.userSkillTwoName == ""){
                    this.userSkillTwoName = "Skill No.2";
                }
                let formData = new FormData();
                formData.append('file', this.userSkillTwoNameInputFile);
                formData.append('skillName', this.userSkillTwoName);
                formData.append('sendingFileType', 'skillTwo');
                formData.append('userName', this.userName);
                formData.append('IfPremiumOrNot', this.IfPremiumUser);

                $("#skillTwoUploadError").html("");

                if(this.userSkillTwoNameInputFile == ""){
                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                }
                else{
                    try{
                        axios.post( '/api/home/uploadskillvideos',
                                formData,
                                {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function( progressEvent ) {
                                    this.skillTwoVideoUploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                                }.bind(this)
                            }
                            ).then((response)=>{
                                //console.log(response);
                                //this.getSkillTwoData();
                                if(response.data == "success"){
                                    window.location.reload();
                                }
                                else if(response.data == "please select a file error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                                }
                                else if(response.data == "file is too small to upload error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video is too small</p>");
                                }
                                else if(response.data == "video cannot be more than 3 minutes error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 3 minutes</p>");
                                }
                                else if(response.data == "video cannot be more than 500MB error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 500 MB</p>");
                                }
                                else if(response.data == "video cannot be more than 5 minutes error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 5 minutes</p>");
                                }
                                else if(response.data == "video cannot be more than 1GB error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 1GB</p>");
                                }
                                else if(response.data == "something went wrong error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Server error! please report</p>");
                                }
                                else if(response.data == "video format does not support error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>File format not supported</p>");
                                }
                                else if(response.data == "cannot upload video error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Cannot upload video</p>");
                                }
                                else if(response.data == "server error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Server error</p>");
                                }
                                else if(response.data == "file uploading problem error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "could not update error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "folder could not be created error"){
                                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                        })
                        .catch(()=>{
                            console.log('FAILURE!!');
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            submitSkillThreeVideo(){
                if(this.userSkillThreeName == ""){
                    this.userSkillThreeName = "Skill No.3";
                }
                let formData = new FormData();
                formData.append('file', this.userSkillThreeNameInputFile);
                formData.append('skillName', this.userSkillThreeName);
                formData.append('sendingFileType', 'skillThree');
                formData.append('userName', this.userName);
                formData.append('IfPremiumOrNot', this.IfPremiumUser);

                $("#skillThreeUploadError").html("");

                if(this.userSkillThreeNameInputFile == ""){
                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                }
                else{
                    try{
                        axios.post( '/api/home/uploadskillvideos',
                                formData,
                                {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress: function( progressEvent ) {
                                    this.skillThreeVideoUploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ));
                                }.bind(this)
                            }
                            ).then((response)=>{
                                //console.log(response);
                                //this.getSkillThreeData();
                                if(response.data == "success"){
                                    window.location.reload();
                                }
                                else if(response.data == "please select a file error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Please select a video</p>");
                                }
                                else if(response.data == "file is too small to upload error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video is too small</p>");
                                }
                                else if(response.data == "video cannot be more than 3 minutes error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 3 minutes</p>");
                                }
                                else if(response.data == "video cannot be more than 500MB error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 500 MB</p>");
                                }
                                else if(response.data == "video cannot be more than 5 minutes error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 5 minutes</p>");
                                }
                                else if(response.data == "video cannot be more than 1GB error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video cannot be more than 1GB</p>");
                                }
                                else if(response.data == "something went wrong error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Server error! please report</p>");
                                }
                                else if(response.data == "video format does not support error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>File format not supported</p>");
                                }
                                else if(response.data == "cannot upload video error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Cannot upload video</p>");
                                }
                                else if(response.data == "server error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Server error</p>");
                                }
                                else if(response.data == "file uploading problem error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "could not update error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                                else if(response.data == "folder could not be created error"){
                                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Video could not be uploaded</p>");
                                }
                        })
                        .catch(()=>{
                            console.log('FAILURE!!');
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            readCVURL(){
                this.cvInputFile = this.$refs.cvpdf.files[0];
                var fileSize = (this.cvInputFile.size /1024 /1024).toFixed(2);
                var filePath = this.$refs.cvpdf.value;
                var fileExtention = filePath.split(".");
                var lastIndex = fileExtention.length-1; 
                $("#cvUploadError").html("");
                if(fileSize > 2){
                    this.$refs.cvpdf.value = null;
                    this.cvInputFile = "";
                    $("#cvUploadError").append("<p style='color:#ff4d4d'>Please select a file less than 2 MB</p>");
                }
                else{
                    if(fileExtention[lastIndex] != "pdf"){
                        this.$refs.cvpdf.value = null;
                        this.cvInputFile = "";
                        $("#cvUploadError").append("<p style='color:#ff4d4d'>Please select a PDF file</p>");
                    }
                }
            },

            async readVideoURL(){
                this.introVideoInputFile = this.$refs.introVideoFile.files[0];
                var fileSize = (this.introVideoInputFile.size /1024 /1024).toFixed(2);
                var filePath = this.$refs.introVideoFile.value;
                var fileExtention = filePath.split(".");
                var lastIndex = fileExtention.length-1;
                $("#introUploadError").html("");
                if(fileSize > 200){
                    this.$refs.introVideoFile.value = null;
                    this.introVideoInputFile = "";
                    $("#introUploadError").append("<p style='color:#ff4d4d'>Please select a video less than 1 Minute and 200 MB</p>");
                }
                else{
                    
                    if(fileExtention[lastIndex] == "avi" ||
                       fileExtention[lastIndex] == "mp4" ||
                       fileExtention[lastIndex] == "mkv" ||
                       fileExtention[lastIndex] == "mov" ||
                       fileExtention[lastIndex] == "mpg" ||
                       fileExtention[lastIndex] == "webm" 
                    ){
                        // video selected
                    }
                    else{
                        this.$refs.introVideoFile.value = null;
                        this.introVideoInputFile = "";
                        $("#introUploadError").append("<p style='color:#ff4d4d'>This video format not supported</p>");
                    }
                }
                    
            },

            readSkillOneVideoURL(){
                this.userSkillOneNameInputFile = this.$refs.skillOne.files[0];
                var fileSize = (this.userSkillOneNameInputFile.size /1024 /1024).toFixed(2);
                var filePath = this.$refs.skillOne.value;
                var fileExtention = filePath.split(".");
                var lastIndex = fileExtention.length-1;
                $("#skillOneUploadError").html("");
                if(fileSize > 500 && this.IfPremiumUser == "no"){
                    this.$refs.skillOne.value = null;
                    this.userSkillOneNameInputFile = "";
                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Please select a video less 3 Minutes than 500 MB</p>");
                }
                else if(fileSize > 1024 && this.IfPremiumUser == "yes"){
                    this.$refs.skillOne.value = null;
                    this.userSkillOneNameInputFile = "";
                    $("#skillOneUploadError").append("<p style='color:#ff4d4d'>Please select a video less 5 Minutes than 1GB</p>");
                }
                else{
                    
                    if(fileExtention[lastIndex] == "avi" ||
                       fileExtention[lastIndex] == "mp4" ||
                       fileExtention[lastIndex] == "mkv" ||
                       fileExtention[lastIndex] == "mov" ||
                       fileExtention[lastIndex] == "mpg" ||
                       fileExtention[lastIndex] == "webm" 
                    ){
                        // video selected
                    }
                    else{
                        this.$refs.skillOne.value = null;
                        this.userSkillOneNameInputFile = "";
                        $("#skillOneUploadError").append("<p style='color:#ff4d4d'>This video format not supported</p>");
                    }
                }
            },

            readSkillTwoVideoURL(){
                this.userSkillTwoNameInputFile = this.$refs.skillTwo.files[0];
                var fileSize = (this.userSkillTwoNameInputFile.size /1024 /1024).toFixed(2);
                var filePath = this.$refs.skillTwo.value;
                var fileExtention = filePath.split(".");
                var lastIndex = fileExtention.length-1;
                $("#skillTwoUploadError").html("");
                if(fileSize > 500 && this.IfPremiumUser == "no"){
                    this.$refs.skillTwo.value = null;
                    this.userSkillTwoNameInputFile = "";
                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Please select a video less 3 Minutes than 500 MB</p>");
                }
                else if(fileSize > 1024 && this.IfPremiumUser == "yes"){
                    this.$refs.skillTwo.value = null;
                    this.userSkillTwoNameInputFile = "";
                    $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>Please select a video less 5 Minutes than 1GB</p>");
                }
                else{
                    
                    if(fileExtention[lastIndex] == "avi" ||
                       fileExtention[lastIndex] == "mp4" ||
                       fileExtention[lastIndex] == "mkv" ||
                       fileExtention[lastIndex] == "mov" ||
                       fileExtention[lastIndex] == "mpg" ||
                       fileExtention[lastIndex] == "webm" 
                    ){
                        // video selected
                    }
                    else{
                        this.$refs.skillTwo.value = null;
                        this.userSkillTwoNameInputFile = "";
                        $("#skillTwoUploadError").append("<p style='color:#ff4d4d'>This video format not supported</p>");
                    }
                }
            },

            readSkillThreeVideoURL(){
                this.userSkillThreeNameInputFile = this.$refs.skillThree.files[0];
                var fileSize = (this.userSkillThreeNameInputFile.size /1024 /1024).toFixed(2);
                var filePath = this.$refs.skillThree.value;
                var fileExtention = filePath.split(".");
                var lastIndex = fileExtention.length-1;
                $("#skillThreeUploadError").html("");
                if(fileSize > 500 && this.IfPremiumUser == "no"){
                    this.$refs.skillThree.value = null;
                    this.userSkillThreeNameInputFile = "";
                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Please select a video less 3 Minutes than 500 MB</p>");
                }
                else if(fileSize > 1024 && this.IfPremiumUser == "yes"){
                    this.$refs.skillThree.value = null;
                    this.userSkillThreeNameInputFile = "";
                    $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>Please select a video less 5 Minutes than 1GB</p>");
                }
                else{
                    
                    if(fileExtention[lastIndex] == "avi" ||
                       fileExtention[lastIndex] == "mp4" ||
                       fileExtention[lastIndex] == "mkv" ||
                       fileExtention[lastIndex] == "mov" ||
                       fileExtention[lastIndex] == "mpg" ||
                       fileExtention[lastIndex] == "webm" 
                    ){
                        // video selected
                    }
                    else{
                        this.$refs.skillThree.value = null;
                        this.userSkillThreeNameInputFile = "";
                        $("#skillThreeUploadError").append("<p style='color:#ff4d4d'>This video format not supported</p>");
                    }
                }
            },

            async getCVData(){
                var gettingFileTypeByString={
                    'gettingFileType': 'cv'
                };
                let returnValue;
                try{
                    await axios.put('/api/home/uploadcvorvideo/' + this.userIdFromLink, gettingFileTypeByString
                    ,{
                        responseType: "arraybuffer",
                        // headers: {
                        //     // "Accept": "application/pdf",
                        //     "Accept": "application/octet-stream"
                        // },
                    }
                    ).then((response) => {
                        returnValue = response.data;
                        console.log(returnValue);
                        // if(response.data == "no data found"){
                        //     // data not found
                        // }
                        // else{
                        //     this.axiosGetCV = response.data[0].cv_video;
                        // }
                    });
                    let buffer = returnValue;
                    // let videoBlob = new Blob([new Uint8Array(buffer)], { type: 'video/mp4' });
                    let pdfBlob = new Blob([buffer], { type: 'application/pdf' });
                    let url = window.URL.createObjectURL(pdfBlob);
                    this.axiosGetCV = url;

                    // let link = document.createElement('a')
                    // link.href = window.URL.createObjectURL(blob)
                    // link.download = 'test.pdf'
                    // link.click()
                }
                catch(e){
                    console.log(e);
                }
            },

            async getIntroData(){
                // this.axiosGetIntroVideo = "http://localhost:8000/user_uploads/8/Introduction_Video-(User_id-8)-xyz3.mp4";
                var gettingFileTypeByString={
                    'gettingFileType': 'introVideo'
                };
                let returnValue;
                try{
                    await axios.put('/api/home/uploadcvorvideo/' + this.userIdFromLink, gettingFileTypeByString
                        ,{
                            responseType: "arraybuffer",
                            headers: {
                                "Accept": "video/avi",
                                "Accept": "video/mp4",
                                "Accept": "video/x-matroska",
                                "Accept": "video/quicktime",
                                "Accept": "video/mpeg",
                                "Accept": "video/webm",
                            },
                        }
                        ).then((response) => {
                            console.log(response);
                            // Vue.set(record, 'data', response.data);
                            returnValue = response.data;
                            // this.getIntroVideoDuration();
                    });
                    let buffer = returnValue;
                    // let videoBlob = new Blob([new Uint8Array(buffer)], { type: 'video/mp4' });
                    let videoBlob = new Blob([new Uint8Array(buffer)]);
                    let url = window.URL.createObjectURL(videoBlob);
                    
                    this.axiosGetIntroVideo = url;
                    // console.log(returnValue);
                    // let blob = new Blob([new Uint8Array(returnValue)]);
                    // let chunk1 = blob.slice(0, 1);
                    // let chunk2 = blob.slice(1, 2);

                    // console.log(blob.size);
                    // console.log(chunk1.size);
                    // console.log(chunk2.size);
                }
                catch(e){
                    console.log(e);
                }
                console.log(this.axiosGetIntroVideo);
            },

            async getSkillOneData(){
                var gettingFileTypeByString={
                    'gettingFileType': 'skillOne'
                };
                let returnValue;
                try{
                    await axios.put('/api/home/uploadcvorvideo/' + this.userIdFromLink, gettingFileTypeByString
                    ,{
                        responseType: "arraybuffer",
                        headers: {
                            "Accept": "video/avi",
                            "Accept": "video/mp4",
                            "Accept": "video/x-matroska",
                            "Accept": "video/quicktime",
                            "Accept": "video/mpeg",
                            "Accept": "video/webm",
                        },
                    }
                    ).then((response) => {
                        
                        returnValue = response.data;
                        this.getSkillOneVideoName("skillOne");
                        // var videoName = response.headers["content-disposition"];
                        // var res = videoName.split('"');
                        // var finalRes = res[1].split("-");
                        // this.axiosGetSkillOneVideoTitle = finalRes[0];
                        // if(response.data[0]){
                        //     this.axiosGetSkillOneVideo = response.data[0].cv_video;
                        //     this.axiosGetSkillOneVideoTitle = response.data[0].name;
                        // }
                        
                    });
                    let buffer = returnValue;
                    // let videoBlob = new Blob([new Uint8Array(buffer)], { type: 'video/mp4' });
                    let videoBlob = new Blob([new Uint8Array(buffer)]);
                    let url = window.URL.createObjectURL(videoBlob);
                    
                    this.axiosGetSkillOneVideo = url;
                }
                catch(e){
                    console.log(e);
                }
            },

            async getSkillOneVideoName(fileType){
                var getResultByString={
                    'fileType': fileType,
                    'userId': this.userIdFromLink
                };
                try{
                    await axios.post('/api/home/getnamesofvideos', getResultByString).then((response) => {
                        if(response.data == "not found"){
                            // data not found
                        }
                        else{
                            if(fileType == "skillOne"){
                                this.axiosGetSkillOneVideoTitle = response.data;
                            }
                            else if(fileType == "skillTwo"){
                                this.axiosGetSkillTwoVideoTitle = response.data;
                            }
                            else if(fileType == "skillThree"){
                                this.axiosGetSkillThreeVideoTitle = response.data;
                            }
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getSkillTwoData(){
                var gettingFileTypeByString={
                    'gettingFileType': 'skillTwo'
                };
                let returnValue;
                try{
                    await axios.put('/api/home/uploadcvorvideo/' + this.userIdFromLink, gettingFileTypeByString
                    ,{
                        responseType: "arraybuffer",
                        headers: {
                            "Accept": "video/avi",
                            "Accept": "video/mp4",
                            "Accept": "video/x-matroska",
                            "Accept": "video/quicktime",
                            "Accept": "video/mpeg",
                            "Accept": "video/webm",
                        },
                    }
                    ).then((response) => {
                        returnValue = response.data;
                        this.getSkillOneVideoName("skillTwo");
                        // var videoName = response.headers["content-disposition"];
                        // var res = videoName.split('"');
                        // var finalRes = res[1].split("-");
                        // this.axiosGetSkillTwoVideoTitle = finalRes[0];
                        // if(response.data[0]){
                        //     this.axiosGetSkillTwoVideo = response.data[0].cv_video;
                        //     this.axiosGetSkillTwoVideoTitle = response.data[0].name;
                        // }
                        
                    });
                    let buffer = returnValue;
                    // let videoBlob = new Blob([new Uint8Array(buffer)], { type: 'video/mp4' });
                    let videoBlob = new Blob([new Uint8Array(buffer)]);
                    let url = window.URL.createObjectURL(videoBlob);
                    
                    this.axiosGetSkillTwoVideo = url;
                }
                catch(e){
                    console.log(e);
                }
            },

            async getSkillThreeData(){
                var gettingFileTypeByString={
                    'gettingFileType': 'skillThree'
                };
                let returnValue;
                try{
                    await axios.put('/api/home/uploadcvorvideo/' + this.userIdFromLink, gettingFileTypeByString
                    ,{
                        responseType: "arraybuffer",
                        headers: {
                            "Accept": "video/avi",
                            "Accept": "video/mp4",
                            "Accept": "video/x-matroska",
                            "Accept": "video/quicktime",
                            "Accept": "video/mpeg",
                            "Accept": "video/webm",
                        },
                    }
                    ).then((response) => {
                        returnValue = response.data;
                        this.getSkillOneVideoName("skillThree");
                        // var videoName = response.headers["content-disposition"];
                        // var res = videoName.split('"');
                        // var finalRes = res[1].split("-");
                        // this.axiosGetSkillThreeVideoTitle = finalRes[0];
                        // if(response.data[0]){
                        //     this.axiosGetSkillThreeVideo = response.data[0].cv_video;
                        //     this.axiosGetSkillThreeVideoTitle = response.data[0].name;
                        // }
                        
                    });
                    let buffer = returnValue;
                    // let videoBlob = new Blob([new Uint8Array(buffer)], { type: 'video/mp4' });
                    let videoBlob = new Blob([new Uint8Array(buffer)]);
                    let url = window.URL.createObjectURL(videoBlob);
                    
                    this.axiosGetSkillThreeVideo = url;
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
                $("#hideForLongPages").hide();
                if(this.userType == "companyUser"){
                    this.updateUsersNumberOfVisited();
                }
            },

            async updateUsersNumberOfVisited(){
                var updateUsersData={
                    'userId': this.userIdFromLink
                };
                try{
                    await axios.post('/api/home/updateusersvisitednumber', updateUsersData).then((response) => {
                        if(response.data == "success"){

                        }
                        else if(response.data == "server error"){

                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async notificationsForUsers(){
                try{
                    await axios.get('/api/home/usersprofilenotification').then((response) => {
                        console.log(response);
                        
                        if(response.data[0].visited_profile > 0){
                            this.notificationForUsers = response.data;
                            this.usersNotificationNumber = response.data[0].numberOfNotification;
                            this.userCheckedNotification = response.data[0].notificationChecked;
                            this.numberOfVisitedProfile = response.data[0].visited_profile;
                        }
                        else if(response.data == "no data found"){
                            this.notificationForUsers = [];
                            this.usersNotificationNumber = "";
                            this.userCheckedNotification = "yes";
                            this.numberOfVisitedProfile = 0;
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },
        }
    }
</script>
