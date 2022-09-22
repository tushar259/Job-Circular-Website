<template>
    <div>
        <div class="container-fluid">
            <div style="height:100px;"></div>
            <div style="text-align:center;font-size:20px;">
                Signing out...
            </div>
            <div style="height:600px;"></div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.loadThispage();
            this.singoutFunction();
        },

        methods:{

            loadThispage(){
                $("#theTitle").html("Sign Out");
                $('.container-fluid .nav-item .btn.active').removeClass('active');
                $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
            },

            singoutFunction(){
                axios.get('/api/home/callsignout').then((response) => {
                    console.log(response);
                    if(response.data == "success"){
                        window.localStorage.setItem('refresh', "");
                        this.$router.push('/');
                    }
                    else if(response.data == "server error"){
                        window.localStorage.setItem('refresh', "");
                        this.$router.back();
                    }
                    else{
                        window.localStorage.setItem('refresh', "");
                        this.$router.push('/');
                    }
                        
                });
            }
        }
    }
</script>
