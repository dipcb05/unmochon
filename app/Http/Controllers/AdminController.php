<?php

namespace App\Http\Controllers;
use App\Mail\change;
use App\Models\Admin;
use App\Models\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');

    }

    function index()
    {
        $admin_id_active = DB::table('admins')
            ->select('active')
            ->where('users_id', '=', Auth::id())
            ->get();
        if (($admin_id_active == '[]') or ($admin_id_active[0]->active == "no"))
            return redirect()->route('admin_first_time');
        else return view('admin.dashboard');
    }

    function index2($admin)
    {

        $admin = Admin::find($admin);
        $use = User::find($admin->users_id);

        if ($use->role == 2) {
            if ($admin->active == "no")
                return view('admin.profiles.editprofile', ['id' => $admin]);
            else return redirect()->route('admin');
        } else return redirect()->route('home');
    }

    function generate_ac()
    {
        $u = User::find(Auth::id());

        if ($u) {
            if ($u->role == 2) {
                Auth::user()->admin()->create([
                    'users_id' => $u->id,

                ]);
                $admin_id = DB::table('admins')
                    ->select('id')
                    ->where('users_id', '=', Auth::id())
                    ->get();

                return redirect()->route('admin_editprofile', ['id' => $admin_id[0]->id]);
            } else return redirect()->route('home');
        } else return redirect()->route('home');
    }

    function profile_update($id, Request $request)
    {
        $u = User::find(Auth::id());
        if ($u->role == 2) {
            $office_id = $request->input('office_id');
            $position = $request->input('position');
            $joining_date = $request->input('joining_date');
            $admin = Admin::find($id);
            $admin->active = 'yes';
            $admin->office_id = $office_id;
            $admin->position = $position;
            $admin->joining_date = $joining_date;
            $admin->save();
            return redirect()->route('admin', $admin);
        } else return redirect()->route('home');
    }

    function stats()
    {
        $p = DB::table('posts')
            ->select(DB::raw('COUNT(*) as count_total_posts'))
            ->get();
        $p1 = DB::table('profiles')
            ->select(DB::raw('COUNT(*) as count_total_profiles'))
            ->get();
        $p2 = DB::table('posts')
            ->select(DB::raw('COUNT(*) as count_today_post'))
            ->whereDate('created_at', today()->toDateString())
            ->get();
        $p3 = DB::table('profiles')
            ->select(DB::raw('COUNT(*) as count_today_account'))
            ->whereDate('created_at', today()->toDateString())
            ->get();
        return view('admin.tasks.stat', ['total_post' => $p[0]->count_total_posts,
            'total_profiles' => $p1[0]->count_total_profiles,
            'today_post' => $p2[0]->count_today_post,
            'today_ac' => $p3[0]->count_today_account,
        ]);
    }

    function paper_request()
    {
        $u = User::find(Auth::id());
        if ($u->role == 2) {
            $p = DB::table('admin_paper_request')
                ->select('*')
                ->get();
            if ($p == '[]')
                $p = null;
            return view('admin.tasks.paper_req', ['posts' => $p]);
        } else return redirect()->route('home');
    }

    function edit_request()
    {
        $u = User::find(Auth::id());
        if ($u->role == 2) {
            $all = DB::table('reviews_edit')
                ->join('reviews', 'reviews_edit.reviews_id', '=', 'reviews.id')
                ->join('users', 'reviews.users_id', '=', 'users.id')
                ->select('reviews_edit.*', 'users.name', 'users.email')
                ->get();
            if ($all == '[]')
                $all = null;
            return view('admin.tasks.reviewedit_req', ['posts' => $all]);
        } else return redirect()->route('home');
    }

    function editreq_approve($reviews)
    {
        $u = User::find(Auth::id());
        if ($u->role == 2) {
            $r = Review::find($reviews);
            $all = DB::table('reviews_edit')
                ->where('reviews_id', '=', $reviews)
                ->select('*')
                ->get();
            $r->summary = $all[0]->summary;
            $r->algo = $all[0]->algo;
            $r->sub = $all[0]->sub;
            $r->link = $all[0]->link;
            $r->res = $all[0]->res;
            $r->save();
            $visitor_id = DB::table('reviews_edit')
                ->rightJoin('views', 'reviews_edit.reviews_id', '=', 'views.reviews_id')
                ->select('views.users_id', 'views.reviews_id', 'reviews_edit.posts_id')
                ->distinct()
                ->get();
            foreach ($visitor_id as $data) {
                $a = User::find($data->users_id);
                $link = 'localhost:8000' . '/p/' . $data->posts_id . '/review/by' . $data->users_id . '/' . $data->reviews_id;
                Mail::to($a->email)->send(new change($link));
            }
            DB::table('reviews_edit')
                ->where('id', '=', $all[0]->id)
                ->delete();
            return redirect()->route('check_edit_req');
        } else return redirect()->route('home');
    }

    function editreq_decline($req)
    {
        $u = User::find(Auth::id());
        if ($u->role == 2) {
            DB::table('reviews_edit')
                ->where('id', '=', $req)
                ->delete();
            return redirect()->route('check_edit_req');
        } else return redirect()->route('home');

    }

    function assign_peer()
    {
        $r = DB::table('user_ratings')
            ->leftJoin('users', 'user_ratings.users_id', '=', 'users.id')
            ->select('ratings', 'users_id', 'name')
            ->where('role', '=', 1)
            ->orderBy('ratings', 'DESC')
            ->limit(5)
            ->get();

        return view('admin.tasks.peer', ['r' => $r]);

    }

    public function peer_assign(User $user)
    {
        $user->role = 3;
        $user->save();
        return redirect()->route('admin');
    }

}
