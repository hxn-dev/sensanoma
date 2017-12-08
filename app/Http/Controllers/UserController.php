<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use File;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function update(UserRequest $request){

        if($request->hasFile('avatar')) {
            $oldavatar = Auth::user()->avatar;
            File::delete('uploads/avatars/' . $oldavatar);

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->fit(200,200)
                ->save(public_path('uploads/avatars/' . $filename));
            $request->merge(['avatar' => $filename]);
        }


        if(!empty($request->input('current_password')) && ! Hash::check($request['current_password'], Auth::user()->getAuthPassword()) ) {
            return redirect()->back()->with('danger', 'Password invalid');
        }

        Auth::user()->update([
            'name'      => $request->input('name'),
            'password'  => (!empty($request->input('password'))) ? Hash::make($request['password']) : Auth::user()->password,
            'avatar'    => (!empty($request->input('avatar'))) ? $filename : Auth::user()->avatar
        ]);

        return view('user.profile')->with('success', 'The account has been updated.');

    }


    public function destroy(User $user){

        if($user->hasRole('admin')) {
            Auth::user()->account->destroy(Auth::user()->account_id);
        }
        return redirect(route('home'));
    }

    public function viewerDestroy(User $user){

        $user = Auth::user()->account->users()->find($user->id);
        $user->delete();

        return redirect(route('home'))->with('success', 'The User has been deleted');
    }
}
