<template>
    <div>
        <div id="showDataTemplate">
            <div style="text-align:center;margin:0 auto;">
                <img style="height:100px;width:100px;" src="/loading_gif/4V0b.gif" alt="loading">
            </div>
            <div style="height:600px;">
            </div>
        </div>
        <div id="divWithData" class="iWantToHideScroll" style="overflow-x:auto;">
            <div class="container-fluid" style="width:100%;max-width:1000px;min-width:260px;margin:auto;">
                <div class="card shadow-lg o-hidden border-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col">
                                <div class="m-auto p-5 text-center">
                                    <div class="user" style="display:inline-block;font-size:16px;">
                                        <input type="hidden" v-model="userId">
                                        <h2 class="card-text">{{companyName}}</h2>
                                        <div style="height:50px;"></div>
                                        <div>
                                            <table style="text-align:left;width:100%;">
                                                <tr>
                                                    <td>Location</td>
                                                    <td style="width:50px;min-width:10px;"></td>
                                                    <td>{{companyAddress}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td style="width:50px;min-width:10px;"></td>
                                                    <td>{{userEmail}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td style="width:50px;min-width:10px;"></td>
                                                    <td>{{userPhone}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="height:600px;">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                userIdFromLink: this.$route.params.givencircid,
                userId: '',
                userIdS: '',
                userEmail: '',
                userPhone: '',
                userType: '',
                companyName: '',
                companyAddress: '',
                
            }
        },

        mounted() {
            $("#divWithData").hide();
            this.loadThispage();
            this.getUserData();
        },

        methods: {

            loadThispage(){
                $("#theTitle").html("About Me");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
                $("[name='sideNavAboutMe']").addClass('active');
                
                // var refresh = window.localStorage.getItem('refreshProfile');
                // console.log(refresh);
                // if(refresh == null || refresh != this.userIdFromLink){
                //     window.localStorage.setItem('refreshProfile', this.userIdFromLink);
                //     window.location.reload();
                // }
            },

            async getUserData(){
                try{
                    await axios.get('/api/home/companyuserinfo/' + this.userIdFromLink).then((response) => {
                        console.log(response);
                        //if(response.data[0].userIdS == "not signed/logged in user")
                        if(response.data == ""){
                            this.$router.push('*');
                        }
                        else if(response.data[0].userIdS != "not signed/logged in user" && response.data[0].userIdS != "normal user"){
                            // console.log(response);
                            this.userType = "companyUser";
                            this.userId = response.data[0].id;
                            this.userEmail = response.data[0].email;
                            this.userPhone = response.data[0].phone;
                            this.companyName = response.data[0].company_name;
                            this.companyAddress = response.data[0].company_address;
                            this.userIdS = response.data[0].userIdS;
                        }
                        else if(response.data[0].userIdS == "not signed/logged in user"){
                            this.$router.push('*');
                        }
                        else if(response.data[0].userIdS == "normal user"){
                            this.$router.push('*');
                        }
                        if(this.userType == "companyUser"){
                            if(this.userIdFromLink != response.data[0].userIdS && this.userType == "companyUser"){
                                this.circularLists = [];
                                this.usersPaymentLists = [];
                                this.$router.push('*');
                            }
                        }
                        
                        
                        // console.log(this.userType);
                        
                    });
                }
                catch(e){
                    console.log(e);
                }
                $("#showDataTemplate").hide();
                $("#divWithData").show();
            },

        }
    }
</script>
