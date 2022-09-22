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
                <div style="max-width:500px;margin:0 auto;">
                    <div v-if="userType == 'user' && userIdS == userId" class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col">
                                    <div class="m-auto p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:25px;">Edit Profile</h4>
                                        </div>
                                        <div class="user" style="font-size:14px;">
                                            
                                            <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditProfile.newUserName" name="name" placeholder="Name" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Name" autocomplete="off" required></div>
                                            <p id="userName"></p>
                                            Gender:<br>
                                            <div v-if="goingToEditProfile.oldUserGender == 'male'">
                                                <input type="radio" style="float:left;" name="selectGender" value="male" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)" checked><label style="padding-left:5px;"> Male</label><br>
                                                <input type="radio" style="float:left;" name="selectGender" value="female" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)"><label style="padding-left:5px;"> Female</label><br>
                                                <input type="radio" style="float:left;" name="selectGender" value="others" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)"><label style="padding-left:5px;"> Others</label><br>
                                            </div>
                                            <div v-if="goingToEditProfile.oldUserGender == 'female'">
                                                <input type="radio" style="float:left;" name="selectGender" value="male" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)"><label style="padding-left:5px;"> Male</label><br>
                                                <input type="radio" style="float:left;" name="selectGender" value="female" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)" checked><label style="padding-left:5px;"> Female</label><br>
                                                <input type="radio" style="float:left;" name="selectGender" value="others" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)"><label style="padding-left:5px;"> Others</label><br>
                                            </div>
                                            <div v-if="goingToEditProfile.oldUserGender == 'others'">
                                                <input type="radio" style="float:left;" name="selectGender" value="male" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)"><label style="padding-left:5px;"> Male</label><br>
                                                <input type="radio" style="float:left;" name="selectGender" value="female" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)"><label style="padding-left:5px;"> Female</label><br>
                                                <input type="radio" style="float:left;" name="selectGender" value="others" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed(0)" checked><label style="padding-left:5px;"> Others</label><br>
                                            </div>
                                            <p id="userGender"></p>
                                            Select your Skill from the list:<br>
                                            <div class="form-group">
                                                <select class="form-control" style="font-size:16px;" v-on:change="selectedUserSkill($event)" @keyup.enter="enterButtonPressed(0)">
                                                    <option value="" disabled selected hidden>Select your Skill...</option>
                                                    <option value="" disabled>Select your Skill...</option>
                                                    <option v-for="jobtype in jobtypes" :value="jobtype.id" :selected="goingToEditProfile.newUserJobTypeId == jobtype.id">{{jobtype.jobtype_name}}</option>
                                                    <option value="" disabled></option>
                                                </select>
                                            </div>
                                            <p id="jobtypeDataId"></p>
                                            <div class="form-group"><input type="email" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditProfile.newUserEmail" name="email" placeholder="Email" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Email" autocomplete="off" required></div>
                                            <p id="userEmail"></p>
                                            <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditProfile.newUserPhone" name="phone" placeholder="Phone" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Phone" autocomplete="off" required></div>
                                            <p id="userPhone"></p>
                                            <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditProfile.userBirthPlace" name="birthPlace" placeholder="Place of Birth" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Place of Birth" autocomplete="off" required></div>
                                            <p id="birthPlaceError"></p><br>
                                            To update profile you need to confirm your identity. Enter your password here<br>
                                            <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditProfile.userPassword" name="password" placeholder="Confirm Your Password.." @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Confirm Your Password.." autocomplete="off" required></div>
                                            <p id="userPassword"></p>
                                            <p id="updatedProfileOrError"></p>
                                            <!-- <div class="alert alert-info beautiful" role="alert"><strong>Info</strong> You have 28 new messages.</div>
                                            <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(234,212,101);color: rgb(5,7,10);"><strong>Info</strong> You have 28 new messages.</div>
                                            <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(238,139,118);color: rgb(10,11,11);"><strong>Info</strong> You have 28 new messages.</div> -->
                                            <div style="height:20px;"></div>
                                            <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="updateUserProfile()" :disabled="updateClicked" name="submit_button">Update Profile</button>
                                            <div style="height:10px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:200px;"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return{
                updateClicked: false,
                submitCircularHasNoError: true,
                goingToEditProfile: {
                    'userId': '',
                    'userIdS': '',
                    'oldUserName': '',
                    'newUserName': '',
                    'oldUserGender': '',
                    'newUserGender': '',
                    'oldUserJobTypeId': '',
                    'newUserJobTypeId': '',
                    'oldUserEmail': '',
                    'newUserEmail': '',
                    'oldUserPhone': '',
                    'newUserPhone': '',
                    'userPassword': '',
                    'oldUserPassword': '',
                    'userType': '',
                    'userBirthPlace': ''
                },
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
                $("#theTitle").html("Edit Profile");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavEditProfile']").addClass('active');
                
            },

            enterButtonPressed(value){
                if(this.interval == value){
                    this.updateUserProfile();
                }
            },

            updateUserProfile(){
                this.interval = 1;
                this.updateClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.updateClicked = false;
                }.bind(this),1000);

                $("#userName").html("");
                $("#userGender").html("");
                $("#jobtypeDataId").html("");
                $("#userEmail").html("");
                $("#userPhone").html("");
                $("#userPassword").html("");
                $("#updatedProfileOrError").html("");
                $("#birthPlaceError").html("");

                // document.getElementById("userName").innerHTML = "";
                // document.getElementById("userGender").innerHTML = "";
                // document.getElementById("jobtypeDataId").innerHTML = "";
                // document.getElementById("userEmail").innerHTML = "";
                // document.getElementById("userPhone").innerHTML = "";
                // document.getElementById("userPassword").innerHTML = "";
                // document.getElementById("updatedProfileOrError").innerHTML = "";


                if (this.goingToEditProfile['newUserName'] == '' ||
                    this.goingToEditProfile['newUserGender'] == '' ||
                    this.goingToEditProfile['newUserJobTypeId'] == '' ||
                    this.goingToEditProfile['userPassword'] == '' ||
                    this.goingToEditProfile['userBirthPlace'] == '' ||
                    this.goingToEditProfile['userBirthPlace'].length <= 14 ||
                    this.goingToEditProfile['userBirthPlace'].length > 100 
                    ) {
                    this.submitCircularHasNoError = false;
                    if(this.goingToEditProfile['newUserName'] == ''){
                        $("#userName").append("<p style='color:#ff4d4d'>Name is required</p>");
                    }
                    if(this.goingToEditProfile['newUserGender'] == ''){
                        $("#userGender").append("<p style='color:#ff4d4d'>Gender is required</p>");
                    }
                    if(this.goingToEditProfile['newUserJobTypeId'] == ''){
                        $("#jobtypeDataId").append("<p style='color:#ff4d4d'>Please select a skill</p>");
                    }
                    if(this.goingToEditProfile['userPassword'] == ''){
                        $("#userPassword").append("<p style='color:#ff4d4d'>Please enter password</p>");
                    }
                    if(this.goingToEditProfile['userBirthPlace'] == ''){
                        $("#birthPlaceError").append("<p style='color:#ff4d4d'>Please enter your birth place</p>");
                    }
                    if(this.goingToEditProfile['userBirthPlace'].length <= 14){
                        $("#birthPlaceError").append("<p style='color:#ff4d4d'>Place of birth is too small, Minimum 15 characters required</p>");
                    }
                    if(this.goingToEditProfile['userBirthPlace'].length > 100){
                        $("#birthPlaceError").append("<p style='color:#ff4d4d'>Place of birth is too big, Maximum 100 characters required</p>");
                    }
                }
                else{
                    if(this.goingToEditProfile['newUserEmail'] == '' &&
                    this.goingToEditProfile['newUserPhone'] == ''){
                        this.submitCircularHasNoError = false;
                        $("#userEmail").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                        $("#userPhone").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                    }
                    else{
                        this.submitCircularHasNoError = true;
                        try{
                            axios.put('/api/home/userinfo/' + this.goingToEditProfile['userId']  , this.goingToEditProfile)
                                .then((response) => {
                                //console.log(response);
                                if(response.data == "success"){
                                    this.goingToEditProfile['userPassword'] = '';
                                    $("#updatedProfileOrError").append("<p style='color:green;'>Updated</p>");
                                    // document.getElementById("updatedProfileOrError").innerHTML = "Updated";
                                }
                                else if(response.data == "name cannot be empty"){
                                    $("#userName").append("<p style='color:#ff4d4d'>Name cannot be empty</p>");
                                    // document.getElementById("userName").innerHTML = "Name cannot be empty";
                                }
                                else if(response.data == "gender cannot be empty"){
                                    $("#userGender").append("<p style='color:#ff4d4d'>Please select a gender</p>");
                                    // document.getElementById("userGender").innerHTML = "Please select a gender";
                                }
                                else if(response.data == "skill cannot be empty"){
                                    $("#jobtypeDataId").append("<p style='color:#ff4d4d'>Please select a skill</p>");
                                    // document.getElementById("jobtypeDataId").innerHTML = "Please select a skill";
                                }
                                else if(response.data == "email and phone both cannot be empty"){
                                    $("#userPhone").append("<p style='color:#ff4d4d'>Please enter a Email or a Phone</p>");
                                    // document.getElementById("userPhone").innerHTML = "Please enter a Email or a Phone";
                                }
                                else if(response.data == "email used error"){
                                    $("#userEmail").append("<p style='color:#ff4d4d'>Email already used</p>");
                                    // document.getElementById("userEmail").innerHTML = "Email already used";
                                }
                                else if(response.data == "not a valid email error"){
                                    $("#userEmail").append("<p style='color:#ff4d4d'>Email is not valid</p>");
                                    // document.getElementById("userEmail").innerHTML = "Email is not valid";
                                }
                                else if(response.data == "phone used error"){
                                    $("#userPhone").append("<p style='color:#ff4d4d'>Phone already used</p>");
                                    // document.getElementById("userPhone").innerHTML = "Phone already used";
                                }
                                else if(response.data == "not a valid phone error"){
                                    $("#userPhone").append("<p style='color:#ff4d4d'>Phone is not valid</p>");
                                    // document.getElementById("userPhone").innerHTML = "Phone is not valid";
                                }
                                else if(response.data == "password did not match error"){
                                    $("#userPassword").append("<p style='color:#ff4d4d'>Password did not match</p>");
                                    // document.getElementById("userPassword").innerHTML = "Password did not match";
                                }
                                else if(response.data == "this user cannot update"){
                                    $("#updatedProfileOrError").append("<p style='color:#ff4d4d'>This user cannot update</p>");
                                    // document.getElementById("updatedProfileOrError").innerHTML = "This user cannot update";
                                }
                                else if(response.data == "server error"){
                                    $("#updatedProfileOrError").append("<p style='color:#ff4d4d'>Error occurred!</p>");
                                    // document.getElementById("updatedProfileOrError").innerHTML = "Error occurred!";
                                }

                            });
                            
                        }
                        catch(e){
                            console.log(e);
                        }
                    }
                }

            },

            selectedUserSkill(event){
                this.goingToEditProfile['newUserJobTypeId'] = event.target.value;
            },

            async getJobtypesData() {
                $("#jobtypeDataId").html("");
                try{
                    await axios.get('/api/home/jobtype').then((response) => {
                        
                        if(response.data[0].id){
                            $("#jobtypeDataId").html("");
                            // document.getElementById("jobtypeDataId").innerHTML = "";
                            this.jobtypes = response.data;
                        }
                        else if(response.data == "data not found"){
                            $("#jobtypeDataId").append("<p style='color:#ff4d4d'>No data found!</p>");
                            // document.getElementById("jobtypeDataId").innerHTML = "No data found!";
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

            selectedGender(event){
                this.goingToEditProfile['newUserGender'] = event.target.value;
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
                        if(!(this.userId == this.userIdS && this.userType == "user")){
                            this.$router.push('*');
                        }
                        else{
                            this.getSelfUserData();
                            this.getJobtypesData();
                            
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getSelfUserData(){
                try{
                    await axios.get('/api/home/userinfo').then((response) => {
                        console.log(response);
                        if(response.data[0].id && response.data[0].user_type == "user" && response.data[0].id == response.data[0].userIdS){
                            this.goingToEditProfile['userType'] = "user";
                            this.goingToEditProfile['userId'] = response.data[0].id;
                            this.goingToEditProfile['oldUserName'] = response.data[0].name;
                            this.goingToEditProfile['oldUserGender'] = response.data[0].gender;
                            this.goingToEditProfile['oldUserJobTypeId'] = response.data[0].job_type_id;
                            this.goingToEditProfile['oldUserEmail'] = response.data[0].email;
                            this.goingToEditProfile['oldUserPhone'] = response.data[0].phone;
                            this.goingToEditProfile['newUserName'] = response.data[0].name;
                            this.goingToEditProfile['newUserGender'] = response.data[0].gender;
                            this.goingToEditProfile['newUserJobTypeId'] = response.data[0].job_type_id;
                            this.goingToEditProfile['newUserEmail'] = response.data[0].email;
                            this.goingToEditProfile['newUserPhone'] = response.data[0].phone;
                            this.goingToEditProfile['userIdS'] = response.data[0].userIdS;
                            this.goingToEditProfile['oldUserPassword'] = response.data[0].password;
                            this.goingToEditProfile['userBirthPlace'] = response.data[0].place_of_birth;
                            
                        }
                        else if(response.data == "not authorized user"){
                            this.$router.push('*');
                        }
                        else{
                            this.$router.push('*');
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
