<?php

namespace App\Http\Controllers\admin;

use App\Admins;
use App\Competence;
use App\CompetencesForIdea;
use App\Http\Controllers\Idea\ProjectController;
use App\Http\Controllers\Utility\NotificationController;
use App\Report;
use App\ReportUsers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends AbstractAdminController {

    const CLOSEDATE = 'closedate';
    const HIDDENID_REPORT = 'hiddenid_report';
    const BAN = 'ban';
    const HIDDENID_OBJECT_REPORTED = 'hiddenid_object_reported';
    const ADMIN = 'admin';
    const REASON = 'reason';
    const NON_APPROPRIATO = 'Non è appropriato';
    const SPAM = 'Spam';


    /**
     * Il metodo permette di visualizzare la pagina delle segnalazioni relativa ai progetti e agli utenti segnalati
     *
     * @param $admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllReports($admin) {

        $all_reports_users = $this->getUtentiSegnalati(-1);
        $all_reports_projects = $this->getProgettiSegnalati(-1);

        return view('admin.adminsegnalazioni',[
           self::ADMIN => Admins::find($admin),
            'all_reports_users' => $all_reports_users,
            'all_reports_projects' => $all_reports_projects
        ]);
    }

    /**
     * Il metodo permette di visualizzare la pagina relativa alle idee segnalate
     *
     * @param $admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllIdeas($admin) {

        $all_ideas = $this->getIdee(-1);

        return view('admin.adminidee',[
           self::ADMIN => Admins::find($admin),
            'all_ideas' => $all_ideas
        ]);
    }

    /**
     * Il metodo permette di visualizzare la pagina relativa ai progetti attivi che sono stati segnalati
     *
     * @param $admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllActiveProjects($admin) {

        $active_projects = $this->getProgettiAttivi(-1);

        return view('admin.adminactiveprojects',[
           self::ADMIN => Admins::find($admin),
            'active_projects' => $active_projects
        ]);
    }

    /**
     * Il metodo permette di accetare o rifiutare la segnalazione relativa ad un utente,un progetto o un'idea progettuale.
     * Tramite il parametro $report_type viene specificato il tipo di report:
     * 0 se si tratta di un utente,
     * 1 se si tratta di un progetto o di un'idea progettuale.
     * L'esito della segnalazione viene specificato tramite il parametro $report.
     * Se l'esito della segnalazione dell'utente è 1,l'utente viene sanzionato per un tempo determinato stabilito dall'admin.
     * Se l'esito della segnalazione del progetto o dell'idea progettuale è 1,il progetto o l'idea progettuale viene eliminato/a
     *
     * @param Request $request
     * @param $report
     * @param $report_type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptReport(Request $request,$report,$report_type) {

        $data = $request->all();
        $now = now()->toDateString();


        if($report_type==0) {
            if($request->input(self::BAN)===null) {
                $request->validate([
                    self::CLOSEDATE => 'required | date | after_or_equal: ' . $now,
                ]);

                DB::update('update report_users set closed_at=timestamp("'.$data[self::CLOSEDATE].'") where id='.$data[self::HIDDENID_REPORT].';');
                DB::update('update users set report_end=timestamp("'.$data[self::CLOSEDATE].'") where id='.$data[self::HIDDENID_OBJECT_REPORTED].';');
                DB::update('update report_users set managed='.$report.' where id='.$data[self::HIDDENID_REPORT].';');
            } else {
                DB::update('update report_users set managed=3 where id='.$data[self::HIDDENID_REPORT].';');
                DB::update('update users set is_banned='.$data[self::BAN].' where id='.$data[self::HIDDENID_OBJECT_REPORTED].';');
            }
            $utente = User::find($data[self::HIDDENID_OBJECT_REPORTED]);
            $mailSend = [
                NotificationController::EMAIL => $utente->email,
                NotificationController::USER => $utente->username,
                NotificationController::SANZIONE => $this->getReason($data[self::HIDDENID_REPORT]),
            ];
            NotificationController::mailSend(NotificationController::INVIO_SANZIONE, $mailSend);

        } else {
            DB::delete('delete from report_projects where id='.$data[self::HIDDENID_REPORT].';');
            $project_controller = new ProjectController();
            $project_controller->removeForLeaderAndAdmin(self::HIDDENID_OBJECT_REPORTED);
        }

        return redirect()->back();
    }


    /**
     * Il metodo permette di visualizzare la pagina delle altre competenze inserite dall'utente o nella creazione di una nuova idea progettuale
     * non ancora verificate
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUnverifiedCompetences($id){
        $competenze = Competence::where('verified', 0)->get();
        $admin = Admins::find($id);
        return view('admin.accettaCompetenze',['competenze'=>$competenze,self::ADMIN=>$admin]);
    }

    /**
     * Il metodo permette di rendere una competenza verificata
     *
     * @param $id int id della competenza
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accettaCompetenza($id){

        $competenza = Competence::find($id);
        $competenza->verified = 1;
        $competenza->save();
        return redirect()->back();
    }

    /**
     * Il metodo permette all'admin di eliminare una competenza di cui si attende la verifica
     *
     * @param $id int id della competenza
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rifiutaCompetenze($id){
        DB::delete('delete from skills where competence_id = '. $id .';');
        DB::delete('delete from competences where id = '. $id .';');
        DB::delete('delete from competences_for_ideas where competence_id= '. $id .';');

        return redirect()->back();
    }


    /**
     * Il metodo restituisce il motivo della segnalazione specifando l'id relativa ad essa
     * @param int $idSegnalazione
     * @return string
     */
    private function getReason(int $idSegnalazione){
        $report = ReportUsers::where('id',$idSegnalazione)->pluck(self::REASON)->first();

        if((int)$report === 1){
            $reason = self::SPAM;
        } else {
            $reason = self::NON_APPROPRIATO;
        }

        return $reason;
    }

}
