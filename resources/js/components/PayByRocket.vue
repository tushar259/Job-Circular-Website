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
            <div class="container-fluid iWantToHideScroll" style="overflow-x:auto;">
                <div class="card shadow-lg o-hidden border-0" style="width:100%;max-width:1000px;min-width:230px;margin:auto;">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col" style="min-width:230px;">
                                <div class="m-auto p-5" style="font-size:16px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="font-size:25px;">Pay Using Rocket</h4>
                                        Follow the steps given below. <br>
                                        <p>*Please note that, To become a premium user you need to pay exact 100 taka only.*</p>
                                    </div>
                                    <div class="user" style="text-align:left;">
                                        <div style="height:50px;"></div>
                                        <b>Step 1:</b> Install "Rocket" from "Play Store" or "App Store" in your Android device or Apple device <br>
                                        <b>Step 2:</b> Open "Rocket" Application. <br>
                                        <b>Step 3:</b> Click to "Send Money".
                                        <ul style="list-style: none;"><li><img src="rocket_screenshots\1.png" height="420" width="250" alt="send money rocket"></li></ul>
                                        <b>Step 4:</b> Write this "01629425153" number, then click the red marked button.
                                        <ul style="list-style: none;"><li><img src="rocket_screenshots\2.png" height="310" width="250" alt="send money rocket"></li></ul>
                                        <b>Step 5:</b> Write amount "100", then click the red marked button
                                        <ul style="list-style: none;"><li><img src="rocket_screenshots\3.png" height="320" width="250" alt="send money rocket"></li></ul>
                                        <b>Step 6:</b> Enter your PIN, then click the red marked button.
                                        <ul style="list-style: none;"><li><img src="rocket_screenshots\4.png" height="420" width="250" alt="send money rocket"></li></ul>
                                        <b>Step 7:</b> <input type="text" v-model="transactionIdOrPhone" placeholder="Enter your Rocket number" @keyup.enter="enterButtonPressed(0)">
                                        <p id="transactionError"></p>
                                        <b>Step 8:</b> <input type="number" v-model="amountPaid" placeholder="Enter amount you paid" @keyup.enter="enterButtonPressed(0)">
                                        <p id="amountError"></p>

                                        <input id="termsAndConditions" type="checkbox">
                                        <label > I accept </label><a href=""> Pay Terms and Conditions</a><br><br>
                                        <p id="termsError"></p>
                                        <p id="submitError"></p>
                                        <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" @click.prevent="confirmPayment()" :disabled="submitClicked">Confirm Payment</a>
                                    
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
                transactionIdOrPhone: '',
                amountPaid: '',
                reference: '',
                submitClicked: false,
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

        methods:{

            loadThispage(){
                $("#theTitle").html("Pay By Rocket");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                
            },

            enterButtonPressed(value){
                if(this.interval == value){
                    this.confirmPayment();
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
                        if(this.userType != "user"){
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
            },

            confirmPayment(){
                this.interval = 1;
                this.submitClicked = true;
                setTimeout(function(){
                    this.interval = 0;
                    this.submitClicked = false;
                }.bind(this),1000);

                $("#transactionError").html("");
                $("#amountError").html("");
                $("#termsError").html("");
                $("#submitError").html("");

                // document.getElementById("transactionError").innerHTML = "";
                // document.getElementById("amountError").innerHTML = "";
                // document.getElementById("termsError").innerHTML = "";
                // document.getElementById("submitError").innerHTML = "";

                if(this.transactionIdOrPhone == "" ||
                   this.amountPaid == "" ||
                   $("#termsAndConditions").prop("checked") != true
                //    document.getElementById("termsAndConditions").checked != true
                ){
                    if(this.transactionIdOrPhone == ""){
                        $("#transactionError").append("<p style='color:#ff4d4d'>Please enter your Transaction ID or Phone from your Rocket account</p>");
                        // document.getElementById("transactionError").innerHTML = "Please enter your Transaction ID or Phone from your bKash account";
                    }
                    if(this.amountPaid == ""){
                        $("#amountError").append("<p style='color:#ff4d4d'>Please enter the amount you paid</p>");
                        // document.getElementById("amountError").innerHTML = "Please enter the amount you paid";
                    }
                    if($("#termsAndConditions").prop("checked") != true){
                    // if(document.getElementById("termsAndConditions").checked != true){
                        $("#termsError").append("<p style='color:#ff4d4d'>Please select this option to confirm payment</p>");
                        // document.getElementById("termsError").innerHTML = "Please select this option to confirm payment";
                    }
                }
                else{

                    var insertData = {
                        'transactionIdOrPhone': this.transactionIdOrPhone,
                        'amountPaid': this.amountPaid,
                        'reference': this.userIdS+"--byDefault",
                        'application': 'rocket'
                    };

                    try{
                        axios.post('/api/home/userpaidamount', insertData).then((response) => {
                            if(response.data == "success"){
                                this.$router.push('/payment-history');
                                // console.log(response);
                            }
                            else if(response.data == "transaction empty"){
                                $("#transactionError").append("<p style='color:#ff4d4d'>Please enter your Transaction ID or Phone from your Rocket account</p>");
                                // document.getElementById("transactionError").innerHTML = "Please enter your Transaction ID or Phone from your bKash account";
                            }
                            else if(response.data == "amount empty"){
                                $("#amountError").append("<p style='color:#ff4d4d'>Please enter the amount you paid</p>");
                                // document.getElementById("amountError").innerHTML = "Please enter the amount you paid";          
                            }
                            else if(response.data == "reference empty"){
                                $("#submitError").append("<p style='color:#ff4d4d'>Server error</p>");
                                // document.getElementById("submitError").innerHTML = "Server error";                                
                            }
                            else if(response.data == "something went wrong"){
                                $("#submitError").append("<p style='color:#ff4d4d'>Something went wrong!</p>");
                                // document.getElementById("submitError").innerHTML = "Something went wrong!";                                
                            }
                            else if(response.data == "user already paid"){
                                $("#submitError").append("<p style='color:#ff4d4d'>User already paid</p>");
                                // document.getElementById("submitError").innerHTML = "User already paid"; 
                            }
                            else if(response.data == "server error"){
                                $("#submitError").append("<p style='color:#ff4d4d'>Server error</p>");
                                // document.getElementById("submitError").innerHTML = "Server error"; 
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
