<?php

namespace App\Http\Controllers\Idea;

use App\Admins;
use App\CompetencesForIdea;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utility\NotificationController;
use App\Level;
use App\Project;
use App\ProjectsArchive;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Request;

abstract class AbstractIdeaController extends Controller
{

    const LEADER = 'leader';
    const TEAMMATE = 'teammate';
    const USER = 'users';
    const USERID = 'users.id';
    const PROJECT_ID = 'project_id';
    const PROGETTO = 'progetto';

    /**
     * AbstractIdeaController constructor.
     */
    public function __construct()
    {
    }

    /** Metodo che consente la visualizzazione della schermata di creazione di un'idea progettuale o di un progetto
     * @return mixed
     */
    public abstract function create();

    /** Metodo che consente la visualizzazione della schermata di modifica di un'idea progettuale o di un progetto
     *
     * @param $id Id del dell'idea o del progetto da modificare
     * @return mixed
     */
    public abstract function modify($id);

    /** Metodo che consente la visualizzazione della schermata di cancellazione di un'idea progettuale o di un progetto
     *
     * @param $id Id dell'idea o del progetto da modificare
     * @return mixed
     */
    public abstract function delete($id);

    /** Metodo che consente il salvataggio delle informazioni inserite in fase di creazione o di modifica di un'idea
     *  progettuale/progetto
     *
     * @param $tipology Tipologia di salvataggio (0 per la creazione, 1 per la modifica)
     * @param $id Id dell'idea o del progetto nel caso sia già noto
     * @return mixed
     */
    public abstract function store($tipology, $id);

    /** Metodo che consente al leader di reperire tutte le richieste di partecipazione per una specifica idea o progetto
     *
     * @param $id Id dell'idea o del progetto di cui si ricercano tutte le richieste di partecipazione pervenute
     * @return \Illuminate\Support\Collection
     */
    public function getRequests($id){
        return DB::table('requests')
            ->join(self::USER, 'requests.teammate_id', '=', self::USERID)
            ->select('users.username', 'requests.description', 'requests.id', 'requests.teammate_id', 'requests.sent_at', 'requests.state')
            ->where('requests.project_id', '=', $id)
            ->get();
    }

    /** Metodo che consente il caricamento dalle classi model di tutte le informazioni che sono sempre mostrate
     *  nella sidebar di tutte le view concernenti l'idea/progetto. Tra le informazioni citate vi sono id, username
     *  e nome del leader e dei teammate del progetto, richieste di partecipazione pervenute dal progetto, informazioni
     *  generali dell'idea/progetto
     *
     * @param $id Id del'idea o del progetto di cui si ricercano le informazioni
     * @return array array contentente l'oggetto Project e tutte le richieste di partecipazione
     */
    protected function loadInformationAlwaysDisplayed($id){
        $richieste = $this->getRequests($id);
        $project = Project::findOrFail($id);
        $info_leader = DB::table(self::USER)->where('id', '=', $project->leader_id)->select('username', 'name')->first();
        $project->leader_id = ['leader_id' => $project->leader_id, 'leader_username' => $info_leader->username, 'leader_name' =>  $info_leader->name];
        $teammates = DB::table('teams')
            ->join(self::USER, 'teams.teammate_id', '=', self::USERID)
            ->select( self::USERID, 'users.username', 'name')
            ->where('teams.project_id', '=', $project->id)
            ->get();
        $project->teammates = $teammates;
        $ended = ProjectsArchive::where(self::PROJECT_ID, $id)->exists();
        $project->project_end_at = $ended;
        return [self::PROGETTO=>$project, 'richieste'=>$richieste];
    }

    /** Metodo che consente il caricamento della schermata di visualizzazione delle info di un'ided progettuale
     *  o di un progetto
     *
     * @param $id Id del'idea o del progetto di cui si ricercano le informazioni$id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $informations = $this->loadInformationAlwaysDisplayed($id);
        $category_name = DB::table('categories')->where('id', '=', $informations[self::PROGETTO]->category_id)->pluck('category')->first();
        $competences_required = DB::table('competences')
            ->join('competences_for_ideas', 'competences.id', '=', 'competences_for_ideas.competence_id')
            ->select('competences.competence', 'competences_for_ideas.level')
            ->where('competences_for_ideas.project_id', '=', $informations[self::PROGETTO]->id)
            ->get();
        $this->substituteLevel($competences_required);
        $informations[self::PROGETTO]->category_id = $category_name;
        return view('idea/infoIdea', array_merge($informations, ['competenze_richieste'=>$competences_required]));
    }

    /** Il metodo permette di sponsorizzare un progetto e di segnalarlo come sponsorizzato
     * Non gestisce il metodo in cui viene effettuato il pagamento della segnalazione
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sponsor($id){
        $projectualIdea = Project::findOrFail($id);
        $projectualIdea->sponsored = 1;
        $projectualIdea->save();
        return redirect()->back();
    }

    /** Metodo che consente la sostituzione dell'id del livello con la stringa ad esso associata
     * @param $searched array di tutti i livelli delle competenze di cui si vuole ottenere la stringa associata
     */
    protected function substituteLevel($searched){
        for($i = 0; $i < count($searched); $i++){
            $searched[$i]->level = Level::getStringLevel($searched[$i]->level);
        }
    }

