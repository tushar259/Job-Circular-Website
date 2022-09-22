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
                                <a class="d-flex align-items-center dropdown-item" href="" target="_blank" style="background-color:rgb(204, 204, 179);font-size:12px;">
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
    <div class="container-fluid">
        <div id="showDataTemplate">
            <div style="text-align:center;margin:0 auto;">
                <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
            </div>
            <div style="height:600px;">
            </div>
        </div>
        
        <div id="divWithData">
            <div v-if="userType == 'companyUser'" class="card shadow-lg o-hidden border-0">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="m-auto p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4" style="font-size:20px;">Create a Circular</h4>
                                </div>
                                <div class="user" style="font-size:14px;">
                                    
                                    <div class="form-group"><input style="border-color:red;font-size:16px;" class="form-control form-control-user" v-model="newCircular.jobName" @keyup.enter="enterButtonPressed(0)" id="job_name" name="job_name" placeholder="Job Position*" data-toggle="tooltip" data-placement="top" title="Job Position" autocomplete="off" required></div>
                                    <p id="submitJobname"></p>
                                    <div class="form-group"><input style="border-color:red;font-size:16px;" class="form-control form-control-user" v-model="newCircular.companyName" @keyup.enter="enterButtonPressed(0)" id="company_name" name="company_name" placeholder="Company Name*" data-toggle="tooltip" data-placement="top" title="Company Name" autocomplete="off" required></div>
                                    <p id="submitCompanyname"></p>
                                    <div class="form-group"><input style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.vacancy" @keyup.enter="enterButtonPressed(0)" type="number" id="vacancy" name="vacancy" placeholder="Vacancy(only number)(Optional)" data-toggle="tooltip" data-placement="top" title="Vacancy(only number)(Optional)" autocomplete="off"></div>
                                    <p id="submitVacancy"></p>
                                    <div class="form-group"><input style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.employmentStatus" @keyup.enter="enterButtonPressed(0)" id="employment_status" name="employment_status" placeholder="Employment Status(Optional)" data-toggle="tooltip" data-placement="top" title="Employment Status(Optional)" autocomplete="off"></div>
                                    <p id="submitEmploymentStatus"></p>
                                    <div class="form-group"><span>Job Type:*</span></div>
                                    <div class="iWantToHideScroll" style="padding-left:12px;padding-top:10px;padding-bottom:10px;height:250px;max-width:740px;margin:0 auto;border:1px solid red;font:10px/20px Georgia, Garamond, Serif;overflow:auto;font-size:16px;" data-toggle="tooltip" data-placement="top" title="Job Type">
                                        <div v-for="(jobtype, index) in jobtypes">
                                            <div v-if="index % 2 == 0 || index == 0" style="background-color:rgb(245, 245, 240);">
                                                <input type="radio" name="selectJobtype" v-on:change="showSelectedJobtypeData(jobtype.id, $event)" @keyup.enter="enterButtonPressed(0)">
                                                <label>{{jobtype.jobtype_name}}</label>
                                            </div>
                                            <div v-else>
                                                <input type="radio" name="selectJobtype" v-on:change="showSelectedJobtypeData(jobtype.id, $event)" @keyup.enter="enterButtonPressed(0)">
                                                <label>{{jobtype.jobtype_name}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="height:20px"><p id="submitJobtype"></p></div>
                                    <div class="form-group"><textarea style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.educationReq" @keyup.enter="enterButtonPressed(0)" id="education_req" name="education_req" placeholder="Educational Requirements(Optional)" data-toggle="tooltip" data-placement="top" title="Educational Requirements(Optional)" autocomplete="off"></textarea></div>
                                    <p id="submitEducationalReq"></p>
                                    <div class="form-group"><textarea style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.experienceReq" @keyup.enter="enterButtonPressed(0)" id="experience_req" name="experience_req" placeholder="Experience Requirements(Optional)" data-toggle="tooltip" data-placement="top" title="Experience Requirements(Optional)" autocomplete="off"></textarea></div>
                                    <p id="submitExperienceReq"></p>
                                    <div class="form-group"><textarea style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.jobResponsibility" @keyup.enter="enterButtonPressed(0)" id="job_responsibility" name="job_responsibility" placeholder="Job Responsibilities(Optional)" data-toggle="tooltip" data-placement="top" title="Job Responsibilities(Optional)" autocomplete="off"></textarea></div>
                                    <p id="submitJobResponsibility"></p>
                                    <div class="form-group"><textarea style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.moreReq" @keyup.enter="enterButtonPressed(0)" id="more_req" name="more_req" placeholder="More Requirements(Optional)" data-toggle="tooltip" data-placement="top" title="More Requirements(Optional)" autocomplete="off"></textarea></div>
                                    <p id="submitMoreReq"></p>
                                    <div class="form-group"><input style="border-color:red;font-size:16px;" class="form-control form-control-user" v-model="newCircular.jobLocation" @keyup.enter="enterButtonPressed(0)" id="job_location" name="job_location" placeholder="Job Location*" data-toggle="tooltip" data-placement="top" title="Job Location" autocomplete="off" required></div>
                                    <p id="submitJobLocation"></p>
                                    <div class="form-group"><input style="border-color:red;font-size:16px;" class="form-control form-control-user" v-model="newCircular.salary" @keyup.enter="enterButtonPressed(0)" id="salary" name="salary" placeholder="Salary(amount and currency)*" data-toggle="tooltip" data-placement="top" title="Salary(amount and currency)" autocomplete="off" required></div>
                                    <p id="submitSalary"></p>
                                    <div class="form-group"><textarea style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.otherBenefits" @keyup.enter="enterButtonPressed(0)" id="other_benefits" name="other_benefits" placeholder="Other Benefits(Optional)" data-toggle="tooltip" data-placement="top" title="Other Benefits(Optional)" autocomplete="off"></textarea></div>
                                    <p id="submitOtherBenefits"></p>
                                    <div class="form-group"><textarea style="font-size:16px;" class="form-control form-control-user" v-model="newCircular.readBeforeApply" @keyup.enter="enterButtonPressed(0)" id="read_before_apply" name="read_before_apply" placeholder="Read Before Apply(Optional" data-toggle="tooltip" data-placement="top" title="Read Before Apply(Optional" autocomplete="off"></textarea></div>
                                    <p id="submitReadBeforeApply"></p>
                                    <div class="form-group"><span>Deadline:*</span></div>
                                    <div class="form-group"><input style="border-color:red;font-size:16px;" class="form-control form-control-user" v-model="newCircular.deadline" @keyup.enter="enterButtonPressed(0)" id="deadline" name="deadline" placeholder="Deadline" type="date" data-toggle="tooltip" data-placement="top" title="Deadline" autocomplete="off" required></div>
                                    <p id="submitDeadline"></p>
                                    <p id="submitProblem"></p>
                                    <p class="alert alert-info beautiful" role="alert" id="submitSuccess">Circular submitted</p>
                                    
                                    <!-- <div class="alert alert-info beautiful" role="alert"><strong>Info</strong> You have 28 new messages.</div>
                                    <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(234,212,101);color: rgb(5,7,10);"><strong>Info</strong> You have 28 new messages.</div>
                                    <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(238,139,118);color: rgb(10,11,11);"><strong>Info</strong> You have 28 new messages.</div> -->
                                    <div style="height:10px;"></div>
                                    <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="submitCircular()" :disabled="submitClicked" name="submit_button">Add A Circular</button>
                                    <div style="height:10px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        



            <div>
                <div class="row">
                    <div class="col-xl-9" style="height:26px;">
                        <h2 class="text-dark mb-4" style="padding-left: 0px;width: 125px;margin: 0 auto;"></h2>
                    </div>
                    <div class="col" style="height:20px;text-align:left;padding-top:7px;">
                        <div class="dropdown no-arrow" style="padding-left: 0px;margin: 0 auto;width: 125px;">
                            <span>Show Results</span>
                            <select id="showNumberOfData" v-on:change="showCircularResults()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20" selected>20</option>
                                <option value="50">50</option>
                                <option value="70">70</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="height:130px;">
                <div class="text-center">
                    <div style="display:inline-block;">
                        <nav class="iWantToHideScroll" style="max-width: 250px;overflow-x:auto;">

                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevCircularData()"><span aria-hidden="true">«Prev</span></a></li>
                                <li class="disabled page-item"><a class="page-link">Page {{currentCircularPage}} of {{totalCircularListPages}}</a></li>
                                <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextCircularData()"><span aria-hidden="true">Next»</span></a></li>
                                
                            </ul>
                            <ul class="pagination">
                                <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" placeholder="0" v-model="getCircularByPage" @keyup.enter="getCircularByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getCircularByPageData()">Go</button>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- <div class = "demo1">
                <div class = "demo">
                    <a @click.prevent="prevCircularData()" style="cursor:pointer;">< Prev</a>
                    <a disabled>Page {{currentCircularPage}} of {{totalCircularListPages}}</a>
                    <a @click.prevent="nextCircularData()" style="cursor:pointer;">Next ></a>
                </div>
            </div> -->



            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->

            <!-- <div class="d-block d-sm-none" style="text-align:center;">
                <span>Show Results</span>
                <select id="showNumberOfData" v-on:change="showCircularResults()">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20" selected>20</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div style="height:10px;"></div>
            <div class="row">
                <div class="col d-none d-xl-block">

                </div>
                <div class="col-3 d-xl-none d-none d-md-block d-lg-block d-xl-none">

                </div>
                <div class="col-2 d-none d-sm-block d-md-none">

                </div>
                <div class="col d-none d-sm-block" style="text-align:center;width:510px;vertical-align:middle;">
                    <div style="width:50%;float:left;">
                        <div style="width: 510px;height:30px;">
                            <ul class="pagination" style="float:left;">
                                <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevCircularData()"><span aria-hidden="true">«Prev</span></a></li>
                                <li class="disabled page-item"><a class="page-link">Page {{currentCircularPage}} of {{totalCircularListPages}}</a></li>
                                <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextCircularData()"><span aria-hidden="true">Next»</span></a></li>
                                
                            </ul>
                            <div style="width:10px;float:left;opacity:0;">--</div>
                            <ul class="pagination" style="padding-top:23px;">
                                <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:70px" placeholder="0" v-model="getCircularByPage" @keyup.enter="getCircularByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getCircularByPageData()">Go</button>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-2 d-none d-sm-block" >
                    <div>
                        <div style="width: 125px;">
                            <span>Show Results</span>
                            <select id="showNumberOfData" v-on:change="showCircularResults()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20" selected>20</option>
                                <option value="50">50</option>
                                <option value="70">70</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="d-block d-sm-none" style="height:100px;">
                <div class="row">
                    <div class="col" style="padding-left: 0px;">
                        <nav class="text-center">

                            <ul class="pagination" style="display: inline-block;margin-bottom: 0px;margin-top: 0px;">
                                <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevCircularData()"><span aria-hidden="true">«Prev</span></a></li>
                                <li class="disabled page-item"><a class="page-link">Page {{currentCircularPage}} of {{totalCircularListPages}}</a></li>
                                <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextCircularData()"><span aria-hidden="true">Next»</span></a></li>
                                
                            </ul>
                            <ul class="pagination" style="display: inline-block;margin-bottom: 0px;margin-top: 0px;">
                                <span style="padding-top:3px;float:left;">Go to page </span>
                                <div style="width:5px;float:left;opacity:0;">-</div>
                                <input type="number" style="width:84px;float:left;" placeholder="0" v-model="getCircularByPage" @keyup.enter="getCircularByPageData()">
                                <div style="width:1px;float:left;opacity:0;">-</div>
                                <button style="width:35px;float:left;" @click.prevent="getCircularByPageData()">Go</button>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div style="height:20px;"></div> -->
            
                
            



            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->
            <!-- trying to make a new pagination -->










            <div style="height:30px;text-align:right">
                <h4 class="text-dark mb-4" style="padding-right:20px;">Results found: {{totalCircularResults}}</h4>
            </div>
            <hr style="height:8px">
            <div class="iWantToHideScroll" style="overflow-x: scroll;">
                
                <div>
                    <div style="width:250px;margin:0 auto;float:left;">
                        <h3 style="text-align:center;">Search Circular By Job Skills</h3>
                        <div class="iWantToHideScroll" style="text-align:left;padding-left:12px;padding-top:10px;padding-bottom:10px;height:400px;max-width:230px;margin:0 auto;font: Georgia, Garamond, Serif;overflow:auto;">
                            <div style="background-color:rgb(245, 245, 240);">
                                <input type="radio" name="searchJobtype" v-on:change="selectedAll()" checked>
                                <label>All</label>
                            </div>
                            <div v-for="(jobtype, index) in jobtypes">
                                <!-- <label>{{index}}</label> -->
                                <div v-if="index % 2 == 0 || index == 0">
                                    
                                        <input  type="radio" name="searchJobtype" v-on:change="showSearchJobtypeData(jobtype.id, $event)">
                                        <label>{{jobtype.jobtype_name}}</label>
                                </div>
                                <div v-else style="background-color:rgb(245, 245, 240);">
                                        <input type="radio" name="searchJobtype" v-on:change="showSearchJobtypeData(jobtype.id, $event)">
                                        <label>{{jobtype.jobtype_name}}</label>
                                </div>
                            </div>
                        </div>
                        <p id="jobtypeDataOne"></p>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col text-center">
                            <div class="card-deck-wrapper">
                                <h2 class="text-dark mb-4">Circular List</h2>
                                <div v-for="(circularList, index) in circularLists" v-bind:key="circularList.id">
                                    <div class="card-deck" v-if="index % 3 == 0 || index == 0">
                                        <a class="card" style="min-width:230px;text-decoration:none;text-align:left;" v-bind:href="'/view-circular/'+circularLists[index].id" v-if="circularLists[index]" target="_blank">
                                            
                                            <div class="card-block">
                                                <h3 class="text-muted">DEADLINE: {{circularLists[index].deadline | timewhen}}</h3>
                                                <p class="circle" style='float:right;' v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index].company_id)" data-toggle="tooltip" data-placement="top" title="Number of People Applied for the Circular">{{circularLists[index].appliedUsersCount}}</p>
                                                <h3 style="color: black" class="card-title">{{circularLists[index].job_name}}</h3>
                                                <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{circularLists[index].company_name}}</em></h4>
                                                <h4 class="card-text" style="color: black;margin:0 auto;">Salary: <span class="text-muted">{{circularLists[index].salary}}</span></h4>
                                                <h4 class="card-text" style="color: black;margin:0 auto;">Location: <span class="text-muted">{{circularLists[index].job_location}}</span></h4>
                                                <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                <br>
                                                <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/view-circular/'+circularLists[index].id" v-if="circularLists[index]" target="_blank">View</a>
                                                <a class="btn btn-primary" type="button" style="color:white;" v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index].company_id)" v-bind:href="'/edit-circular/'+circularLists[index].id" target="_blank">Edit</a>
                                                <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;" v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index].company_id)" v-bind:href="'/delete-circular/'+circularLists[index].id" target="_blank">Delete</a>
                                                
                                            </div>
                                        </a>
                                        <a class="card" style="min-width:230px;text-decoration:none;text-align:left;" v-bind:href="'/view-circular/'+circularLists[index+1].id" v-if="circularLists[index+1]" target="_blank">
                                            
                                            <div class="card-block">
                                                <h3 class="text-muted">DEADLINE: {{circularLists[index+1].deadline | timewhen}}</h3>
                                                <p class="circle" style='float:right;' v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+1].company_id)" data-toggle="tooltip" data-placement="top" title="Number of People Applied for the Circular">{{circularLists[index+1].appliedUsersCount}}</p>
                                                <h3 style="color: black" class="card-title">{{circularLists[index+1].job_name}}</h3>
                                                <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{circularLists[index+1].company_name}}</em></h4>
                                                <h4 class="card-text" style="color: black;margin:0 auto;">Salary: <span class="text-muted">{{circularLists[index+1].salary}}</span></h4>
                                                <h4 class="card-text" style="color: black;margin:0 auto;">Location: <span class="text-muted">{{circularLists[index+1].job_location}}</span></h4>
                                                <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                <br>
                                                <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/view-circular/'+circularLists[index+1].id" v-if="circularLists[index+1]" target="_blank">View</a>
                                                <a class="btn btn-primary" type="button" style="color:white;" v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+1].company_id)" v-bind:href="'/edit-circular/'+circularLists[index+1].id" target="_blank">Edit</a>
                                                <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;" v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+1].company_id)" v-bind:href="'/delete-circular/'+circularLists[index+1].id" target="_blank">Delete</a>
                                                
                                            </div>
                                        </a>
                                        <a v-else class="card" style="min-width:230px;text-decoration:none;text-align:left;opacity:0;"></a>
                                        <a class="card" style="min-width:230px;text-decoration:none;text-align:left;" v-bind:href="'/view-circular/'+circularLists[index+2].id" v-if="circularLists[index+2]" target="_blank">
                                            
                                            <div class="card-block">
                                                <h3 class="text-muted">DEADLINE: {{circularLists[index+2].deadline | timewhen}}</h3>
                                                <p class="circle" style='float:right;' v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+2].company_id)" data-toggle="tooltip" data-placement="top" title="Number of People Applied for the Circular">{{circularLists[index+2].appliedUsersCount}}</p>
                                                <h3 style="color: black" class="card-title">{{circularLists[index+2].job_name}}</h3>
                                                <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{circularLists[index+2].company_name}}</em></h4>
                                                <h4 class="card-text" style="color: black;margin:0 auto;">Salary: <span class="text-muted">{{circularLists[index+2].salary}}</span></h4>
                                                <h4 class="card-text" style="color: black;margin:0 auto;">Location: <span class="text-muted">{{circularLists[index+2].job_location}}</span></h4>
                                                <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                <br>
                                                <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/view-circular/'+circularLists[index+2].id" v-if="circularLists[index+2]" target="_blank">View</a>
                                                <a class="btn btn-primary" type="button" style="color:white;" v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+2].company_id)" v-bind:href="'/edit-circular/'+circularLists[index+2].id" target="_blank">Edit</a>
                                                <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;" v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+2].company_id)" v-bind:href="'/delete-circular/'+circularLists[index+2].id" target="_blank">Delete</a>
                                                
                                            </div>
                                        </a>
                                        <a v-else class="card" style="min-width:230px;text-decoration:none;text-align:left;opacity:0;"></a>
                                    </div>
                                </div>
                                <p id="circularListId"></p>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
            <hr>
            <div>
                <div class="text-center">
                    <div style="display:inline-block;">
                        <nav style="max-width: 250px;">

                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevCircularData()"><span aria-hidden="true">«Prev</span></a></li>
                                <li class="disabled page-item"><a class="page-link">Page {{currentCircularPage}} of {{totalCircularListPages}}</a></li>
                                <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextCircularData()"><span aria-hidden="true">Next»</span></a></li>
                                
                                
                            </ul>
                            <ul class="pagination">
                                <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" v-model="getCircularByPage" @keyup.enter="getCircularByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getCircularByPageData()">Go</button>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div style="height:10px"></div>
        </div>

    </div>

