<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{

  public function __construct()
  {
    $this->middleware(['auth', 'permission:User show'])->only(['index', 'show']);
    $this->middleware(['auth', 'permission:User create'])->only(['create', 'store']);
    $this->middleware(['auth', 'permission:User update'])->only(['edit', 'update']);
    $this->middleware(['auth', 'permission:User delete'])->only(['destroy']);
  }
  /**
   *to show all Users
   **/
  public function index()
  {

    $users = User::all();
    return view('dashboard.users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('dashboard.users.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([

      'name' => 'required',
      'email' => 'requierd|email|unique:users',
      'passwoard' => 'required|min:8',

    ]);


    $user = new User([

      'name' => $request->get('name'),
      'email' => $request->get('email'),
      'password' => Hash::make($request->password),

    ]);

    $user->save();

    return redirect()->route('users.index')->with('success', 'User has been added');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {

    return view('users.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    return view('dashboard.users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    $request->validate([

      'name' => 'required',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'password' => 'nullable|min:8',
    ]);

    $user->update([

      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password ? Hash::make($request->password) : $user->password,

    ]);
    return redirect()->route('users.index');
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $user->delete();
    return redirect()->route('users.index');
  }
}