    /** Metodo che standardizza tutte le stringhe inserite in input dall'utente registrato di modo che inizino
     *  sempre con la lettera maiuscola e proseguino con le lettere minuscole (ad eccezione di nomi e cognomi)
     *
     * @param $string Stringa della quale si intende eseguire la conversione
     * @return string Stringa convertita
     */
    protected function convertInputString($string){
        return ucfirst(mb_strtolower($string));
    }

    /** Metodo che consente la rimozione di tutte le competenze richieste da un progetto, utile sia per la il controller
     *  dell'admin che per il controller dell'idea
     * @param $id Id dell'idea o del progetto di cui si intendono cancellare tutte le competenze associate
     */
    public function removeForLeaderAndAdmin($id) {
        $competences_for_delete = CompetencesForIdea::where(self::PROJECT_ID, $id);
        $competences_for_delete->delete();
        $project = Project::find($id);
        $project->delete();
    }

    /** Metodo che consente la rimozione di tutte le competenze associate ad un progetto utile per il controller
     *  dell'idea, che esegue il redirect alla home della piattaforma
     *
     * @param $id Id dell'idea o del progetto di cui si intendono cancellare tutte le competenze associate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id){
        $project = Project::findOrFail($id);
        $this->authorize('update', $project);
        $this->removeForLeaderAndAdmin($id);

        return redirect()->route('home');
    }

    /**
     * Il metodo permette di abbandonare un progetto o un'idea progettuale, controllando che
     * l'utente sia partecipante del team o meno. In caso affermativo si passa al metodo che permette
     * la rimozione effettiva del teammate
     *
     * @param $id int id del progetto che si intende abbandonare
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function leave($id){
        $progetto = Project::find($id);
        $team = Team::where(self::PROJECT_ID, $id)->get();
        $userId = Auth::id();
        $goToProject = true;

        if($userId === $progetto->leader_id){
            $goToProject = $this->removeFromProject($userId, $progetto,self::LEADER);
        } else {
            //controllo che sia nel team, se è parte di esso procedo con la rimozione
            if($this->isPartOfTeam($userId, $team)){
                $this->removeFromProject($userId, $progetto, self::TEAMMATE);
                //invio della mail
                $leader = User::find($progetto->leader_id);
                $mailData = [
                  NotificationController::EMAIL =>  $leader->email,
                    NotificationController::LEADER => $leader->username,
                    NotificationController::TEAMMATE => Auth::user()->username,
                    NotificationController::PROJECT => $progetto->name,
                ];
                NotificationController::mailSend(NotificationController::ABBANDONO_PROGETTO,$mailData);
            }
        }
        if($goToProject) {
            return redirect()->back();
        } else {
            return redirect('/');
        }
    }

    /**
     * Il metodo permette di effettuare la rimozione di un utente da un progetto o idea progettuale
     *
     * @param int $userId id dell'utente da rimuovere
     * @param Project $progetto progetto da cui si rimuove l'utente
     * @param string $role ruolo dell'utente nel progetto (leader o teammate)
     * @return bool true se il progetto è ancora esistente, false altrimenti
     * @throws \Exception
     */
    private function removeFromProject(int $userId, Project $progetto,string $role){
        $flag = true;
        if ($progetto->numberOfComponentsActual > 1) {
            if ($role === self::LEADER) {
                $eldestTeammate = Team::where(self::PROJECT_ID, $progetto->id)->orderByRaw('join_date')->first();
                $progetto->leader_id = $eldestTeammate->teammate_id;
                //utilizzato per rendere comune l'eliminazione della row dal db in quanto essendo il nuovo leader
                // non deve più essere presente nella tabella dei teammate per il progetto
                $userId = $eldestTeammate->teammate_id;

                //invio mail al nuovo leader
                $newLeader = User::find($userId);
                $mailData = [
                    NotificationController::EMAIL => $newLeader->email,
                    NotificationController::LEADER => $newLeader->username,
                    NotificationController::PROJECT => $progetto->name,
                ];
                NotificationController::mailSend(NotificationController::NEW_LEADER, $mailData);
            }
            $progetto->numberOfComponentsActual--;
            $progetto->save();
            DB::delete('delete from teams where teammate_id = ' . $userId);
        } else {
            $competences_for_delete = CompetencesForIdea::where(self::PROJECT_ID, $progetto->id);
            $competences_for_delete->delete();
            $progetto->delete();
            $flag = false;
        }
        return $flag;
    }

    /**
     * Il metodo permette di verificare se un utente è un teammate per il progetto o meno
     *
     * @param int $userId id dell'user che si ricerca
     * @param $team Collection di teammate per il progetto che si intende controllare
     * @return bool true se si appartiene al team, false altrimenti
     */
    private function isPartOfTeam(int $userId, $team){
        $flag = false;
        $i = 0;
        if(count($team) !== 0) {
            do {
                if ($userId === $team[$i]->teammate_id) {
                    $flag = true;
                }
                $i++;
            } while (!$flag && $i < count($team));
        }
        return $flag;
    }

}
