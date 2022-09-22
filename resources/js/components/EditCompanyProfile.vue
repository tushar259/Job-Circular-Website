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
                    <div v-if="userType == 'companyUser' && userIdS == userId" class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col">
                                    <div class="m-auto p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:25px;">Edit Profile</h4>
                                        </div>
                                        <div class="user" style="font-size:14px;">
                                            <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditCompanyProfile.newCompanyName" name="companyName" placeholder="Company Name" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Company Name" autocomplete="off" required></div>
                                            <p id="companyName"></p>
                                            <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditCompanyProfile.newCompanyAddress" name="companyAddress" placeholder="Company Address" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Company Address" autocomplete="off" required></div>
                                            <p id="companyAddress"></p>
                                            <div class="form-group"><input type="email" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditCompanyProfile.newEmail" name="email" placeholder="Email" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Email" autocomplete="off" required></div>
                                            <p id="companyEmail"></p>
                                            <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditCompanyProfile.newPhone" name="phone" placeholder="Phone" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Phone" autocomplete="off" required></div>
                                            <p id="companyPhone"></p><br>
                                            To update profile you need to confirm your identity. Enter your password here<br>
                                            <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="goingToEditCompanyProfile.userPassword" name="password" placeholder="Confirm Your Password.." @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Confirm Your Password.." autocomplete="off" required></div>
                                            <p id="companyPassword"></p>
                                            <p id="profileUpdatedOrError"></p>
                                            
                                            <!-- <div class="alert alert-info beautiful" role="alert"><strong>Info</strong> You have 28 new messages.</div>
                                            <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(234,212,101);color: rgb(5,7,10);"><strong>Info</strong> You have 28 new messages.</div>
                                            <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(238,139,118);color: rgb(10,11,11);"><strong>Info</strong> You have 28 new messages.</div> -->
                                            <div style="height:20px;"></div>
                                            <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="updateCompanyUserProfile()" :disabled="updateClicked" name="submit_button">Update Profile</button>
                                            <div style="height:10px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:300px;"></div>
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
                goingToEditCompanyProfile: {
                    'userType': '',
                    'userId': '',
                    'userIdS': '',
                    'newCompanyName': '',
                    'newCompanyAddress': '',
                    'newEmail': '',
                    'newPhone': '',
                    'oldCompanyName': '',
                    'oldCompanyAddress': '',
                    'oldEmail': '',
                    'oldPhone': '',
                    'userPassword': '',
                    'oldUserPassword': ''
                },
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
                    this.updateCompanyUserProfile();
                }
            },

            updateCompanyUserProfile(){
                this.interval = 1;
                this.updateClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.updateClicked = false;
                }.bind(this),1000);

                $("#companyName").html("");
                $("#companyAddress").html("");
                $("#companyEmail").html("");
                $("#companyPhone").html("");
                $("#companyPassword").html("");
                $("#profileUpdatedOrError").html("");

                if (this.goingToEditCompanyProfile['newCompanyName'] == '' ||
                    this.goingToEditCompanyProfile['newCompanyAddress'] == '' ||
                    this.goingToEditCompanyProfile['newEmail'] == '' ||
                    this.goingToEditCompanyProfile['userPassword'] == '' ||
                    this.goingToEditCompanyProfile['newPhone'] == ''
                    ) {
                    this.submitCircularHasNoError = false;
                    if(this.goingToEditCompanyProfile['newCompanyName'] == ''){
                        $("#companyName").append("<p style='color:#ff4d4d;'>Please enter your Company Name</p>");
                    }
                    if(this.goingToEditCompanyProfile['newCompanyAddress'] == ''){
                        $("#companyAddress").append("<p style='color:#ff4d4d;'>Please enter your Company Address</p>");
                    }
                    if(this.goingToEditCompanyProfile['newEmail'] == ''){
                        $("#companyEmail").append("<p style='color:#ff4d4d;'>Please enter your Company Email</p>");
                    }
                    if(this.goingToEditCompanyProfile['userPassword'] == ''){
                        $("#companyPassword").append("<p style='color:#ff4d4d;'>Please enter your Password</p>");
                    }
                    if(this.goingToEditCompanyProfile['newPhone'] == ''){
                        $("#companyPhone").append("<p style='color:#ff4d4d;'>Please enter your Company Phone no.</p>");
                    }
                }
                else{
                    this.submitCircularHasNoError = true;
                    try{
                        axios.put('/api/home/companyuserinfo/' + this.goingToEditCompanyProfile['userId']  , this.goingToEditCompanyProfile)
                            .then((response) => {
                            console.log(response);
                            if(response.data == "success"){
                                this.goingToEditCompanyProfile['userPassword'] = '';
                                $("#profileUpdatedOrError").append("<p style='color:green;'>Updated</p>");
                                // document.getElementById("profileUpdatedOrError").innerHTML = "Updated";
                            }
                            else if(response.data == "company name cannot be empty"){
                                $("#companyName").append("<p style='color:#ff4d4d'>Company name cannot be empty</p>");
                                // document.getElementById("companyName").innerHTML = "Company name cannot be empty";
                            }
                            else if(response.data == "company address cannot be empty"){
                                $("#companyAddress").append("<p style='color:#ff4d4d'>Company address cannot be empty</p>");
                                // document.getElementById("companyAddress").innerHTML = "Company address cannot be empty";
                            }
                            else if(response.data == "email cannot be empty"){
                                $("#companyEmail").append("<p style='color:#ff4d4d'>Email cannot be empty</p>");
                                // document.getElementById("companyEmail").innerHTML = "Email cannot be empty";
                            }
                            else if(response.data == "phone cannot be empty"){
                                $("#companyPhone").append("<p style='color:#ff4d4d'>Phone cannot be empty</p>");
                                // document.getElementById("companyPhone").innerHTML = "Phone cannot be empty";
                            }
                            else if(response.data == "email used error"){
                                $("#companyEmail").append("<p style='color:#ff4d4d'>Email already used</p>");
                                // document.getElementById("companyEmail").innerHTML = "Email already used";
                            }
                            else if(response.data == "not a valid email error"){
                                $("#companyEmail").append("<p style='color:#ff4d4d'>Email is not valid</p>");
                                // document.getElementById("companyEmail").innerHTML = "Email is not valid";
                            }
                            else if(response.data == "phone used error"){
                                $("#companyPhone").append("<p style='color:#ff4d4d'>Phone already used</p>");
                                // document.getElementById("companyPhone").innerHTML = "Phone already used";
                            }
                            else if(response.data == "not a valid phone error"){
                                $("#companyPhone").append("<p style='color:#ff4d4d'>Phone is not valid</p>");
                                // document.getElementById("companyPhone").innerHTML = "Phone is not valid";
                            }
                            else if(response.data == "phone cannot be empty"){
                                $("#companyPhone").append("<p style='color:#ff4d4d'>Phone cannot be empty</p>");
                                // document.getElementById("companyPhone").innerHTML = "Phone cannot be empty";
                            }
                            else if(response.data == "password did not match error"){
                                $("#companyPassword").append("<p style='color:#ff4d4d'>Password did not match</p>");
                                // document.getElementById("companyPassword").innerHTML = "Password did not match";
                            }
                            else if(response.data == "this user cannot update"){
                                $("#profileUpdatedOrError").append("<p style='color:#ff4d4d'>This user cannot update</p>");
                                // document.getElementById("profileUpdatedOrError").innerHTML = "This user cannot update";
                            }
                            else if(response.data == "server error"){
                                $("#profileUpdatedOrError").append("<p style='color:#ff4d4d'>Error occurred</p>");
                                // document.getElementById("profileUpdatedOrError").innerHTML = "Error occurred";
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
                        if(!(this.userId == this.userIdS && this.userType == "companyUser")){
                            this.$router.push('*');
                        }
                        else{
                            this.getSelfUserData();
                        }
                    });
                }
                catch(e){
                    console.log(e);
                }
            },

            async getSelfUserData(){
                try{
                    await axios.get('/api/home/companyuserinfo').then((response) => {
                        
                        if(response.data[0].id && response.data[0].user_type == "companyUser" && response.data[0].id == response.data[0].userIdS){
                            this.goingToEditCompanyProfile['userType'] = "companyUser";
                            this.goingToEditCompanyProfile['userIdS'] = response.data[0].userIdS;
                            this.goingToEditCompanyProfile['userId'] = response.data[0].id;

                            this.goingToEditCompanyProfile['newCompanyName'] = response.data[0].company_name;
                            this.goingToEditCompanyProfile['newCompanyAddress'] = response.data[0].company_address;
                            this.goingToEditCompanyProfile['newEmail'] = response.data[0].email;
                            this.goingToEditCompanyProfile['newPhone'] = response.data[0].phone;

                            this.goingToEditCompanyProfile['oldCompanyName'] = response.data[0].company_name;
                            this.goingToEditCompanyProfile['oldCompanyAddress'] = response.data[0].company_address;
                            this.goingToEditCompanyProfile['oldEmail'] = response.data[0].email;
                            this.goingToEditCompanyProfile['oldPhone'] = response.data[0].phone;
                            this.goingToEditCompanyProfile['oldUserPassword'] = response.data[0].password;
                        }
                        else if(response.data == "not authorized user"){
                            this.$router.push('*');
                        }
                        else{
                            this.$router.push('*');
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
            }
        }
    }
</script>
