<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     *to show all Users
     **/
    public function index()
    {
       $users = User::all();
       
         return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([

            'name'=>'required',
            'email'=>'requierd|email|unique:users',
            'passwoard'=>'required|min:8',

         ]);


      $user=new User([

        'name'=>$request->get('name'),
        'email'=>$request->get('email'),
        'password'=>Hash::make($request->password),

         ]);  

         $user->save();

         return redirect('\users')->with('success','User has een added');
     
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
           $request->validate([

                'name' =>'required',
                'email' =>'required|email|unique:users,email,'.$user->id,
                'password'=>'nullable|min:8',
           ]);

           $user->update([

                'name'=> $request->name,
                'email'=>$request->email,
                'password'=>$request->password? Hash::make($request->password):$user->password,

           ]);
           return redirect()->route('user.index');
    }
    /**
      * Remove the specified resource from storage.
     */
        public function destroy(User $user)
        {
               $user->delete();
               return redirect()->route('user.index');
    }
}
