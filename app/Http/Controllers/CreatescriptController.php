<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\URL;
use App\Models\CheckURL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use DB;







class CreatescriptController extends Controller
{
    //


    
    public function AddURL(Request $request){
        $randomString = Str::random(30);

      
          $input = Validator::make($request->all(),[
            'defaulturl' => 'required|url',
            'r1url' => 'required|url',
            'r2url' => 'required|url',
        ]);
       
          if($input->fails()){
            return redirect()->back()->with('error', 'use http:// or https:// with url'); 
          }

        $addnewurl = new URL([
            'uid'=> $randomString,
            'added_by'=>Auth::user()->id,
            'defaulturl'=>$request->get('defaulturl'),
            'redirectionurl1'=>$request->get('r1url'),
            'redirectionurl2'=>$request->get('r2url'),
            'time'=>$request->get('time'),
            'date'=>$request->get('date'),



        ]);
        $addnewurl->save();
        $url = $addnewurl->uid;
   
        return redirect()->back()->with('success', 'URL saved !!!')->with( ['data' => $url] );   
    }

    public function GetScript(Request $request){
        $id = $request->get('scriptid');
        $script = URL::where('id',$id)->first();
        $host = request()->getHttpHost();

        $html = '';
        $html.= '
        <input type="name" class="form-control" id="myInput" value="&#60;meta http-equiv=&#34;Refresh&#34; content=&#34;0; url=&#39;http://'.$host.'/script/'.$script->uid.'&#39;&#34;/&#62;">

            ';
        return $html;
    }
    // <input type="name" class="form-control" id="myInput" value="&#60;meta http-equiv=&#34;Refresh&#34; content=&#34;0&#34; url=&#34;http://'.$host.'/script/'.$script->uid.'&#34;/&#62;">

   
    public function  deletescripts(Request $request){

    $scriptid = $request->get('scriptid');
        $Delete = URL::find($scriptid);
        if($Delete->delete()){
            return redirect()->intended('firstlevel');
        }
    }

    public function  deletescriptslevel2(Request $request){

        $deleteid = $request->get('deleteid');
            $Delete = CheckURL::where('ipaddress',$deleteid);
            
            if($Delete->delete()){
                return redirect()->intended('firstlevel');
            }
        }

   
    public function GenerateScript($id){
       $redirect = URL::where('uid',$id)->first();
       $checkurl = request()->ip();
    //    DB::table('checkurl')->select('ipaddress')->get();
      
       if (CheckURL::where('uid', '=', $id)->exists()) {
            // dd($exist->ipaddress);
        if (CheckURL::where('ipaddress', '=', $checkurl)->exists()) {
          if (CheckURL::where('redirectionurls', '=', $redirect->redirectionurl1)->exists()) {

                       //redirect
                        $addnewurl = new CheckURL([
                            'uid'=> $id,
                            'ipaddress'=>request()->ip(),
                            'redirectionurls'=>$redirect->redirectionurl2,
                            'time'=>$redirect->time,
                            'added_by'=>$redirect->added_by,
                            'date'=>$redirect->date,

                        ]);
                        $addnewurl->save();
                        return redirect()->away($redirect->redirectionurl2);

                    }else{

                        $addnewurl = new CheckURL([
                            'uid'=> $id,
                            'ipaddress'=>request()->ip(),
                            'redirectionurls'=>$redirect->redirectionurl1,
                            'time'=>$redirect->time,
                            'added_by'=>$redirect->added_by,
                            'date'=>$redirect->date,

                        ]);
                        $addnewurl->save();
                        return redirect()->away($redirect->redirectionurl1);
                    } //redirect
                      //ipaddress
            }else{

                $addnewurl = new CheckURL([
                    'uid'=> $id,
                    'ipaddress'=>request()->ip(),
                    'redirectionurls'=>$redirect->redirectionurl1,
                    'time'=>$redirect->time,
                    'added_by'=>$redirect->added_by,
                    'date'=>$redirect->date,

                ]);
                $addnewurl->save();
                return redirect()->away($redirect->redirectionurl1);
            }//ipaddress\
            // }//foreach end
             //UID
        }else{

            $addnewurl = new CheckURL([
                'uid'=> $id,
                'ipaddress'=>request()->ip(),
                'redirectionurls'=>$redirect->redirectionurl1,
                'time'=>$redirect->time,
                'added_by'=>$redirect->added_by,
                'date'=>$redirect->date,

            ]);
            // dd($addnewurl);
            $addnewurl->save();
            return redirect()->away($redirect->redirectionurl1);
        }//UID

    
            // return redirect()->away($redirect->defaulturl);
    }

  