</div>
</template>

<script>
    export default {


        data(){
            return{
                searchField: '',
                userId: '',
                userIdS: '',
                userType: '',
                submitClicked: false,
                jobtypes:[],
                circularLists:[],
                newCircular: { 
                    'jobName': '',
                    'companyName': '',
                    'employmentStatus': '',
                    'jobType': '',
                    'educationReq': '',
                    'experienceReq': '',
                    'jobResponsibility': '',
                    'moreReq': '',
                    'jobLocation': '',
                    'salary': '',
                    'otherBenefits': '',
                    'readBeforeApply': '',
                    'vacancy': '',
                    'deadline': '',
                },
                submitCircularHasNoError: true,
                appliedUserForCirculars: [],
                notificationNumber: '',
                notificationForUsers: [],
                usersNotificationNumber: '',
                userCheckedNotification: 'no',
                currentCircularPage: 1,
                totalCircularListPages: '',
                getCircularByPage: '',
                getNumberOfData: 20,
                selectedJobTypeIdForSearch: '',
                interval: 0,
                totalCircularResults: 0,
                
            }
        },

        mounted() {
            $("#submitSuccess").hide();
            $("#divWithData").hide();
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            enterButtonPressed(value){
                if(this.interval == value){
                    this.submitCircular();
                }
            },

            selectedAll(){
                this.selectedJobTypeIdForSearch = '';
                this.getPaginationCircularListData();
            },

            showCircularResults(){
                this.getNumberOfData = document.getElementById("showNumberOfData").value;
                this.currentCircularPage = 1;
                this.getPaginationCircularListData();
            },

            getCircularByPageData(){
                var getData = {
                    'getDataType': 'pagination',
                    'fromTable': 'circular',
                    'getNumberOfData': this.getNumberOfData,
                    'selectedJobTypeIdForSearch': this.selectedJobTypeIdForSearch
                };
                $("#circularListId").html("");
                if(this.getCircularByPage != '' && !(this.getCircularByPage > this.totalCircularListPages) && !(this.getCircularByPage < 1)){
                    try{
                        axios.put('/api/home/pagination/'+ this.getCircularByPage, getData).then((response) => {
                            console.log(response);
                            if(response.data[0].id){
                                $("#circularListId").html("");
                                this.circularLists = response.data;
                                this.currentCircularPage = parseInt(this.getCircularByPage);
                                this.totalCircularResults = response.data[0].totalResults;
                            }
                            else if(response.data == "no data found"){
                                this.circularLists = [];
                                this.totalCircularResults = 0;
                                $("#circularListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                            }
                            
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            prevCircularData(){
                this.currentCircularPage -= 1;
                if(this.currentCircularPage < 1){
                    this.currentCircularPage = 1;
                }
                else if(this.currentCircularPage >= 1){
                    // search data;
                    this.getPaginationCircularListData();
                }
                // console.log(this.currentCircularPage);
            },

            nextCircularData(){
                this.currentCircularPage += 1;
                if(this.currentCircularPage > this.totalCircularListPages){
                    this.currentCircularPage = this.totalCircularListPages;
                }
                else if(this.currentCircularPage <= this.totalCircularListPages){
                    // search data;
                    this.getPaginationCircularListData();
                }
                // console.log(this.currentCircularPage);
            },

            getPaginationCircularListData(){
                var getData = {
                    'getDataType': 'pagination',
                    'fromTable': 'circular',
                    'getNumberOfData': this.getNumberOfData,
                    'selectedJobTypeIdForSearch': this.selectedJobTypeIdForSearch
                };
                $("#circularListId").html("");
                try{
                    axios.put('/api/home/pagination/'+ this.currentCircularPage, getData).then((response) => {
                        // console.log(response);
                        
                        if(response.data[0].id){
                            $("#circularListId").html("");
                            this.circularLists = response.data;
                            this.totalCircularListPages = response.data[0].totalPages;
                            this.totalCircularResults = response.data[0].totalResults;
                        }
                        else if(response.data == "no data found"){
                            this.circularLists = [];
                            this.totalCircularListPages = 1;
                            this.totalCircularResults = 0;
                            $("#circularListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                        }
                        
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

            async getUserData(){
                // document.getElementById("divWithData").style.display = "none";
                try{
                    await axios.get('/api/home/userinfo').then((response) => {
                        //console.log(response);
                        if(response.data == "not authorized user"){
                            this.userType = "notAuthorizedUser";
                            this.userId = "";
                        }
                        else if(response.data[0].id){
                            this.userId = response.data[0].id;
                            this.userIdS = response.data[0].userIdS;
                            if(response.data[0].user_type == "user"){
                                this.userType = "user";
                            }
                            else if(response.data[0].user_type == "companyUser"){
                                this.userType = "companyUser";
                            }
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                this.getJobtypesData();
                this.getCircularListData(); 
                if(this.userType == "companyUser"){
                    this.usersThatAppliedForJob();
                }
                else if(this.userType == "user"){
                    this.notificationsForUsers();
                }
                $("#hideForLongPages").hide();
            },

            async notificationsForUsers(){
                try{
                    await axios.get('/api/home/usersprofilenotification').then((response) => {
                        console.log(response);
                        
                        if(response.data[0].visited_profile > 0){
                            this.notificationForUsers = response.data;
                            this.usersNotificationNumber = response.data[0].numberOfNotification;
                            this.userCheckedNotification = response.data[0].notificationChecked;
                        }
                        else if(response.data == "no data found"){
                            this.notificationForUsers = [];
                            this.usersNotificationNumber = "";
                            this.userCheckedNotification = "yes";
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
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

            loadThispage(){
                $("#theTitle").html("Job24");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                var activeNow = $("[name='navHome'] .btn");
                activeNow.addClass('active');
                $("[name='sideNavHome']").addClass('active');
                var refresh = window.localStorage.getItem('refresh');
                if(refresh == null || refresh == ""){
                    window.localStorage.setItem('refresh', "1");
                    window.location.reload();
                }
            },

            async getJobtypesData() {
                try{
                    await axios.get('/api/home/jobtype').then((response) => {
                        
                        if(response.data[0].id){
                            $("#jobtypeDataOne").html("");
                            // document.getElementById("jobtypeDataOne").innerHTML = "";
                            this.jobtypes = response.data;
                        }
                        else if(response.data == "data not found"){
                            $("#jobtypeDataOne").append("<p style='color:#ff4d4d'>Data not found! somthing went wrong.</p>");
                            // document.getElementById("jobtypeDataOne").innerHTML = "Data not found! somthing went wrong.";
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getCircularListData() {
                $("#circularListId").html("");
                try{
                    await axios.get('/api/home/circular').then((response) => {
                        console.log(response);
                        if(response.data == ""){
                            this.circularLists = [];
                            this.totalCircularListPages = 1;
                            this.totalCircularResults = 0;
                            $("#circularListId").append("<p style='color:#ff4d4d'>No data found!</p>");
                        }
                        else if(response.data[0].id){
                            $("#circularListId").html("");
                            this.circularLists = response.data;
                            this.totalCircularListPages = response.data[0].totalPages;
                            this.totalCircularResults = response.data[0].totalResults;
                            
                        }
                        else if(response.data == "no circular data found"){
                            this.circularLists = [];
                            this.totalCircularListPages = 1;
                            this.totalCircularResults = 0;
                            $("#circularListId").append("<p style='color:#ff4d4d'>No data found!</p>");
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
                $("#submitSuccess").hide();
            },

            showSearchJobtypeData(jobtypeId, event){
                // console.log(jobtypeId);
                // console.log(event.target.name);
                
                this.selectedJobTypeIdForSearch = jobtypeId;
                this.currentCircularPage = 1;
                var getData = {
                    'getDataType': 'pagination',
                    'fromTable': 'circular',
                    'getNumberOfData': this.getNumberOfData,
                    'currentPage': this.currentCircularPage
                };
                $("#circularListId").html("");
                try{
                    axios.put('/api/home/searchdata/' + jobtypeId, getData).then((response) => {
                        console.log(response);
                        if(response.data[0].id){
                            $("#circularListId").html("");
                            this.circularLists = response.data;
                            this.totalCircularListPages = response.data[0].totalPages;
                            this.totalCircularResults = response.data[0].totalResults;
                        }
                        else if(response.data == "no data found"){
                            this.circularLists = [];
                            this.totalCircularListPages = 1;
                            this.totalCircularResults = 0;
                            $("#circularListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            showSelectedJobtypeData(jobtypeId, event){
                
                //console.log(event.target.name);
                this.newCircular['jobType'] = jobtypeId;
            },

            submitCircular(){
                this.interval = 1;
                this.submitClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.submitClicked = false;
                }.bind(this),1500);


                $("#submitJobname").html("");
                $("#submitCompanyname").html("");
                $("#submitJobtype").html("");
                $("#submitJobLocation").html("");
                $("#submitSalary").html("");
                $("#submitDeadline").html("");
                $("#submitProblem").html("");
                $("#submitSuccess").hide();

                var input = this.newCircular;
                if (input['jobName'] == '' ||
                    input['companyName'] == '' ||
                    input['jobType'] == '' ||
                    input['jobLocation'] == '' ||
                    input['salary'] == '' ||
                    input['deadline'] == ''
                    ) {
                    this.submitCircularHasNoError = false;
                    if(input['jobName'] == ''){
                        $("#submitJobname").append("<p style='color:#ff4d4d'>Job position cannot be empty</p>");
                        // document.getElementById("submitJobname").innerHTML="Job position cannot be empty";
                    }
                    if(input['companyName'] == ''){
                        $("#submitCompanyname").append("<p style='color:#ff4d4d'>Company name cannot be empty</p>");
                        // document.getElementById("submitCompanyname").innerHTML="Company name cannot be empty";
                    }
                    if(input['jobType'] == ''){
                        $("#submitJobtype").append("<p style='color:#ff4d4d'>Select any option</p>");
                        // document.getElementById("submitJobtype").innerHTML="Select any option";
                    }
                    if(input['jobLocation'] == ''){
                        $("#submitJobLocation").append("<p style='color:#ff4d4d'>Location cannot be empty</p>");
                        // document.getElementById("submitJobLocation").innerHTML="Location cannot be empty";
                    }
                    if(input['salary'] == ''){
                        $("#submitSalary").append("<p style='color:#ff4d4d'>Write a amount with currency</p>");
                        // document.getElementById("submitSalary").innerHTML="Write a amount with currency";
                    }
                    if(input['deadline'] == ''){
                        $("#submitDeadline").append("<p style='color:#ff4d4d'>Please select a deadline</p>");
                        // document.getElementById("submitDeadline").innerHTML="Please select a deadline";
                    }
                } 
                else {
                    this.submitCircularHasNoError = true;
                    try{
                        axios.post('/api/home/circular', input)
                            .then((response) => {
                                // console.log(response);
                                if(response.data == "success"){
                                    // document.getElementById("submitProblem").innerHTML="";
                                    this.newCircular = { 
                                        'jobName': '',
                                        'companyName': '',
                                        'employmentStatus': '',
                                        'jobType': '',
                                        'educationReq': '',
                                        'experienceReq': '',
                                        'jobResponsibility': '',
                                        'moreReq': '',
                                        'jobLocation': '',
                                        'salary': '',
                                        'otherBenefits': '',
                                        'readBeforeApply': '',
                                        'vacancy': '',
                                        'deadline': ''
                                    };
                                    swal.fire("<p style='font-size:22px;color:green;'>Congratulations!</p>", "<p style='font-size:18px;'>Circular Created</p>");
                                    $("#submitSuccess").show();
                                    setTimeout(function(){
                                        $("#submitSuccess").hide();
                                    }.bind(this),3500);
                                    this.getCircularListData();
                                }
                                else if(response.data == "something went wrong"){
                                    $("#submitProblem").append("<p style='color:#ff4d4d'>Could not Submit!</p>");
                                    // document.getElementById("submitProblem").innerHTML="Could not Submit!";
                                }
                                else if(response.data == "Job position cannot be empty"){
                                    $("#submitJobname").append("<p style='color:#ff4d4d'>Job position cannot be empty</p>");
                                    // document.getElementById("submitJobname").innerHTML="Job position cannot be empty";
                                }
                                else if(response.data == "Company name cannot be empty"){
                                    $("#submitCompanyname").append("<p style='color:#ff4d4d'>Company name cannot be empty</p>");
                                    // document.getElementById("submitCompanyname").innerHTML="Company name cannot be empty";
                                }
                                else if(response.data == "Select any option"){
                                    $("#submitJobtype").append("<p style='color:#ff4d4d'>Select any option</p>");
                                    // document.getElementById("submitJobtype").innerHTML="Select any option";
                                }
                                else if(response.data == "Location cannot be empty"){
                                    $("#submitJobLocation").append("<p style='color:#ff4d4d'>Location cannot be empty</p>");
                                    // document.getElementById("submitJobLocation").innerHTML="Location cannot be empty";
                                }
                                else if(response.data == "Write a amount with currency"){
                                    $("#submitSalary").append("<p style='color:#ff4d4d'>Write a amount with currency</p>");
                                    // document.getElementById("submitSalary").innerHTML="Write a amount with currency";
                                }
                                else if(response.data == "Please select a deadline"){
                                    $("#submitDeadline").append("<p style='color:#ff4d4d'>Please select a deadline</p>");
                                    // document.getElementById("submitDeadline").innerHTML="Please select a deadline";
                                }
                        });
                        
                        
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },
        }
    }
</script>
