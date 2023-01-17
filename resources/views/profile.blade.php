@extends('layouts.app')
@section('content')
@include('components.header')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('components.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main>
            <!--profile-->

            <section class="profile-main">
                <div class="container-fluid">
                    <div class="row">
                        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>

        @endif
                        <div class="col-md-3">
                            <div class="profile-img mt-5 text-center">
                                <figure>
                                    @php $img =
                                    DB::table('users')->where('id',Auth::user()->id)->first();
                                    @endphp
                                    <img src="{{ url('storage/'.$img->img_name)}}" alt="img">
                                    <figcaption>
                                        <div class="mt-3">
                                            <h4>{{ Auth::user()->name }}</h4>
                                        </div>
                                        <div>
                                            <p>designation</p>
                                        </div>
                                    </figcaption>
                                </figure>
                                    <form class="form-vertical" method="POST" enctype="multipart/form-data" action="{{route('profile.img')}}">
                                        @csrf
                                        <input class="form-control" id="inputFirstName" type="hidden"
                                                        value="{{ Auth::user()->id}}" name="id"/>
                                <div class="col-lg-12 col-sm-12 col-12 mb-3">
                                    <span class="file-input btn btn-block btn-success btn-file">
                                        Upload Your Image&hellip; 
                                        <input type="file" class="form-control" name="profile_pic">

                                    </span>
                                    <br>
                                    <input class="btn btn-primary" type="submit">
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-lg-12 profile-form dark-bg rg-form">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Profile Page</h3>
                                    </div>
                                    <form class="form-vertical" method="POST" action="{{route('profile_update')}}">
                                        @csrf
                                    
                                    <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="mb-3 mb-md-0 ">
                                                       
                                                        <input class="form-control" id="inputFirstName" type="hidden"
                                                        value="{{ Auth::user()->id}}" name="id"/>
                                                        <input class="form-control" id="inputFirstName" type="text"
                                                            value="{{ Auth::user()->name}}" name="name"/>
                                                    </div>
                                                    
                                                    <div class="mb-3 mb-md-0 ">
                                                        <input class="form-control" id="inputFirstName" type="text"
                                                            value="{{ Auth::user()->lname}}" name="lname"/>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="form-fleld mb-3">
                                                <input class="form-control" id="inputEmail" type="email"
                                                    value="{{ Auth::user()->email}}"  name="email"/>

                                            </div>
                                            <div class="form-fleld mb-3">
                                                <input class="form-control" id="inputEmail" type="text"
                                                    value="{{ Auth::user()->phone}}" name="phone"/>

                                            </div>
                                         

                                            <div class="row mb-3 wt">
                                                <div class="col-md-4">
                                                    <h5>Membership levels</h5>
                                                </div>
                                                <div class="col-md-8">
                                                    <h5>Paid</h5>
                                                </div>
                                            </div>
                                            <input class="btn btn-primary" type="submit" placeholder="submit">
                                                
                                          
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- 
                                
                                --}}

                                <div class="col-md-9">
                                    <div class="col-lg-12 profile-form dark-bg rg-form">
                                        <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                            <div class="card-header">
                                                <h3 class="text-center font-weight-light my-4">Change Password</h3>
                                            </div>
                                            <form action="{{ route('update-password') }}" method="POST">
                                                @csrf
                                            
                                                <div class="card-body">
                                                    @if (session('status'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('status') }}
                                                        </div>
                                                    @elseif (session('error'))
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                        
                                                    <div class="mb-3">
                                                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                                                        <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                                            placeholder="Old Password">
                                                        @error('old_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="newPasswordInput" class="form-label">New Password</label>
                                                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                                            placeholder="New Password">
                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                                            placeholder="Confirm New Password">
                                                    </div>
                        
                                                </div>
                        
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                        
                                                  
                                                </form>
                                            </div>
                                        </div>
                                    </div>
        
                                    {{--  --}}

                        </div>
                    </div>
                </div>
            </section>
            <!--profile end-->
        </main>
        @include('components.footer')
    </div>

</div>



</div>
</div>

@endsection