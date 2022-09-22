<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <div class="card-deck-wrapper">
                        <div class="card-deck">
                            <div class="card">
                                <img class="card-img-top" src="" alt="Card image cap">
                                <div class="card-block">
                                    <h4 class="card-title">About Us</h4>
                                    <p class="card-text">This is About component</p>
                                    <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                            <!-- This is About component -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            $("#theTitle").html("About Us");
            $('.container-fluid .nav-item .btn.active').removeClass('active');
            $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
            var activeNow = $("[name='navAbout'] .btn");
            activeNow.addClass('active');
            $("[name='sideNavAboutUs']").addClass('active');
            $("#hideForLongPages").hide();
        },
    }
</script>
