<template>
    <div>

        <div id="showDataTemplate">
            <div style="text-align:center;margin:0 auto;">
                <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
            </div>
        </div>
        <div id="divWithData">
            <div style="max-width:500px;margin:0 auto;">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col">
                                <div class="m-auto p-5" style="font-size:14px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="font-size:20px;">Create Account</h4>
                                        <div style="text-align:left;">
                                            <div style="font-size:16px;">Select If you are going to create a Company Account or a Employee Account:</div>
                                            <div style="height:10px;"></div>
                                            <input type="radio" style="float:left;" name="selectRegistration" value="companyRegistration" v-on:change="selectedRegistration($event)"><label style="padding-left:5px;"> Create Company Account</label><br>
                                            <input type="radio" style="float:left;" name="selectRegistration" value="userRegistration" v-on:change="selectedRegistration($event)" checked><label style="padding-left:5px;"> Create Employee Account</label>
                                            <div style="height:10px;"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="userRegistration" class="user">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:20px;">Create Employee Account</h4>
                                        </div>
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="createUserAccount.name" name="name" placeholder="Name" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Name" required></div>
                                        <p id="userNameError"></p>
                                        Gender:<br>
                                        <input type="radio" style="float:left;" name="selectGender" value="male" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed('user',0)"><label style="padding-left:5px;padding-top:2px;"> Male</label><br>
                                        <input type="radio" style="float:left;" name="selectGender" value="female" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed('user',0)"><label style="padding-left:5px;padding-top:2px;"> Female</label><br>
                                        <input type="radio" style="float:left;" name="selectGender" value="others" v-on:change="selectedGender($event)" @keyup.enter="enterButtonPressed('user',0)"><label style="padding-left:5px;padding-top:2px;"> Others</label><br>
                                        <p id="userGenderError"></p>
                                        Select your Skill from the list:<br>
                                        <div class="form-group">
                                            <select class="form-control" style="font-size:16px;" v-on:change="selectedUserSkill($event)" @keyup.enter="enterButtonPressed('user',0)">
                                                <option value="" disabled selected hidden>Select your Skill...</option>
                                                <option value="" disabled>Select your Skill...</option>
                                                <option v-for="jobtype in jobtypes" v-bind:value="jobtype.id">{{jobtype.jobtype_name}}</option>
                                                <option value="" disabled></option>
                                            </select>
                                        </div>
                                        <p id="jobtypeError"></p>
                                        <p>*You need to submit at least one field from Email and Phone*</p>
                                        <div class="form-group"><input type="email" style="font-size:16px;" class="form-control form-control-user" v-model="createUserAccount.email" name="email" placeholder="Email" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Email" required></div>
                                        <p id="userEmailError"></p>
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="createUserAccount.phone" name="phone" placeholder="Phone" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Phone" required></div>
                                        <p id="userPhoneError"></p>
                                        <div class="form-group"><input id="userPOB" style="font-size:16px;" type="text" class="form-control form-control-user" v-model="createUserAccount.placeOfBirth" placeholder="Place of Birth(City, Country)" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Place of Birth(City, Country)" required></div>
                                        <p id="userPlaceofBirth"></p>
                                        <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="createUserAccount.password" name="password" placeholder="Password" min="5" max="20" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Password" required></div>
                                        <p id="userPasswordError"></p>
                                        <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="createUserAccount.rePassword" name="retypePassword" placeholder="Retype Password" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Retype Password" required></div>
                                        <p id="userRetypePasswordError"></p>
                                        What is your first Teacher's Name? (Remember your Teacher's Name when you forget your password. Do not share with anybody.)
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="createUserAccount.firstTeacherName" name="firstTeachersName" placeholder="Teacher's Name" @keyup.enter="enterButtonPressed('user',0)" data-toggle="tooltip" data-placement="top" title="Teacher's Name" required></div>
                                        <p id="userTeacherNameError"></p>
                                        <p id="errorOccurred"></p>
                                        
                                    </div>
                                    <div id="companyRegistration" class="user" style="font-size:14px;">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4" style="font-size:20px;">Create Company Account</h4>
                                        </div>
                                        <div class="form-group"><input type="email" style="font-size:16px;" class="form-control form-control-user" v-model="createCompanyAccount.email" name="email" placeholder="Email" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Email" required></div>
                                        <p id="companyEmailError"></p>
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="createCompanyAccount.phone" name="phone" placeholder="Phone" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Phone" required></div>
                                        <p id="companyPhoneError"></p>
                                        <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="createCompanyAccount.password" name="password" placeholder="Password" min="5" max="20" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Password" required></div>
                                        <p id="companyPasswordError"></p>
                                        <div class="form-group"><input type="password" style="font-size:16px;" class="form-control form-control-user" v-model="createCompanyAccount.rePassword" name="retypePassword" placeholder="Retype Password" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Retype Password" required></div>
                                        <p id="companyRetypePasswordError"></p>
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="createCompanyAccount.companyName" name="companyName" placeholder="Company Name" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Company Name" required></div>
                                        <p id="companyNameError"></p>
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" id="companyAddrs" v-model="createCompanyAccount.companyAddress" name="companyAddress" placeholder="Company Address" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Company Address" required></div>
                                        <p id="companyAddressError"></p>
                                        What is your first Teacher's Name? (Remember your Teacher's Name when you forget your password. Do not share with anybody.)
                                        <div class="form-group"><input type="text" style="font-size:16px;" class="form-control form-control-user" v-model="createCompanyAccount.firstTeacherName" name="companyfirstTeachersName" placeholder="Teacher's Name" @keyup.enter="enterButtonPressed('company',0)" data-toggle="tooltip" data-placement="top" title="Teacher's Name" required></div>
                                        <p id="companyTeacherNameError"></p>
                                        <p id="companyErrorOccurred"></p>
                                        
                                    </div>
                                    <input id="termsAndConditions" type="checkbox">
                                    <label style="font-size:14px;"> I accept </label><a href=""> Terms and Conditions</a><br>
                                    <p id="termsError"></p>

                                    <div style="height:10px;"></div>
                                    <button style="font-size:16px;" class="btn btn-primary btn-block text-white btn-user" @click.prevent="createAccount()" :disabled="submitClicked" name="submit_button">Create Account</button>
                                    <div style="height:10px;"></div>
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

        data() {
            return{
                submitCircularHasNoError: true,
                submitClicked: false,
                jobtypes:[],
                selectedRegistrationForm: 'userRegistration',
                createUserAccount: { 
                    'name': '',
                    'gender': '',
                    'jobtypeid': '',
                    'email': '',
                    'phone': '',
                    'placeOfBirth': '',
                    'password': '',
                    'rePassword': '',
                    'firstTeacherName': '',
                    'selectedRegistrationForm': '',
                },
                createCompanyAccount: { 
                    'email': '',
                    'phone': '',
                    'password': '',
                    'rePassword': '',
                    'companyName': '',
                    'companyAddress': '',
                    'firstTeacherName': '',
                    'selectedRegistrationForm': '',
                },
                interval: 0,
            }
        },

        mounted() {
            $("#divWithData").hide();
            $(document).ready(function(){
                $("#companyRegistration").hide();
            });
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("Sign Up");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavSignUp']").addClass('active');
            },

            enterButtonPressed(submitTo,value){
                if(submitTo == "user" && this.interval == value){
                    this.selectedRegistrationForm = "userRegistration";
                    this.createAccount();
                }
                else if(submitTo == "company" && this.interval == value){
                    this.selectedRegistrationForm = "companyRegistration";
                    this.createAccount();
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
                        if(this.userType == "user" || this.userType == "companyUser"){
                            this.$router.push('/');
                        }
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                this.getJobtypesData();
            },

            async getJobtypesData() {
                $("#jobtypeError").html("");
                try{
                    await axios.get('/api/home/jobtype').then((response) => {
                        if(response.data[0].id){
                            this.jobtypes = response.data;
                            $("#jobtypeError").html("");
                        }
                        else if(response.data == "data not found"){
                            $("#jobtypeError").append("<p style='color:#ff4d4d'>Data not found!</p>");
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

            selectedGender(event){
                this.createUserAccount['gender'] = event.target.value;
            },

            selectedUserSkill(event){
                //console.log(event.target.value);
                this.createUserAccount['jobtypeid'] = event.target.value;
            },

            selectedRegistration(event){
                if(event.target.value == "companyRegistration"){
                    $("#companyRegistration").show();
                    $("#userRegistration").hide();
                    this.selectedRegistrationForm = "companyRegistration";
                    
                }
                else{
                    $("#companyRegistration").hide();
                    $("#userRegistration").show();
                    this.selectedRegistrationForm = "userRegistration";
                }
            },

            createAccount(){
                this.interval = 1;
                this.submitClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.submitClicked = false;
                }.bind(this),1000);

                if(this.selectedRegistrationForm == "userRegistration"){

                    $("#userNameError").html("");
                    $("#userGenderError").html("");
                    $("#jobtypeError").html("");
                    $("#userPasswordError").html("");
                    $("#userRetypePasswordError").html("");
                    $("#errorOccurred").html("");
                    $("#userPlaceofBirth").html("");
                    $("#termsError").html("");
                    $("#userPhoneError").html("");
                    $("#userTeacherNameError").html("");

                    
                    var input = this.createUserAccount;
                    input['selectedRegistrationForm'] = this.selectedRegistrationForm;
                    if (input['name'] == '' ||
                        input['gender'] == '' ||
                        input['jobtypeid'] == '' ||
                        input['password'] == '' ||
                        input['rePassword'] == '' ||
                        input['placeOfBirth'] == '' ||
                        input['placeOfBirth'].length <= 14 ||
                        input['placeOfBirth'].length > 100 ||
                        input['password'].length < 5 || 
                        input['password'].length > 20 ||
                        (input['password'] != input['rePassword']) ||
                        input['firstTeacherName'] == '' ||
                        input['firstTeacherName'].length < 4 ||
                        $("#termsAndConditions").prop("checked") != true
                        ) {
                            console.log(input);
                        this.submitCircularHasNoError = false;
                        if(input['name'] == ''){
                            $("#userNameError").append("<p style='color:#ff4d4d'>Please enter a name</p>");
                        }
                        if(input['gender'] == ''){
                            $("#userGenderError").append("<p style='color:#ff4d4d'>Please enter a gender</p>");
                        }
                        if(input['firstTeacherName'] == ''){
                            $("#userTeacherNameError").append("<p style='color:#ff4d4d'>Please enter Teacher's name</p>");
                        }
                        if(input['firstTeacherName'].length < 4){
                            $("#userTeacherNameError").append("<p style='color:#ff4d4d'>Teacher's name is too small, Minimum 4 characters required.</p>");
                        }
                        if(input['jobtypeid'] == ''){
                            $("#jobtypeError").append("<p style='color:#ff4d4d'>Please select a skill</p>");
                        }
                        if(input['password'] == ''){
                            $("#userPasswordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                        }
                        if(input['rePassword'] == ''){
                            $("#userRetypePasswordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                        }
                        if(input['password'] != input['rePassword']){
                            $("#userRetypePasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                        }
                        if(input['placeOfBirth'] == ''){
                            $("#userPlaceofBirth").append("<p style='color:#ff4d4d'>Please enter a place of birth</p>");
                        }
                        if(input['placeOfBirth'].length <= 14){
                            $("#userPlaceofBirth").append("<p style='color:#ff4d4d'>Place of birth is too small, Minimun 15 characters required.</p>");
                        }
                        if(input['placeOfBirth'].length > 100){
                            $("#userPlaceofBirth").append("<p style='color:#ff4d4d'>Place of birth is too big, Maximum 100 characters required.</p>");
                        }
                        if(input['password'].length < 5){
                            $("#userPasswordError").append("<p style='color:#ff4d4d'>Password is too small, Minimum 5 characters required.</p>");
                        }
                        if(input['password'].length > 20){
                            $("#userPasswordError").append("<p style='color:#ff4d4d'>Password is too big, Maximum 20 characters required.</p>");
                        }
                        if($("#termsAndConditions").prop("checked") != true){
                            $("#termsError").append("<p style='color:#ff4d4d'>Please select this option</p>");
                        }
                    }
                    else{
                        if(input['email'] == '' && input['phone'] == ''){
                            this.submitCircularHasNoError = false;
                            $("#userEmailError").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                            $("#userPhoneError").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                        }
                        else{
                            if(input['password'] != input['rePassword']){
                                this.submitCircularHasNoError = false;
                                $("#userRetypePasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                            }
                            else{
                                if($("#termsAndConditions").prop("checked") == true){
                                    this.submitCircularHasNoError = true;
                                    try{
                                        axios.post('/api/home/createaccount', input)
                                            .then((response) => {
                                                if(response.data == "email or phone anyone required error"){
                                                    $("#userEmailError").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                                                    $("#userPhoneError").append("<p style='color:#ff4d4d'>Please enter a email or a phone</p>");
                                                }
                                                else if(response.data == "Teacher's name minimum 4 characters requiured"){
                                                    $("#userTeacherNameError").append("<p style='color:#ff4d4d'>Teacher's name is too small, Minimum 4 characters required.</p>");
                                                }
                                                else if(response.data == "place of birth is too small"){
                                                    $("#userPlaceofBirth").append("<p style='color:#ff4d4d'>Place of birth is too small, Minimun 15 characters required.</p>");
                                                }
                                                else if(response.data == "place of birth is too big"){
                                                    $("#userPlaceofBirth").append("<p style='color:#ff4d4d'>Place of birth is too big, Maximum 100 characters required.</p>");
                                                }
                                                else if(response.data == "password is too small"){
                                                    $("#userPasswordError").append("<p style='color:#ff4d4d'>Password is too small, Minimum 5 characters required.</p>");
                                                }
                                                else if(response.data == "password is too big"){
                                                    $("#userPasswordError").append("<p style='color:#ff4d4d'>Password is too big, Maximum 20 characters required.</p>");
                                                }
                                                else if(response.data == "email used error"){
                                                    $("#userEmailError").append("<p style='color:#ff4d4d'>Email already used!</p>");  
                                                }
                                                else if(response.data == "not a valid email error"){
                                                    $("#userEmailError").append("<p style='color:#ff4d4d'>Email is not valid</p>");
                                                }
                                                else if(response.data == "phone used error"){
                                                    $("#userPhoneError").append("<p style='color:#ff4d4d'>Phone already used</p>");
                                                }
                                                else if(response.data == "password did not match error"){
                                                    $("#userRetypePasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                                                }
                                                else if(response.data == "server error"){
                                                    $("#errorOccurred").append("<p style='color:#ff4d4d'>Error occurred</p>");
                                                }
                                                else if(response.data == "success"){
                                                    this.createUserAccount = { 
                                                        'name': '',
                                                        'gender': '',
                                                        'jobtypeid': '',
                                                        'password': '',
                                                        'rePassword': '',
                                                        'email': '',
                                                        'phone': '',
                                                        'placeOfBirth': ''
                                                    };
                                                    swal.fire("<p style='font-size:22px;color:green;'>Congratulations!</p>", "<p style='font-size:18px;'>Account Created</p>");
                                                    // swal.fire("Congratulations!", "Account Created");
                                                    setTimeout(function(){
                                                        this.$router.push('/sign-in');
                                                    }.bind(this),2000);
                                                    
                                                }
                                        });
                                    }
                                    catch(e){
                                        console.log(e);
                                    }
                                }
                                else{
                                    $("#termsError").append("<p style='color:#ff4d4d'>Please select this option</p>");
                                }
                            }
                        }
                    }
                }
                else if(this.selectedRegistrationForm == "companyRegistration"){
                    
                    $("#companyEmailError").html("");
                    $("#companyPhoneError").html("");
                    $("#companyPasswordError").html("");
                    $("#companyRetypePasswordError").html("");
                    $("#companyNameError").html("");
                    $("#companyAddressError").html("");
                    $("#companyErrorOccurred").html("");
                    $("#termsError").html("");
                    $("#companyTeacherNameError").html("");


                    var input = this.createCompanyAccount;
                    input['selectedRegistrationForm'] = this.selectedRegistrationForm;
                    if (input['email'] == '' ||
                        input['phone'] == '' ||
                        input['password'] == '' ||
                        input['rePassword'] == '' ||
                        input['companyName'] == '' ||
                        input['companyAddress'] == '' ||
                        input['companyAddress'].length <= 14 ||
                        input['companyAddress'].length > 100 ||
                        input['password'].length < 5 ||
                        input['password'].length > 20 ||
                        (input['password'] != input['rePassword']) ||
                        input['firstTeacherName'] == '' ||
                        input['firstTeacherName'].length < 4 ||
                        $("#termsAndConditions").prop("checked") != true
                        ) {
                        this.submitCircularHasNoError = false;
                        if(input['email'] == ''){
                            $("#companyEmailError").append("<p style='color:#ff4d4d'>Please enter a email</p>");
                        }
                        if(input['phone'] == ''){
                            $("#companyPhoneError").append("<p style='color:#ff4d4d'>Please enter a phone</p>");
                        }
                        if(input['firstTeacherName'] == ''){
                            $("#companyTeacherNameError").append("<p style='color:#ff4d4d'>Please enter Teacher's name</p>");
                        }
                        if(input['firstTeacherName'].length < 4){
                            $("#companyTeacherNameError").append("<p style='color:#ff4d4d'>Teacher's name is too small, Minimum 4 characters required.</p>");
                        }
                        if(input['password'] == ''){
                            $("#companyPasswordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                        }
                        if(input['rePassword'] == ''){
                            $("#companyRetypePasswordError").append("<p style='color:#ff4d4d'>Please enter a password</p>");
                        }
                        if(input['password'] != input['rePassword']){
                            $("#companyRetypePasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                        }
                        if(input['companyName'] == ''){
                            $("#companyNameError").append("<p style='color:#ff4d4d'>Please enter a name</p>");
                        }
                        if(input['companyAddress'] == ''){
                            $("#companyAddressError").append("<p style='color:#ff4d4d'>Please enter address</p>");
                        }
                        if(input['companyAddress'].length <= 14){
                            $("#companyAddressError").append("<p style='color:#ff4d4d'>Address is too small, Minimum 15 characters required.</p>");
                        }
                        if(input['companyAddress'].length > 100){
                            $("#companyAddressError").append("<p style='color:#ff4d4d'>Address is too big, Maximum 100 characters required.</p>");
                        }
                        if(input['password'].length < 5){
                            $("#companyPasswordError").append("<p style='color:#ff4d4d'>Password is too small, Minimum 5 characters required.</p>");
                        }
                        if(input['password'].length > 20){
                            $("#companyPasswordError").append("<p style='color:#ff4d4d'>Password is too big, Maximum 20 characters required.</p>");
                        }
                        if($("#termsAndConditions").prop("checked") != true){
                            $("#termsError").append("<p style='color:#ff4d4d'>Please select this option</p>");
                        }
                    }
                    else{
                        if(input['password'] != input['rePassword']){
                            this.submitCircularHasNoError = false;
                            $("#companyRetypePasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                        }
                        else{
                            if($("#termsAndConditions").prop("checked") == true){
                                this.submitCircularHasNoError = true;
                                try{
                                    axios.post('/api/home/createaccount', input)
                                        .then((response) => {
                                            if(response.data == "email and phone required error"){
                                                $("#companyPhoneError").append("<p style='color:#ff4d4d'>Email and Phone both required</p>");
                                            }
                                            else if(response.data == "Teacher's name minimum 4 characters requiured"){
                                                $("#companyTeacherNameError").append("<p style='color:#ff4d4d'>Teacher's name is too small, Minimum 4 characters required.</p>");
                                            }
                                            else if(response.data == "address is too small"){
                                                $("#companyAddressError").append("<p style='color:#ff4d4d'>Address is too small, Minimum 15 characters required.</p>");
                                            }
                                            else if(response.data == "address is too big"){
                                                $("#companyAddressError").append("<p style='color:#ff4d4d'>Address is too big, Maximum 100 characters required.</p>");
                                            }
                                            else if(response.data == "password is too small"){
                                                $("#companyPasswordError").append("<p style='color:#ff4d4d'>Password is too small, Minimum 5 characters required.</p>");
                                            }
                                            else if(response.data == "password is too big"){
                                                $("#companyPasswordError").append("<p style='color:#ff4d4d'>Password is too big, Maximum 20 characters required.</p>");
                                            }
                                            else if(response.data == "email used error"){
                                                $("#companyEmailError").append("<p style='color:#ff4d4d'>Email already used</p>");
                                            }
                                            else if(response.data == "not a valid email error"){
                                                $("#companyEmailError").append("<p style='color:#ff4d4d'>Email is not valid</p>");
                                            }
                                            else if(response.data == "phone used error"){
                                                $("#companyPhoneError").append("<p style='color:#ff4d4d'>Phone already used</p>");
                                            }
                                            else if(response.data == "password did not match error"){
                                                $("#companyRetypePasswordError").append("<p style='color:#ff4d4d'>Password did not match</p>");
                                            }
                                            else if(response.data == "server error"){
                                                $("#companyErrorOccurred").append("<p style='color:#ff4d4d'>Error occurred</p>");
                                            }
                                            else if(response.data == "success"){
                                                this.createCompanyAccount = { 
                                                    'email': '',
                                                    'phone': '',
                                                    'password': '',
                                                    'rePassword': '',
                                                    'companyName': '',
                                                    'companyAddress': ''
                                                };
                                                swal.fire("<p style='font-size:22px;color:green;'>Congratulations!</p>", "<p style='font-size:18px;'>Account Created</p>");
                                                // swal.fire("Congratulations!", "Account Created");
                                                setTimeout(function(){
                                                    this.$router.push('/sign-in');
                                                }.bind(this),2000);
                                            }
                                    });
                                }
                                catch(e){
                                    console.log(e);
                                }
                            }
                            else{
                                $("#termsError").append("<p style='color:#ff4d4d'>Please select this option</p>");
                            }
                        }
                    }
                }
            }
            
        }
    }
</script>
