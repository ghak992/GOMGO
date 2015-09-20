<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListExpostController extends Controller {

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        //
    }

    public function alllist($flag) {
        if ($flag == "newRequestsList") {

            return \Maatwebsite\Excel\Facades\Excel::create(
                            'الطلبات الجديدة' . ' ' . date("Y/m/d ") . ' | ' . date("h:i:sa"), function($excel) {

                        $excel->sheet('New sheet', function($sheet) {
                            $requests = \Illuminate\Support\Facades\DB::table('request')
                                    ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                                    ->join('request_status', 'request.status', '=', 'request_status.id')
                                    ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                                    ->select(
                                            'request.*', 'muscat_state.state_name', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                                    ->where('request.status', '=', 1)//from the table 1 = new
//                ->orderBy('request.created_at', 'desc')
                                    ->get();
                            $data = [array('حالة الطلب', 'سبب الطلب', 'رقم الطلب', 'الهاتف', 'العنوان', 'الرقم المدني', 'الإسم', '')];
                            $count = 1;
                            foreach ($requests as $request) {
                                array_push($data, [
                                    $request->requeststatus,
                                    $request->requestreasone,
                                    $request->id,
                                    $request->requester_phone,
                                    $request->state_name . '/' . $request->requester_address_district,
                                    $request->requester_civil_id,
                                    $request->requester_first_name . ' ' .
                                    $request->requester_middle_name . ' ' .
                                    $request->requester_last_name . ' ' .
                                    $request->requester_sair_name,
                                    $count
                                        ]
                                );
                                $count++;
                            }
                            $sheet->setFontSize(15);
                            $sheet->setAutoSize(true);
                            $sheet->setAllBorders('thin');
                            $sheet->fromArray($data, null, FALSE, 'A1', FALSE, FALSE);
                        });
                    })->download('xlsx');
        } 
        else if ($flag == "checkedRequestsList") {
            return \Maatwebsite\Excel\Facades\Excel::create(
                            'الطلبات المراجعة في انتظار الموافقة' . ' ' . date("Y/m/d ") . ' | ' . date("h:i:sa"), function($excel) {

                        $excel->sheet('New sheet', function($sheet) {
                            $requests = \Illuminate\Support\Facades\DB::table('request')
                                    ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                                    ->join('request_status', 'request.status', '=', 'request_status.id')
                                    ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                                    ->select(
                                            'request.*', 'muscat_state.state_name', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                                    ->where('request.status', '=', 3)//from the table 3 = checked request
//                ->orderBy('request.created_at', 'desc')
                                    ->get();
                            $data = [array('حالة الطلب', 'سبب الطلب', 'رقم الطلب', 'الهاتف', 'العنوان', 'الرقم المدني', 'الإسم', '')];
                            $count = 1;
                            foreach ($requests as $request) {
                                array_push($data, [
                                    $request->requeststatus,
                                    $request->requestreasone,
                                    $request->id,
                                    $request->requester_phone,
                                    $request->state_name . '/' . $request->requester_address_district,
                                    $request->requester_civil_id,
                                    $request->requester_first_name . ' ' .
                                    $request->requester_middle_name . ' ' .
                                    $request->requester_last_name . ' ' .
                                    $request->requester_sair_name,
                                    $count
                                        ]
                                );
                                $count++;
                            }
                            $sheet->setFontSize(15);
                            $sheet->setAutoSize(true);
                            $sheet->setAllBorders('thin');
                            $sheet->fromArray($data, null, FALSE, 'A1', FALSE, FALSE);
                        });
                    })->download('xlsx');
        } 
        else if ($flag == "savedRequestsList") {
            return \Maatwebsite\Excel\Facades\Excel::create(
                            'قائمة الطلبات المحفوظة' . ' ' . date("Y/m/d ") . ' | ' . date("h:i:sa"), function($excel) {

                        $excel->sheet('New sheet', function($sheet) {
                            $requests = \Illuminate\Support\Facades\DB::table('request')
                                    ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                                    ->join('request_status', 'request.status', '=', 'request_status.id')
                                    ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                                    ->select(
                                            'request.*', 'muscat_state.state_name', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                                    ->where('request.status', '=', 2)//from the table 2 = save
//                ->orderBy('request.created_at', 'desc')
                                    ->get();
                            $data = [array('حالة الطلب', 'سبب الطلب', 'رقم الطلب', 'الهاتف', 'العنوان', 'الرقم المدني', 'الإسم', '')];
                            $count = 1;
                            foreach ($requests as $request) {
                                array_push($data, [
                                    $request->requeststatus,
                                    $request->requestreasone,
                                    $request->id,
                                    $request->requester_phone,
                                    $request->state_name . '/' . $request->requester_address_district,
                                    $request->requester_civil_id,
                                    $request->requester_first_name . ' ' .
                                    $request->requester_middle_name . ' ' .
                                    $request->requester_last_name . ' ' .
                                    $request->requester_sair_name,
                                    $count
                                        ]
                                );
                                $count++;
                            }
                            $sheet->setFontSize(15);
                            $sheet->setAutoSize(true);
                            $sheet->setAllBorders('thin');
                            $sheet->fromArray($data, null, FALSE, 'A1', FALSE, FALSE);
                        });
                    })->download('xlsx');
        } 
        else if ($flag == "approvedRequestsList") {
            return \Maatwebsite\Excel\Facades\Excel::create(
                            'قائمة الطلبات الموافق عليها' . ' ' . date("Y/m/d ") . ' | ' . date("h:i:sa"), function($excel) {

                        $excel->sheet('New sheet', function($sheet) {
                            $requests = \Illuminate\Support\Facades\DB::table('request')
                                    ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                                    ->join('request_status', 'request.status', '=', 'request_status.id')
                                    ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                                    ->join('last_check', 'request.id', '=', 'last_check.request')
                                    ->select(
                                            'request.*', 'last_check.aide_amount', 'muscat_state.state_name', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                                    ->where('request.status', '=', 4)////from the table 4 = approved
                                    ->orWhere(function($query) {
                                        $query->where('request.status', '=', 6); //from the table 6 = aid exchenge done
                                    })
//                ->orderBy('request.created_at', 'desc')
                                    ->get();
                            $data = [array('قيمة المساعدة بالريال', 'حالة الطلب', 'سبب الطلب', 'رقم الطلب', 'الهاتف', 'العنوان', 'الرقم المدني', 'الإسم', '')];
                            $count = 1;
                            foreach ($requests as $request) {
                                array_push($data, [
                                    $request->aide_amount,
                                    $request->requeststatus,
                                    $request->requestreasone,
                                    $request->id,
                                    $request->requester_phone,
                                    $request->state_name . '/' . $request->requester_address_district,
                                    $request->requester_civil_id,
                                    $request->requester_first_name . ' ' .
                                    $request->requester_middle_name . ' ' .
                                    $request->requester_last_name . ' ' .
                                    $request->requester_sair_name,
                                    $count
                                        ]
                                );
                                $count++;
                            }
                            $sheet->setFontSize(15);
                            $sheet->setAutoSize(true);
                            $sheet->setAllBorders('thin');
                            $sheet->fromArray($data, null, FALSE, 'A1', FALSE, FALSE);
                        });
                    })->download('xlsx');
        } 
        else if ($flag == "waitingexchangeRequestsList") {
            return \Maatwebsite\Excel\Facades\Excel::create(
                            'قائمة الطلبات في انتظار الصرف' . ' ' . date("Y/m/d ") . ' | ' . date("h:i:sa"), function($excel) {

                        $excel->sheet('New sheet', function($sheet) {
                            $requests = \Illuminate\Support\Facades\DB::table('request')
                                    ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                                    ->join('request_status', 'request.status', '=', 'request_status.id')
                                    ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                                    ->join('last_check', 'request.id', '=', 'last_check.request')
                                    ->select(
                                            'request.*', 'last_check.aide_amount', 'muscat_state.state_name', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                                    ->where('request.status', '=', 4)
                                    ->get();
                            $data = [array('قيمة المساعدة بالريال', 'حالة الطلب', 'سبب الطلب', 'رقم الطلب', 'الهاتف', 'العنوان', 'الرقم المدني', 'الإسم', '')];
                            $count = 1;
                            foreach ($requests as $request) {
                                array_push($data, [
                                    $request->aide_amount,
                                    $request->requeststatus,
                                    $request->requestreasone,
                                    $request->id,
                                    $request->requester_phone,
                                    $request->state_name . '/' . $request->requester_address_district,
                                    $request->requester_civil_id,
                                    $request->requester_first_name . ' ' .
                                    $request->requester_middle_name . ' ' .
                                    $request->requester_last_name . ' ' .
                                    $request->requester_sair_name,
                                    $count
                                        ]
                                );
                                $count++;
                            }
                            $sheet->setFontSize(15);
                            $sheet->setAutoSize(true);
                            $sheet->setAllBorders('thin');
                            $sheet->fromArray($data, null, FALSE, 'A1', FALSE, FALSE);
                        });
                    })->download('xlsx');
        } 
        else if ($flag == "exchangeRequestsList") {
            return \Maatwebsite\Excel\Facades\Excel::create(
                            'الطلبات المصروفة' . ' ' . date("Y/m/d ") . ' | ' . date("h:i:sa"), function($excel) {

                        $excel->sheet('New sheet', function($sheet) {
                            $requests = \Illuminate\Support\Facades\DB::table('request')
                                    ->join('muscat_state', 'request.address_state', '=', 'muscat_state.id')
                                    ->join('request_status', 'request.status', '=', 'request_status.id')
                                    ->join('request_reasone', 'request.reasone', '=', 'request_reasone.id')
                                    ->join('aid_exchange', 'request.id', '=', 'aid_exchange.request')
                                    ->join('exchange_way', 'exchange_way.id', '=', 'aid_exchange.exchange_way')
                                    ->select(
                                            'request.*', 'aid_exchange.created_at as exchange_date', 'exchange_way.name as exchangeway', 'aid_exchange.amount', 'muscat_state.state_name', 'request_reasone.type as requestreasone', 'request_status.title as requeststatus')
                                    ->where('request.status', '=', 6)
                                    ->get();
                            
                            $data = [
                                array('التاريخ',
                                    'طريقة الصرف',
                                    'قيمة المساعدة بالريال',
                                    'حالة الطلب', 'سبب الطلب',
                                    'رقم الطلب', 'الهاتف',
                                    'العنوان',
                                    'الرقم المدني',
                                    'الإسم',
                                    '')];
                            $count = 1;
                            foreach ($requests as $request) {
                                $arabicday = array('Saturday' => 'السبت',
                                    'Sunday' => 'الاحد',
                                    'Monday' => 'الاثنين',
                                    'Tuesday' => 'الثلاثاء',
                                    'Wednesday' => 'الاربعاء',
                                    'Thursday' => 'الخميس',
                                    'Friday' => 'الجمعة');
                                $basedate = strtotime($request->exchange_date);
                                $date = date("l", $basedate);
                                $day = $arabicday[$date].'';
                                $timestamp = strtotime($request->exchange_date);
                                $date = date('Y/m/d', $timestamp).'';
                                
                                array_push($data, [
                                    $date. ' ' .$day,
                                    $request->exchangeway,
                                    $request->amount,
                                    $request->requeststatus,
                                    $request->requestreasone,
                                    $request->id,
                                    $request->requester_phone,
                                    $request->state_name . '/' . $request->requester_address_district,
                                    $request->requester_civil_id,
                                    $request->requester_first_name . ' ' .
                                    $request->requester_middle_name . ' ' .
                                    $request->requester_last_name . ' ' .
                                    $request->requester_sair_name,
                                    $count
                                        ]
                                );
                                $count++;
                            }
                            $sheet->setFontSize(15);
                            $sheet->setAutoSize(true);
                            $sheet->setAllBorders('thin');
                            $sheet->fromArray($data, null, FALSE, 'A1', FALSE, FALSE);
                        });
                    })->download('xlsx');
        } 
        else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
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
    public function update(Request $request, $id) {
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
