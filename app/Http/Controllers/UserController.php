<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\tr_User;
use App\Events\Links;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fires link event capturing page url
        event(new Links());
        //retrieves all users table
        $userDB = User::all();
       //dumps values to view index page for display
        return view('Users.index',['userDB' => $userDB]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
return view('Users.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //fires link event capturing page url
        event(new Links());
        //save user
        if(Auth::check() && $request->input('role') != ""){
           try {
            //code...
           $Logs = User::create([
               
                'name' => $request->input('Name'),
                'email' => $request->input('Email'),
                'password' => bcrypt($request->input('Password')), 
                'role' => $request->input('role'),             
            ]);
            //retrieves all users table
             $userDB = User::all();
            //need to redirect to user index page with success session message and payload data
            return redirect()->route('user.index',['userDB' => $userDB])
                ->with('success' , 'User Details added');
            } 
            catch (\Throwable $th) {
                //throw $th;
                
                //retrieves all users table
                $userDB = User::all();
                //need to redirect to user index page with success session message and payload data
                return redirect()->route('user.index',['userDB' => $userDB])
                    ->withErrors( 'User Details not added try again');
            } 
        }

        return back()->withInput()-withErrors('Error creating try again');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //fires link event capturing page url
        event(new Links());
        //finds user with supplied id to edit
        $user = User::find($user->id);
        //display view edit form with user details
        return view('Users.edit',['user' => $user]);
      
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //update user
        $User = User::where('id',$user->id)->update([
           
            'name' => $request->input('Name'),
            'email' => $request->input('Email'),
            'password' => bcrypt($request->input('Password')), 
            'role' => $request->input('role'), 
        ]);

        if($User){
            //fires link event capturing page url
            event(new Links());
            //retrieves all users table
            $userDB = User::all();
            //need to redirect to user index page with success session message and payload data 
            return redirect()->route('user.index',['userDB' => $userDB])->with('success' , 'User Details Updated');
        }
        return back()->withInput()-withErrors('Error creating try again');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
            
        //fires link event capturing page url
        event(new Links());
        //finds user with supplied id to delete
        $finduser = User::find($user->id);
        $findtr_user = tr_User::find($user->id);

        if($finduser->delete()){
            //retrieves all users table
            $userDB = User::all();
            //need to redirect to user index page with success session message and payload data 
            return redirect()->route('user.index',['userDB' => $userDB])
            ->with('success','user deleted successfully');
        }

        return back()->withInput()->withErrors('user couldn\'t be deleted');
    }
}
