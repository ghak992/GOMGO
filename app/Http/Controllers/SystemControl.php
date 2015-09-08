<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SystemControl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
    }

    public function users() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $rolls = \App\Role::all();


        $users = \Illuminate\Support\Facades\DB::table('user')
                ->join('role', 'user.role', '=', 'role.id')
                ->select('user.id', 'user.created_at', 'role.type', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                ->orderBy('user.created_at', 'DESC')
                ->paginate(26);
        $users->setPath('');

        return view('pages.systemcontrol.users')
                        ->with('users', $users)
                        ->with('roles', $rolls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    public function systempages() {

        $systempage = \Illuminate\Support\Facades\DB::table('system_page')
                ->orderBy('system_page.created_at', 'DESC')
                ->paginate(25);
        $systempage->setPath('');
        $pagesid = [];
        foreach ($systempage as $key => $value) {
            array_push($pagesid, $value->id);
        }

        $pagesusercount = [];
        foreach ($pagesid as $value) {
            $count = \Illuminate\Support\Facades\DB::table('user_page_auth')
                    ->select(\Illuminate\Support\Facades\DB::raw('count(*) as users_count'))
                    ->where('user_page_auth.page', '=', $value)
                    ->get();
            $pagesusercount[$value] = $count[0]->users_count;
        }

        return view("pages.systemcontrol.systempages")
                        ->with("systempage", $systempage)
                        ->with("pagesusercount", $pagesusercount);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(\Illuminate\Http\Request $request) {
        //
    }

    public function updatesystempage(\Illuminate\Http\Request $request) {
        $update = \App\System_page::findOrNew($request->input('id'));
        $update->path = $request->input('path');
        $update->title = $request->input('title');
        $update->note = $request->input('note');
        $update->save();
        $array['status'] = 'true';
        return \Illuminate\Support\Facades\Response::json($array);
    }
    public function deletesystempage(\Illuminate\Http\Request $request) {
        \App\System_page::where('id', $request->input('id'))->delete();
        $array['status'] = 'true';
        return \Illuminate\Support\Facades\Response::json($array);
    }

    public function storesystempage(\Illuminate\Http\Request $request) {
        $rules = [
            'path' => 'required|string|unique:system_page',
            'title' => 'required|string',
            'note' => 'required|string'
        ];
        $nicename = [
            'path' => 'مسار الصفحة',
            'title' => 'عنوان الصفحة',
            'note' => 'وصف الصفحة'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $add = new \App\System_page;
        $add->path = $request->input('path');
        $add->title = $request->input('title');
        $add->note = $request->input('note');
        $add->save();

        return redirect()->back()->with("addsucsess", TRUE);
    }

    public function pagesaccessusers(\Illuminate\Http\Request $request) {
        $users = \Illuminate\Support\Facades\DB::table('user_page_auth')
                ->join('user', 'user_page_auth.user', '=', 'user.id')
                ->select('user.id', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                ->where('user_page_auth.page', '=', $request->input("pageid"))
                ->orderBy('user.created_at', 'DESC')
                ->get();



        return \Illuminate\Support\Facades\Response::json($users);
    }

    public function storebudget(\Illuminate\Http\Request $request) {
        $rules = [
            'year' => 'required|numeric|unique:aid_budget',
            'amount' => 'required'
        ];
        $nicename = [
            'year' => 'السنة',
            'amount' => 'الميزانية'
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $add = new \App\Aid_budget;
        $add->year = $request->input('year');
        $add->amount = $request->input('amount');
        $add->creator = \Illuminate\Support\Facades\Auth::user()->id;
        $add->save();

        return redirect()->back();
    }

    public function search(\Illuminate\Http\Request $request) {
        $data = [];
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->where('request.id', '=', $request->input('searckeyword'))//ID of maneger on role table
                ->orwhere('request.requester_civil_id', '=', $request->input('searckeyword'))//ID of maneger on role table
                ->select(
                        'request.id', 'request.requester_first_name', 'request.requester_last_name', 'request.requester_sair_name'
                )
                ->get();


        foreach ($requests as $request) {
            array_push($data, ["name" => $request->requester_first_name
                . " " . $request->requester_last_name .
                " " . $request->requester_sair_name,
                "id" => $request->id]);
        }
        return \Illuminate\Support\Facades\Response::json($data);
    }

    public static function sendEmaile($request_id, $created_date, $operation_title) {

        $users = \Illuminate\Support\Facades\DB::table('user')
                ->where('user.role', '=', 3)//ID of maneger on role table
                ->select(
                        'user.email', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name'
                )
                ->get();

        $requesterinfo = \Illuminate\Support\Facades\DB::table('request')
                ->where('request.id', '=', $request_id)//ID of maneger on role table
                ->select(
                        'request.requester_first_name', 'request.requester_middle_name', 'request.requester_last_name', 'request.requester_sair_name'
                )
                ->get();
        $requester_name = $requesterinfo[0]->requester_first_name . ' ' .
                $requesterinfo[0]->requester_middle_name . ' ' .
                $requesterinfo[0]->requester_last_name . ' ' .
                $requesterinfo[0]->requester_sair_name;

        $emaildata = ['request_id' => $request_id, 'requestername' => $requester_name, 'operation_title' => $operation_title, 'created_at' => $created_date];
        foreach ($users as $user) {
            $data = [$user, $operation_title];
            \Illuminate\Support\Facades\Mail::send('emails.requestoperations', $emaildata, function ($m) use ($data) {
                $name = $data[0]->first_name . ' ' . $data[0]->middle_name . ' ' . $data[0]->sair_name;
                $m->to($data[0]->email, $name)->subject($data[1]);
            });
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function budget() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $yearsbudget = \Illuminate\Support\Facades\DB::table('aid_budget')->paginate(25);
        $yearsbudget->setPath('');
        $years = [];
        foreach ($yearsbudget as $key => $value) {
            array_push($years, $value->year);
        }


        $yearsexchangeide = [];
        for ($index = 0; $index < count($years); $index++) {
            $yearexchangeide = \Illuminate\Support\Facades\DB::table('aid_exchange')
                    ->select(\Illuminate\Support\Facades\DB::raw('SUM(amount) as total'))
                    ->where(\Illuminate\Support\Facades\DB::raw('YEAR(created_at)'), '=', $years[$index])
                    ->get();
            $yearsexchangeide[$years[$index]] = ($yearexchangeide[0]->total < 1) ? 0 : $yearexchangeide[0]->total;
        }

        $approvedaidsbudget = [];
        for ($index = 0; $index < count($years); $index++) {
            $approvedaidbudget = \Illuminate\Support\Facades\DB::table('last_check')
                    ->select(\Illuminate\Support\Facades\DB::raw('SUM(aide_amount) as total'))
                    ->where(\Illuminate\Support\Facades\DB::raw('YEAR(created_at)'), '=', $years[$index])
                    ->get();
            $approvedaidsbudget[$years[$index]] = ($approvedaidbudget[0]->total < 1) ? 0 : $approvedaidbudget[0]->total;
        }

        return view("pages.systemcontrol.budget")
                        ->with("yearsbudget", $yearsbudget)
                        ->with("approvedaidsbudget", $approvedaidsbudget)
                        ->with("yearsexchangeide", $yearsexchangeide);
    }

    public function show($id) {
        //
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
    public function update(\Illuminate\Http\Request $request, $id) {
        //
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
