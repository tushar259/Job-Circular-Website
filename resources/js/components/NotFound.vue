<template>

    <div class="absolute" style="text-align:center;font-size:20px;">
        <div style="height:170px;"></div>
        404 ERROR<br>
        Page Not Found!<br>
    </div>
</template>

<script>
    export default {
        mounted() {
            $("#theTitle").html("Not Found");
            $('.container-fluid .nav-item .btn.active').removeClass('active');
            $('.container-fluid .navbar-nav .nav-item .dropdown-menu .dropdown-item.active').removeClass('active');
        },
    }
</script>