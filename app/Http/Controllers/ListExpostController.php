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
                    'الطلبات الجديدة' . ' '. date("Y/m/d "). ' | '.  date("h:i:sa"), 
                    function($excel) {

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
                                    $request->state_name. '/'. $request->requester_address_district,
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
        }  else {
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
