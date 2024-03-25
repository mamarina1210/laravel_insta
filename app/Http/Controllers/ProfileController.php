<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id)

    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')->with('user', $user);
        
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')
        ->with('user',$user);
    }
    public function update(Request $request)
    {
       #1.Validate the data from the form
        $request->validate([
            #user id is depends on user, Auth:user is depends on who
            
            'name'      =>      'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            //in the case don't wanna change the email addres...same email can work!
            'introduction'   =>      'max:1000',
            'avatar'         =>      'mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        # 2. Update the post
        $user  = $this->user->findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        #If there is a new image ...
       if($request->avatar)
       {

        $user->avatar = 'data:image/' . $request->avatar->extension().';base64,'.base64_encode(file_get_contents($request->avatar));
        }
        $user->save();

        #5. Redirect to Show Post page(to confirm the update)
        return redirect()->route('profile.show', Auth::user()->id);
}

public function followers($id)
{
    $user = $this->user->findOrFail($id);
    return view('users.profile.followers')->with('user', $user);
    // don't use Auth::user->id because everyone can see this page
}

public function following($id)
{
    $user = $this->user->findOrFail($id);
    return view('users.profile.following')->with('user', $user);
    // don't use Auth::user->id because everyone can see this page
}
}
