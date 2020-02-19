<!doctype html>
<html lang="en">
<head>
    <title>Internship Management System</title>
    <link rel="icon" href="{{ asset('img/system_icon.png') }}"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin_layout_style.css') }}">
    @yield('stylesheet')

</head>
<body>
<?php
if(!session()->has('side_bar')){
    session(['side_bar'=>'open']);
}
if(!session()->has('sidebar_dropdown')){
    session(['sidebar_dropdown'=>'close']);
}

if(!session()->has('sidebar_dropdown_manage_account')){
    session(['sidebar_dropdown_manage_account'=>'close']);
}

if(!session()->has('sidebar_dropdown_manage_appraisal')){
    session(['sidebar_dropdown_manage_appraisal'=>'close']);
}

?>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav class="{{session('side_bar')=='open'?'':'active'}}" id="sidebar">
        <div class="sidebar-header">
            <div class="img_profile_container img-wrapper" >

                <img class="rounded rounded-circle mx-auto d-block" id="img_profile" src="{{ asset(Auth::user()->photo) }}" alt="profile picture">
{{--                <img class="rounded rounded-circle mx-auto d-block" id="img_profile" src="{{ asset('img/woman_profile_icon.png') }}" alt="profile picture">--}}
{{--                <form name="profileForm" action="{{ Auth::user()->id }}/submit_profile" method="post" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <input type="file" id="img_user" name="submit_image" style="display:none;">--}}
{{--                </form>--}}

                <a id="camera_icon_container" class="rounded rounded-circle img-overlay" onclick='document.getElementById("img_user").click()'>

                    <i id="camera_icon" class="fas fa-camera"></i>
                </a>
                <!-- <input type="button" value="Select" onclick="document.getElementById('img_user').click()"> -->
            </div>
            <div class="text-center sideber-text mt-3 mb-0">
                <div style="font-size: 18px; font-weight: bold;">{{Auth::user()->first_name.' '.Auth::user()->last_name }}</div>
                <div style="font-style: italic; display: block;">{{Auth::user()->type }}</div>
                <div id="emailInfo" style="display: none;">{{Auth::user()->email }}</div>

                <div id="btnShowMoreInfo" title="show more profile information">
                    <i class="fas fa-caret-down"></i>
                </div>
            </div>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="/trainer/dashboard">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a id="btnManageAccount" href="#subMenuManageAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="material-icons">people_outline</i>
                    Manage Accounts
                </a>
                <ul class="collapse list-unstyled {{ session('sidebar_dropdown_manage_account') === 'open'?'show':'' }}" id="subMenuManageAccount">
                    <li>
                        <a href="#">
                            <i class="material-icons">
                                format_list_bulleted
                            </i>
                            <span>Accounts List</span>
                        </a>
                    </li>
                    @if(Auth::user()->type == 'Admin')
                        <li>
                            <a href="/trainer/create_account">
                                <i class="material-icons">
                                    person_add
                                </i>
                                <span>Create Account</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li>
                <a id="btnManageAppraisal" href="#subMenuManageAppraisal" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="material-icons">
                        insert_chart
                    </i>
                    Manage Appraisal
                </a>
                <ul class="collapse list-unstyled {{ session('sidebar_dropdown_manage_appraisal') === 'open'?'show':'' }}" id="subMenuManageAppraisal">
                    <li>
                        <a href="#">
                            <i class="material-icons">
                                format_list_bulleted
                            </i>
                            <span>Appraisal List</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="material-icons">
                                post_add
                            </i>
                            <span>Make Appraisal</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a id="btnSetting" href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user-cog"></i>
                    Setting
                </a>
                {{--                    <ul class="{{ session('sidebar_dropdown') === 'close'?'list-unstyled​collapse':'list-unstyled​collapse show' }}" id="homeSubmenu">--}}
                <ul class="collapse list-unstyled {{ session('sidebar_dropdown') === 'open'?'show':'' }}" id="homeSubmenu">
                    <li>
                        <a href="/account/edit">
                            <i class="fas fa-user-edit"></i>
                            <span>Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-key"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="#">
                    <div class="btn btn-outline-light">Profile</div>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="article" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Sign out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info rounded rounded-circle d-flex align-items-center align-self-center">
                    <i class="fa fa-chevron-{{ session('side_bar') == 'open'?'left':'right' }}"></i>
                </button>
                <div style="margin-left: 5px; font-size: 18px;">
                    @yield('section_title', 'Internship Management System')
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <!-- choose upload option Modal -->
            <div class="modal fade" id="chooseUploadOptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Upload Option</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            How many pictures you want to upload?
                        </div>
                        <div class="modal-footer align-self-center">

                            <a href='/admin/upload_single_picture'>
                                <button  type="button" class="btn btn-primary">Single Picture</button>
                            </a>

                            <a href="/admin/upload_multiple_pictures">
                                <button type="button" class="btn btn-primary">Multiple Pictures</button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://kit.fontawesome.com/8d4428d323.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');

            class_name = $('#sidebar').attr('class');
            // console.log('class name = ' + class_name)
            if(class_name === 'active'){
                $('#sidebarCollapse > i').attr('class', 'fa fa-chevron-right');
                update_session('side_bar', 'close')
            }else{
                $('#sidebarCollapse > i').attr('class', 'fa fa-chevron-left');
                update_session('side_bar', 'open')
            }

        });

        $('#btnSetting').on('click', function () {

            // class_name = $('#homeSubmenu').attr('class');
            // console.log(class_name)
            if($('#homeSubmenu').hasClass('show')){
                update_session('sidebar_dropdown', 'close')
            }else{
                update_session('sidebar_dropdown', 'open')
            }
        });

        $('#btnManageAccount').on('click', function () {

            // class_name = $('#subMenuManageAccount').attr('class');
            // console.log(class_name)
            if($('#subMenuManageAccount').hasClass('show')){
                update_session('sidebar_dropdown_manage_account', 'close')
            }else{
                update_session('sidebar_dropdown_manage_account', 'open')
            }
        });

        $('#btnManageAppraisal').on('click', function () {

            if($('#subMenuManageAccount').hasClass('show')){
                update_session('sidebar_dropdown_manage_appraisal', 'close')
            }else{
                update_session('sidebar_dropdown_manage_appraisal', 'open')
            }
        });

        // button show more info
        $('#btnShowMoreInfo').click(function () {
            if($('#btnShowMoreInfo > i').attr('class') === 'fas fa-caret-down'){
                $('#btnShowMoreInfo').attr('title', 'hide profile information');

                $('#emailInfo').attr('style', 'display: block;');
                $('#btnShowMoreInfo > i').attr('class', 'fas fa-caret-up');
            }else{
                $('#btnShowMoreInfo').attr('title', 'show more profile information');

                $('#emailInfo').attr('style', 'display: none;');
                $('#btnShowMoreInfo > i').attr('class', 'fas fa-caret-down');
            }
        });

        function update_session(session_name, session_value){
            console.log("session name : " + session_name)
            console.log("session value : " + session_value)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/update_session',
                type: 'post',
                data: {
                    session_name:session_name,
                    session_value:session_value,
                },
                success:function (data) {
                    console.log(data)
                },
                error: function (data) {
                    console.log('error retrieving data')
                }
            });
        }

        // $('input[name="submit_image"]').change(function () {
        //     $('form[name="profileForm"]').submit();
        // });


        @yield('script')
    });
</script>
@yield('javascript')

</body>
</html>
