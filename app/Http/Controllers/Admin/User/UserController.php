<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        $data =  User::latest()->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('email_verified_at', function($row){
                        if($row->email_verified_at  != null){
                            $btn =' <a href="'.route('user.get.unverified',['id'=>Crypt::encrypt($row->id)]) .'"
                                    class="btn btn-xs btn-success">
                                    <b> Verified </b>
                                    </a>';
                        }else{
                            $btn ='<a href="'.route('user.get.verified',['id'=>Crypt::encrypt($row->id)]) .'"
                                class="btn btn-xs btn-danger">
                                <b>NotVerified</b>
                                </a>';
                        }
                        return $btn;
                       })
                    ->addColumn('status', function($row){
                      if($row->status=='active'){
                        $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs"><b>Active</b></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon btn-xs" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="'.route('user.get.active',['id'=>Crypt::encrypt($row->id)]) .'">Active</a>
                                    <a class="dropdown-item" href="'.route('user.get.inactive',['id'=>Crypt::encrypt($row->id)]) .'">Deactive</a>
                                    <a class="dropdown-item" href="'.route('user.get.pending',['id'=>Crypt::encrypt($row->id)]) .'">Pending</a>
                                    </div>
                            </div>';
                       } elseif($row->status=='deactive') {
                         $btn = '<div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-xs"><b>Dactive</b></button>
                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon btn-xs" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="'.route('user.get.active',['id'=>Crypt::encrypt($row->id)]) .'">Active</a>
                                    <a class="dropdown-item" href="'.route('user.get.inactive',['id'=>Crypt::encrypt($row->id)]) .'">Deactive</a>
                                    <a class="dropdown-item" href="'.route('user.get.pending',['id'=>Crypt::encrypt($row->id)]) .'">Pending</a>
                                    </div>
                                </div>';
                       } else{
                        $btn = '<div class="btn-group">
                                <button type="button" class="btn btn-warning btn-xs"><b>Pending</b></button>
                                <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon btn-xs" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="'.route('user.get.active',['id'=>Crypt::encrypt($row->id)]) .'">Active</a>
                                <a class="dropdown-item" href="'.route('user.get.inactive',['id'=>Crypt::encrypt($row->id)]) .'">Deactive</a>
                                <a class="dropdown-item" href="'.route('user.get.pending',['id'=>Crypt::encrypt($row->id)]) .'">Pending</a>
                                </div>
                            </div>';
                       } 

                        return $btn;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm">';
                        //@can('user-show')
                        $btn = $btn.' <a class="btn btn-info" data-toggle="modal" data-target="#view-user'.$row->id.'" title="View" ><i class="fas fa-eye"></i></a>';
                        //@endcan

                        //@can('user-edit')
                        $btn = $btn.' <a class="btn btn-primary" data-toggle="modal" data-target="#edit-user'.$row->id.'" title="Edit"><i class="fas fa-edit"></i></a>';
                        //@endcan

                        $btn = $btn.'<a href="'.route('user.get.delete',['id'=>Crypt::encrypt($row->id)]).'" class="btn btn-danger " onclick="return myFunction()" title="Delete" ><i class="fas fa-trash"></i></a>';
                        $btn = $btn.'</div>';
                        return $btn;
                    })
                
                    ->rawColumns(['email_verified_at','status','action'])
                    ->make(true);
        }
        return view('admin.pages.users.index', compact('data'));

        // 
        // return view('admin.pages.users.index',['Users'=>$Users]);
    }
     public function create(Request $request)
    {
         $this->validate($request, [
                'name'               => 'required',
                'username'           => 'required|unique:users',
                'email'              => 'required|unique:users',
                'phone'              => 'required',
                'password'           => 'required',
                'dob'                => 'required',
                'city'               => 'required',
                'gender'             => 'required',
              ]);

            $result = new User();
            $result->name               = $request['name'];
            $result->username           = $request['username'];
            $result->email              = $request['email'];
            $result->phone              = $request['phone'];
            $result->password           = Hash::make($request['password']);
            $result->dob                = $request['dob'];
            $result->registeration_type = 'Normal';
            $result->activation_token   = '';
            $result->city               = $request['city'];
            $result->gender             = $request['gender'];
            $result->email_verification = 1;
            $result->active             = 1;

         if($result->save())
            {
                smilify('success', 'User Created Successfully 🔥');
                return redirect()->route('user.get.index');
            }
            else
            { 
                smilify('error', 'Something went wrong!!🙁 Please Try again.');
                return redirect()->back();
            } 
    }
    public function edit($id)
    {
       try {
           $decrypted    = Crypt::decrypt($id);
           $getResult    = User::where('id',$decrypted)->first();

           if(!is_null($getResult)){
            return view('admin.users.edit',['getResult'=>$getResult]);
           } 
            smilify('error', 'Something went wrong!!🙁 Please Try again.');
            return redirect()->back();

       } catch (\Exception $e) {
        smilify('error', 'User edit page not found 🙁 . Please Try again.');
        return redirect()->back();
       }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
                'name'                => 'required',
                'username'            => 'required',
                'email'               => 'required',
                'phone'               => 'required',
                'password'            => 'required',
                'dob'                 => 'required',
                'city'                => 'required',
                'gender'              => 'required',   
         ]);
                $id                 = Crypt::decrypt($request['id']);
                $name               = strip_tags($request['name']);
                $username           = strip_tags($request['username']);
                $email              = strip_tags($request['email']);
                $phone              = strip_tags($request['phone']);
                $password           = Hash::make($request['password']);
                $dob                = strip_tags($request['dob']);
                $city               = strip_tags($request['city']);
                $gender             = strip_tags($request['gender']);

                $updateUser  = User::where('id',$id)->update([
                'name'               => $name,
                'username'           => $username,
                'email'              => $email,
                'phone'              => $phone,
                'password'           => $password,
                'dob'                => $dob,
                'city'               => $city,
                'gender'             => $gender,
                'email_verification' => 1,
               ]);
 
        if($updateUser){
            smilify('success', 'User Updated Successfully 😊');
            return redirect()->route('user.get.index');
        } 
        smilify('error', 'Something went wrong!!🙁 Please Try again.');
        return redirect()->back();
        
    }
    public function destroy($id)
     {
        try {
            $decrypted  = Crypt::decrypt($id);
            $deleteUser = User::find($decrypted)->delete();
           if($deleteUser) {
            smilify('success', 'User deleted Successfully 😊');
            return redirect()->route('user.get.index');
           }
        } catch (\Exception $e) {
            connectify('error', 'Ooops 🙁', $e->getMessage());
            return redirect()->back();
           }
     }

          /**
     * Activate a specific user.
     *
     * @param  \App\User  $id
     * @return \Illuminate\Http\Response
     */
    public function activeUser($id)
    {
        try {
            $decrypted  = Crypt::decrypt($id);
            $activeUser = User::haveId($decrypted)->update([
                'status' => 'active'
            ]);
            if($activeUser){
                smilify('success', 'User activated Successfully 😊');
                return redirect()->back();
            } else {
                connectify('error', 'Ooops 🙁', 'Something went wrong');
                return redirect()->back();
            }
           
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
            connectify('error', 'Ooops 🙁', $e->getMessage());
            return redirect()->back();
        }
    }

     /**
     * Deactivate a specific user.
     *
     * @param  \App\User  $id
     * @return \Illuminate\Http\Response
     */
    public function deactiveUser($id)
    {
        try {
            $decrypted      = Crypt::decrypt($id);
            $deactiveUser   = User::haveId($decrypted)->update([
                'status' => 'deactive'
            ]);
            if($deactiveUser){
                smilify('success', 'User deactivated Successfully');
                return redirect()->back();
            } else {
                connectify('error', 'Ooops 🙁', 'Something went wrong');
                return redirect()->back();
            }
           
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
            connectify('error', 'Ooops 🙁', $e->getMessage());
            return redirect()->back();
        }
    }

    public function pendingUser($id)
    {
        try {
            $decrypted      = Crypt::decrypt($id);
            $pendingUser   = User::haveId($decrypted)->update([
                'status' => 'pending'
            ]);
            if($pendingUser){
                smilify('success', 'User Pendding Updated Successfully');
                return redirect()->back();
            } else {
                connectify('error', 'Ooops 🙁', 'Something went wrong');
                return redirect()->back();
            }
           
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
            connectify('error', 'Ooops 🙁', $e->getMessage());
            return redirect()->back();
        }
    }

    /*-----------Unverified Users-----------*/
        public function verifiedUser($id)
    {
        try {
            $decrypted  = Crypt::decrypt($id);
            $verifiedUser = User::haveId($decrypted)->update([
                'email_verified_at' => Carbon::now()
            ]);
            if($verifiedUser){
                smilify('success', 'User Email Verified Successfully 😊');
                return redirect()->back();
            } else {
                connectify('error', 'Ooops 🙁', 'Something went wrong');
                return redirect()->back();
            }
           
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
            connectify('error', 'Ooops 🙁', $e->getMessage());
            return redirect()->back();
        }
    }

    public function unverifiedUser($id)
    {
        try {
            $decrypted      = Crypt::decrypt($id);
            $unverifiedUser   = User::haveId($decrypted)->update([
                'email_verified_at' => null
            ]);
            if($unverifiedUser){
                smilify('success', 'User Email Unverified Successfully');
                return redirect()->back();
            } else {
                connectify('error', 'Ooops 🙁', 'Something went wrong');
                return redirect()->back();
            }
           
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            
            connectify('error', 'Ooops 🙁', $e->getMessage());
            return redirect()->back();
        }
    }
}
