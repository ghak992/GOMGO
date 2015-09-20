<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinancialaidssystemController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($year = null) {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        
        if ($year == null) {
            $year = date("Y");
        }
        $statistics = [];

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.requester_gender', '=', "M")
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->get();
        $statistics['mailsrequest'] = $requestscount[0]->requests_count;

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.requester_gender', '=', "F")
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->get();
        $statistics['femailsrequest'] = $requestscount[0]->requests_count;


        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.status', '=', 1)
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->get();
        $statistics['newrequest'] = $requestscount[0]->requests_count;

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.status', '=', 2)
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->get();
        $statistics['saved'] = $requestscount[0]->requests_count;

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.status', '=', 3)
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->get();
        $statistics['waitingapprove'] = $requestscount[0]->requests_count;

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.status', '=', 4)
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->orWhere(function($query) {
                    $query->where('request.status', '=', 6);
                })
                ->get();
        $statistics['approved'] = $requestscount[0]->requests_count;

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->where('request.status', '=', 4)
                ->get();
        $statistics['waitingexchange'] = $requestscount[0]->requests_count;

        $requestscount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                ->where('request.status', '=', 6)
                ->get();
        $statistics['exchange'] = $requestscount[0]->requests_count;

        $yearexchangeide = \Illuminate\Support\Facades\DB::table('last_check')
                ->select(\Illuminate\Support\Facades\DB::raw('SUM(aide_amount) as total'))
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(last_check.created_at)'), '=', $year)
                ->get();
        $statistics['approvedamount'] = $yearexchangeide[0]->total;


        $yearexchangeide = \Illuminate\Support\Facades\DB::table('aid_exchange')
                ->select(\Illuminate\Support\Facades\DB::raw('SUM(amount) as total'))
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(aid_exchange.created_at)'), '=', $year)
                ->get();
        $statistics['exchangeamount'] = $yearexchangeide[0]->total;

        $statistics['waitingexchangeamount'] = $statistics['approvedamount'] - $statistics['exchangeamount'];


        $states = \Illuminate\Support\Facades\DB::table('muscat_state')->get();
        $requestsbystates = [];
        for ($index = 0; $index < count($states); $index++) {
            $requestscount = \Illuminate\Support\Facades\DB::table('request')
                    ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                    ->where('request.address_state', '=', $states[$index]->id)
                    ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                    ->get();
            $requestsbystates[$states[$index]->id] = $requestscount[0]->requests_count;
        }


        $reasones = \Illuminate\Support\Facades\DB::table('request_reasone')->get();
        $requestsbyreasones = [];
        for ($index = 0; $index < count($reasones); $index++) {
            $requestscount = \Illuminate\Support\Facades\DB::table('request')
                    ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                    ->where('request.reasone', '=', $reasones[$index]->id)
                     ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', $year)
                    ->get();
            $requestsbyreasones[$reasones[$index]->id] = $requestscount[0]->requests_count;
        }


        $aidbudgetyears = \Illuminate\Support\Facades\DB::table('aid_budget')->get(["year"]);

        return view("pages.financialaidssystem.index")
                        ->with("reasones", $reasones)
                        ->with("requestsbyreasones", $requestsbyreasones)
                        ->with("statistics", $statistics)
                        ->with("aidbudgetyears", $aidbudgetyears)
                        ->with("year", $year)
                        ->with("requestsbystates", $requestsbystates)
                        ->with("states", $states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     * @return Response
     */
    public function create() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }

        $maritalstatus = \App\Marital_status::all();
        $muscatstates = \App\Muscat_state::all();
        $requestreasone = \App\Request_reasone::all();
        return view('pages.financialaidssystem.newrequest')
                        ->with("maritalstatus", $maritalstatus)
                        ->with("muscatstates", $muscatstates)
                        ->with("requestreasone", $requestreasone);
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
            'birthday' => 'required|date',
            'civilid' => 'required|numeric|min:8',
            'maritalstatus' => 'required',
            'gender' => 'required',
            'addressdistrict' => 'required|string',
            'state' => 'required|string',
            'phone' => 'required|numeric|min:8',
            'bankaccount' => 'required|numeric|min:14',
            'reasone' => 'required',
            'comments' => 'string',
        ];
        $nicename = [
            'fname' => 'الاسم الأول',
            'mname' => 'الاسم الثاني',
            'lname' => 'الاسم الثالث',
            'sname' => 'القبيلة',
            'birthday' => 'تاريخ الميلاد',
            'civilid' => 'الرقم المدني',
            'maritalstatus' => 'الحالة الإجتماعية',
            'gender' => 'الجنس',
            'addressdistrict' => 'إسم الحلة',
            'state' => 'الولاية',
            'phone' => 'رقم الهاتف',
            'bankaccount' => 'رقم الحساب البنكي',
            'reasone' => 'سبب الطلب',
            'comments' => 'الملاحظات',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $add = new \App\Request;
        $add->status = 1; //insert data from table request statuse
        $add->requester_first_name = $request->input('fname');
        $add->requester_middle_name = $request->input('mname');
        $add->requester_last_name = $request->input('lname');
        $add->requester_sair_name = $request->input('sname');

        $add->requester_bod = $request->input('birthday');
        $add->requester_civil_id = $request->input('civilid');
        $add->requester_marital_status = $request->input('maritalstatus');
        $add->requester_gender = $request->input('gender');
        $add->requester_address_district = $request->input('addressdistrict');
        $add->address_state = $request->input('state');

        $add->requester_phone = $request->input('phone');
        $add->requester_bank_acount_id = $request->input('bankaccount');
        $add->reasone = $request->input('reasone');
        $add->note = $request->input('comments');

        $add->creator = \Illuminate\Support\Facades\Auth::user()->id;

        $add->save();


        $files = $request->file('files');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = \Illuminate\Support\Facades\Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploadsFiles';
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $now = \DateTime::createFromFormat('U.u', microtime(true));

                $filename = $now->format("mdYHisu") . '.' . $extension;

                $upload_success = $file->move($destinationPath, $filename);
                $attachfile = new \App\Document;
                $attachfile->request = $add->id;
                $now = new \DateTime();
                $attachfile->name = $filename;
                $attachfile->filepath = $destinationPath;
                $attachfile->save();
                $uploadcount ++;
            }
        }


        SystemControl::sendEmaile($add->id, $add->created_at, "استقبال طلب مساعدة جديد");


        return \Illuminate\Support\Facades\Redirect::to('financial-aids-system/requests-info/' . $add->id);
    }

    public function firstcheck(\Illuminate\Http\Request $request) {
        $add = new \App\First_check;
        $add->request = $request->input('id');
        $add->checker = \Illuminate\Support\Facades\Auth::user()->id;
        $add->note = $request->input('comments');
        $add->aid_amount = $request->input('aidvalue');
        $add->save();

        $update = \App\Request::findOrNew($request->input('id'));
        $update->status = 3; //from request_status on database 3 mean first check done
        $update->save();

        $arabicday = array('Saturday' => 'السبت',
            'Sunday' => 'الاحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الاربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة');
        $basedate = strtotime($add->created_at);
        $date = date("l", $basedate);
        $day = $arabicday[$date];
        $timestamp = strtotime($add->created_at);
        $date = date('Y/m/d', $timestamp);


        $array['status'] = 'true';
        $array['info'] = $add;
        $array['created_at'] = $day . ' ' . $date;
        $array['user_name'] = \Illuminate\Support\Facades\Auth::user()->first_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->middle_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->last_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->sair_name;
        $array['user_id'] = \Illuminate\Support\Facades\Auth::user()->id;


        SystemControl::sendEmaile($request->input('id'), $add->created_at, "اضافة المراجعة للطلب");


        return \Illuminate\Support\Facades\Response::json($array);
    }

    public function saverequest(\Illuminate\Http\Request $request) {
        $add = new \App\Saved_request;
        $add->request = $request->input('id');
        $add->saved_by = \Illuminate\Support\Facades\Auth::user()->id;
        $add->note = $request->input('note');
        $add->last_status = $request->input('status');
        $add->save();

        $update = \App\Request::findOrNew($request->input('id'));
        $update->status = 2; //from request_status on database 2 mean save 
        $update->save();

        $arabicday = array('Saturday' => 'السبت',
            'Sunday' => 'الاحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الاربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة');
        $basedate = strtotime($add->created_at);
        $date = date("l", $basedate);
        $day = $arabicday[$date];
        $timestamp = strtotime($add->created_at);
        $date = date('Y/m/d', $timestamp);


        $array['status'] = 'true';
        $array['info'] = $add;
        $array['created_at'] = $day . ' ' . $date;
        $array['user_name'] = \Illuminate\Support\Facades\Auth::user()->first_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->middle_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->last_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->sair_name;
        $array['user_id'] = \Illuminate\Support\Facades\Auth::user()->id;

        SystemControl::sendEmaile($request->input('id'), $add->created_at, "تحويل الطلب للحفظ");


        return \Illuminate\Support\Facades\Response::json($array);
    }

    public function approved(\Illuminate\Http\Request $request) {
        $add = new \App\Last_check();
        $add->request = $request->input('id');
        $add->checker = \Illuminate\Support\Facades\Auth::user()->id;

        if ($request->has('comments')) {
            $add->not = $request->input('comments');
        }
        $add->aide_amount = $request->input('lastaidvalue');
        $add->save();

        $update = \App\Request::findOrNew($request->input('id'));
        $update->status = 4; //from request_status on database 3 mean approved
        $update->save();

        $arabicday = array('Saturday' => 'السبت',
            'Sunday' => 'الاحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الاربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة');
        $basedate = strtotime($add->created_at);
        $date = date("l", $basedate);
        $day = $arabicday[$date];
        $timestamp = strtotime($add->created_at);
        $date = date('Y/m/d', $timestamp);


        $array['status'] = 'true';
        $array['info'] = $add;
        $array['created_at'] = $day . ' ' . $date;
        $array['user_name'] = \Illuminate\Support\Facades\Auth::user()->first_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->middle_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->last_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->sair_name;
        $array['user_id'] = \Illuminate\Support\Facades\Auth::user()->id;


        SystemControl::sendEmaile($request->input('id'), $add->created_at, "تحويل طلب المساعدة للحفظ");


        return \Illuminate\Support\Facades\Response::json($array);
    }

    public function unsaverequest(\Illuminate\Http\Request $request) {

        $update = \App\Request::findOrNew($request->input('id'));
        $update->status = $request->input('status');
        $update->save();

        $array['status'] = 'true';

        SystemControl::sendEmaile($request->input('id'), $update->updated_at, "استخراج طلب المساعدة من الحفظ");

        return \Illuminate\Support\Facades\Response::json($array);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function userRequestsList($civilid) {
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.requester_civil_id', '=', $civilid)//from the table 1 = new
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');
        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "requesterRequestsList")
                        ->with("pagetitle", "الطلبات السابقة")
                        ->with("requests", $requests);
    }

    public function approvedRequestsList() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', date("Y"))
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.status', '=', 4)//from the table 4 = approved
                ->orWhere(function($query) {
                    $query->where('request.status', '=', 6);//from the table 6 = aid exchenge done
                })
                ->paginate(25);
        $requests->setPath('');
        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "approvedRequestsList")
                        ->with("pagetitle", "الطلبات الموافق عليها")
                        ->with("requests", $requests);
    }

    public function waitingexchangeRequestsList() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                ->join('last_check', 'request.id', '=', 'last_check.request')
                 ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', date("Y"))
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'last_check.id as last_check_id', 'last_check.created_at as last_check_created_at', 'last_check.updated_at as last_check_updated_at', 'last_check.request as last_check_request', 'last_check.checker as last_check_checker', 'last_check.not as last_check_not', 'last_check.aide_amount as approved_aide_amount', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.status', '=', 4)//from the table 4 = approved
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');
        return view('pages.financialaidssystem.waitingexchangerequestlist')
                        ->with("flag", "waitingexchangeRequestsList")
                        ->with("pagetitle", "الطلبات في انتظار الصرف")
                        ->with("requests", $requests);
    }

    public function exchangerequests($id) {

        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }

        $requestinfo = \Illuminate\Support\Facades\DB::table('last_check')
                ->join('request', 'last_check.request', '=', 'request.id')
                ->where('last_check.request', '=', $id)
                ->select('last_check.aide_amount', 'request.status', 'request.requester_first_name', 'request.requester_middle_name', 'request.requester_last_name', 'request.requester_sair_name'
                )
                ->get();
        $Exchange_way = \App\Exchange_way::all();
        return view('pages.financialaidssystem.aidexchange')
                        ->with('exchangeways', $Exchange_way)
                        ->with('requestinfo', $requestinfo)
                        ->with('requestid', $id);
    }

    public function exchange(\Illuminate\Http\Request $request) {

        $rules = [
            'id' => 'required',
            'aidvalue' => 'required',
            'exchangeway' => 'required',
        ];
        $nicename = [
            'id' => 'رقم الطلب',
            'aidvalue' => 'قيمة المساعدة المصروفة',
            'exchangeway' => 'طريقة الصرف',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        $validator->setAttributeNames($nicename);
        if ($validator->fails()) {
            $request->flash();
            $array['status'] = 'false';
            $array['errorflage'] = 'validation';
            $array['errors'] = $validator;
            return \Illuminate\Support\Facades\Response::json($array);
        }


        $yearbudget = \App\Aid_budget::where('year', date("Y"))->first()->amount;
        $yearexchangeide = \Illuminate\Support\Facades\DB::table('last_check')
                ->select(\Illuminate\Support\Facades\DB::raw('SUM(aide_amount) as total'))
                ->where(\Illuminate\Support\Facades\DB::raw('YEAR(created_at)'), '=', date('Y'))
                ->get();
        $yearexchangeide = $yearexchangeide[0]->total;

        if ((($yearexchangeide + $request->input('aidvalue')) > $yearbudget)) {
            $array['status'] = 'false';
            $array['errorflage'] = 'budget';
            $array['errorinfo'] = ['yearbudget' => $yearbudget, 'yearexchangeide' => $yearexchangeide];
            return \Illuminate\Support\Facades\Response::json($array);
        }


        $add = new \App\Aid_exchange();
        $add->request = $request->input('id');
        $add->amount = $request->input('aidvalue');
        $add->exchange_way = $request->input('exchangeway');
        $add->financial_user = \Illuminate\Support\Facades\Auth::user()->id;
        $add->save();


        $update = \App\Request::findOrNew($request->input('id'));
        $update->status = 6; //from request_status on database 6 = exchange done
        $update->save();

        $arabicday = array('Saturday' => 'السبت',
            'Sunday' => 'الاحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الاربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة');
        $basedate = strtotime($add->created_at);
        $date = date("l", $basedate);
        $day = $arabicday[$date];
        $timestamp = strtotime($add->created_at);
        $date = date('Y/m/d', $timestamp);


        $array['status'] = 'true';
        $array['info'] = $add;
        $array['created_at'] = $day . ' ' . $date;
        $array['user_name'] = \Illuminate\Support\Facades\Auth::user()->first_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->middle_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->last_name . ' ' .
                \Illuminate\Support\Facades\Auth::user()->sair_name;
        $array['user_id'] = \Illuminate\Support\Facades\Auth::user()->id;


        SystemControl::sendEmaile($request->input('id'), $add->created_at, "صرف المساعدة المالية");



        return \Illuminate\Support\Facades\Response::json($array);
    }

    public function newRequestsList() {


        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }

        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                 ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', date("Y"))
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.status', '=', 1)//from the table 1 = new
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');

        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "newRequestsList")
                        ->with("pagetitle", "الطلبات الجديدة")
                        ->with("requests", $requests);
    }

    public function checkedRequestsList() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                 ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', date("Y"))
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.status', '=', 3)//from the table 3 = checked request
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');

        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "checkedRequestsList")
                        ->with("pagetitle", "الطلبات المراجعة")
                        ->with("requests", $requests);
    }

    public function exchangeRequestsList() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                 ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', date("Y"))
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.status', '=', 6)
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');

        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "exchangeRequestsList")
                        ->with("pagetitle", "الطلبات المصروفة")
                        ->with("requests", $requests);
    }

    public function savedRequestsList() {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                 ->where(\Illuminate\Support\Facades\DB::raw('YEAR(request.created_at)'), '=', date("Y"))
                ->orderBy('request.created_at', 'DESC')
                ->select(
                        'request.*', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                ->where('request.status', '=', 2)//from the table 2 = save
//                ->orderBy('request.created_at', 'desc')
                ->paginate(25);
        $requests->setPath('');

        return view('pages.financialaidssystem.requestlist')
                        ->with("flag", "savedRequestsList")
                        ->with("pagetitle", "الطلبات المحفوظة")
                        ->with("requests", $requests);
    }

    public function show($id) {
        if (!in_array(rtrim(preg_replace('/[0-9]+/', '', Request::path()), '/'), session()->get('user-pages-auth'))) {
            return User::userAccessControl();
        }
        $request = \Illuminate\Support\Facades\DB::table('request')
                ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                ->join('request_status', 'request.status', '=', 'request_status.id')
                ->join('marital_status', 'request.requester_marital_status', '=', 'marital_status.id')
                ->join('user', 'request.creator', '=', 'user.id')
                ->where('request.id', '=', $id)
                ->select(
                        'request.*', 'muscat_state.state_name', 'request_reasone.type as reasone', 'request_status.title as requeststatus', 'marital_status.title as maritalstatus', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                ->get();
        $data['request'] = $request;


        $bastrequestcount = \Illuminate\Support\Facades\DB::table('request')
                ->select(\Illuminate\Support\Facades\DB::raw('count(*) as requests_count'))
                ->where('request.requester_civil_id', '=', $request[0]->requester_civil_id)
                ->get();

        $data['bastrequestcount'] = $bastrequestcount[0]->requests_count;


        $documents = \Illuminate\Support\Facades\DB::table('document')
                ->where('document.request', '=', $id)
                ->select('document.name', 'document.filepath')
                ->get();
        $data['documents'] = $documents;

         if (\App\Saved_request::where('saved_request.request', $id)->first() != null) {
            $savedinfo = \Illuminate\Support\Facades\DB::table('saved_request')
                    ->join('user', 'saved_request.saved_by', '=', 'user.id')
                    ->join('request_status', 'saved_request.last_status', '=', 'request_status.id')
                    ->where('saved_request.request', '=', $id)
                    ->orderBy('saved_request.created_at', 'DESC')
                    ->select(
                            'saved_request.*', 'request_status.title', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['savedinfo'] = $savedinfo;
        }

        if ($request[0]->status == 2) {
            if (\App\First_check::where('first_check.request', $id)->first() != null) {
                $checkinfo = \Illuminate\Support\Facades\DB::table('first_check')
                        ->join('user', 'first_check.checker', '=', 'user.id')
                        ->where('first_check.request', '=', $id)
                        ->select(
                                'first_check.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                        ->get();
                $data['checkinfo'] = $checkinfo;
            }
        }


        if ($request[0]->status == 3) {

            $checkinfo = \Illuminate\Support\Facades\DB::table('first_check')
                    ->join('user', 'first_check.checker', '=', 'user.id')
                    ->where('first_check.request', '=', $id)
                    ->select(
                            'first_check.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['checkinfo'] = $checkinfo;
        }

        if ($request[0]->status == 4) {


            $approvedinfo = \Illuminate\Support\Facades\DB::table('last_check')
                    ->join('user', 'last_check.checker', '=', 'user.id')
                    ->where('last_check.request', '=', $id)
                    ->select(
                            'last_check.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['approvedinfo'] = $approvedinfo;


            $checkinfo = \Illuminate\Support\Facades\DB::table('first_check')
                    ->join('user', 'first_check.checker', '=', 'user.id')
                    ->where('first_check.request', '=', $id)
                    ->select(
                            'first_check.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['checkinfo'] = $checkinfo;
        }

        if ($request[0]->status == 6) {


            $approvedinfo = \Illuminate\Support\Facades\DB::table('last_check')
                    ->join('user', 'last_check.checker', '=', 'user.id')
                    ->where('last_check.request', '=', $id)
                    ->select(
                            'last_check.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['approvedinfo'] = $approvedinfo;


            $checkinfo = \Illuminate\Support\Facades\DB::table('first_check')
                    ->join('user', 'first_check.checker', '=', 'user.id')
                    ->where('first_check.request', '=', $id)
                    ->select(
                            'first_check.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['checkinfo'] = $checkinfo;

            $exchange = \Illuminate\Support\Facades\DB::table('aid_exchange')
                    ->join('user', 'aid_exchange.financial_user', '=', 'user.id')
                    ->where('aid_exchange.request', '=', $id)
                    ->select(
                            'aid_exchange.*', 'user.first_name', 'user.middle_name', 'user.last_name', 'user.sair_name')
                    ->get();
            $data['exchange'] = $exchange;
        }


        return view('pages.financialaidssystem.requestinfo', $data);
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
    public function requesterpastrequest(\Illuminate\Http\Request $request) {
        $data = [];
        $requests = \Illuminate\Support\Facades\DB::table('request')
                ->where('request.requester_civil_id', '=', $request->input('civilid'))
                ->select(
                        'request.id', 
                        'request.requester_first_name', 
                        'request.requester_last_name',
                        'request.requester_middle_name',
                        'request.requester_sair_name',
                        'request.requester_bod',
                        'request.requester_bank_acount_id',
                        'request.requester_marital_status',
                        'request.address_state',
                        'request.requester_address_district',
                        'request.requester_phone',
                        'request.requester_gender'
                )
                ->get();

        $data["requesterinfo"] = $requests[0];
        $shortdata = [];
        foreach ($requests as $request) {
            array_push($shortdata, ["name" => $request->requester_first_name
                . " " . $request->requester_last_name .
                " " . $request->requester_sair_name,
                "id" => $request->id]);
            
        }
        $data["shortdata"] = $shortdata;
        return \Illuminate\Support\Facades\Response::json($data);
    }

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
