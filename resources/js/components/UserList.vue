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
            </div>
            <div id="divWithData">
                <div v-if="userType == 'user'">
                    <div>
                        <div class="row">
                            <div class="col-xl-9" style="height:26px;">
                                <h2 class="text-dark mb-4" style="padding-left: 0px;width: 125px;margin: 0 auto;"></h2>
                            </div>
                            <div class="col" style="height:20px;text-align:left;padding-top:7px;">
                                <div class="dropdown no-arrow" style="padding-left: 0px;margin: 0 auto;width: 125px;">
                                    <span>Show Results</span>
                                    <select id="showNumberOfProfileData" v-on:change="showProfileResults()">
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
                                        <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevProfileData()"><span aria-hidden="true">«Prev</span></a></li>
                                        <li class="disabled page-item"><a class="page-link">Page {{currentProfilePage}} of {{totalProfileListPages}}</a></li>
                                        <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextProfileData()"><span aria-hidden="true">Next»</span></a></li>
                                        
                                    </ul>
                                    <ul class="pagination">
                                        <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" placeholder="0" v-model="getProfileByPage" @keyup.enter="getProfileByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getProfileByPageData()">Go</button>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="height:30px;text-align:right">
                        <h4 class="text-dark mb-4" style="padding-right:20px;">Results found: {{totalProfileResultsFound}}</h4>
                    </div>
                    <hr style="height:8px">
                    <div class="iWantToHideScroll" style="overflow-x: scroll;">
                    
                        <div>
                            <div class="row">
                                
                                <div class="col text-center">
                                    <div class="card-deck-wrapper">
                                        <h2 class="text-dark mb-4">Company List</h2>
                                        <div v-for="(userList, index) in userLists">
                                            <div class="card-deck" v-if="index % 3 == 0 || index == 0">
                                                <a class="card" style="min-width:200px;text-decoration:none;text-align:left;" v-bind:href="'/profile/'+userLists[index].id+'/0a5ci=159t04cn27-l3jsvm3rt83-y6'" v-if="userLists[index]" target="_blank">
                                                    
                                                    <div class="card-block">
                                                        <h3 style="color: black" class="card-title">{{userLists[index].company_name}}</h3>
                                                        <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{userLists[index].company_address}}</em></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Email: <span class="text-muted">{{userLists[index].email}}</span></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Phone: <span class="text-muted">{{userLists[index].phone}}</span></h4>
                                                        <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                        <br>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/profile/'+userLists[index].id+'/0a5ci=159t04cn27-l3jsvm3rt83-y6'" v-if="userLists[index]" target="_blank">View</a>
                                                        
                                                    </div>
                                                </a>
                                                <a class="card" style="min-width:200px;text-decoration:none;text-align:left;" v-bind:href="'/profile/'+userLists[index+1].id+'/0a5ci=159t04cn27-l3jsvm3rt83-y6'" v-if="userLists[index+1]" target="_blank">
                                                    
                                                    <div class="card-block">
                                                        <h3 style="color: black" class="card-title">{{userLists[index+1].company_name}}</h3>
                                                        <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{userLists[index+1].company_address}}</em></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Email: <span class="text-muted">{{userLists[index+1].email}}</span></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Phone: <span class="text-muted">{{userLists[index+1].phone}}</span></h4>
                                                        <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                        <br>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/profile/'+userLists[index+1].id+'/0a5ci=159t04cn27-l3jsvm3rt83-y6'" v-if="userLists[index+1]" target="_blank">View</a>
                                                        
                                                    </div>
                                                </a>
                                                <a v-else class="card" style="min-width:200px;text-decoration:none;text-align:left;opacity:0;"></a>
                                                <a class="card" style="min-width:200px;text-decoration:none;text-align:left;" v-bind:href="'/profile/'+userLists[index+2].id+'/0a5ci=159t04cn27-l3jsvm3rt83-y6'" v-if="userLists[index+2]" target="_blank">
                                                    
                                                    <div class="card-block">
                                                        <h3 style="color: black" class="card-title">{{userLists[index+2].company_name}}</h3>
                                                        <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{userLists[index+2].company_address}}</em></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Email: <span class="text-muted">{{userLists[index+2].email}}</span></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Phone: <span class="text-muted">{{userLists[index+2].phone}}</span></h4>
                                                        <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                        <br>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/profile/'+userLists[index+2].id+'/0a5ci=159t04cn27-l3jsvm3rt83-y6'" v-if="userLists[index+2]" target="_blank">View</a>
                                                        
                                                    </div>
                                                </a>
                                                <a v-else class="card" style="min-width:200px;text-decoration:none;text-align:left;opacity:0;"></a>
                                                
                                            </div>
                                        </div>
                                        <p id="companyListError"></p>
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
                                        <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevProfileData()"><span aria-hidden="true">«Prev</span></a></li>
                                        <li class="disabled page-item"><a class="page-link">Page {{currentProfilePage}} of {{totalProfileListPages}}</a></li>
                                        <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextProfileData()"><span aria-hidden="true">Next»</span></a></li>
                                        
                                        
                                    </ul>
                                    <ul class="pagination">
                                        <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" v-model="getProfileByPage" @keyup.enter="getProfileByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getProfileByPageData()">Go</button>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="height:10px"></div>
                </div>
                <div v-if="userType == 'companyUser'">
                    <div>
                        <div class="row">
                            <div class="col-xl-9" style="height:26px;">
                                <h2 class="text-dark mb-4" style="padding-left: 0px;width: 125px;margin: 0 auto;"></h2>
                            </div>
                            <div class="col" style="height:20px;text-align:left;padding-top:7px;">
                                <div class="dropdown no-arrow" style="padding-left: 0px;margin: 0 auto;width: 125px;">
                                    <span>Show Results</span>
                                    <select id="showNumberOfProfileData" v-on:change="showProfileResults()">
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
                                        <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevProfileData()"><span aria-hidden="true">«Prev</span></a></li>
                                        <li class="disabled page-item"><a class="page-link">Page {{currentProfilePage}} of {{totalProfileListPages}}</a></li>
                                        <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextProfileData()"><span aria-hidden="true">Next»</span></a></li>
                                        
                                    </ul>
                                    <ul class="pagination">
                                        <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" placeholder="0" v-model="getProfileByPage" @keyup.enter="getProfileByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getProfileByPageData()">Go</button>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="height:30px;text-align:right">
                        <h4 class="text-dark mb-4" style="padding-right:20px;">Results found: {{totalProfileResultsFound}}</h4>
                    </div>
                    <hr style="height:8px">
                    <div class="iWantToHideScroll" style="overflow-x: scroll;">
                    
                        <div>
                            <div style="width:250px;margin:0 auto;float: left;">
                                <h3 style="text-align:center;">Search Users By Job Skills</h3>
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
                                <p id="jobtypeError"></p>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <div class="card-deck-wrapper">
                                        <h2 class="text-dark mb-4">User List</h2>
                                        <div v-for="(userList, index) in userLists">
                                            <div class="card-deck" v-if="index % 3 == 0 || index == 0">
                                                <a class="card" style="min-width:200px;text-decoration:none;text-align:left;" v-bind:href="'/profile/'+userLists[index].id+'/0a3i-15k04cn27=l103rt83-25jkx4'" v-if="userLists[index]" target="_blank">
                                                    
                                                    <div class="card-block">
                                                        <h3 style="color: black" class="card-title">{{userLists[index].name}}</h3>
                                                        <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{userLists[index].gender}}</em></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Email: <span class="text-muted">{{userLists[index].email}}</span></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Phone: <span class="text-muted">{{userLists[index].phone}}</span></h4>
                                                        <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                        <br>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/profile/'+userLists[index].id+'/0a3i-15k04cn27=l103rt83-25jkx4'" v-if="userLists[index]" target="_blank">View</a>
                                                        
                                                    </div>
                                                </a>
                                                <a class="card" style="min-width:200px;text-decoration:none;text-align:left;" v-bind:href="'/profile/'+userLists[index+1].id+'/0a3i-15k04cn27=l103rt83-25jkx4'" v-if="userLists[index+1]" target="_blank">
                                                    
                                                    <div class="card-block">
                                                        <h3 style="color: black" class="card-title">{{userLists[index+1].name}}</h3>
                                                        <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{userLists[index+1].gender}}</em></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Email: <span class="text-muted">{{userLists[index+1].email}}</span></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Phone: <span class="text-muted">{{userLists[index+1].phone}}</span></h4>
                                                        <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                        <br>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/profile/'+userLists[index+1].id+'/0a3i-15k04cn27=l103rt83-25jkx4'" v-if="userLists[index+1]" target="_blank">View</a>
                                                        
                                                    </div>
                                                </a>
                                                <a v-else class="card" style="min-width:200px;text-decoration:none;text-align:left;opacity:0;"></a>
                                                <a class="card" style="min-width:200px;text-decoration:none;text-align:left;" v-bind:href="'/profile/'+userLists[index+2].id+'/0a3i-15k04cn27=l103rt83-25jkx4'" v-if="userLists[index+2]" target="_blank">
                                                    
                                                    <div class="card-block">
                                                        <h3 style="color: black" class="card-title">{{userLists[index+2].name}}</h3>
                                                        <h4 class="card-text text-muted" style="color: black;margin:0 auto;"><em>{{userLists[index+2].gender}}</em></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Email: <span class="text-muted">{{userLists[index+2].email}}</span></h4>
                                                        <h4 class="card-text" style="color: black;margin:0 auto;">Phone: <span class="text-muted">{{userLists[index+2].phone}}</span></h4>
                                                        <p class="card-text" style="height:0px;opacity:0;margin:0 auto;">This is a longer card with supporting text below as. This content is a little bit longer.</p>
                                                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                                        <br>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;" v-bind:href="'/profile/'+userLists[index+2].id+'/0a3i-15k04cn27=l103rt83-25jkx4'" v-if="userLists[index+2]" target="_blank">View</a>
                                                        
                                                    </div>
                                                </a>
                                                <a v-else class="card" style="min-width:200px;text-decoration:none;text-align:left;opacity:0;"></a>
                                            </div>
                                        </div>
                                        <p id="userListError"></p>
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
                                        <li class="page-item"><a class="page-link" href="" aria-label="Previous" @click.prevent="prevProfileData()"><span aria-hidden="true">«Prev</span></a></li>
                                        <li class="disabled page-item"><a class="page-link">Page {{currentProfilePage}} of {{totalProfileListPages}}</a></li>
                                        <li class="page-item"><a class="page-link" href="" aria-label="Next" @click.prevent="nextProfileData()"><span aria-hidden="true">Next»</span></a></li>
                                        
                                        
                                    </ul>
                                    <ul class="pagination">
                                        <span style="padding-top:3px">Go to page </span><div style="width:5px"></div> <input type="number" style="width:84px" v-model="getProfileByPage" @keyup.enter="getProfileByPageData()"> <div style="width:1px"></div> <button style="width:35px" @click.prevent="getProfileByPageData()">Go</button>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div style="height:10px"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                searchField: '',
                userLists: [],
                jobtypes:[],
                userId: '',
                userIdS: '',
                userType: '',
                searchProfileByJobType: 'all',
                currentProfilePage: 1,
                totalProfileListPages: '',
                getProfileByPage: '',
                getNumberOfProfileData: 20,
                selectedJobTypeIdForSearch: '',
                appliedUserForCirculars: [],
                notificationNumber: '',
                notificationForUsers: [],
                usersNotificationNumber: '',
                userCheckedNotification: 'no',
                totalProfileResultsFound: 0,

            }
        },

        mounted() {
            $("#divWithData").hide();
            this.getUserData();
        },

        methods: {

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

            selectedAll(){
                this.currentProfilePage = 1;
                this.selectedJobTypeIdForSearch = '';
                this.getPaginationProfileListData();
            },

            showProfileResults(){
                this.getNumberOfProfileData = document.getElementById("showNumberOfProfileData").value;
                this.currentProfilePage = 1;
                this.getPaginationProfileListData();
            },

            prevProfileData(){
                this.currentProfilePage -= 1;
                if(this.currentProfilePage < 1){
                    this.currentProfilePage = 1;
                }
                else if(this.currentProfilePage >= 1){
                    // search data;
                    this.getPaginationProfileListData();
                }
                // console.log(this.currentProfilePage);
            },

            nextProfileData(){
                this.currentProfilePage += 1;
                if(this.currentProfilePage > this.totalProfileListPages){
                    this.currentProfilePage = this.totalProfileListPages;
                }
                else if(this.currentProfilePage <= this.totalProfileListPages){
                    // search data;
                    this.getPaginationProfileListData();
                }
                // console.log(this.currentProfilePage);
            },

            getProfileByPageData(){
                var getData = {
                    'getDataType': 'pagination',
                    'fromTable': 'userAndCompany',
                    'getNumberOfData': this.getNumberOfProfileData,
                    'selectedJobTypeIdForSearch': this.selectedJobTypeIdForSearch,
                    'userType': this.userType
                };
                if(this.getProfileByPage != '' && !(this.getProfileByPage > this.totalProfileListPages) && !(this.getProfileByPage < 1)){
                    try{
                        axios.put('/api/home/pagination/'+ this.getProfileByPage, getData).then((response) => {
                            // console.log(response);
                            if(response.data[0].id){
                                this.userLists = response.data;
                                this.currentProfilePage = parseInt(this.getProfileByPage);
                                this.totalProfileResultsFound = response.data[0].totalProfilesFound;
                                $("#companyListError").html("");
                                $("#userListError").html("");
                            }
                            else if(response.data == "no data found"){
                                this.userLists = [];
                                this.currentProfilePage = 1;
                                this.totalProfileListPages = 1;
                                this.totalProfileResultsFound = 0;
                                $("#companyListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                                $("#userListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                            }
                            
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            getPaginationProfileListData(){
                var getData = {
                    'getDataType': 'pagination',
                    'fromTable': 'userAndCompany',
                    'getNumberOfData': this.getNumberOfProfileData,
                    'selectedJobTypeIdForSearch': this.selectedJobTypeIdForSearch,
                    'userType': this.userType
                };
                try{
                    axios.put('/api/home/pagination/'+ this.currentProfilePage, getData).then((response) => {
                        // console.log(response);
                        if(response.data[0].id){
                            // console.log(response);
                            this.userLists = response.data;
                            this.totalProfileListPages = response.data[0].totalProfilePages;
                            this.totalProfileResultsFound = response.data[0].totalProfilesFound;
                            $("#companyListError").html("");
                            $("#userListError").html("");
                            // document.getElementById("companyListError").innerHTML = "";
                            // document.getElementById("userListError").innerHTML = "";
                        }
                        else if(response.data == "no data found"){
                            this.userLists = [];
                            this.currentProfilePage = 1;
                            this.totalProfileListPages = 1;
                            this.totalProfileResultsFound = 0;
                            $("#companyListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                            $("#userListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                            // document.getElementById("companyListError").innerHTML = "No data found!";
                            // document.getElementById("userListError").innerHTML = "No data found!";
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            // showSearchJobtypeData(jobtypeId, event){
            //     this.searchProfileByJobType = jobtypeId;
            //     this.getUserAndCompanyProfileList();
            // },

            showSearchJobtypeData(jobtypeId, event){
                // console.log(jobtypeId);
                // console.log(event.target.name);
                
                this.selectedJobTypeIdForSearch = jobtypeId;
                this.currentProfilePage = 1;
                var getData = {
                    'getDataType': 'pagination',
                    'fromTable': 'userAndCompany',
                    'getNumberOfData': this.getNumberOfProfileData,
                    'selectedJobTypeIdForSearch': this.selectedJobTypeIdForSearch,
                    'userType': this.userType
                };
                try{
                    axios.put('/api/home/pagination/' + this.currentProfilePage, getData).then((response) => {
                        console.log(response);
                        if(response.data[0].id){
                            this.userLists = response.data;
                            this.totalProfileListPages = response.data[0].totalProfilePages;
                            this.totalProfileResultsFound = response.data[0].totalProfilesFound;
                            $("#companyListError").html("");
                            $("#userListError").html("");
                            // document.getElementById("companyListError").innerHTML = "";
                            // document.getElementById("userListError").innerHTML = "";
                        }
                        else if(response.data == "no data found"){
                            this.userLists = [];
                            this.currentProfilePage = 1;
                            this.totalProfileListPages = 1;
                            this.totalProfileResultsFound = 0;
                            $("#companyListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                            $("#userListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                            // document.getElementById("companyListError").innerHTML = "No data found!";
                            // document.getElementById("userListError").innerHTML = "No data found!";
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getJobtypesData() {
                try{
                    await axios.get('/api/home/jobtype').then((response) => {
                        if(response.data[0].id){
                            this.jobtypes = response.data;
                            $("#jobtypeError").html("");
                            // document.getElementById("jobtypeError").innerHTML = "";
                        }
                        else if(response.data == "data not found"){
                            this.jobtypes = [];
                            $("#jobtypeError").append("<p style='color:#ff4d4d'>Data not found!</p>");
                            // document.getElementById("jobtypeError").innerHTML = "Data not found!";
                        }
                        
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getUserData(){
                try{
                    $("#theTitle").html("Profile List");
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

                this.getUserAndCompanyProfileList();
                this.getJobtypesData();
                if(this.userType == "companyUser"){
                    this.usersThatAppliedForJob();
                    $('.container-fluid .nav-item .btn.active').removeClass('active');
                    $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                    var activeNow = $("[name='navUserList'] .btn");
                    activeNow.addClass('active');
                    $("[name='sideNavHomeUserList']").addClass('active');
                    
                }
                else if(this.userType == "user"){
                    this.notificationsForUsers();
                    $('.container-fluid .nav-item .btn.active').removeClass('active');
                    $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                    var activeNow = $("[name='navCompanyList'] .btn");
                    activeNow.addClass('active');
                    $("[name='sideNavHomeCompanyList']").addClass('active');
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

            async getUserAndCompanyProfileList(showNumberOfUsers){
                if(showNumberOfUsers == null || showNumberOfUsers == ""){
                    showNumberOfUsers = 20;
                }
                var goingToGetProfile = {
                    'userType': this.userType,
                    'getDataType': 'showUserAndCompanyProfile',
                    'searchByJobTypeId': this.searchProfileByJobType
                };
                try{
                    await axios.put('/api/home/userandcompanyprofile/'+ showNumberOfUsers, goingToGetProfile).then((response) => {
                        // console.log(response);
                        if(response.data[0].id){
                            this.userLists = response.data;
                            this.totalProfileListPages = response.data[0].totalProfilePages;
                            this.totalProfileResultsFound = response.data[0].totalProfilesFound;
                            $("#showDataTemplate").hide();
                            $("#divWithData").show();
                            $("#companyListError").html("");
                            $("#userListError").html("");
                        }
                        else if(response.data == "no data found"){
                            this.userLists = [];
                            this.currentProfilePage = 1;
                            this.totalProfileListPages = 1;
                            this.totalProfileResultsFound = 0;
                            $("#showDataTemplate").hide();
                            $("#divWithData").show();
                            $("#companyListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                            $("#userListError").append("<p style='color:#ff4d4d'>No data found!</p>");
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
                $("#hideForLongPages").hide();
            }

        }
    }
</script>
