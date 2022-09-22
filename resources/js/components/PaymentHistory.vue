<template>
    <div>

        <nav class="navbar navbar-light navbar-expand mb-4 topbar static-top">
            <div class="container-fluid">
                <div class="col-10 text-center">
                    <input class="bg-light border-0" type="text" placeholder="Search for ..." style="padding-left:4px;height:37px;width:135px;font-size:14px;" name="searchBox" v-model="searchField" @keyup.enter="searchData()"><button class="btn btn-primary py-0"
                        type="button" style="height: 37px;width: 36px;background-color:rgb(214, 214, 194);font-size:16px;" @click.prevent="searchData()"><i class="fas fa-search"></i></button>
                
                </div>
                <div class="col">
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
                <div class="row">
                    <div class="col text-center">
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-block" style="text-align:center;max-width:900px;margin:0 auto;">
                                        <h2 class="card-title" style="font-size:20px;"><u>Payment History</u></h2>
                                        <div class="card-text" style="font-size:12px;">
                                            It may take time to update Payment History, Please wait at least 24 hours.
                                        </div>
                                        <div style="height:20px;"></div>
                                        <div class="card-text iWantToHideScroll" style="text-align:left;overflow:auto;font-size:14px;">
                                            <table id="customers" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">User ID</th>
                                                        <th scope="col">Transaction or Phone</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Application</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="notFoundData" v-for="(userPaidHistoryList, index) in userPaidHistoryLists">
                                                        <th scope="row">{{index+1}}</th>
                                                        <td>{{userPaidHistoryList.userid}}</td>
                                                        <td>{{userPaidHistoryList.transactionid_or_phone}}</td>
                                                        <td>{{userPaidHistoryList.amount_paid}}</td>
                                                        <td>{{userPaidHistoryList.paid_by_app}}</td>
                                                        <td v-if="userPaidHistoryList.status == 'pending'" style="background-color:#ffff80;">{{userPaidHistoryList.status}}</td>
                                                        <td v-if="userPaidHistoryList.status == 'approved'" style="background-color:#80ff80;">{{userPaidHistoryList.status}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p id="tableDataError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:500px;"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                searchField: '',
                submitClicked: false,
                userType: '',
                userId: '',
                userIdS: '',
                notificationForUsers: [],
                usersNotificationNumber: '',
                userCheckedNotification: 'no',
                userPaidHistoryLists: [],
            }
        },

        mounted() {
            $("#divWithData").hide();
            // document.getElementById("divWithData").style.display = "none";
            this.loadThispage();
            this.getUserData();
        },

        methods:{

            loadThispage(){
                $("#theTitle").html("Payment History");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavPaymentHistory']").addClass('active');
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
                        if(this.userType != "user"){
                            this.$router.push('*');
                        }
                        
                        
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                this.getPaymentHistory();
                this.notificationsForUsers();
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

            async getPaymentHistory(){

                $("#tableDataError").html("");
                // document.getElementById("tableDataError").innerHTML = "";

                try{
                    await axios.get('/api/home/userpayhistory').then((response) => {
                        
                        console.log(response);
                        if(response.data[0].id){
                            this.userPaidHistoryLists = response.data;
                        }
                        else if(response.data == "this user did not pay"){
                            $("#notFoundData").remove();
                            $("#tableDataError").append("<p style='color:#ff4d4d'>This user did not pay</p>");
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
            }

        }
    }
</script>
