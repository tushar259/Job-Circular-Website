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
                <div class="card shadow-lg o-hidden border-0">
                    <div class="card-body p-0">
                        <div class="row iWantToHideScroll" style="overflow-x:auto;">
                            <div class="col" style="min-width:240px;">
                                <div class="m-auto p-5" style="font-size:16px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="font-size:25px;">Delete Circular</h4>
                                    </div>
                                    <div class="user iWantToHideScroll" style="overflow-x:auto;">
                                        <div style="width:100%;max-width:1000px;margin-left:auto;margin-right:auto;">
                                            <p id="circularDataNotFound"></p>
                                            <div v-if="goingToDeleteCircular.id">
                                                <input type="hidden" v-bind:value="goingToDeleteCircular.id">
                                                <input type="hidden" v-bind:value="goingToDeleteCircular.job_type_id">
                                                <h3 class="text-muted" style="text-align:right;font-weight:bold;">DEADLINE: {{goingToDeleteCircular.deadline | timewhen}}</h3>
                                                <table id="customers">
                                                    <tr>
                                                        <th>Requirement</th>
                                                        <th>Details</th>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.job_name">
                                                        <td>Position:</td>
                                                        <td>{{goingToDeleteCircular.job_name}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.company_name">
                                                        <td>Company Name:</td>
                                                        <td>{{goingToDeleteCircular.company_name}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.salary">
                                                        <td>Salary:</td>
                                                        <td>{{goingToDeleteCircular.salary}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.vacancy">
                                                        <td>Vacancy:</td>
                                                        <td>{{goingToDeleteCircular.vacancy}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.employment_status">
                                                        <td>Status:</td>
                                                        <td>{{goingToDeleteCircular.employment_status}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.job_location">
                                                        <td>Work Location:</td>
                                                        <td>{{goingToDeleteCircular.job_location}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.education_req">
                                                        <td>Educational Req.:</td>
                                                        <td>{{goingToDeleteCircular.education_req}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Job Type:</td>
                                                        <td>{{jobtypeName}}<p id="jobtypeNameNotFound"></p></td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.experience_req">
                                                        <td>Experience Req.:</td>
                                                        <td>{{goingToDeleteCircular.experience_req}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.job_responsibility">
                                                        <td>Job Responsibility:</td>
                                                        <td>{{goingToDeleteCircular.job_responsibility}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.more_req">
                                                        <td>More Req.:</td>
                                                        <td>{{goingToDeleteCircular.more_req}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.other_benefits">
                                                        <td>Other Benefits:</td>
                                                        <td>{{goingToDeleteCircular.other_benefits}}</td>
                                                    </tr>
                                                    <tr v-if="goingToDeleteCircular.read_before_apply">
                                                        <td>Read Before Apply:</td>
                                                        <td>{{goingToDeleteCircular.read_before_apply}}</td>
                                                    </tr>
                                                </table>
                                                <div style="height:10px;"></div>
                                                <p id="couldnotDelete"></p>
                                                <div style="height:10px;"></div>
                                                <div style="text-align:center;" v-if="goingToDeleteCircular.company_id == userId && goingToDeleteCircular.company_id == userIdS && userType == 'companyUser'">
                                                    Are you sure you want to delete Circular?
                                                    <div style="height:10px;"></div>
                                                    <a class="btn btn-primary" type="button" style="background-color:rgb(227,64,28);color:white;font-size:16px;" @click.prevent="deleteCircular(goingToDeleteCircular.id)">Yes, Delete</a>
                                                    <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" @click.prevent="gotoHome">Cancel</a>
                                                    
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
                circularIdFromRoute: this.$route.params.givencircid,
                goingToDeleteCircular: {},
                jobtypeName: '',
                userType: '',
                userId: '',
                userIdS: '',
                
            }
        },

        mounted() {
            $("#divWithData").hide();
            // document.getElementById("divWithData").style.display = "none";
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Delete Circular");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
            },

            async getUserData(){
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
                        if(this.userType != "companyUser"){
                            this.$router.push('*');
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
                        if(response.data[0].id){
                            $("#circularDataNotFound").html("");
                            // document.getElementById("circularDataNotFound").innerHTML="";
                            this.goingToDeleteCircular = response.data[0];
                            // console.log(this.goingToDeleteCircular);
                            if(!(response.data[0].company_id == this.userId && response.data[0].company_id == this.userIdS && this.userType == "companyUser")){
                                this.goingToDeleteCircular = {};
                                $("#circularDataNotFound").append("<p style='color:#ff4d4d'>Data not found!</p>");
                                // document.getElementById("circularDataNotFound").innerHTML="Data not found!";
                            }
                            else{
                                axios.get('/api/home/jobtype/' + response.data[0].job_type_id ).then((responseJobtype) => {
                                    if(responseJobtype.data[0].id){
                                        $("#jobtypeNameNotFound").html("");
                                        // document.getElementById("jobtypeNameNotFound").innerHTML="";
                                        this.jobtypeName = responseJobtype.data[0].jobtype_name;
                                    }
                                    else if(responseJobtype.data == "no data found"){
                                        this.jobtypeName = "";
                                        $("#jobtypeNameNotFound").append("<p style='color:#ff4d4d'>Error occurred</p>");
                                        // document.getElementById("jobtypeNameNotFound").innerHTML="Error occurred";
                                    }
                                    
                                    // document.getElementById("showDataTemplate").style.display = "none";
                                    // document.getElementById("divWithData").style.display = "block";
                                });
                            }
                        }
                        else if(response.data == "data not found"){
                            this.viewCircularData = {};
                            // $("#showDataTemplate").hide();
                            // $("#divWithData").show();
                            // document.getElementById("showDataTemplate").style.display = "none";
                            // document.getElementById("divWithData").style.display = "block";
                            $("#circularDataNotFound").append("<p style='color:#ff4d4d'>Data not found!</p>");
                            // document.getElementById("circularDataNotFound").innerHTML="Data not found!";
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

            deleteCircular(circId) {
                try{
                    axios.delete('/api/home/circular/' + circId ).then((response) => {
                        //this.goingToDeleteCircular = response.data[0];
                        if(response.data == "success"){
                            $("#couldnotDelete").html("");
                            // document.getElementById("couldnotDelete").innerHTML="";
                            this.gotoHome();
                        }
                        else if(response.data == "could not delete"){
                            $("#couldnotDelete").append("<p style='color:#ff4d4d'>Failed to delete!</p>");
                            // document.getElementById("couldnotDelete").innerHTML="Failed to delete!";
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