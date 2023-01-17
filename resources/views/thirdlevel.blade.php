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
                                <h1 class="mt-2 mb-4">Level-3</h1>
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
                                        <th scope="col">Url</th>
                                        <th scope="col">Visits</th>
                                        <th scope="col">Redirection url 1</th>
                                        <th scope="col">Visits</th>
                                        <th scope="col">Redirection url 2</th>
                                        <th scope="col">Visits</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                               

                                 $url = DB::table('url')->where('added_by', Auth::user()->id)->latest()->paginate(10);
                                     @endphp
                                     @if(count($url)>0)
                                     @php
                                     $i=0;
                                     @endphp
                                    @foreach($url as $script)
                                    @php
                                    $url0 = DB::table('checkurl')->where('redirectionurls',$script->defaulturl)->where('uid',$script->uid)->select('redirectionurls')->latest()->distinct()->count();
                                    $url1 = DB::table('checkurl')->where('redirectionurls',$script->redirectionurl1)->where('uid',$script->uid)->select('redirectionurls')->latest()->distinct()->count();
                                    $url2 = DB::table('checkurl')->where('redirectionurls',$script->redirectionurl2)->where('uid',$script->uid)->select('redirectionurls')->latest()->distinct()->count();

                                    @endphp
                                    <tr>
                                        <th>{{++$i}}</th>
                                        <td>{{$script->defaulturl}}</td>
                                        <td>{{$url0}}</td>
                                        <td>{{$script->redirectionurl1}}</td>
                                        <td>{{$url1}}</td>
                                        <td>{{$script->redirectionurl2}}</td>
                                        <td>{{$url2}}</td>
                                        <td>
                                            <button class="del-btn" data-bs-toggle="tooltip" title="Delete!"><i
                                                    class="fa-regular fa-trash-can" onclick="deletes({{$script->id}})"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    {{-- onclick="script({{$script->id}})" --}}

                                </tbody>
                            </table>
                            <div class="db-pagination mt-4">
                                <ul class="pagination">
                                    {{-- {{ $url->links('vendor.pagination.custom') }} --}}
                                    {{ $url->links() }}
                                </ul>
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
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">192.0.0.1</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="dt-table">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No</th>
                            <th scope="col">Main Url</th>
                            <th scope="col">Redirection url-1</th>
                            <th scope="col">Redirection url-2</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>google.com</td>
                            <td>yahoo.com</td>
                            <td>spartanbots</td>

                        </tr>

                    </tbody>
                </table>
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

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal label 1 end-->

<script>

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

@endsection