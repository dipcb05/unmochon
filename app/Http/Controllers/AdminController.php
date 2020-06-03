<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.login');
    }
    function login()
    {

            if (isset($_POST['identity']) && isset($_POST['password'])) {
                $identity = $_POST['identity'];
              //  $password = sha1($_POST['password']);
                $password = $_POST['password'];
                $a = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            }

            try {
                $conn = new PDO("mysql:host=localhost:3306; dbname=unmochon", "root", "abcdef12");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                echo "error";
            }
            if ($a == 'username')
                $q = "SELECT * from admins where username = '$identity' and password = '$password'";
            else $q = "select * from admins where email = '$identity' and password = '$password'";
            $ret = $conn->query($q);
            if ($ret->rowCount()) {
                echo "logged in";
                session_start();
               $_SESSION["isloggedin"] = true;
               return redirect()->route('dashboard.show');
            } else echo "failed, return back and try to login";

        }
        function dashboard()
        {
            if (session_status()) {
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
                $p4 = DB::table('admin_tasks')
                    ->select('*')
                    ->get();
                return view('admin.dashboard', ['total_post' => $p[0]->count_total_posts,
                    'total_profiles' => $p1[0]->count_total_profiles,
                    'today_post' => $p2[0]->count_today_post,
                    'today_ac' => $p3[0]->count_today_account,
                    'req' => $p4
                ]);
            }
            else echo 'you have to log in first as a admin';
        }
        function logout()
        {
            if (session_status())
            {
                session_abort();
                $_SESSION['isloggedin'] = false;
                return redirect()->route('admin.auth');
            }
            else echo 'log in first';
        }
}
