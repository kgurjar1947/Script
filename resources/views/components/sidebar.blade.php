    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="dashboard.html">
                    <div class="profile-sec">
                        <div class="profile-dtl">  
                              {{-- image data set --}}
                            @php $img =
                            DB::table('users')->where('id',Auth::user()->id)->first();
                            @endphp
                            <img src="{{ url('storage/'.$img->img_name)}}" alt="img">
                            <p>{{Auth::user()->name}}</p>
                        </div>
                    </div>
                </a> 
                <div class="sb-sidenav-menu-heading">Pages</div>
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('firstlevel')}}">𝟣<sup>𝓈𝓉</sup> level</a>
                    <a class="nav-link" href="{{ route('secondlevel')}}">𝟤<sup>𝓃𝒹</sup> level</a>
                    <a class="nav-link" href="{{ route('thirdlevel')}}">𝟥<sup>𝓇𝒹</sup> level</a>
                </nav>
               
                <div class="sb-sidenav-menu-heading">Profile</div>
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('profile')}}">My Profile</a>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
       
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </div>
        </div>
    </nav>
