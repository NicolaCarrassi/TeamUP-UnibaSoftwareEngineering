<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Report;
use App\ReportProject;
use App\ReportUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller{

    //costanti utilizzate per fornire una migliore leggibilità al codice
    const USER_ID = "user_id";
    const PROJECT_ID = "project_id";
    const REASON = "reason";
    const DESCRIPTION = "description";
    const DATA_CREAZIONE= "created_at";
    const REPORTER = 'user1_id';
    const REPORTED = 'user2_id';
    const REPORTED_USER = 'reported_user_id';
    /**
     * Il metodo permette di effettuare una segnalazione ad un progetto
     *
     * @param Request $request dati della segnalazione passati mediante metodo post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeReportRequest(Request $request){
        $data = $request->all();


        if(!ReportProject::where([
            [self::PROJECT_ID, $data[self::PROJECT_ID]],
            [self::USER_ID, Auth::id()],])->exists()) {

            if ($data[self::DESCRIPTION] !== null) {
                ReportProject::Create([
                    self::USER_ID => Auth::id(),
                    self::PROJECT_ID => $data[self::PROJECT_ID],
                    self::REASON => $data[self::REASON],
                    self::DATA_CREAZIONE => now(),
                    self::DESCRIPTION => $data[self::DESCRIPTION]
                ]);
            } else {
                ReportProject::Create([
                    self::USER_ID => Auth::id(),
                    self::PROJECT_ID => $data[self::PROJECT_ID],
                    self::REASON => $data[self::REASON],
                    self::DATA_CREAZIONE => now()
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * Il metodo permette di effettuare una segnalazione verso un utente
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeReportRequestUser(Request $request) {
        $data = $request->all();

        if(!ReportUsers::where([
            [self::REPORTED,$data[self::REPORTED_USER] ],
            [self::REPORTER, Auth::id()],])->exists()) {

            if ($data[self::DESCRIPTION] !== null) {
                ReportUsers::Create([
                    self::REPORTER => Auth::id(),
                    self::REPORTED => $data[self::REPORTED_USER],
                    self::REASON => $data[self::REASON],
                    self::DATA_CREAZIONE => now(),
                    self::DESCRIPTION => $data[self::DESCRIPTION]
                ]);
            } else {
                ReportUsers::Create([
                    self::REPORTER => Auth::id(),
                    self::REPORTED => $data[self::REPORTED_USER],
                    self::REASON => $data[self::REASON],
                    self::DATA_CREAZIONE => now(),
                ]);
            }
        }

        return redirect()->back();
    }

}
