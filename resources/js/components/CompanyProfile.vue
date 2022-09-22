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
        <div id="showDataTemplate">
            <div style="text-align:center;margin:0 auto;">
                <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
            </div>
            <div style="height:600px;">
            </div>
        </div>
        <div id="divWithData">
            <div class="container-fluid">
                <div class="card shadow-lg o-hidden border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col">
                                <div class="m-auto p-5">
                                    <div class="user" style="text-align:center;">
                                        <div style="font-family:Arial, Helvetica, sans-serif;font-size:30px;font-weight:bold;">{{companyName}}</div>
                                        <div class="text-muted" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;">{{companyAddress}}</div>
                                        <div style="height:30px;"></div>
                                        <div class="iWantToHideScroll" style="text-align:left;overflow-x:auto;">
                                            <table style="margin-left:auto;margin-right:auto;">
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
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:10px;"></div>
                <div v-if="userIdFromLink == userIdS && userIdS == 1 && userType == 'companyUser'">
                    <div style="height:10px;"></div>
                    <div>
                        <div class="row">
                            <div class="col-xl-9" style="height:26px;">
                                <h2 class="text-dark mb-4" style="padding-left: 0px;width: 180px;margin: 0 auto;">Users Payment List</h2>
                            </div>
                            <div class="col" style="height:20px;text-align:left;padding-top:7px;">
                                <div class="dropdown no-arrow" style="padding-left: 0px;margin: 0 auto;width: 125px;">
                                    <span>Show Results</span>
                                    <select id="showNumberOfData" v-on:change="showUserPaymentResults()">
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
                                <nav style="max-width: 250px;">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevUserPaymentData()"><span aria-hidden="true">«Prev</span></a></li>
                                        <li class="disabled page-item"><a class="page-link">Page {{currentUserPaymentPage}} of {{totalUserPaymentListPages}}</a></li>
                                        <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextUserPaymentData()"><span aria-hidden="true">Next»</span></a></li>
                                    </ul>
                                    <ul class="pagination">
                                        <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" placeholder="0" v-model="getUserPaymentByPage" @keyup.enter="getUserPaymentByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getUserPaymentByPageData()">Go</button>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <p id="updateFailed"></p>
                    <div style="padding-left:12px;height:420px;max-width:1330px;margin:0 auto;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                        <table id="customers">
                            <tr>
                                <th>#</th>
                                <th>Table ID</th>
                                <th>User ID</th>
                                <th>Amount Paid</th>
                                <th>Transaction ID or Phone No.</th>
                                <th>Reference or Self ID</th>
                                <th>Application Used</th>
                                <th>Status(type approved if 100)</th>
                                <th>User Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Premium</th>
                                <th>User Type</th>
                                <th>Payment Date/Time</th>
                                <th>Update Date/Time</th>
                                <th>Action Clicked</th>
                                <th>Action Clicked</th>
                                <th>Action Clicked</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th><input type="text" id="text_id" style="color:black;" name="id" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_userid" style="color:black;" name="userid" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_amount_paid" style="color:black;" name="amount_paid" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_transactionid_or_phone" style="color:black;" name="transactionid_or_phone" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_reference_id" style="color:black;" name="reference_id" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_paid_by_app" style="color:black;" name="paid_by_app" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_status" style="color:black;" name="status" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_name" style="color:black;" name="name" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_gender" style="color:black;" name="gender" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_email" style="color:black;" name="email" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_phone" style="color:black;" name="phone" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th><input type="text" id="text_premium" style="color:black;" name="premium" v-on:keyup="searchUserPaymentBy($event)"></th>
                                <th></th>
                                <th><input type="date" id="text_created_at" style="color:black;" name="created_at" v-on:change="searchUserPaymentBy($event)"></th>
                                <th><input type="date" id="text_updated_at" style="color:black;" name="updated_at" v-on:change="searchUserPaymentBy($event)"></th>
                                <th><button style="color:black;" @click.prevent="clearAllInput()">Clear/Cancel</button></th>
                                <th><button style="color:black;" @click.prevent="getUsersPaymentListFromDatabase()">Refresh</button></th>
                                <th></th>
                            </tr>
                            <tr v-for="(usersPaymentList, index) in usersPaymentLists" v-bind:id="index+'selectedRow'" v-on:click="selectedARowToEdit(index)">
                                <td><input type="radio" name="userPayments" v-bind:id="index+'radioButton'" v-on:change="selectedARowToEdit(index)"></td>
                                <td>{{usersPaymentList.id}}</td>
                                <td>{{usersPaymentList.userid}}</td>
                                <td v-if="usersPaymentList.amount_paid >= 100" style="background-color:#80ff80;color:grey;"><input type="number" v-bind:id="'amount'+usersPaymentList.id" v-bind:value="usersPaymentList.amount_paid"></td>
                                <td v-else style="background-color:#ffff80;color:grey;"><input type="number" v-bind:id="'amount'+usersPaymentList.id" v-bind:value="usersPaymentList.amount_paid"></td>
                                <td>{{usersPaymentList.transactionid_or_phone}}</td>
                                <td>{{usersPaymentList.reference_id}}</td>
                                <td>{{usersPaymentList.paid_by_app}}</td>
                                <td v-if="usersPaymentList.status == 'pending'" style="background-color:#ffff80;color:grey;"><input type="text" v-bind:id="'status'+usersPaymentList.id" v-bind:value="usersPaymentList.status"></td>
                                <td v-if="usersPaymentList.status == 'approved'" style="background-color:#80ff80;color:grey;"><input type="text" v-bind:id="'status'+usersPaymentList.id" v-bind:value="usersPaymentList.status"></td>
                                <td>{{usersPaymentList.user_name}}</td>
                                <td>{{usersPaymentList.user_gender}}</td>
                                <td>{{usersPaymentList.user_email}}</td>
                                <td>{{usersPaymentList.user_phone}}</td>
                                <td>{{usersPaymentList.premium_or_not}}</td>
                                <td>{{usersPaymentList.user_type}}</td>
                                <td>{{usersPaymentList.created_at}}</td>
                                <td>{{usersPaymentList.updated_at}}</td>
                                <td><button v-bind:id="'upbtn'+usersPaymentList.id+'1'" name="1" style="color:grey;" @click.prevent="paymentUpdateCalled($event, usersPaymentList.id, usersPaymentList.userid)">Update</button></td>
                                <td><button v-bind:id="'upbtn'+usersPaymentList.id+'2'" name="2" style="color:grey;" @click.prevent="paymentUpdateCalled($event, usersPaymentList.id, usersPaymentList.userid)">Update</button></td>
                                <td><button v-bind:id="'upbtn'+usersPaymentList.id+'3'" name="3" style="color:grey;" @click.prevent="paymentUpdateCalled($event, usersPaymentList.id, usersPaymentList.userid)">Update</button></td>
                            </tr>
                        </table>
                    </div>
                    <p id="userPaymentListId"></p>
                    <div>
                        <div class="text-center">
                            <div style="display:inline-block;">
                                <nav style="max-width: 250px;">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevUserPaymentData()"><span aria-hidden="true">«Prev</span></a></li>
                                        <li class="disabled page-item"><a class="page-link">Page {{currentUserPaymentPage}} of {{totalUserPaymentListPages}}</a></li>
                                        <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextUserPaymentData()"><span aria-hidden="true">Next»</span></a></li>
                                    </ul>
                                    <ul class="pagination">
                                        <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" v-model="getUserPaymentByPage" @keyup.enter="getUserPaymentByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getUserPaymentByPageData()">Go</button>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="height:10px;"></div>
                </div>
                <div style="font-size:30px;text-align:center;">CIRCULAR LIST</div>
                <div style="height:8px;"></div>
                <div style="font-size:16px;" v-if="circularLists[0] && circularLists[0].circular_id != null">
                    <div v-for="(circularList, index) in circularLists">
                        <div class="row iWantToHideScroll" v-if="index % 3 == 0 || index == 0" style="overflow-x: auto;">
                            <div class="col" v-if="circularLists[index]" style="min-width:230px;">
                                <div class="card shadow-lg o-hidden border-0">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col">
                                                <div class="m-auto p-5" style="overflow-x:auto;">
                                                    <div style="text-align:left;">
                                                        <h4 class="text-dark mb-4">{{index+1}}</h4>
                                                    </div>
                                                    <div class="user iWantToHideScroll" style="overflow-x: auto;">
                                                        <input type="hidden" v-bind:value="circularLists[index].circular_id">
                                                        <input type="hidden" v-bind:value="circularLists[index].circular_job_type_id">
                                                        <p class="circle" style='float:right;' v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index].circular_company_id)" data-toggle="tooltip" data-placement="top" title="Number of People Applied for the Circular">{{circularLists[index].appliedUsersCount}}</p>
                                                        <h3 class="text-muted" v-if="circularLists[index].circular_deadline">DEADLINE: {{circularLists[index].circular_deadline | timewhen}}</h3>
                                                        
                                                        <table id="customers">
                                                            <tr v-if="circularLists[index].circular_job_name">
                                                                <td style="color:black;">Position:</td>
                                                                <td>{{circularLists[index].circular_job_name}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_company_name">
                                                                <td style="color:black;">Company Name:</td>
                                                                <td>{{circularLists[index].circular_company_name}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_salary">
                                                                <td style="color:black;">Salary:</td>
                                                                <td>{{circularLists[index].circular_salary}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_vacancy">
                                                                <td style="color:black;">Vacancy:</td>
                                                                <td>{{circularLists[index].circular_vacancy}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_employment_status">
                                                                <td style="color:black;">Status:</td>
                                                                <td>{{circularLists[index].circular_employment_status}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_job_location">
                                                                <td style="color:black;">Work Location:</td>
                                                                <td>{{circularLists[index].circular_job_location}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_education_req">
                                                                <td style="color:black;">Educational Req.:</td>
                                                                <td>{{circularLists[index].circular_education_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_experience_req">
                                                                <td style="color:black;">Experience Req.:</td>
                                                                <td>{{circularLists[index].circular_experience_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_job_responsibility">
                                                                <td style="color:black;">Job Responsibility:</td>
                                                                <td>{{circularLists[index].circular_job_responsibility}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_more_req">
                                                                <td style="color:black;">More Req.:</td>
                                                                <td>{{circularLists[index].circular_more_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_other_benefits">
                                                                <td style="color:black;">Other Benefits:</td>
                                                                <td>{{circularLists[index].circular_other_benefits}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index].circular_read_before_apply">
                                                                <td style="color:black;">Read Before Apply:</td>
                                                                <td>{{circularLists[index].circular_read_before_apply}}</td>
                                                            </tr>
                                                        </table>
                                                        <div style="height:10px;"></div>
                                                        <div v-if="userType == 'companyUser' && userId == userIdFromLink" style="text-align:center;">
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" v-bind:href="'/view-circular/'+circularLists[index].circular_id" target="_blank">View</a>
                                                            <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" v-bind:href="'/edit-circular/'+circularLists[index].circular_id" target="_blank">Edit</a>
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;font-size:16px;" v-bind:href="'/delete-circular/'+circularLists[index].circular_id" target="_blank">Delete</a>
                                                        </div>
                                                        <div v-else style="text-align:center;">
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" v-bind:href="'/view-circular/'+circularLists[index].circular_id" target="_blank">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col" v-if="circularLists[index+1]" style="min-width:230px;">
                                <div class="card shadow-lg o-hidden border-0">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col">
                                                <div class="m-auto p-5">
                                                    <div style="text-align:left;">
                                                        <h4 class="text-dark mb-4">{{index+2}}</h4>
                                                    </div>
                                                    <div class="user iWantToHideScroll" style="overflow-x: auto;">
                                                        <input type="hidden" v-bind:value="circularLists[index+1].circular_id">
                                                        <input type="hidden" v-bind:value="circularLists[index+1].circular_job_type_id">
                                                        <p class="circle" style='float:right;' v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+1].circular_company_id)" data-toggle="tooltip" data-placement="top" title="Number of People Applied for the Circular">{{circularLists[index+1].appliedUsersCount}}</p>
                                                        <h3 class="text-muted" v-if="circularLists[index+1].circular_deadline">DEADLINE: {{circularLists[index+1].circular_deadline | timewhen}}</h3>

                                                        <table id="customers">
                                                            <tr v-if="circularLists[index+1].circular_job_name">
                                                                <td style="color:black;">Position:</td>
                                                                <td>{{circularLists[index+1].circular_job_name}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_company_name">
                                                                <td style="color:black;">Company Name:</td>
                                                                <td>{{circularLists[index+1].circular_company_name}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_salary">
                                                                <td style="color:black;">Salary:</td>
                                                                <td>{{circularLists[index+1].circular_salary}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_vacancy">
                                                                <td style="color:black;">Vacancy:</td>
                                                                <td>{{circularLists[index+1].circular_vacancy}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_employment_status">
                                                                <td style="color:black;">Status:</td>
                                                                <td>{{circularLists[index+1].circular_employment_status}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_job_location">
                                                                <td style="color:black;">Work Location:</td>
                                                                <td>{{circularLists[index+1].circular_job_location}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_education_req">
                                                                <td style="color:black;">Educational Req.:</td>
                                                                <td>{{circularLists[index+1].circular_education_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_experience_req">
                                                                <td style="color:black;">Experience Req.:</td>
                                                                <td>{{circularLists[index+1].circular_experience_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_job_responsibility">
                                                                <td style="color:black;">Job Responsibility:</td>
                                                                <td>{{circularLists[index+1].circular_job_responsibility}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_more_req">
                                                                <td style="color:black;">More Req.:</td>
                                                                <td>{{circularLists[index+1].circular_more_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_other_benefits">
                                                                <td style="color:black;">Other Benefits:</td>
                                                                <td>{{circularLists[index+1].circular_other_benefits}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+1].circular_read_before_apply">
                                                                <td style="color:black;">Read Before Apply:</td>
                                                                <td>{{circularLists[index+1].circular_read_before_apply}}</td>
                                                            </tr>
                                                        </table>
                                                        <div style="height:10px;"></div>
                                                        <div v-if="userType == 'companyUser' && userId == userIdFromLink" style="text-align:center;">
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" v-bind:href="'/view-circular/'+circularLists[index+1].circular_id" target="_blank">View</a>
                                                            <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" v-bind:href="'/edit-circular/'+circularLists[index+1].circular_id" target="_blank">Edit</a>
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;font-size:16px;" v-bind:href="'/delete-circular/'+circularLists[index+1].circular_id" target="_blank">Delete</a>
                                                        </div>
                                                        <div v-else style="text-align:center;">
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" v-bind:href="'/view-circular/'+circularLists[index+1].circular_id" target="_blank">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col" v-else></div>

                            <div class="col" v-if="circularLists[index+2]" style="min-width:230px;">
                                <div class="card shadow-lg o-hidden border-0">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col">
                                                <div class="m-auto p-5">
                                                    <div style="text-align:left;">
                                                        <h4 class="text-dark mb-4">{{index+3}}</h4>
                                                        
                                                    </div>
                                                    <div class="user iWantToHideScroll" style="overflow-x: auto;">
                                                        <input type="hidden" v-bind:value="circularLists[index+2].circular_id">
                                                        <input type="hidden" v-bind:value="circularLists[index+2].circular_job_type_id">
                                                        <p class="circle" style='float:right;' v-if="userType == 'companyUser' && (userId == userIdS) && (userIdS == circularLists[index+2].circular_company_id)" data-toggle="tooltip" data-placement="top" title="Number of People Applied for the Circular">{{circularLists[index+2].appliedUsersCount}}</p>
                                                        <h3 class="text-muted" v-if="circularLists[index+2].circular_deadline">DEADLINE: {{circularLists[index+2].circular_deadline | timewhen}}</h3>
                                                        
                                                        <table id="customers">
                                                            <tr v-if="circularLists[index+2].circular_job_name">
                                                                <td style="color:black;">Position:</td>
                                                                <td>{{circularLists[index+2].circular_job_name}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_company_name">
                                                                <td style="color:black;">Company Name:</td>
                                                                <td>{{circularLists[index+2].circular_company_name}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_salary">
                                                                <td style="color:black;">Salary:</td>
                                                                <td>{{circularLists[index+2].circular_salary}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_vacancy">
                                                                <td style="color:black;">Vacancy:</td>
                                                                <td>{{circularLists[index+2].circular_vacancy}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_employment_status">
                                                                <td style="color:black;">Status:</td>
                                                                <td>{{circularLists[index+2].circular_employment_status}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_job_location">
                                                                <td style="color:black;">Work Location:</td>
                                                                <td>{{circularLists[index+2].circular_job_location}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_education_req">
                                                                <td style="color:black;">Educational Req.:</td>
                                                                <td>{{circularLists[index+2].circular_education_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_experience_req">
                                                                <td style="color:black;">Experience Req.:</td>
                                                                <td>{{circularLists[index+2].circular_experience_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_job_responsibility">
                                                                <td style="color:black;">Job Responsibility:</td>
                                                                <td>{{circularLists[index+2].circular_job_responsibility}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_more_req">
                                                                <td style="color:black;">More Req.:</td>
                                                                <td>{{circularLists[index+2].circular_more_req}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_other_benefits">
                                                                <td style="color:black;">Other Benefits:</td>
                                                                <td>{{circularLists[index+2].circular_other_benefits}}</td>
                                                            </tr>
                                                            <tr v-if="circularLists[index+2].circular_read_before_apply">
                                                                <td style="color:black;">Read Before Apply:</td>
                                                                <td>{{circularLists[index+2].circular_read_before_apply}}</td>
                                                            </tr>
                                                        </table>
                                                        <div style="height:10px;"></div>
                                                        <div v-if="userType == 'companyUser' && userId == userIdFromLink" style="text-align:center;">
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" v-bind:href="'/view-circular/'+circularLists[index+2].circular_id" target="_blank">View</a>
                                                            <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" v-bind:href="'/edit-circular/'+circularLists[index+2].circular_id" target="_blank">Edit</a>
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;font-size:16px;" v-bind:href="'/delete-circular/'+circularLists[index+2].circular_id" target="_blank">Delete</a>
                                                        </div>
                                                        <div v-else style="text-align:center;">
                                                            <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" v-bind:href="'/view-circular/'+circularLists[index+2].circular_id" target="_blank">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col" v-else></div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <label>No Circular Submitted</label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                userIdFromLink: this.$route.params.givencircid,
                searchField: '',
                userId: '',
                userIdS: '',
                userEmail: '',
                userPhone: '',
                userType: '',
                companyName: '',
                companyAddress: '',
                circularLists: [],
                usersPaymentLists: [],
                currentUserPaymentPage: 1,
                totalUserPaymentListPages: '',
                getUserPaymentByPage: '',
                getNumberOfData: 20,
                firstClickedButton: '',
                secondClickedButton: '',
                thirdClickedButton: '',
                appliedUserForCirculars: [],
                notificationNumber: '',
                usersNotificationNumber: '',
                userCheckedNotification: 'no',
                notificationForUsers: [],
                previouslySelected: '',
            }
        },

        mounted() {
            //this.loadThispage();
            $("#divWithData").hide();
            // document.getElementById("divWithData").style.display = "none";
            this.loadThispage();
            this.getUserData();
            
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Profile");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavProfile']").addClass('active');
            },

            selectedARowToEdit(selectedRowToEdit){
                if(this.previouslySelected % 2 == 0 || this.previouslySelected == 0){
                    $("#"+this.previouslySelected+"selectedRow").css('background-color', '#f8f9fc');
                    $("#"+this.previouslySelected+"selectedRow").css('color', 'grey');
                }
                else{
                    $("#"+this.previouslySelected+"selectedRow").css('background-color', '#f2f2f2');
                    $("#"+this.previouslySelected+"selectedRow").css('color', 'grey');
                }
                $("#"+selectedRowToEdit+"radioButton").prop("checked", true);
                $("#"+selectedRowToEdit+"selectedRow").css('background-color', 'red');
                $("#"+selectedRowToEdit+"selectedRow").css('color', 'white');
                this.previouslySelected = selectedRowToEdit;
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

            async usersThatAppliedForJob(){
                try{
                    await axios.get('/api/home/appliedforjob').then((response) => {
                        // console.log(response);
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

            searchData(){
                if(this.searchField != ""){
                    window.localStorage.setItem('searchBy', this.searchField);
                    this.$router.push('/search');
                }
                
            },

            searchUserPaymentBy(event){
                // $("#text_id").val();
                this.currentUserPaymentPage = 1;

                console.log("called");
                var searchByUserDetails = {
                    'getNumberOfData': this.getNumberOfData,
                    'currentPage': this.currentUserPaymentPage,
                    'userId': this.userIdS,
                    'userType': this.userType,

                    'id': $("#text_id").val(),
                    'userid': $("#text_userid").val(),
                    'amount_paid': $("#text_amount_paid").val(),
                    'transactionid_or_phone': $("#text_transactionid_or_phone").val(),
                    'reference_id': $("#text_reference_id").val(),
                    'paid_by_app': $("#text_paid_by_app").val(),
                    'status': $("#text_status").val(),
                    'name': $("#text_name").val(),
                    'gender': $("#text_gender").val(),
                    'email': $("#text_email").val(),
                    'phone': $("#text_phone").val(),
                    'premium': $("#text_premium").val(),
                    'created_at': $("#text_created_at").val(),
                    'updated_at': $("#text_updated_at").val()
                };
                try{
                    axios.post('/api/home/getuserpaymentsearch', searchByUserDetails).then((response) => {
                        console.log(response);
                        if(response.data[0].id){
                            $("#userPaymentListId").html("");
                            this.usersPaymentLists = response.data;
                            this.totalUserPaymentListPages = response.data[0].totalPages;
                        }
                        else if(response.data == "no data found"){
                            this.usersPaymentLists = [];
                            this.currentUserPaymentPage = 1;
                            this.totalUserPaymentListPages = 1;
                            $("#userPaymentListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            clearAllInput(){
                $("#text_id").val("");
                $("#text_userid").val("");
                $("#text_amount_paid").val("");
                $("#text_transactionid_or_phone").val("");
                $("#text_reference_id").val("");
                $("#text_paid_by_app").val("");
                $("#text_status").val("");
                $("#text_name").val("");
                $("#text_gender").val("");
                $("#text_email").val("");
                $("#text_phone").val("");
                $("#text_premium").val("");
                $("#text_created_at").val("");
                $("#text_updated_at").val("");
                this.getUsersPaymentListFromDatabase();
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
                    await axios.get('/api/home/companyuserinfo/' + this.userIdFromLink).then((response) => {
                        console.log(response);
                        //if(response.data[0].userIdS == "not signed/logged in user")
                        if(response.data == ""){
                            this.$router.push('*');
                        }
                        else if(response.data[0].userIdS != "not signed/logged in user" && response.data[0].userIdS != "normal user"){
                            // console.log(response);
                            this.userType = "companyUser";
                            this.userId = response.data[0].id;
                            this.userEmail = response.data[0].email;
                            this.userPhone = response.data[0].phone;
                            this.companyName = response.data[0].company_name;
                            this.companyAddress = response.data[0].company_address;
                            this.userIdS = response.data[0].userIdS;
                            this.circularLists = response.data;
                        }
                        else if(response.data[0].userIdS == "not signed/logged in user"){
                            this.userType = "notAuthorizedUser";
                            this.userEmail = response.data[0].email;
                            this.userPhone = response.data[0].phone;
                            this.companyName = response.data[0].company_name;
                            this.companyAddress = response.data[0].company_address;
                            this.circularLists = response.data;
                        }
                        else if(response.data[0].userIdS == "normal user"){
                            this.userType = "user";
                            this.userEmail = response.data[0].email;
                            this.userPhone = response.data[0].phone;
                            this.companyName = response.data[0].company_name;
                            this.companyAddress = response.data[0].company_address;
                            this.circularLists = response.data;
                            this.notificationsForUsers();
                        }
                        if(this.userType == "companyUser"){
                            if(this.userIdFromLink != response.data[0].userIdS && this.userType == "companyUser"){
                                this.circularLists = [];
                                this.usersPaymentLists = [];
                                this.$router.push('*');
                            }
                            else if(this.userIdFromLink == response.data[0].userIdS && this.userType == "companyUser"){
                                if(this.userIdS == 1){
                                    this.getUsersPaymentListFromDatabase();
                                }
                                this.usersThatAppliedForJob();
                            }
                        }
                        if(this.userIdFromLink == 1 && this.userType == "user"){
                            this.circularLists = [];
                            this.usersPaymentLists = [];
                            this.$router.push('*');
                        }
                        
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
                $("#hideForLongPages").hide();
            },

            async getUsersPaymentListFromDatabase(){
                var getDataFromTable = {
                    'getNumberOfData': this.getNumberOfData,
                    'getPageData': this.currentUserPaymentPage,
                    'userId': this.userId,
                    'userType': this.userType,

                    'id': $("#text_id").val(),
                    'userid': $("#text_userid").val(),
                    'amount_paid': $("#text_amount_paid").val(),
                    'transactionid_or_phone': $("#text_transactionid_or_phone").val(),
                    'reference_id': $("#text_reference_id").val(),
                    'paid_by_app': $("#text_paid_by_app").val(),
                    'status': $("#text_status").val(),
                    'name': $("#text_name").val(),
                    'gender': $("#text_gender").val(),
                    'email': $("#text_email").val(),
                    'phone': $("#text_phone").val(),
                    'premium': $("#text_premium").val(),
                    'created_at': $("#text_created_at").val(),
                    'updated_at': $("#text_updated_at").val()
                };

                try{
                    await axios.post('/api/home/getuserpaymentlist', getDataFromTable).then((response) => {
                        console.log(response);
                        if(response.data[0].id){
                            $("#userPaymentListId").html("");
                            this.usersPaymentLists = response.data;
                            this.totalUserPaymentListPages = response.data[0].totalPages;
                        }
                        else if(response.data == "no data found"){
                            this.usersPaymentLists = [];
                            this.currentUserPaymentPage = 1;
                            this.totalUserPaymentListPages = 1;
                            $("#userPaymentListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            prevUserPaymentData(){
                this.currentUserPaymentPage -= 1;
                if(this.currentUserPaymentPage < 1){
                    this.currentUserPaymentPage = 1;
                }
                else if(this.currentUserPaymentPage >= 1){
                    // search data;
                    this.getPaginationUserPaymentListData();
                }
                // console.log(this.currentUserPaymentPage);
            },

            nextUserPaymentData(){
                this.currentUserPaymentPage += 1;
                if(this.currentUserPaymentPage > this.totalUserPaymentListPages){
                    this.currentUserPaymentPage = this.totalUserPaymentListPages;
                }
                else if(this.currentUserPaymentPage <= this.totalUserPaymentListPages){
                    // search data;
                    this.getPaginationUserPaymentListData();
                }
                // console.log(this.currentUserPaymentPage);
            },

            getPaginationUserPaymentListData(){
                var getData = {
                    'getNumberOfData': this.getNumberOfData,
                    'currentPage': this.currentUserPaymentPage,
                    'userId': this.userIdS,
                    'userType': this.userType,

                    'id': $("#text_id").val(),
                    'userid': $("#text_userid").val(),
                    'amount_paid': $("#text_amount_paid").val(),
                    'transactionid_or_phone': $("#text_transactionid_or_phone").val(),
                    'reference_id': $("#text_reference_id").val(),
                    'paid_by_app': $("#text_paid_by_app").val(),
                    'status': $("#text_status").val(),
                    'name': $("#text_name").val(),
                    'gender': $("#text_gender").val(),
                    'email': $("#text_email").val(),
                    'phone': $("#text_phone").val(),
                    'premium': $("#text_premium").val(),
                    'created_at': $("#text_created_at").val(),
                    'updated_at': $("#text_updated_at").val()
                };
                try{
                    axios.post('/api/home/getpaginateduserpayment' , getData).then((response) => {
                        console.log(response);
                        if(response.data[0].id){
                            $("#userPaymentListId").html("");
                            this.usersPaymentLists = response.data;
                            this.totalUserPaymentListPages = response.data[0].totalPages;
                        }
                        else if(response.data == "no data found"){
                            this.usersPaymentLists = [];
                            this.currentUserPaymentPage = 1;
                            this.totalUserPaymentListPages = 1;
                            $("#userPaymentListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            showUserPaymentResults(){
                this.getNumberOfData = document.getElementById("showNumberOfData").value;
                this.currentUserPaymentPage = 1;
                this.getPaginationUserPaymentListData();
            },

            getUserPaymentByPageData(){
                var getData = {
                    'getNumberOfData': this.getNumberOfData,
                    'getPageData': this.getUserPaymentByPage,
                    'userId': this.userIdS,
                    'userType': this.userType,

                    'id': $("#text_id").val(),
                    'userid': $("#text_userid").val(),
                    'amount_paid': $("#text_amount_paid").val(),
                    'transactionid_or_phone': $("#text_transactionid_or_phone").val(),
                    'reference_id': $("#text_reference_id").val(),
                    'paid_by_app': $("#text_paid_by_app").val(),
                    'status': $("#text_status").val(),
                    'name': $("#text_name").val(),
                    'gender': $("#text_gender").val(),
                    'email': $("#text_email").val(),
                    'phone': $("#text_phone").val(),
                    'premium': $("#text_premium").val(),
                    'created_at': $("#text_created_at").val(),
                    'updated_at': $("#text_updated_at").val()
                };
                if(this.getUserPaymentByPage != '' && !(this.getUserPaymentByPage > this.totalUserPaymentListPages) && !(this.getUserPaymentByPage < 1)){
                    try{
                        axios.post('/api/home/getuserpaymentlist', getData).then((response) => {
                            // console.log(response);
                            if(response.data[0].id){
                                $("#userPaymentListId").html("");
                                this.usersPaymentLists = response.data;
                                this.currentUserPaymentPage = parseInt(this.getUserPaymentByPage);
                            }
                            else if(response.data == "no data found"){
                                this.usersPaymentLists = [];
                                this.currentUserPaymentPage = 1;
                                this.totalUserPaymentListPages = 1;
                                $("#userPaymentListId").append("<p style='color:#ff4d4d'>no data found!</p>");
                            }
                            
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            paymentUpdateCalled(event, goingToUpdateTableID, goingToUpdateUserID){
                
                if(event.target.name != 1){
                    var currentButtonClicked = "";
                    var prevButtonClicked = "";
                    if(this.firstClickedButton == ""){
                        this.firstClickedButton = "";
                        this.secondClickedButton = "";
                        this.thirdClickedButton = "";
                    }
                    else if(this.firstClickedButton != ""){
                        if(event.target.name != 2){
                            currentButtonClicked = "upbtn"+goingToUpdateTableID+""+event.target.name;
                            prevButtonClicked = "upbtn"+goingToUpdateTableID+""+(parseInt(event.target.name)-1);
                            if(prevButtonClicked == this.secondClickedButton){
                                this.thirdClickedButton = currentButtonClicked;
                                this.paymentValueUpdate(goingToUpdateTableID, goingToUpdateUserID);
                            }
                            else{
                                this.firstClickedButton = "";
                                this.secondClickedButton = "";
                                this.thirdClickedButton = "";
                            }
                        }
                        else{
                            currentButtonClicked = "upbtn"+goingToUpdateTableID+""+event.target.name;
                            prevButtonClicked = "upbtn"+goingToUpdateTableID+""+(parseInt(event.target.name)-1);
                            if(prevButtonClicked == this.firstClickedButton){
                                this.secondClickedButton = currentButtonClicked;
                            }
                            else{
                                this.firstClickedButton = "";
                                this.secondClickedButton = "";
                                this.thirdClickedButton = "";
                            }
                        }
                    }
                }
                else{
                    this.firstClickedButton = event.target.id;
                }
                
            },

            paymentValueUpdate(goingToUpdateTableID, goingToUpdateUserID){
                console.log($("#"+"amount"+goingToUpdateTableID+"").val());
                console.log($("#"+"status"+goingToUpdateTableID+"").val());
                var updateData = {
                    'tableId': goingToUpdateTableID,
                    'updateUserId': goingToUpdateUserID,
                    'amount': $("#"+"amount"+goingToUpdateTableID+"").val(),
                    'status': $("#"+"status"+goingToUpdateTableID+"").val(),
                    'userId': this.userIdS,
                    'userType': this.userType,
                };

                $("#updateFailed").html("");

                try{
                    axios.post('/api/home/updateuserpayment', updateData).then((response) => {
                        console.log(response);
                        if(response.data == "success"){
                            $("#updateFailed").append("<p style='color:green;'>Updated</p>");
                            this.getUsersPaymentListFromDatabase();
                            setTimeout(function(){
                                $("#updateFailed").hide();
                            }.bind(this),2000);
                        }
                        else if(response.data == "could not update"){
                            $("#updateFailed").append("<p style='color:#ff4d4d'>Could not update!</p>");
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            }

        }
    }
</script>
