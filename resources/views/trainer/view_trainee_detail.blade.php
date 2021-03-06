@extends('trainer.layout')
@section('stylesheet')
    <style>
        body{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }
        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 70%;
            height: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .profile-edit-btn{
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>
@endsection
@section('content')
    <?php
        if(!session()->has('trainee_detail_tab')){
            session(['trainee_detail_tab'=>'about']);
        }
    ?>

    <div class="container emp-profile">

        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="{{asset($trainee->photo)}}" alt=""/>
                </div>
            </div>
            <div class="col-md-7">
                <div class="profile-head">
                    <h5>
                        <b>
                        {{ $trainee->first_name.' '.$trainee->last_name }}
                        </b>
                    </h5>
                    <h6>
                        {{$trainee->type}}
                    </h6>
                    @if($traineeInfo != null)
                        <?php
                        session(['trainee_detail_tab'=>'about']);
                        ?>
                        <p class="proile-rating">CONTRACT : {{ $traineeInfo->contract_start.' -> '.$traineeInfo->contract_end }}</p>
                    @endif
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{session('trainee_detail_tab')=='about'?'active':''}}" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
                        </li>
                        @if($traineeInfo != null)
                        <li class="nav-item">
                            <a class="nav-link {{session('trainee_detail_tab')=='more'?'active':''}}" id="more-tab" data-toggle="tab" href="#more" role="tab" aria-controls="more" aria-selected="false">More</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade {{session('trainee_detail_tab')=='about'?'show active':''}}" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <label>First name</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $trainee->first_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Last name</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $trainee->last_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Sex</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $trainee->sex }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $trainee->phone }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $trainee->email }}</p>
                            </div>
                        </div>
                    </div>


                    @if($traineeInfo != null)
                    <div class="tab-pane fade {{session('trainee_detail_tab')=='more'?'show active':''}}" id="more" role="tabpanel" aria-labelledby="more-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Internship Status</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->internship_status }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Position</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->position }}</p>
                            </div>
                        </div>

                        {{--   ------------------   skills ---------------------------------}}

                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                Skills
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>

                        @if($skills != null)
                        @foreach($skills as $skill)
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{ $skill->skill }}</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $skill->rate * 10 }}%" aria-valuenow="{{ $skill->rate }}" aria-valuemin="0" aria-valuemax="10"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        {{--           ----------------------------------------             --}
                        {{--   ------------------   work experience ---------------------------------}}

                        <div class="row">
                            <div class="col-4">
                                <hr class="w-100">
                            </div>
                            <div class="col-4">
                                Work Experiences
                            </div>
                            <div class="col-4">
                                <hr class="w-100">
                            </div>
                        </div>

                        @if($workExperiences != null)
                        @foreach($workExperiences as $workExperience)
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{ $workExperience->date }}</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{ $workExperience->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        {{--           ----------------------------------------             --}}
                        {{--   ------------------   educations  ---------------------------------}}

                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                <div>Educations</div>
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>
                        @if($educations != null)
                        @foreach($educations as $education)
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{ $education->date }}</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{ $education->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        {{--           ----------------------------------------             --}}
                        {{--   ------------------   languages  ---------------------------------}}

                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                <div>Languages</div>
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>
                        @if($languages != null)
                        @foreach($languages as $language)
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{ $language->language }}</label>
                                </div>
                                <div class="col-md-8">
                                    <p>{{ $language->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <hr class="w-100">
                            </div>
                        </div>
                        {{--           ----------------------------------------             --}}

                        <div class="row">
                            <div class="col-md-4">
                                <label>Address</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->address }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Height</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->height }} m</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Date of birth</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->dob }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Place of birth</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->place_of_birth }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nationality</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->nationality }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Marital status</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->marital_status }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Hobbies</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->hobbies }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                Reference
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Name</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->reference_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Position</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->reference_position }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->reference_phone }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ $traineeInfo->reference_email }}</p>
                            </div>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-1">
                <a href="/user">
                    <button class="btn btn-info">Back</button>
                </a>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                // console.log(e.target.getAttribute('aria-controls'))
                update_session('trainee_detail_tab', '' + e.target.getAttribute('aria-controls'))
            });
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
    </script>
@endsection



