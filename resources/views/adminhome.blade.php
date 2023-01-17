@extends('layouts.app')

@section('content')

@include('components.header')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">

@include('components.sidebar')
</div>
 
    <div id="layoutSidenav_content">
       <main>
          <div class="container-fluid px-4">
           <div class="row inner-box px-4 mt-4">
               <div class="col-md-12">
                <h1 class="mt-4">Dashboard</h1>
             <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Welcome to Dashboard</li>
             </ol>
           </div>
           </div>
           <div class="row">
                  <div class="col-md-6 pl-0">
                       <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                          <h4>Total visits</h4>
                          <h5>10</h5>
                       </div>
                  </div>
                  <div class="col-md-6 pr-0">
                      <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                        <h4>Total Urls</h4>
                          <h5>10</h5>
                       </div>
                  </div> 
           </div>
            
             <div class="row inner-box px-4 mb-4 pt-4 pb-4">
                <div class="col-md-12">
                   <table class="dt-table">
                      <thead>
                         <tr>
                            <th scope="col">Sr. No</th>
                            <th scope="col">Url</th>
                            <th scope="col">Redirection url 1</th>  
                            <th scope="col">Redirection url 2</th>                                 
                            <th scope="col">Visits</th>
                            <th scope="col">Action</th>                              
                            
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                         @php
                            $code = DB::table('url')->get();

                         @endphp
                           @foreach($code as $script)
                            <th>{{$script->id}}</th>
                            <td>{{$script->defaulturl}}</td>
                            <td>{{$script->redirectionurl1}}</td>
                            <td>{{$script->redirectionurl2}}</td>
                            <td>2</td>
                            <td>
                              <button type="button" class="btn btn-success get-script" data-toggle="modal" data-target="#bookNow" >Get Script</button>
                                <button class="del-btn" data-bs-toggle="tooltip" title="Delete!"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                            {{-- onclick="script({{$script->id}})" --}}
                         </tr>
                         
                      </tbody>
                   </table>

          
                   @endforeach
                   <div class="db-pagination mt-4">
<ul class="pagination">
<li class="page-item"><a class="page-link" href="#">Previous</a></li>
<li class="page-item"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul>
</div>
                </div>
             </div>
          </div>
       </main>
       <footer class="py-3 db-dark-bg mt-auto">
          <div class="container-fluid px-4">
             <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                   <a href="#">Privacy Policy</a>
                   &middot;
                   <a href="#">Terms &amp; Conditions</a>
                </div>
             </div>
          </div>
       </footer>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row inner-box px-4 mt-4">
                    <div class="col-md-12">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Welcome to Dashboard</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pl-0">
                        <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                            <h4>Total visits</h4>
                            <h5>10</h5>
                        </div>
                    </div>
                    <div class="col-md-6 pr-0">
                        <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                            <h4>Total Urls</h4>
                            <h5>10</h5>
                        </div>
                    </div>
                </div>

                <div class="row inner-box px-4 mb-4 pt-4 pb-4">
                    <div class="col-md-12">
                        <table class="dt-table">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. No</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Redirection url 1</th>
                                    <th scope="col">Redirection url 2</th>
                                    <th scope="col">Visits</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                    $code = DB::table('url')->get();

                                    @endphp
                                    @foreach($code as $script)
                                    <th>{{$script->id}}</th>
                                    <td>{{$script->defaulturl}}</td>
                                    <td>{{$script->redirectionurl1}}</td>
                                    <td>{{$script->redirectionurl2}}</td>
                                    <td>2</td>
                                    <td>
                                        <button type="button" class="btn btn-success get-script" data-bs-toggle="modal"
                                            data-bs-target="#scriptpopup">Get Script</button>
                                        <button class="del-btn" data-bs-toggle="tooltip" title="Delete!"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                    {{-- onclick="script({{$script->id}})" --}}
                                </tr>
                                scriptpopup
                            </tbody>
                        </table>

                        {{-- scriptmodel --}}
                        <div class="modal fade" id="bookNow" tabindex="-1" aria-labelledby="bookNowLabel"
                            aria-hidden="true" style="color: black">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookNowLabel">Fill In The Following Details</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>


                                    <div class="modal-body">
                                        <div id="scripts">

                                            &#60;meta http-equiv="Refresh" content="0;
                                            url='http://127.0.0.1:8000/script/{{$script->uid}}" /&#62;
                                            <input type="text" value="Hello World" id="myInput">

                                            <div class="tooltip">
                                                <button onclick="myFunction()" onmouseout="outFunc()">
                                                    <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                                    Copy text
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="db-pagination mt-4">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-3 db-dark-bg mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

       </div>
        {{-- scriptmodel --}}
 <div class="modal fade" id="bookNow" tabindex="-1" aria-labelledby="bookNowLabel" aria-hidden="true" style="color: black">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
       <div class="modal-content">
       
           <div class="modal-header">
               <h5 class="modal-title" id="bookNowLabel">Fill In The Following Details</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
           </div>
           
                   
               <div class="modal-body"> 
                   <div id="scripts">

                     &#60;meta http-equiv="Refresh" content="0; url='http://127.0.0.1:8000/script/{{$script->uid}}" /&#62;
                     <input type="text" value="Hello World" id="myInput">

                     <div class="tooltip">
                     <button onclick="myFunction()" onmouseout="outFunc()">
                       <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                       Copy text
                       </button>
                     </div>
                   </div>
               </div>
              
      
     </div>
   </div>
 </div>
 <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>



</div>
</div>



<!--script popup Modal -->
<div class="modal fade full-size" id="scriptpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="scriptpopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scriptpopupLabel">Script</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="scripts">
                    &#60;meta http-equiv="Refresh" content="0; url='http://127.0.0.1:8000/script/{{$script->uid}}"
                    /&#62;

                    <button class="btn-success" onclick="myFunction()" onmouseout="outFunc()">
                        Copy text
                    </button>


                </div>
            </div>
        </div>
        <!-- Modal end -->







        <!-- Modal -->
        <div class="modal fade full-size" id="addurl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="addurlLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addurlLabel">ADD URL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('add.url')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Default Url</label>
                                <input type="name" class="form-control" name="defaulturl" placeholder="http://URL">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Redirection Url 1</label>
                                <input type="name" class="form-control" name="r1url"
                                    placeholder="http://redirectionURL1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Redirection Url 2</label>
                                <input type="name" class="form-control" name="r2url"
                                    placeholder="http://redirectionURL2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">time</label>
                                <input type="name" class="form-control" name="time" placeholder="1-24 only">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>

        <script>
        function script(index) {
            $.ajax({
                url: '{{route('get.script')}}',
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "scriptid": index
                },
                success: function(response) {
                    console.log(response);
                    document.getElementById('scripts').innerHTML = response;
                },
            });

        }
        </script>

        <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);

            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied: " + copyText.value;
        }

        function outFunc() {
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copy to clipboard";
        }
        </script>

        @endsection