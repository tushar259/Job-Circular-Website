@extends('layouts.app')
@section('content')
    
    <div>
        <!-- class="bg-white shadow" this 2 classes are removed from nav -->
        <!-- #04AA6D -->
        <!-- #e6e6e6 -->
        <nav class="navbar navbar-light navbar-expand mb-4 topbar static-top" style="background-color:#04AA6D;height:65px;">
            

                    <div class="nav-item">
                        <a class="nav-link" href="/"><img src="" alt="logo"></a>
                    </div>
                    <div class="d-none d-sm-block topbar-divider" style="opacity:0;"></div>
                    
                    <div class="d-none d-sm-block nav-item" name="navHome" role="presentation">
                    <!-- <span class="d-lg-inline text-gray-600 small">Home</span> -->
                        <a class="nav-link btn" style="font-size:20px;" href="/" exact><span class="d-lg-inline small" style="color:white;">Home</span></a>
                    </div>
                    <div class="d-none d-sm-block nav-item" name="navAbout" role="presentation">
                        <a class="nav-link btn" style="font-size:20px;" href="/about-us" ><span class="d-lg-inline small" style="color:white;">About Us</span></a>
                    </div>
                    <div class="d-none d-sm-block nav-item" name="navCircularList" role="presentation">
                        <a class="nav-link btn" style="font-size:20px;" href="/circular-list" ><span class="d-lg-inline small" style="color:white;">Circular List</span></a>
                    </div>
                    @if(session('userType')=="user")
                    <div class="d-none d-sm-block nav-item" name="navCompanyList" role="presentation">
                        <a class="nav-link btn" style="font-size:20px;" href="/user-company-profiles"><span class="d-lg-inline small" style="color:white;">Company List</span></a>
                    </div>
                    @elseif(session('userType')=="companyUser")
                    <div class="d-none d-sm-block nav-item" name="navUserList" role="presentation">
                        <a class="nav-link btn" style="font-size:20px;" href="/user-company-profiles"><span class="d-lg-inline small" style="color:white;">User List</span></a>
                    </div>
                    @endif
                
                    <ul class="nav navbar-nav flex-nowrap ml-auto" style="padding-right:10px;text-align:left;">
                        <div id="addAButtonIfPremiumOrNot" class="nav-item" name="navPremiumOrNot" role="presentation">
                            
                        </div>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        @if(session('userType')=="user")
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-lg-inline mr-2 small" style="color:white;">{{session('usersName')}}</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
                                    role="menu" style="width:170px;font-size:12px;">

                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavHome" role="presentation" href="/" exact><i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Home</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavAboutUs" role="presentation" href="/about-us"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;About Us</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavCircularList" role="presentation" href="/circular-list"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Circular List</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavHomeCompanyList" role="presentation" href="/user-company-profiles"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Company List</a>

                                        
                                        <div class="d-md-none d-lg-none d-xl-none dropdown-divider"></div>

                                    <a class="dropdown-item" name="sideNavProfile" role="presentation" href="/profile/{{session('userId')}}/0a3i-15k04cn27=l103rt83-25jkx4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                    <a class="dropdown-item" name="sideNavAboutMe" role="presentation" href="/about-me/{{session('userId')}}/0a3i-15k04cn27=l103rt83-25jkx4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;About Me</a>
                                    <a class="dropdown-item" name="sideNavPaymentHistory" role="presentation" href="/payment-history"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Payment History</a>
                                    <a class="dropdown-item" name="sideNavEditProfile" role="presentation" href="/edit-profile/0a3i-15k04cn27=l103rt83-25jkx4"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile</a>
                                    <a class="dropdown-item" name="sideNavChangePassword" role="presentation" href="/change-password/0a3i-15k04cn27=l103rt83-25jkx4"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Change Password</a>

                                        <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" role="presentation" href="/sign-out"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Sign Out</a>
                                </div>
                            </div>
                        </li>
                        @elseif(session('userType')=="companyUser")
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-lg-inline mr-2 small" style="color:white;">{{session('usersName')}}</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
                                    role="menu" style="width:170px;font-size:12px;">
                                    
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavHome" role="presentation" href="/" exact><i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Home</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavAboutUs" role="presentation" href="/about-us"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;About Us</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavCircularList" role="presentation" href="/circular-list"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Circular List</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavHomeUserList" role="presentation" href="/user-company-profiles"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;User List</a>

                                        
                                        <div class="d-md-none d-lg-none d-xl-none dropdown-divider"></div>
                                    
                                    
                                    <a class="dropdown-item" name="sideNavProfile" role="presentation" href="/profile/{{session('userId')}}/0a5ci=159t04cn27-l3jsvm3rt83-y6"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                    <a class="dropdown-item" name="sideNavAboutMe" role="presentation" href="/about-company/{{session('userId')}}/0a5ci=159t04cn27-l3jsvm3rt83-y6"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;About Me</a>
                                    <a class="dropdown-item" name="sideNavEditProfile" role="presentation" href="/edit-profile/0a5ci=159t04cn27-l3jsvm3rt83-y6"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Edit Profile</a>
                                    <a class="dropdown-item" name="sideNavChangePassword" role="presentation" href="/change-password/0a5ci=159t04cn27-l3jsvm3rt83-y6"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Change Password</a>
                                    
                                        <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" role="presentation" href="/sign-out"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Sign Out</a>
                                </div>
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown no-arrow" role="presentation">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-lg-inline small" style="font-size:12px;color:white;">Sign in/Create account</span></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
                                    role="menu" style="width:170px;font-size:12px;" >

                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavHome" role="presentation" href="/" exact><i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Home</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavAboutUs" role="presentation" href="/about-us"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;About Us</a>
                                    <a class="d-md-none d-lg-none d-xl-none dropdown-item" name="sideNavCircularList" role="presentation" href="/circular-list"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Circular List</a>

                                        
                                        <div class="d-md-none d-lg-none d-xl-none dropdown-divider"></div>


                                    <a class="dropdown-item" name="sideNavSignIn" role="presentation" href="/sign-in">&nbsp;Sign in</a>
                                    <a class="dropdown-item" name="sideNavSignUp" role="presentation" href="/sign-up">&nbsp;Create account</a>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                    
            
        </nav>


        <!-- <router-link to="/" exact>Home</router-link>
        <router-link to="/about-us">About</router-link>
        <router-link to="/circular-list">Circular List</router-link>
        {{session('userType')}}
        @if(session('userType')=="user")
        <a href="/user-company-profiles">Company List</a>
        <a href="/profile/{{session('userId')}}/0a3i-15k04cn27=l103rt83-25jkx4">Profile</a>
        <a href="/about-me/{{session('userId')}}/0a3i-15k04cn27=l103rt83-25jkx4">About Me</a>
        <router-link to="/edit-profile/0a3i-15k04cn27=l103rt83-25jkx4">EDIT PROFILE</router-link>
        <router-link to="/change-password/0a3i-15k04cn27=l103rt83-25jkx4">Change Password</router-link>
        <router-link to="/payment-history">Payment History</router-link>
        <router-link to="/sign-out">Sign Out</router-link>
        @elseif(session('userType')=="companyUser")
        <a href="/user-company-profiles">Users List</a>
        <a href="/profile/{{session('userId')}}/0a5ci=159t04cn27-l3jsvm3rt83-y6">Profile</a>
        <a href="/about-company/{{session('userId')}}/0a5ci=159t04cn27-l3jsvm3rt83-y6">About Me</a>
        <router-link to="/edit-profile/0a5ci=159t04cn27-l3jsvm3rt83-y6">EDIT PROFILE</router-link>
        <router-link to="/change-password/0a5ci=159t04cn27-l3jsvm3rt83-y6">Change Password</router-link>
        <router-link to="/sign-out">Sign Out</router-link>
        @else
        <router-link to="/sign-up">Sign up</router-link>
        <router-link to="/sign-in">Sign in</router-link>
        @endif -->
        
    </div>
    
    <div>
        <router-view></router-view>
    </div>
        
@endsection