    public function Getlevel1view(Request $request){
        $id = $request->get('viewid');
        $script = URL::where('id',$id)->first();
        $checkurl = CheckURL::where('uid',$script->uid)->select('ipaddress')->distinct()->latest()->paginate(10);
        $html = '';
        $ip = '';
        if(count($checkurl)>0){
            $i=0;
        foreach($checkurl as $ipcount){
            $count = CheckURL::where('uid',$script->uid)->where('ipaddress',$ipcount->ipaddress)->select('ipaddress')->distinct()->count();
            $date = CheckURL::where('uid',$script->uid)->where('ipaddress',$ipcount->ipaddress)->select('date')->first();
            // $ipcount->ipaddress
        
          
            
            
            $ip.= '
            <tr>
            <th>'.++$i.'</th>
            <td>'.$ipcount->ipaddress.'</td>
            <td>'.$count.'</td>
            <td>'.$script->date.'</td>
            <td>'.$script->time.' Hr</td>
        
        </tr>
      
        '.$checkurl->links() .'
        ';
        }
    }else{
        $ip.= '
        <tr>
        <th></th>
        <td></td>
        <td>no data found</td>
        <td></td>
        <td></td>
    
    </tr>
  

  ';
    }

      
        $html.= '
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">'.$script->defaulturl.'</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
    
        <!-- Modal body -->
        <div class="modal-body">
            <table class="dt-table">

                <thead>
                    <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">IP Address</th>
                        <th scope="col">Visits</th>
                        <th scope="col">Deletion Date</th>
                        <th scope="col">Deletion Time</th>
                    </tr>
                </thead>
                <tbody>
                   '.$ip.'
                   </tbody>
                   </table>
        </div>          
          ';
        return $html;
    }


    public function Getlevel2view(Request $request){
        $id = $request->get('viewip');
        // $script = URL::where('id',$id)->first();
        $checkurl = CheckURL::where('ipaddress',$id)->select('uid')->distinct()->get();
        $html = '';
        $ip = '';
        if(count($checkurl)>0){
            $i=0;
        foreach($checkurl as $ipdata){
            $uid = URL::where('uid', $ipdata->uid)->first();  
            // $ipcount->ipaddress
            $ip.= '
            <tr>

                <th scope="row">'.++$i.'</th>
                <td>'.$uid->defaulturl.'</td>
                <td>'.$uid->redirectionurl1.'</td>
                <td>'.$uid->redirectionurl2.'</td>

            </tr>';
        
    }
        }


      
        $html.= '
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">'.$id.'</h4>
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
             
'.$ip.'
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

        
          ';
        return $html;
    }

    public function  profilepic(Request $request){
        $validator = Validator::make($request->all(),[
            'profile_pic' => 'file|image|mimes:PNG,JPG,jpg,jpeg,png,gif,webp|max:2048'
          ]);

         $profile_pic = $request->file('profile_pic');

          if (isset($profile_pic) && $profile_pic!=NULL) {            
            $fileExt=$profile_pic->getClientOriginalExtension();
            Storage::disk('public')->put($profile_pic->getFilename().'.'.$fileExt, File::get($profile_pic));
            $Profile_pic_file = $profile_pic->getFilename().'.'.$fileExt;
          }

        if (User::where('id', '=', $request->get('id'))->exists()) {
            $user = User::find($request->get('id'));
            if (isset($profile_pic)) {
                $user->img_name = isset($profile_pic) ? $Profile_pic_file : '';
            }
           
            $user->save();

            
        }else{
            $user = new User([
                'img_name'=> isset($profile_pic) ? $Profile_pic_file : '',
            ]);
            $user->save();
        }
        return redirect()->intended('profile');
}




    public function  profileupdate(Request $request){
        
        $request->validate([
            'name'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required',
            'phone'=>'required',

          ]);

       
          if (User::where('id', '=', Auth::user()->id)->exists()) {
            $user = User::find(Auth::user()->id);
            $user->name= $request->get('name');
            $user->lname= $request->get('lname');
            $user->email= $request->get('email');
            $user->phone= $request->get('phone');
            $user->save();
          }

          return redirect()->intended('profile');

     
        }
       

   
}
