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
                <div class="form-sec">
                    <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="mt-2 mb-4">Level-1</h1>
                            </div>
                        </div> 
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                        <div class="url-form">
                            <form action="{{route('add.url')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="Url1">URL</label>
                                            <input type="url" class="form-control" name="defaulturl"
                                                placeholder="http://URL">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="Redirectionurl"> Redirection URL 1</label>
                                            <input type="name" class="form-control" name="r1url"
                                                placeholder="http://redirectionURL1">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="Redirectionur2"> Redirection URL 2</label>
                                            <input type="name" class="form-control" name="r2url"
                                                placeholder="http://redirectionURL2">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="cronjob"> Cron JOB Time (Daily At)</label>
                                            <input type="time" class="form-control" name="time">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="cronjob"> Cron JOB Date </label>
                                            <input type="date" id="date_picker" class="form-control" name="date">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                           <button type="submit" class="btn btn-success" >Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="level-one-sec">
                    <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                        <div class="row">
                            <table class="dt-table lavel-one-tb">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. No</th>
                                        <th scope="col">Main Url</th>
                                        <th scope="col">Visits</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $code = DB::table('url')->where('added_by', Auth::user()->id)->latest()->paginate(10);
 

                                    @endphp
                                     @if(count($code)>0)
                                     @php
                                     $i=0;
                                       @endphp
                                    @foreach($code as $script)

                                    @php 
                                    $clickcount = DB::table('checkurl')->where('uid',$script->uid)->get();
                                    $ip = DB::table('checkurl')->select('ipaddress')->latest()->first();

                                    $count = count($clickcount)
                                  
                                @endphp
                                 
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$script->defaulturl}}</td>
                                        <td>{{$count}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success get-script"
                                                data-bs-toggle="modal" data-bs-target="#scriptpopup" onclick="script({{$script->id}})">Get Script</button>
                                            <button type="button" class="btn btn-success view" data-bs-toggle="modal"
                                                data-bs-target="#laveloneview" onclick="level1view({{$script->id}})">View</button>
                                            <button class="del-btn" data-bs-toggle="tooltip" onclick="deletes({{$script->id}})"><i
                                                    class="fa-regular fa-trash-can"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- onclick="script({{$script->id}})" --}}

                                    @endif
                                </tbody>
                            </table>
                            <div class="db-pagination mt-4">
                                {{ $code->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </main>

<!--script modal label 1 -->
<div class="modal" id="scriptpopup">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Script Alert</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="scripts" class="col-md-12 mb-3">
                   
                </div>
                <div class="col-md-12 mb-3">
                    <button class="btn btn-success" onclick="myFunction()" onmouseout="outFunc()">
                        Copy text
                    </button>
    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal label 1 end-->




        @if (\Session::has('success'))
   <!--script modal label 1 -->
<div class="modal" id="simpleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Script Alert</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="scripts" class="col-md-12 mb-3">
                    @php

                    $id = session()->get('data');
                    $host = request()->getHttpHost();
                    @endphp
                   
                    <input type="name" class="form-control" id="myInput" value="&#60;meta http-equiv=&#34;Refresh&#34; content=&#34;0; url=&#39;http://{{$host}}/script/{{$id}}&#39;&#34;/&#62;">
            
                </div>
                <div class="col-md-12 mb-3">
                    <button class="btn btn-success" onclick="myFunction()" onmouseout="outFunc()">
                        Copy text
                    </button>
    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal label 1 end-->

@endif
        @include('components.footer')
    </div>

</div>



</div>
</div>
<!-- lavelone_view  -->
<div class="modal fade full-size" id="laveloneview">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div id="data">
                
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal label 1 end-->

<script type="text/javascript">
    window.onload = function () {
        OpenBootstrapPopup();
    };
    function OpenBootstrapPopup() {
        $("#simpleModal").modal('show');
    }
</script>
<script>
    function script(index) {
        jQuery.ajax({
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
    function level1view(index) {
        jQuery.ajax({
            url: '{{route('Get.level1.view')}}',
            type: "POST",
            data: {
                "_token": "{{csrf_token()}}",
                "viewid": index
            },
            success: function(response) {
                console.log(response);
                document.getElementById('data').innerHTML = response;
            },
        });

    }
   
    

    function deletes(index){
        Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover URL',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    type:"POST",
                    url:'{{route('delete.script')}}',
                    data:{
                        "_token":"{{csrf_token()}}",
                        "scriptid":index,
                    }
                    });
                    
            Swal.fire(
            'Deleted!',
            'Your URL has been deleted.',
            'success'
            ).then(function(){ 
        location.reload();
        }
        );  
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
            'Cancelled',
            'Your URL is safe :)',
            'error'
            
            )
            return false;
        }
        })
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
         <script language="javascript">
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
    
            today = yyyy + '-' + mm + '-' + dd;
            $('#date_picker').attr('min',today);
        </script>


@endsection