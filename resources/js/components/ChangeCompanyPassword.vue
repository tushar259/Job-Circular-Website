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
                <div style="max-width:400px;margin:0 auto;">
                    <div v-if="userType == 'companyUser' && userIdS == userId" class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col">
                                    <div class="m-auto p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:25px;">Change Password</h4>
                                        </div>
                                        <div class="user" style="font-size:14px;">
                                            
                                            <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="goingToChangePasswordData.newPassword" name="password" placeholder="New Password" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="New Password" autocomplete="off" required></div>
                                            <p id="newPassword"></p>
                                            <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="goingToChangePasswordData.retypeNewPassword" name="retypePassword" placeholder="Retype Password" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Retype Password" autocomplete="off" required></div>
                                            <p id="retypePassword"></p><br>
                                            To make changes, confirm your current password here<br>
                                            <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="goingToChangePasswordData.currentPassword" name="currentPassword" placeholder="Current Password" @keyup.enter="enterButtonPressed(0)" data-toggle="tooltip" data-placement="top" title="Current Password" autocomplete="off" required></div>
                                            <p id="currentPassword"></p>
                                            <p id="failedToChangePassword"></p>
                                            
                                            <!-- <div class="alert alert-info beautiful" role="alert"><strong>Info</strong> You have 28 new messages.</div>
                                            <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(234,212,101);color: rgb(5,7,10);"><strong>Info</strong> You have 28 new messages.</div>
                                            <div class="alert alert-info beautiful" role="alert" style="background-color: rgb(238,139,118);color: rgb(10,11,11);"><strong>Info</strong> You have 28 new messages.</div> -->
                                            <div style="height:20px;"></div>
                                            <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="updatePassword()" :disabled="updateClicked" name="submit_button">Change Password</button>
                                            <div style="height:10px;"></div>
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

        data() {
            return{
                updateClicked: false,
                submitCircularHasNoError: true,
                goingToChangePasswordData: {
                    'newPassword': '',
                    'retypeNewPassword': '',
                    'currentPassword': ''
                },
                userType: '',
                userId: '',
                userIdS: '',
                interval: 0
            }
        },

        mounted() {
            // console.log('Component mounted.')
            $("#divWithData").hide();
            // document.getElementById("divWithData").style.display = "none";
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Change Password");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavChangePassword']").addClass('active');
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
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#divWithData").show();
                $("#showDataTemplate").hide();
                $("#hideForLongPages").hide();
            },

            enterButtonPressed(value){
                if(this.interval == value){
                    this.updatePassword();
                }
            },

            updatePassword(){
                this.interval = 1;
                this.updateClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.updateClicked = false;
                }.bind(this),1500);
                
                $("#currentPassword").html("");
                $("#newPassword").html("");
                $("#retypePassword").html("");
                $("#failedToChangePassword").html("");

                // document.getElementById("currentPassword").innerHTML = "";
                // document.getElementById("newPassword").innerHTML = "";
                // document.getElementById("retypePassword").innerHTML = "";
                // document.getElementById("failedToChangePassword").innerHTML = "";

                if (this.goingToChangePasswordData['newPassword'] == '' ||
                    this.goingToChangePasswordData['retypeNewPassword'] == '' ||
                    this.goingToChangePasswordData['currentPassword'] == ''
                    ) {
                    this.submitCircularHasNoError = false;
                    if(this.goingToChangePasswordData['newPassword'] == ''){
                        $("#newPassword").append("<p style='color:#ff4d4d'>Please enter your New Password</p>");
                    }
                    if(this.goingToChangePasswordData['retypeNewPassword'] == ''){
                        $("#retypePassword").append("<p style='color:#ff4d4d'>Please Retype your Password</p>");
                    }
                    if(this.goingToChangePasswordData['currentPassword'] == ''){
                        $("#currentPassword").append("<p style='color:#ff4d4d'>Please enter your Current Password</p>");
                    }
                }
                else{
                    this.submitCircularHasNoError = true;
                    try{
                        axios.post('/api/home/companyuserinfo', this.goingToChangePasswordData)
                            .then((response) => {
                            console.log(response);
                            if(response.data == "success"){
                                // this.$router.back();
                                this.goingToChangePasswordData={
                                    'newPassword': '',
                                    'retypeNewPassword': '',
                                    'currentPassword': ''
                                }
                                swal.fire("<p style='font-size:22px;color:green;'>Congratulations!</p>", "<p style='font-size:18px;'>Password Changed</p>");
                            }
                            else if(response.data == "current password cannot be empty error"){
                                $("#currentPassword").append("<p style='color:#ff4d4d'>Please enter current password</p>");
                                // document.getElementById("currentPassword").innerHTML = "Please enter current password";
                            }
                            else if(response.data == "new password cannot be empty error"){
                                $("#newPassword").append("<p style='color:#ff4d4d'>Please enter new password</p>");
                                // document.getElementById("newPassword").innerHTML = "Please enter new password";
                            }
                            else if(response.data == "retype password cannot be empty error"){
                                $("#retypePassword").append("<p style='color:#ff4d4d'>Please enter retype password</p>");
                                // document.getElementById("retypePassword").innerHTML = "Please enter retype password";
                            }
                            else if(response.data == "retype password did not match error"){
                                $("#retypePassword").append("<p style='color:#ff4d4d'>Password did not match</p>");
                                // document.getElementById("retypePassword").innerHTML = "Password did not match";
                            }
                            else if(response.data == "server error"){
                                $("#failedToChangePassword").append("<p style='color:#ff4d4d'>Password could not be changed</p>");
                                // document.getElementById("failedToChangePassword").innerHTML = "Password could not be changed";
                            }
                            else if(response.data == "current password did not match error"){
                                $("#currentPassword").append("<p style='color:#ff4d4d'>Password did not match</p>");
                                // document.getElementById("currentPassword").innerHTML = "Password did not match";
                            }
                            else if(response.data == "not authorized user"){
                                $("#failedToChangePassword").append("<p style='color:#ff4d4d'>This user cannot change password</p>");
                                // document.getElementById("failedToChangePassword").innerHTML = "This user cannot change password";
                            }
                            //this.gotoHome();
                        });
                        
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            }
        }
    }
</script>
