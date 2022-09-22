<template>
    <div>

        <div id="showDataTemplate">
            <div style="text-align:center;margin:0 auto;">
                <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
            </div>
            <div style="height:600px;">
            </div>
        </div>
        <div id="divWithData">
            <div class="container-fluid">
                <p id="circularDataNotFound"></p>
                <div v-if="viewCircularData.id == circularIdFromRoute" class="card shadow-lg o-hidden border-0">
                    <div class="card-body p-0">
                        <div class="row iWantToHideScroll" style="overflow-x:auto;">
                            <div class="col" style="min-width:240px;">
                                <div class="m-auto p-5" style="font-size:16px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="font-size:25px;">Circular</h4>
                                    </div>
                                    <div class="user iWantToHideScroll" style="overflow-x:auto;">
                                        <div style="width:100%;max-width:1000px;margin-left:auto;margin-right:auto;">
                                            <input type="hidden" v-bind:value="viewCircularData.id">
                                            <input type="hidden" v-bind:value="viewCircularData.job_type_id">
                                            <h3 class="text-muted" style="text-align:right;font-weight:bold;">DEADLINE: {{viewCircularData.deadline | timewhen}}</h3>
                                            <table id="customers">
                                                <tr>
                                                    <th>Requirement</th>
                                                    <th>Details</th>
                                                </tr>
                                                <tr v-if="viewCircularData.job_name">
                                                    <td>Position:</td>
                                                    <td>{{viewCircularData.job_name}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.company_name">
                                                    <td>Company Name:</td>
                                                    <td>{{viewCircularData.company_name}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.salary">
                                                    <td>Salary:</td>
                                                    <td>{{viewCircularData.salary}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.vacancy">
                                                    <td>Vacancy:</td>
                                                    <td>{{viewCircularData.vacancy}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.employment_status">
                                                    <td>Status:</td>
                                                    <td>{{viewCircularData.employment_status}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.job_location">
                                                    <td>Work Location:</td>
                                                    <td>{{viewCircularData.job_location}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.education_req">
                                                    <td>Educational Req.:</td>
                                                    <td>{{viewCircularData.education_req}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Job Type:</td>
                                                    <td>{{jobtypeName}}<p id="jobtypeNameNotFound"></p></td>
                                                </tr>
                                                <tr v-if="viewCircularData.experience_req">
                                                    <td>Experience Req.:</td>
                                                    <td>{{viewCircularData.experience_req}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.job_responsibility">
                                                    <td>Job Responsibility:</td>
                                                    <td>{{viewCircularData.job_responsibility}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.more_req">
                                                    <td>More Req.:</td>
                                                    <td>{{viewCircularData.more_req}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.other_benefits">
                                                    <td>Other Benefits:</td>
                                                    <td>{{viewCircularData.other_benefits}}</td>
                                                </tr>
                                                <tr v-if="viewCircularData.read_before_apply">
                                                    <td>Read Before Apply:</td>
                                                    <td>{{viewCircularData.read_before_apply}}</td>
                                                </tr>
                                            </table>
                                            <div style="height:20px;"></div>
                                            <div v-if="userType == 'user'" style="text-align:center;">
                                                <div v-if="userAppliedForTheCircular == 'no'">
                                                    <p id="applyForTheCircular"></p>
                                                    <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" v-bind:name="viewCircularData.id" v-bind:id="viewCircularData.company_id" @click.prevent="applyForTheJob($event)">Apply</a>
                                                </div>
                                                <div v-if="userAppliedForTheCircular == 'yes'">
                                                    <a style="font-size:30px;" disabled>Applied</a>
                                                </div>
                                            </div>
                                            <div v-if="userType == 'companyUser'">
                                                <div v-if="showUsersAppliedList == 'yes'">
                                                    <div v-if="showUsersAppliedListInfo == 'no'" style="text-align:center;">
                                                        <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" v-bind:href="'/edit-circular/'+viewCircularData.id" target="_blank">Edit</a>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;font-size:16px;" v-bind:href="'/delete-circular/'+viewCircularData.id" target="_blank">Delete</a>
                                                        <div style="height:10px;"></div>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" @click.prevent="showUsersAppliedListData()">Show Applied List</a>
                                                        <!-- <a @click.prevent="showUsersAppliedListData()" href="">Show applied list</a> -->
                                                    </div>
                                                    <div v-if="showUsersAppliedListInfo == 'yes'" style="text-align:center;">
                                                        <div style="height:43px;"></div>
                                                        <a class="btn btn-primary" type="button" style="background-color:rgb(64,132,63);color:white;font-size:16px;" @click.prevent="hideUsersAppliedListData()">Hide Applied List</a>
                                                        <!-- <a @click.prevent="hideUsersAppliedListData()" href="">Hide applied list</a> -->
                                                        <div style="height:30px;"></div>
                                                        <table id="customers" style="text-align:left;">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>User ID</th>
                                                                <th>User Name</th>
                                                            </tr>
                                                            <tr v-for="(viewCircularAppliedListData, index) in viewCircularAppliedListDatas" v-bind:key="viewCircularAppliedListData.id">
                                                                <th>{{index+1}}</th>
                                                                <td>{{viewCircularAppliedListData.applied_user_id}}</td>
                                                                <td><a v-bind:href="'/profile/'+viewCircularAppliedListData.applied_user_id+'/0a3i-15k04cn27=l103rt83-25jkx4'" target="_blank">{{viewCircularAppliedListData.name}}</a></td>
                                                            </tr>
                                                        </table>
                                                        <p id="userAppliedList"></p>
                                                    </div>
                                                </div>
                                                <div v-if="showUsersAppliedList == 'no'"> 
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
</template>

<script>
    export default {

        data(){
            return{
                showUsersAppliedListInfo: 'no',
                showUsersAppliedList: 'no',
                userAppliedForTheCircular: 'no',
                userId: '',
                userType: '',
                circularIdFromRoute: this.$route.params.givencircid,
                viewCircularData: {},
                jobtypeName: '',
                viewCircularAppliedListDatas: [],
            }
        },

        mounted() {
            $("#divWithData").hide();
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Circular");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
            },

            showUsersAppliedListData(){
                this.showUsersAppliedListInfo = "yes";
            },

            hideUsersAppliedListData(){
                this.showUsersAppliedListInfo = "no";
            },

            async getCircularAppliedOrSubmitByThisUserData(){
                var goingToFindThisUser = {
                    'userId': this.userId,
                    'userType': this.userType
                };
                try{
                    await axios.put('/api/home/appliedforjob/' + this.circularIdFromRoute, goingToFindThisUser).then((response) => {
                        console.log(response);
                        if(response.data == "applied"){
                            this.userAppliedForTheCircular = "yes";
                        }
                        else if(response.data == "not applied"){
                            this.userAppliedForTheCircular = "no";
                        }
                        else if(response.data[0].id){
                            console.log(response);
                            this.showUsersAppliedList = "yes";
                            this.viewCircularAppliedListDatas = response.data;
                            $("#userAppliedList").html("");
                            // document.getElementById("userAppliedList").innerHTML = "";
                        }
                        else if(response.data == "this user did not upload the circular"){
                            this.showUsersAppliedList = "no";
                        }
                        else if(response.data == "nobody applied yet"){
                            this.showUsersAppliedList = "yes";
                            $("#userAppliedList").append("<p style='color:#ff4d4d'>Nobody applied yet</p>");
                            // document.getElementById("userAppliedList").innerHTML = "Nobody applied yet";
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            applyForTheJob(event){
                // console.log(event.target.id);
                var goingToApply = {
                    'userId': this.userId,
                    'circularId': event.target.name,
                    'companyId': event.target.id
                };
                console.log(event.target.name);
                if(this.userType == "user"){
                    try{
                        axios.post('/api/home/appliedforjob', goingToApply).then((response) => {
                            //console.log(response);
                            if(response.data == "success"){
                                // console.log("this user not applied");
                                this.userAppliedForTheCircular = "yes";
                                $("#applyForTheCircular").html("");
                                // document.getElementById("applyForTheCircular").innerHTML="";
                            }
                            else if(response.data == "failed"){
                                // console.log("failed to apply");
                                $("#applyForTheCircular").append("<p style='color:#ff4d4d'>Failed to apply!</p>");
                                // document.getElementById("applyForTheCircular").innerHTML="Failed to apply!";
                            }
                            
                            
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            async getUserData(){
                try{
                    await axios.get('/api/home/userinfo').then((response) => {
                        //console.log(response);
                        if(response.data == "not authorized user"){
                            this.userType = "notAuthorizedUser";
                            this.userId = "";
                        }
                        else if(response.data[0]){
                            this.userId = response.data[0].id;
                            if(response.data[0].user_type == "user"){
                                this.userType = "user";
                            }
                            else if(response.data[0].user_type == "companyUser"){
                                this.userType = "companyUser";
                            }
                            this.getCircularAppliedOrSubmitByThisUserData();
                            
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                this.getCircularData();
            },

            gotoHome() {
                //this.$router.push('/');
                this.$router.back();
            },

            async getCircularData() {
                $("#circularDataNotFound").html("");
                $("#jobtypeNameNotFound").html("");
                try{
                    await axios.get('/api/home/circular/' + this.circularIdFromRoute ).then((response) => {
                        // this.viewCircularData = response.data[0];
                        console.log(response);
                        if(response.data[0].id){
                            this.viewCircularData = response.data[0];
                            axios.get('/api/home/jobtype/' + response.data[0].job_type_id ).then((responseJobtype) => {
                                if(responseJobtype.data[0].id){
                                    this.jobtypeName = responseJobtype.data[0].jobtype_name;
                                }
                                else if(responseJobtype.data == "no data found"){
                                    this.jobtypeName = "";
                                    $("#jobtypeNameNotFound").append("<p style='color:#ff4d4d'>Error occurred</p>");
                                }
                                
                            });
                        }
                        else if(response.data == "data not found"){
                            this.viewCircularData = {};
                            // $("#showDataTemplate").hide();
                            // $("#divWithData").show();
                            $("#circularDataNotFound").append("<p style='color:#ff4d4d'>Data not found!</p>");
                        }
                        // else{
                        //     $("#showDataTemplate").hide();
                        //     $("#divWithData").show();
                        // }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
                $("#hideForLongPages").hide();
            },
        }
    }
</script>
