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
                        <div class="row">
                            <div class="col" style="min-width:240px;">
                                <div class="m-auto p-5" style="font-size:16px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="font-size:25px;">Pay Using</h4>
                                    </div>
                                    <div class="user" style="vertical-align:middle;text-align:center;">
                                        <table style="text-align:left;margin-left:auto;margin-right:auto;">
                                            <tr>
                                                <td><input type="radio" name="paymentMethod" value="bkash" v-on:change="selectedPaymentMethod($event)" @keyup.enter="payUsingMobileBanking()"></td>
                                                <td style="width:5px;"></td>
                                                <td>bKash</td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="paymentMethod" value="nagad" v-on:change="selectedPaymentMethod($event)" @keyup.enter="payUsingMobileBanking()"></td>
                                                <td style="width:5px;"></td>
                                                <td>Nagad</td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="paymentMethod" value="rocket" v-on:change="selectedPaymentMethod($event)" @keyup.enter="payUsingMobileBanking()"></td>
                                                <td style="width:5px;"></td>
                                                <td>Rocket</td>
                                            </tr>
                                        </table>
                                        <p id="pleaseSelectAnOption"></p>
                                        <input id="termsAndConditions" type="checkbox">
                                        <label > I accept </label><a href=""> Pay Terms and Conditions</a>
                                        <p id="termsError"></p>
                                        <p id="serverError"></p>
                                        <a class="btn btn-primary" type="button" style="color:white;font-size:16px;" @click.prevent="payUsingMobileBanking()">Select</a>
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
                selectedPaymentMethodValue: '',
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
                $("#theTitle").html("Payment");
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
            },

            selectedPaymentMethod(event){
                this.selectedPaymentMethodValue = event.target.value;
            },

            payUsingMobileBanking(){
                $("#termsError").html("");
                $("#pleaseSelectAnOption").html("");
                // document.getElementById("termsError").innerHTML = "";
                if($("#termsAndConditions").prop("checked") != true ||
                    this.selectedPaymentMethodValue == "" ){
                // if(document.getElementById("termsAndConditions").checked != true){
                    if($("#termsAndConditions").prop("checked") != true){
                        $("#termsError").append("<p style='color:#ff4d4d'>Please select this option</p>");
                    }
                    if(this.selectedPaymentMethodValue == ""){
                        $("#pleaseSelectAnOption").append("<p style='color:#ff4d4d'>Please select an option</p>");
                    }
                    // document.getElementById("termsError").innerHTML = "Please select this option";
                }
                else if($("#termsAndConditions").prop("checked") == true && this.selectedPaymentMethodValue != ""){
                // else if(document.getElementById("termsAndConditions").checked == true){

                    // insert into useraccount that user accepted  terms and conditions

                    try{
                        axios.get('/api/home/acceptagreement').then((response) => {
                            if(response.data == "success"){
                                // console.log(response);
                                if(this.selectedPaymentMethodValue == "bkash"){
                                    // BkashPayment();
                                    this.$router.push('/pay-method-bkash');
                                }
                                else if(this.selectedPaymentMethodValue == "nagad"){
                                    
                                    this.$router.push('/pay-method-nagad');
                                }
                                else if(this.selectedPaymentMethodValue == "rocket"){
                                    
                                    this.$router.push('/pay-method-rocket');
                                }
                                else if(this.selectedPaymentMethodValue == ""){
                                    $("#pleaseSelectAnOption").append("<p style='color:#ff4d4d'>Please select an option</p>");
                                }
                            }
                            else if(response.data == "server error"){
                                $("#serverError").append("<p style='color:#ff4d4d'>Server error!</p>");
                                // document.getElementById("serverError").innerHTML = "Server error!";
                            }
                        });
                    }
                    catch(e){

                    }

                    
                }
                
            },

        }
    }
</script>
