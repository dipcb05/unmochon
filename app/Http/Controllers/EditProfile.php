<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Controller
{

    public function index($user)
    {
        $user = User::findorFail($user);
        return view('profile.EditProfile', ['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $name = $request->input('name');
        $country = $request->input('country');
        $bday = $request->input('bday');
        $job  = $request->input('job');
        $wdate = $request->input('wdate');
        $des = $request->input('description');
        $web = $request->input('website');
        $pic = request('pic');
        if($pic) $pic = $pic->store('upload/pro_pic', 'public');
        if($name || $country || $bday || $job || $wdate || $pic || $web || $des) {
            if ($name) {
                $user->name = $name;
                $user->save();
            }
            if ($country) {
                $user->country = $country;
                $user->save();
            }
            if ($bday) {
                $user->bday = $bday;
                $user->save();
            }
            if ($job) {
                $user->job = $job;
                $user->save();
            }
            if ($wdate) {
                $user->wdate = $wdate;
                $user->save();
            }
            if ($pic) {
                $user->pic = $pic;
                $user->save();
            }
            if ($des) {
                $user->description = $des;
                $user->save();
            }
            if ($web) {
                $user->website = $web;
                $user->save();
            }
            echo 'updated';
        }
        else echo 'nothing to update';

        return redirect()->route('profile.show', $user);

    }

}
