<template>
    <div>

        <div class="container-fluid">
            <div id="showDataTemplate">
                <div style="text-align:center;margin:0 auto;">
                    <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
                </div>
                <div style="height:600px;">
                </div>
            </div>
            <div id="divWithData">
                <p id="circularDataNotFound"></p>
                <div class="row">
                    <div class="col" style="width:100%;max-width:800px;margin:auto;" v-if="goingToEditCircularData.id">
                        <div v-if="userType == 'companyUser'" class="card shadow-lg o-hidden border-0">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col" style="font-size:16px;">
                                        <div class="m-auto p-5">
                                            <div class="text-center">
                                                <h4 class="text-dark mb-4" style="font-size:30px;">UPDATE CIRCULAR</h4>
                                            </div>
                                            <div class="user">
                                                <input type="hidden" v-bind:value="goingToEditCircularData.id">
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.job_name" @keyup.enter="enterButtonPressed(0)" id="job_name" name="job_name" placeholder="Job Position" data-toggle="tooltip" data-placement="top" title="Job Position" autocomplete="off" required></div>
                                                <p id="submitJobname"></p>
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.company_name" @keyup.enter="enterButtonPressed(0)" id="company_name" name="company_name" placeholder="Company Name" data-toggle="tooltip" data-placement="top" title="Company Name" autocomplete="off" required></div>
                                                <p id="submitCompanyname"></p>
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.vacancy" @keyup.enter="enterButtonPressed(0)" type="number" id="vacancy" name="vacancy" min="1" placeholder="Vacancy(only number)(Optional)" data-toggle="tooltip" data-placement="top" title="Vacancy(only number)(Optional)" autocomplete="off"></div>
                                                <p id="submitVacancy"></p>
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.employment_status" @keyup.enter="enterButtonPressed(0)" id="employment_status" name="employment_status" placeholder="Employment Status(Optional)" data-toggle="tooltip" data-placement="top" title="Employment Status(Optional)" autocomplete="off"></div>
                                                <p id="submitEmploymentStatus"></p>
                                                <div class="form-group"><span>Job Type:</span></div>
                                                <div class="iWantToHideScroll" style="padding-left:12px;padding-top:10px;padding-bottom:10px;height:250px;max-width:740px;margin:0 auto;border:1px solid;font:10px/20px Georgia, Garamond, Serif;overflow:auto;" data-toggle="tooltip" data-placement="top" title="Job Type">
                                                    <div v-for="(jobtype, index) in jobtypes">
                                                        <div v-if="index % 2 == 0 || index == 0" style="background-color:rgb(245, 245, 240);">
                                                            <input type="radio" name="selectJobtype" :checked="goingToEditCircularData.job_type_id == jobtype.id" v-on:change="showSelectedJobtypeData(jobtype.id, $event)" @keyup.enter="enterButtonPressed(0)">
                                                            <label>{{jobtype.jobtype_name}}</label>
                                                        </div>
                                                        <div v-else>
                                                            <input type="radio" name="selectJobtype" :checked="goingToEditCircularData.job_type_id == jobtype.id" v-on:change="showSelectedJobtypeData(jobtype.id, $event)" @keyup.enter="enterButtonPressed(0)">
                                                            <label>{{jobtype.jobtype_name}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="height:20px"><p id="jobtypeDataOne"></p></div>
                                                <div style="height:20px"><p id="submitJobtype"></p></div>
                                                <div class="form-group"><textarea class="form-control form-control-user" rows="5" cols="25" v-model="goingToEditCircularData.education_req" @keyup.enter="enterButtonPressed(0)" id="education_req" name="education_req" placeholder="Educational Requirements(Optional)" data-toggle="tooltip" data-placement="top" title="Educational Requirements(Optional)" autocomplete="off"></textarea></div>
                                                <p id="submitEducationalReq"></p>
                                                <div class="form-group"><textarea class="form-control form-control-user" rows="5" cols="25" v-model="goingToEditCircularData.experience_req" @keyup.enter="enterButtonPressed(0)" id="experience_req" name="experience_req" placeholder="Experience Requirements(Optional)" data-toggle="tooltip" data-placement="top" title="Experience Requirements(Optional)" autocomplete="off"></textarea></div>
                                                <p id="submitExperienceReq"></p>
                                                <div class="form-group"><textarea class="form-control form-control-user" rows="5" cols="25" v-model="goingToEditCircularData.job_responsibility" @keyup.enter="enterButtonPressed(0)" id="job_responsibility" name="job_responsibility" placeholder="Job Responsibilities(Optional)" data-toggle="tooltip" data-placement="top" title="Job Responsibilities(Optional)" autocomplete="off"></textarea></div>
                                                <p id="submitJobResponsibility"></p>
                                                <div class="form-group"><textarea class="form-control form-control-user" rows="5" cols="25" v-model="goingToEditCircularData.more_req" @keyup.enter="enterButtonPressed(0)" id="more_req" name="more_req" placeholder="More Requirements(Optional)" data-toggle="tooltip" data-placement="top" title="More Requirements(Optional)" autocomplete="off"></textarea></div>
                                                <p id="submitMoreReq"></p>
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.job_location" @keyup.enter="enterButtonPressed(0)" id="job_location" name="job_location" placeholder="Job Location" data-toggle="tooltip" data-placement="top" title="Job Location" autocomplete="off" required></div>
                                                <p id="submitJobLocation"></p>
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.salary" @keyup.enter="enterButtonPressed(0)" id="salary" name="salary" placeholder="Salary(amount and currency)" data-toggle="tooltip" data-placement="top" title="Salary(amount and currency)" autocomplete="off" required></div>
                                                <p id="submitSalary"></p>
                                                <div class="form-group"><textarea class="form-control form-control-user" rows="5" cols="25" v-model="goingToEditCircularData.other_benefits" @keyup.enter="enterButtonPressed(0)" id="other_benefits" name="other_benefits" placeholder="Other Benefits(Optional)" data-toggle="tooltip" data-placement="top" title="Other Benefits(Optional)" autocomplete="off"></textarea></div>
                                                <p id="submitOtherBenefits"></p>
                                                <div class="form-group"><textarea class="form-control form-control-user" rows="5" cols="25" v-model="goingToEditCircularData.read_before_apply" @keyup.enter="enterButtonPressed(0)" id="read_before_apply" name="read_before_apply" placeholder="Read Before Apply(Optional" data-toggle="tooltip" data-placement="top" title="Read Before Apply(Optional" autocomplete="off"></textarea></div>
                                                <p id="submitReadBeforeApply"></p>
                                                <div class="form-group"><span>Deadline:</span></div>
                                                <div class="form-group"><input class="form-control form-control-user" v-model="goingToEditCircularData.deadline" @keyup.enter="enterButtonPressed(0)" id="deadline" name="deadline" placeholder="Deadline" type="date" data-toggle="tooltip" data-placement="top" title="Deadline" autocomplete="off" required></div>
                                                <p id="submitDeadline"></p>
                                                <p id="submitProblem"></p>

                                                <!-- <p class="text-center alert alert-danger"
                                                    v-bind:class="{ hidden: submitCircularHasNoError }">Please fill all fields!</p> -->

                                                <!-- <div class="alert alert-info beautiful" role="alert"><strong>Info</strong> You have 28 new messages.</div>
                                                <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(234,212,101);color: rgb(5,7,10);"><strong>Info</strong> You have 28 new messages.</div>
                                                <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(238,139,118);color: rgb(10,11,11);"><strong>Info</strong> You have 28 new messages.</div> -->
                                                <div style="height:10px;"></div>
                                                <div style="text-align:center;">
                                                    <button class="btn btn-primary text-white btn-user" @click.prevent="updateCircular()" :disabled="updateClicked" name="submit_button">Update Circular</button>
                                                    <button class="btn btn-danger text-white btn-user" @click.prevent="gotoHome" :disabled="updateClicked">Cancel</button>
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
                updateClicked: false,
                circularIdFromRoute: this.$route.params.givencircid,
                goingToEditCircularData: {},
                submitCircularHasNoError: true,
                jobtypes:[],
                userType: '',
                userId: '',
                userIdS: '',
                interval: 0
            }
        },

        mounted() {
            $("#divWithData").hide();
            // document.getElementById("divWithData").style.display = "none";
            this.loadThispage();
            this.getUserData();
            // this.getJobtypesData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Edit Circular");
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
                        this.getCircularData();
                        this.getJobtypesData();
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            enterButtonPressed(value){
                if(this.interval == value){
                    this.updateCircular();
                }
            },

            gotoHome() {
                //this.$router.push('/');
                this.$router.back();
            },

            async getCircularData() {
                $("#circularDataNotFound").html("");
                try{
                    await axios.get('/api/home/circular/' + this.circularIdFromRoute ).then((response) => {
                        
                        if(response.data[0].id){
                            $("#circularDataNotFound").html("");
                            // document.getElementById("circularDataNotFound").innerHTML="";
                            this.goingToEditCircularData = response.data[0];
                            
                            if(!(response.data[0].company_id == this.userId && response.data[0].company_id == this.userIdS && this.userType == "companyUser")){
                                this.goingToEditCircularData = {};
                                $("#circularDataNotFound").append("<p style='color:#ff4d4d'>Data not found!</p>");
                                // document.getElementById("circularDataNotFound").innerHTML="Data not found!";
                            }
                        }
                        else if(response.data == "data not found"){
                            this.goingToEditCircularData = {};
                            $("#circularDataNotFound").append("<p style='color:#ff4d4d'>Data not found!</p>");
                            // document.getElementById("circularDataNotFound").innerHTML="Data not found!";
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getJobtypesData() {
                $("#jobtypeDataOne").html("");
                try{
                    await axios.get('/api/home/jobtype').then((response) => {
                        // this.jobtypes = response.data;
                        if(response.data[0].id){
                            $("#jobtypeDataOne").html("");
                            // document.getElementById("jobtypeDataOne").innerHTML = "";
                            this.jobtypes = response.data;
                        }
                        else if(response.data == "data not found"){
                            $("#jobtypeDataOne").append("<p style='color:#ff4d4d'>Data not found! somthing went wrong.</p>");
                            // document.getElementById("jobtypeDataOne").innerHTML = "Data not found! somthing went wrong.";
                        }
                        
                        // document.getElementById("showDataTemplate").style.display = "none";
                        // document.getElementById("divWithData").style.display = "block";
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
                $("#hideForLongPages").hide();
            },

            showSelectedJobtypeData(jobtypeId, event){
                
                //console.log(event.target.name);
                this.goingToEditCircularData['jobType'] = jobtypeId; //created new index jobType to store selected jobtype id
                
            },

            updateCircular(){
                this.interval = 1;
                this.updateClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.updateClicked = false;
                }.bind(this),1000);
                
                $("#submitJobname").html("");
                $("#submitCompanyname").html("");
                $("#submitJobtype").html("");
                $("#submitJobLocation").html("");
                $("#submitSalary").html("");
                $("#submitDeadline").html("");
                $("#submitProblem").html("");

                // document.getElementById("submitJobname").innerHTML="";
                // document.getElementById("submitCompanyname").innerHTML="";
                // document.getElementById("submitJobtype").innerHTML="";
                // document.getElementById("submitJobLocation").innerHTML="";
                // document.getElementById("submitSalary").innerHTML="";
                // document.getElementById("submitDeadline").innerHTML="";
                // document.getElementById("submitProblem").innerHTML="";

                if (this.goingToEditCircularData['job_name'] == '' ||
                    this.goingToEditCircularData['company_name'] == '' ||
                    this.goingToEditCircularData['job_type_id'] == '' ||
                    this.goingToEditCircularData['job_location'] == '' ||
                    this.goingToEditCircularData['salary'] == '' ||
                    this.goingToEditCircularData['deadline'] == ''
                    ) {
                    this.submitCircularHasNoError = false;
                    if(this.goingToEditCircularData['job_name'] == ''){
                        $("#submitJobname").append("<p style='color:#ff4d4d'>Job position cannot be empty</p>");
                        // document.getElementById("submitJobname").innerHTML="Job position cannot be empty";
                    }
                    if(this.goingToEditCircularData['company_name'] == ''){
                        $("#submitCompanyname").append("<p style='color:#ff4d4d'>Company name cannot be empty</p>");
                        // document.getElementById("submitCompanyname").innerHTML="Company name cannot be empty";
                    }
                    if(this.goingToEditCircularData['job_type_id'] == ''){
                        $("#submitJobtype").append("<p style='color:#ff4d4d'>Select any option</p>");
                        // document.getElementById("submitJobtype").innerHTML="Select any option";
                    }
                    if(this.goingToEditCircularData['job_location'] == ''){
                        $("#submitJobLocation").append("<p style='color:#ff4d4d'>Location cannot be empty</p>");
                        // document.getElementById("submitJobLocation").innerHTML="Location cannot be empty";
                    }
                    if(this.goingToEditCircularData['salary'] == ''){
                        $("#submitSalary").append("<p style='color:#ff4d4d'>Write a amount with currency</p>");
                        // document.getElementById("submitSalary").innerHTML="Write a amount with currency";
                    }
                    if(this.goingToEditCircularData['deadline'] == ''){
                        $("#submitDeadline").append("<p style='color:#ff4d4d'>Please select a deadline</p>");
                        // document.getElementById("submitDeadline").innerHTML="Please select a deadline";
                    }
                }
                else {
                    this.submitCircularHasNoError = true;
                    try{
                        axios.put('/api/home/circular/' + this.goingToEditCircularData.id  , this.goingToEditCircularData)
                            .then((response) => {
                                console.log(response);
                                if(response.data == "success"){
                                    this.gotoHome();
                                }
                                else if(response.data == "something went wrong"){
                                    $("#submitProblem").append("<p style='color:#ff4d4d'>Could not Update!</p>");
                                    // document.getElementById("submitProblem").innerHTML="Could not Update!";
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