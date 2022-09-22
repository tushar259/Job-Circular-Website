<template>
    <div>
        <div class="container-fluid">
            <div id="showDataTemplate">
                <div style="text-align:center;margin:0 auto;">
                    <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
                </div>
            </div>
            <div id="divWithData">
                <div style="max-width:400px;margin:0 auto;">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col">
                                    <div class="m-auto p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:20px;">Sign In</h4>
                                        </div>
                                        <div class="user">
                                            <div class="form-group"><input type="email" style="font-size:16px;" class="form-control form-control-user" v-model="signinSubmitData.email_phone" name="email_phone" @keyup.enter="enterButtonPressed(0)" placeholder="Email/Phone no." data-toggle="tooltip" data-placement="top" title="Email / Phone no." required></div>
                                            <p id="emailOrPhoneError"></p>
                                            <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="signinSubmitData.password" name="password" @keyup.enter="enterButtonPressed(0)" placeholder="Password" data-toggle="tooltip" data-placement="top" title="Password" required></div>
                                            <p id="passwordError"></p>
                                            <p id="emailOrPasswordError"></p>
                                            <a href="/change-password" style="font-size:12px;">Forgot password?</a>
                                            <p ></p>
                                            <div style="height:20px;"></div>
                                            <button class="btn btn-primary btn-block text-white btn-user" style="font-size:20px;" @click.prevent="signInFunc()" :disabled="submitClicked" name="submit_button">sign in</button>
                                            <div style="height:20px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height:390px;">
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return{
                submitCircularHasNoError: true,
                submitClicked: false,
                signinSubmitData: {
                    'email_phone': '',
                    'password': '',
                    'submitType': 'signIn_logIn'
                },
                interval: 0
            }
        },

        mounted() {
            $("#divWithData").hide();
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Sign In");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavSignIn']").addClass('active');
                
            },

            async getUserData(){
                try{
                    await axios.get('/api/home/userinfo').then((response) => {
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
                        if(this.userType == "user" || this.userType == "companyUser"){
                            this.$router.push('/');
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

            enterButtonPressed(value){
                if(this.interval == value){
                    this.signInFunc();
                }
            },

            signInFunc(){
                this.interval = 1;
                this.submitClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.submitClicked = false;
                }.bind(this),1500);

                $("#emailOrPasswordError").html("");
                $("#emailOrPhoneError").html("");
                $("#passwordError").html("");

                // document.getElementById("emailOrPasswordError").innerHTML = "";
                // document.getElementById("emailOrPhoneError").innerHTML = "";
                // document.getElementById("passwordError").innerHTML = "";

                var input = this.signinSubmitData;
                if (input['email_phone'] == '' ||
                    input['password'] == ''
                    ) {
                    this.submitCircularHasNoError = false;
                    if(input['email_phone'] == ''){
                        $("#emailOrPhoneError").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                        // document.getElementById("emailOrPhoneError").innerHTML = "Please enter a email or a phone";
                    }
                    if(input['password'] == ''){
                        $("#passwordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                        // document.getElementById("passwordError").innerHTML = "Please enter a password";
                    }
                    
                }
                else{
                    this.submitCircularHasNoError = true;
                    try{
                        axios.post('/api/home/createaccount', input)
                            .then((response) => {
                                //console.log(response);
                                //console.log('<%=Session["userId"] %>');
                                //console.log(Session['userId']);
                                
                                if(response.data == "email or password not found error"){
                                    $("#emailOrPasswordError").append("<p style='color:#ff4d4d'>Email or password did not match</p>");
                                    // document.getElementById("emailOrPasswordError").innerHTML = "Email or password did not match";
                                }
                                else if(response.data == "Fill all the fields error"){
                                    $("#emailOrPasswordError").append("<p style='color:#ff4d4d'>Please enter all the fields</p>");
                                    // document.getElementById("emailOrPasswordError").innerHTML = "Please enter all the fields";
                                }
                                else if(response.data[0].id){
                                    // console.log(response);
                                    $("#emailOrPasswordError").html("");
                                    $("#emailOrPhoneError").html("");
                                    $("#passwordError").html("");

                                    // document.getElementById("emailOrPasswordError").innerHTML = "";
                                    // document.getElementById("emailOrPhoneError").innerHTML = "";
                                    // document.getElementById("passwordError").innerHTML = "";
                                    window.localStorage.setItem('refresh', "");
                                    this.signinSubmitData = { 
                                        'email_phone': '',
                                        'password': ''
                                    };
                                    this.gotoHome();
                                }
                                else if(response.data == "email or phone cannot be empty error"){
                                    $("#emailOrPhoneError").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                                    // document.getElementById("emailOrPhoneError").innerHTML = "Please enter a email or a phone";
                                }
                                else if(response.data == "password cannot be empty error"){
                                    $("#passwordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                                    // document.getElementById("passwordError").innerHTML = "Please enter a password";
                                }
                                
                        });
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            },

            gotoHome() {
                this.$router.push('/');
                //this.$router.back();
            },

        }
    }
</script>
