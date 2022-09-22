<template>
    <div>
        <div style="max-width:400px;margin:0 auto;">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col">
                            <div class="m-auto p-5">
                                
                                <div class="user" style="font-size:14px;">
                                    <div id="searchByEmailField">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:20px;">Find Yourself</h4>
                                        </div>
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" name="email" v-model="searchByEmailOrPhone" placeholder="Email/Phone no." @keyup.enter="enterButtonPressed($event,0)" data-toggle="tooltip" data-placement="top" title="Email/Phone no." required></div>
                                        <p id="noEmailFound"></p>
                                        <div style="height:20px;"></div>
                                        <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="searchByEmail()" :disabled="findClicked">Find</button>
                                        <div style="height:10px;"></div>
                                    </div>
                                    <div id="emailFoundAndVerify">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:20px;">Verify Yourself</h4>
                                        </div>
                                        <div class="mr-3" style="float:left;padding-top:3px;">
                                            <div class="bg-dark icon-circle"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                        </div>
                                        <p id="emailFound" style="font-size:20px;"></p>
                                        <div style="height:10px;"></div>
                                        
                                        What is your first Teacher's Name?
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" name="teacherNameForBoth" v-model="verifyByTeacherName" placeholder="Teacher's Name" @keyup.enter="enterButtonPressed($event,0)" data-toggle="tooltip" data-placement="top" title="Teacher's Name" required></div>
                                        <p id="couldNotVerify"></p>
                                        <div style="height:20px;"></div>
                                        <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="verifyByTeacher()" :disabled="verifyClicked">Verify</button>
                                        <div style="height:10px;"></div>
                                    </div>
                                    <div id="verifiedAllProcess">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:20px;">Change Password</h4>
                                        </div>
                                        <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" name="password" v-model="entNewPassword" min="5" max="20" placeholder="New Password" @keyup.enter="enterButtonPressed($event,0)" data-toggle="tooltip" data-placement="top" title="New Password" required></div>
                                        <p id="passwordError"></p>
                                        <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" name="rePassword" v-model="entRetypePassword" placeholder="Retype Password" @keyup.enter="enterButtonPressed($event,0)" data-toggle="tooltip" data-placement="top" title="Retype Password" required></div>
                                        <p id="repasswordError"></p>
                                        <div style="height:20px;"></div>
                                        <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="changeNewPasswordCalled()" :disabled="changePasswordClicked">Change Password</button>
                                        <div style="height:10px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height:410px;"></div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                searchByEmailOrPhone: '',
                verifyByTeacherName: '',
                verifyClicked: false,
                findClicked: false,
                entNewPassword: '',
                entRetypePassword: '',
                changePasswordClicked: false,
                allVerified: '',
                getDataFrom: '',
                interval: 0
            }
        },

        mounted() {
            $("#theTitle").html("Change Password");
            $('.container-fluid .nav-item .btn.active').removeClass('active');
            $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
            $("#verifiedAllProcess").hide();
            $("#emailFoundAndVerify").hide();
            $("#hideForLongPages").hide();
        },

        methods:{

            enterButtonPressed(event,value){
                if(event.target.name == "email" && this.interval == value){
                    this.searchByEmail();
                }
                else if(event.target.name == "teacherNameForBoth" && this.interval == value){
                    this.verifyByTeacher();
                }
                else if((event.target.name == "password" || event.target.name == "rePassword") && this.interval == value){
                    this.changeNewPasswordCalled();
                }
            },

            changeNewPasswordCalled(){
                this.interval = 1;
                this.changePasswordClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.changePasswordClicked = false;
                }.bind(this),1500);

                $("#passwordError").html("");
                $("#repasswordError").html("");

                if(this.entNewPassword == '' || 
                   this.entRetypePassword == '' || 
                   (this.entNewPassword != this.entRetypePassword) || 
                   this.entNewPassword.length <= 4 || 
                   this.entNewPassword.length > 20){
                    if(this.entNewPassword == ''){
                        $("#passwordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                    }
                    if(this.entRetypePassword == ''){
                        $("#repasswordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                    }
                    if(this.entNewPassword != this.entRetypePassword){
                        $("#repasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                    }
                    if(this.entNewPassword.length <= 4){
                        $("#passwordError").append("<p style='color:#ff4d4d'>Password is too small, Minimum 5 characters required</p>");
                    }
                    if(this.entNewPassword.length > 20){
                        $("#passwordError").append("<p style='color:#ff4d4d'>Password is too big, Maximum 20 characters required</p>");
                    }
                }
                else{

                    var updateData = {
                        'searchByEmailOrPhone': this.searchByEmailOrPhone,
                        'entNewPassword': this.entNewPassword,
                        'entRetypePassword': this.entRetypePassword,
                        'allVerified': this.allVerified,
                        'getDataFrom': this.getDataFrom
                    };

                    try{
                        axios.post('/api/home/changepasswordcalled', updateData).then((response) => {
                            if(response.data == "cheating used"){
                                this.searchByEmailOrPhone = '';
                                this.verifyByTeacherName = '';
                                this.allVerified = '';
                                $("#emailFoundAndVerify").hide();
                                $("#verifiedAllProcess").hide();
                                $("#searchByEmailField").show();
                            }
                            else if(response.data == "enter a password"){
                                $("#passwordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                            }
                            else if(response.data == "enter a repassword"){
                                $("#repasswordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                            }
                            else if(response.data == "password did not match"){
                                $("#repasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                            }
                            else if(response.data == "password is small"){
                                $("#passwordError").append("<p style='color:#ff4d4d'>Password is too small, Minimum 5 characters required</p>");
                            }
                            else if(response.data == "password is big"){
                                $("#passwordError").append("<p style='color:#ff4d4d'>Password is too big, Maximum 20 characters required</p>");
                            }
                            else if(response.data == "success"){
                                this.searchByEmailOrPhone = '';
                                this.verifyByTeacherName = '';
                                this.allVerified = '';
                                this.entNewPassword = '';
                                this.entRetypePassword = '';
                                swal.fire("Congratulations!", "Password Changed");
                                setTimeout(function(){
                                    this.$router.push('/sign-in');
                                }.bind(this),2500);
                            }
                            else if(response.data == "could not change password"){
                                $("#repasswordError").append("<p style='color:#ff4d4d'>Password could not be changed</p>");
                            }
                            
                            
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            searchByEmail(){
                this.interval = 1;
                this.findClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.findClicked = false;
                }.bind(this),1500);

                this.allVerified = '';
                $("#noEmailFound").html("");

                if(this.searchByEmailOrPhone == ''){
                    $("#noEmailFound").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                }
                else{
                    var getData = {
                        'searchByEmailOrPhone': this.searchByEmailOrPhone
                    };

                    try{
                        axios.post('/api/home/finduserbyemailorphone', getData).then((response) => {
                            console.log(response);
                            if(response.data == "please enter a email or a phone"){
                                $("#noEmailFound").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                            }
                            if(response.data == "no data found"){
                                $("#noEmailFound").append("<p style='color:#ff4d4d'>No user found!</p>");
                            }
                            if(response.data[0] == "success"){
                                this.allVerified = 'emailFound';
                                this.getDataFrom = response.data[2];
                                $("#searchByEmailField").hide();
                                $("#emailFoundAndVerify").show();
                                $("#emailFound").html(response.data[1]);
                                
                                
                            }
                            
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            verifyByTeacher(){
                this.interval = 1;
                this.verifyClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.verifyClicked = false;
                }.bind(this),1500);

                $("#couldNotVerify").html("");

                if(this.verifyByTeacherName == ''){
                    $("#couldNotVerify").append("<p style='color:#ff4d4d'>Sorry, Could not verify!</p>");
                }
                else{

                    var getData = {
                        'searchByEmailOrPhone': this.searchByEmailOrPhone,
                        'verifyByTeacherName': this.verifyByTeacherName
                    };

                    try{
                        axios.post('/api/home/verifyteachername', getData).then((response) => {
                            if(response.data == "day limit over"){
                                $("#couldNotVerify").append("<p style='color:#ff4d4d'>Day limit over, Please try after 24 hours.</p>");
                            }
                            else if(response.data == "success"){
                                this.allVerified = 'locationVerified';
                                $("#searchByEmailField").hide();
                                $("#emailFoundAndVerify").hide();
                                $("#verifiedAllProcess").show();
                                
                            }
                            else if(response.data == "server error"){
                                $("#couldNotVerify").append("<p style='color:#ff4d4d'>Server error</p>");
                            }
                            else if(response.data == "did not match"){
                                $("#couldNotVerify").append("<p style='color:#ff4d4d'>Did not match!</p>");
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
