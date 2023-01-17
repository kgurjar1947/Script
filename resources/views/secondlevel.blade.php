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
                                <h1 class="mt-2 mb-4">Level-2</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="level-two-sec">
                    <div class="inner-box px-4 mt-4 mb-4 pt-4 pb-4">
                        <div class="row">
                            <table class="dt-table lavel-one-tb">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. No</th>
                                        <th scope="col">IP Address</th>
                                        <th scope="col">Visits</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @php
                                 
                                    // $url = DB::table('url')->get();
                                    $checkurl = DB::table('checkurl')->where('added_by', Auth::user()->id)->select('ipaddress')->distinct()->latest()->paginate(10);
         
                                    @endphp
                                    @if(count($checkurl)>0)
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach($checkurl as $ipcount)
                                    @php
                                    $count = DB::table('checkurl')->where('added_by', Auth::user()->id)->where('ipaddress',$ipcount->ipaddress)->select('ipaddress')->distinct()->count();

                                    // $url = DB::table('checkurl')->where('ipaddress',$ipcount->ipaddress)->get();
                                    $ip = $ipcount->ipaddress;

                                    @endphp  
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$ip}}</td>
                                        <td>{{$count}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success view" data-bs-toggle="modal" data-bs-target="#laveltwoview" onclick="level2view(' {{$ip}}')">View</button>

                                           
                                            <button class="del-btn" data-bs-toggle="tooltip" title="Delete!"><i class="fa-regular fa-trash-can" onclick="deletes(' {{$ip}}')"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    {{-- onclick="level2view({{$ipcount->id}})" --}}


                                </tbody>
                            </table>
                            <div class="db-pagination mt-4">
                                {{ $checkurl->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </main>
        @include('components.footer')
    </div>

</div>



</div>
</div>
<!-- lavelone_view  -->
<div class="modal fade full-size" id="laveltwoview">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" id="data">
           
 <!-- Modal footer -->
 <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>   
        </div>
    </div>
</div>

<!-- modal label 1 end-->

<script>
   
    function level2view(index) {
        $.ajax({
            url: '{{route('Get.level2.view')}}',
            type: "POST",
            data: {
                "_token": "{{csrf_token()}}",
                "viewip": index
            },
            success: function(response) {
                console.log(response);
                document.getElementById('data').innerHTML = response;
            },
        });

    }

</script>
<script>


    function deletes(index){
        Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover URL',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it',
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    type:"POST",
                    url:'{{route('deletelevel')}}',
                    data:{
                        "_token":"{{csrf_token()}}",
                        "deleteid":index,
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

@endsection