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
                            <!-- iWantToHideScroll style="overflow-x:auto;" -->
                            <div class="col">
                                <div class="m-auto p-5 text-center">
                                    <div class="user" style="display:inline-block;font-size:16px;">
                                        <h4 class="card-title"><a v-if="IfPremiumUser == 'no'" href="/pay-method">Go Premium</a></h4>
                                        <h4 class="card-title"><a v-if="IfPremiumUser == 'yes'">Premium User</a></h4>
                                        <input type="hidden" v-model="userId">
                                        <h2 class="card-text">{{userName}}</h2>
                                        <div style="height:50px;"></div>
                                        <div>
                                            <table style="text-align:left;width:100%;">
                                                <tr>
                                                    <td>Gender</td>
                                                    <td style="width:50px;min-width:10px;"></td>
                                                    <td>{{userGender}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Skill</td>
                                                    <td style="width:50px;min-width:10px;"></td>
                                                    <td>{{userJobTypeName}}</td>
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
                                                <tr v-if="userIdFromLink == userIdS && userType == 'user'">
                                                    <td>Birth place</td>
                                                    <td style="width:50px;min-width:10px;"></td>
                                                    <td>{{userPlaceOfBirth}}</td>
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
                userName: '',
                userGender: '',
                userJobTypeId: '',
                userJobTypeName: '',
                userEmail: '',
                userPhone: '',
                userType: '',
                userPlaceOfBirth: '',
                IfPremiumUser: '',
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
                    await axios.get('/api/home/userinfo/' + this.userIdFromLink).then((response) => {
                        // console.log(response);
                        if(response.data == ""){
                            this.$router.push('*');
                        }
                        else if(response.data[0].id){
                            // console.log(response);
                            
                            if(response.data[0].userIdS != "companyUser" && response.data[0].userIdS != "not signed/logged in user"){
                                //if(response.data[0].userIdS == "not signed/logged in user") 
                                this.userType = "user";
                                this.userId = response.data[0].id;
                                this.userName = response.data[0].name;
                                this.userGender = response.data[0].gender;
                                this.userJobTypeId = response.data[0].job_type_id;
                                //this.userJobTypeName = 
                                this.userEmail = response.data[0].email;
                                this.userPhone = response.data[0].phone;
                                this.userPlaceOfBirth = response.data[0].place_of_birth;
                                this.userIdS = response.data[0].userIdS;
                                this.IfPremiumUser = response.data[0].premium_or_not;
                            }
                            else if(response.data[0].userIdS == "companyUser"){
                                this.$router.push('*');
                            }
                            else if(response.data[0].userIdS == "not signed/logged in user"){
                                this.$router.push('*');
                            }
                            if(this.userType == "user"){
                                if(response.data[0].userIdS != this.userIdFromLink && this.userType == "user"){
                                    this.userType = "";
                                    this.userId = "";
                                    this.userName = "";
                                    this.userGender = "";
                                    this.userJobTypeId = "";
                                    this.userEmail = "";
                                    this.userPhone = "";
                                    this.userIdS = "";
                                    this.IfPremiumUser = "";
                                    this.userPlaceOfBirth = "";
                                    this.$router.push('*');
                                }
                            }
                            axios.get('/api/home/jobtype/' + response.data[0].job_type_id ).then((responseJobtype) => {
                                if(responseJobtype.data[0].jobtype_name){
                                    this.userJobTypeName = responseJobtype.data[0].jobtype_name;
                                }
                                else if(responseJobtype.data == "no data found"){
                                    this.userJobTypeName = "";
                                }
                                
                            });
                            
                        }
                        
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
