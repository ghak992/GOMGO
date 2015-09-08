<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class User extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
//        $rolls = \App\Role::all();
//        return view('user.create')->with('roles', $rolls);
    }

    public function info() {
        
    }

    public static function userAccessControl() {
        $pages = \Illuminate\Support\Facades\DB::table('system_page')
                ->join('user_page_auth', 'system_page.id', '=', 'user_page_auth.page')
                ->where('user_page_auth.user', '=', \Illuminate\Support\Facades\Auth::user()->id)
                ->select(
                        'system_page.*'
                )
                ->get();
        return view("pages.systemcontrol.pagesauth")
                        ->with("pages", $pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(\Illuminate\Http\Request $request) {

        $rules = [
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'sname' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            'userrolle' => 'required',
        ];
        $nicename = [
            'fname' => 'الاسم الأول',
            'mname' => 'الاسم الثاني',
            'lname' => 'الاسم الثالث',
            'sname' => 'القبيلة',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'userrolle' => 'صلاحيات المستخدم',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $add = new \App\User;
        $add->first_name = $request->input('fname');
        $add->middle_name = $request->input('mname');
        $add->last_name = $request->input('lname');
        $add->sair_name = $request->input('sname');
        $add->role = $request->input('userrolle');
        $add->email = $request->input('email');
        $add->password = bcrypt($request->input('password'));
        $add->save();
        return redirect()->back();
    }

    public function signin() {
        return view('user.login');
    }

    public function login(\Illuminate\Http\Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $nicename = [
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور'
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }


        if ($request->has('password') && $request->has('email')) {
            if (Auth::attempt(['email' => $request->input('email'),
                        'password' => $request->input('password')])) {

//              user access controll
                $pages = \Illuminate\Support\Facades\DB::table('system_page')
                        ->join('user_page_auth', 'system_page.id', '=', 'user_page_auth.page')
                        ->where('user_page_auth.user', '=', \Illuminate\Support\Facades\Auth::user()->id)
                        ->select(
                                'system_page.path'
                        )
                        ->get();
                $userauthpages = [];
                foreach ($pages as $page) {
                    array_push($userauthpages, $page->path);
                }
                session()->put('user-pages-auth', $userauthpages);



//                 Authentication passed...
                return redirect()->intended('system/route');
            } else {
                $request->flash();
                return redirect()->back()->withErrors(['loginwrong' => 'تأكد من معلومات تسجيل الدخول الخاصة بك']);
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $systempages = \App\System_page::all();
        $pages = \Illuminate\Support\Facades\DB::table('system_page')
                ->join('user_page_auth', 'system_page.id', '=', 'user_page_auth.page')
                ->where('user_page_auth.user', '=', $id)
                ->select(
                        'system_page.id'
                )
                ->get();
        $userauthpages = [];
        foreach ($pages as $page) {
            array_push($userauthpages, $page->id);
        }

        $rolls = \App\Role::all();
        $user = \Illuminate\Support\Facades\DB::table('user')
                ->where('user.id', '=', $id)
                ->join('role', 'user.role', '=', 'role.id')
                ->select(
                        'user.id', 'user.role', 'user.email', 'user.created_at', 'role.type', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name'
                )
                ->get();

        $request = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.creator', '=', $id)
                ->get();

        return view('pages.systemcontrol.userinfo')
                        ->with("user", $user)->with('roles', $rolls)
                        ->with("id", $id)
                        ->with("flag", "userinfo")
                        ->with("request", $request)
                        ->with("userauthpages", $userauthpages)
                        ->with("systempages", $systempages);
    }

    public function profile() {
        
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }

        $id = \Illuminate\Support\Facades\Auth::user()->id;
        $rolls = \App\Role::all();
        $user = \Illuminate\Support\Facades\DB::table('user')
                ->where('user.id', '=', $id)
                ->join('role', 'user.role', '=', 'role.id')
                ->select(
                        'user.id', 'user.role', 'user.email', 'user.created_at', 'role.type', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name'
                )
                ->get();

        $request = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.creator', '=', $id)
                ->get();

        return view('user.profile')
                        ->with("user", $user)->with('roles', $rolls)
                        ->with("flag", "profile")
                        ->with("id", $id)
                        ->with("request", $request);
    }

    public function userrequestslist($id) {
        
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.creator', '=', $id)//from the table 1 = new
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');
        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "userRequestsList")
                        ->with("pagetitle", "طلبات المساعدة")
                        ->with("requests", $requests);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(\Illuminate\Http\Request $request) {
        $rules = [
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'sname' => 'required',
        ];
        $nicename = [
            'fname' => 'الاسم الأول',
            'mname' => 'الاسم الثاني',
            'lname' => 'الاسم الثالث',
            'sname' => 'القبيلة'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = \App\User::findOrNew($request->id);
        $update->first_name = $request->input('fname');
        $update->middle_name = $request->input('mname');
        $update->last_name = $request->input('lname');
        $update->sair_name = $request->input('sname');
        if ($request->has('userrolle')) {
            $update->role = $request->input('userrolle');
        }
        $update->save();
        return redirect()->back();
    }

    public function updateaccessauth(\Illuminate\Http\Request $request) {

        \DB::table('user_page_auth')->where('user', '=', $request->input("userid"))->delete();
        $pages = [];
        $pages = $request->input("user-pages-auth");
        foreach ($pages as $pageid) {
            $add = new \App\User_page_auth;
            $add->user = $request->input("userid");
            $add->page = $pageid;
            $add->save();
        }

        if ($request->input("userid") == \Auth::user()->id) {
            session()->forget('user-pages-auth');
            //              user access controll
            $pages = \Illuminate\Support\Facades\DB::table('system_page')
                    ->join('user_page_auth', 'system_page.id', '=', 'user_page_auth.page')
                    ->where('user_page_auth.user', '=', \Illuminate\Support\Facades\Auth::user()->id)
                    ->select(
                            'system_page.path'
                    )
                    ->get();
            $userauthpages = [];
            foreach ($pages as $page) {
                array_push($userauthpages, $page->path);
            }
            session()->put('user-pages-auth', $userauthpages);
        }

        return redirect()->back();
    }

    public function updateemail(\Illuminate\Http\Request $request) {
        $rules = [
            'email' => 'required|email|unique:user'
        ];
        $nicename = [
            'email' => 'البريد الإلكتروني'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = \App\User::findOrNew($request->id);
        $update->email = $request->input('email');
        $update->save();
        return redirect()->back();
    }

    public function updatepass(\Illuminate\Http\Request $request) {
        $rules = [
            'password' => 'required|min:6'
        ];
        $nicename = [
            'password' => 'كلمة المرور'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $update = \App\User::findOrNew($request->id);
        $update->password = bcrypt($request->input('password'));
        $update->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
