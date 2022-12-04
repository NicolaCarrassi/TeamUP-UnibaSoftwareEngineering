<?php

namespace App\Http\Controllers\Idea;

use App\Feed;
use App\Http\Controllers\Idea\AbstractIdeaController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\NotificationController;
use App\Project;
use App\ProjectsArchive;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Team;
use App\User;
use Psy\VersionUpdater\NoopChecker;


class ProjectController extends AbstractIdeaController{

    const DESCRIPTION = 'description';
    const MANDATORY = 'required';
    const TASK_TEAMMATE = 'tasks.teammate_id';
    const USER_ID = 'users.id';
    const FEED_ID = 'feeds.user_id';

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        Parent::__construct();
        $this->middleware('auth');
    }

    /** Metodo che si occupa della trasformazione di un'idea in progetto, quindi del suo effettivo avvio con
     *  conseguente invio delle notifiche necessarie a tutti i teammate del progetto
     *
     * @param $id Id del progetto da avviare
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startProject($id){
        $project = Project::find($id);
        $project->idea_start_at = now();
        $project->save();

        $teammates = Team::where(self::PROJECT_ID, $id)->get();
        foreach ($teammates as $teammate){
            $user = User::find($teammate->teammate_id);
            $mailData = [
                NotificationController::EMAIL => $user->email,
                NotificationController::TEAMMATE => $user->username,
                NotificationController::PROJECT => $project->name,
            ];
             NotificationController::mailSend(NotificationController::AVVIO_PROGETTO, $mailData);
        }

        return redirect()->route('riepilogativePage', $id);
    }

    /** Metodo che si occupa della chiusura del progetto da parte del leader, con
     *  conseguente invio delle notifiche necessarie a tutti i teammate del progetto
     *
     * @param $id Id del progetto da terminare
     * @return \Illuminate\Http\RedirectResponse
     */
    public function endProject($id){
        $partecipationList = Team::where(self::PROJECT_ID, $id)->get();
        $projectName = Project::where('id', $id)->pluck('name')->first();

        ProjectsArchive::create([
            self::PROJECT_ID => $id,
            'end_date' => now(),
            'ended' => 1,
        ]);

        foreach ($partecipationList as $partecipation){
            $teammate = User::where('id', $partecipation->teammate_id)->first();

            $mailData = [
                NotificationController::EMAIL => $teammate->email,
                NotificationController::TEAMMATE =>$teammate->username,
                NotificationController::PROJECT => $projectName,
            ];
            NotificationController::mailSend(NotificationController::TERMINE_PROGETTO, $mailData);
        }


        return redirect()->route('riepilogativePage', $id);
    }

    /**
     * Il metodo permette di annullare una richiesta di partecipazione
     *
     * @param $id int id della richiesta da annullare
     * @return \Illuminate\Http\RedirectResponse
     */
    public function annullaRichiesta($id){
        DB::table('requests')->delete($id);
        return redirect()->back();
    }

    /** Metodo che si occupa del caricamento della schermata nella quale poter inserire e visualizzare tutte le idee
     *  e aggiornamenti del progetto
     *
     * @param $id Id del progetto di cui si intende visualizzare la schermata sopra descritta
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showTasksAndFeeds($id){
        $informations = parent::loadInformationAlwaysDisplayed($id);
        $this->authorize('view', $informations['progetto']);
        $tasks = DB::table('tasks')
            ->join(self::USER, self::TASK_TEAMMATE, '=', self::USER_ID)
            ->select('tasks.id', self::TASK_TEAMMATE, 'users.username', 'tasks.description', 'tasks.assignment_date')
            ->where('tasks.project_id', '=', $id)
            ->simplePaginate(5);
        $feeds = DB::table('feeds')
            ->join(self::USER, self::FEED_ID, '=', self::USER_ID)
            ->select(self::FEED_ID, 'users.username', 'feeds.description', 'feeds.feed_date')
            ->where('feeds.project_id', '=', $id)
            ->simplePaginate(5);
        return view('idea/taskFeeds', array_merge($informations, ['compiti'=>$tasks, 'aggiornamenti'=>$feeds]));
    }

    /**
     * Il metodo permette la paginazione della tabella che mostra i compiti assegnati
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tasksPagination(Request $request) {
        if($request->ajax()) {
            $tasks = DB::table('tasks')
                ->join(self::USER, self::TASK_TEAMMATE, '=', self::USER_ID)
                ->select('tasks.id', self::TASK_TEAMMATE, 'users.username', 'tasks.description', 'tasks.assignment_date')
                ->where('tasks.project_id', '=', $request->input('project_id'))
                ->simplePaginate(5);
            return view('components.task-assigned-modal-table',[
                'compiti' => $tasks
            ]);
        }
    }

    /**
     * Il metodo permette la paginazione della tabella che mostra nuovi aggiornamenti realtivi al progetto
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedsPagination(Request $request) {
        if($request->ajax()) {
            $feeds = DB::table('feeds')
                ->join(self::USER, self::FEED_ID, '=', self::USER_ID)
                ->select(self::FEED_ID, 'users.username', 'feeds.description', 'feeds.feed_date')
                ->where('feeds.project_id', '=', $request->input('project_id'))
                ->simplePaginate(5);
            return view('components.feeds-assinged-modal-table',[
                'aggiornamenti' => $feeds
            ]);
        }
    }

    /** Metodo che consente la creazione di un nuovo compito, che pertanto si interfaccia con il model per la memorizzazione
     *  dello stesso nella sorgente dati.
     *
     * @param $id Id del progetto al quale il leader intende aggiungere un compito
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewTask($id){
        $data = request()->validate([
            self::DESCRIPTION => [self::MANDATORY, 'string', 'max:300'],
            'task_to_user' => self::MANDATORY,
        ]);
        $teammate_id = DB::table(self::USER)->where('username', $data['task_to_user'])->pluck('id')->first();
        Task::create([
            self::DESCRIPTION => $this->convertInputString($data[self::DESCRIPTION]),
            self::PROJECT_ID => $id,
            'teammate_id' => $teammate_id,
            'assignment_date' => now(),
        ]);
        $project= Project::where('id',$id)->first();
        $leader = User::where('id', $project->leader_id)->first();
        $teammate = User::find($teammate_id);
        if($teammate->id  !== $leader->id) {
            $mailSend = [
              NotificationController::EMAIL => $teammate->email,
                NotificationController::TEAMMATE => $teammate->username,
                NotificationController::LEADER => $leader->username,
                NotificationController::PROJECT => $project->name,
                NotificationController::COMPITO => $data[self::DESCRIPTION],
             ];
            NotificationController::mailSend(NotificationController::ASSEGNO_COMPITO, $mailSend);
        }

        return redirect()->route('tasksAndFeeds', $id);
    }

    /** Metodo che consente la creazione di un nuovo aggiornamento, che pertanto si interfaccia con il model per la memorizzazione
     *  dello stesso nella sorgente dati.
     *
     * @param $id Id del progetto al quale si intende aggiungere un aggiornamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewFeed($id){
        $data = request()->validate([
            'feed' => [self::MANDATORY, 'string', 'max:150'],
        ]);
        $teammate_id = auth()->user()->id;
        Feed::create([
            self::DESCRIPTION => $data['feed'],
            self::PROJECT_ID => $id,
            'user_id' => $teammate_id,
            'feed_date' => now(),
        ]);
        return redirect()->route('tasksAndFeeds', $id);
    }

    /** Metodo che consente al leader la rimozione di più teammate simultaneamente dal progetto
     *
     * @param $id Id del progetto dal quale si vogliono rimuovere i teammate
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeTeammates($id){
        $data = request()->all();
        $project = Project::find($id);
        $componentiAttuali = $project->numberOfComponentsActual;
        foreach($data as $key => $value){
            if($key != '_token' && $value != 0) {
                $partecipazione = Team::where([[self::PROJECT_ID, $id], ['teammate_id', $key]]);
                $partecipazione->delete();
                $componentiAttuali--;

                $teammate = User::where('id', $key)->first();
                $mailData = [
                    NotificationController::EMAIL => $teammate->email,
                    NotificationController::TEAMMATE => $teammate->username,
                    NotificationController::PROJECT => $project->name,
                ];
                NotificationController::mailSend(NotificationController::RIMOZIONE_PROGETTO, $mailData);

            }
        }
        $project->numberOfComponentsActual = $componentiAttuali;
        $project->save();
        return redirect('/idea/'.$project->id);
    }

    public function create(){

    }

    public function modify($id){

    }

    public function delete($id){

    }

    public function store($tipology, $id){

    }


}
