<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::latest()->get();
        return view('admin.pages.users.index',['Users'=>$Users]);
      
    }
    public function show($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);
            $SpecificUser = User::where('id',$decrypted)->first();

            /* Fetch all the friends request sent by the user */
            $getFriends = FriendRequest::where('sender_id',$decrypted)->with('receiver')->get();
            $getCloserRequestCount = CloserRequestCount::where('sender_id',$decrypted)->get();
            return view('admin.users.show',['SpecificUser'=>$SpecificUser,'getFriends' => $getFriends,'getCloserRequestCount'=>$getCloserRequestCount]);
        } catch (\Exception $e) {
            smilify('error', 'Something went wrong!!🙁 Please Try again.');
            return redirect()->back();
        }
       
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
                'active' =>1
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
                'active' =>0
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

    /*-----------Unverified Users-----------*/
    public function getUsers()
    {
        $unverifiedUsers = User::latest()->get();
        return view('admin.users.unverified',['unverifiedUsers'=>$unverifiedUsers]);
      
    }
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
