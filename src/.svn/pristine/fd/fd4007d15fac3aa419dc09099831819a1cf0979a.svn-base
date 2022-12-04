<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller{


    /**
     * Il metodo permette di visualizzare il profilo di un utente
     *
     * @param $user int id dell'utente di cui si vuole visualizzare il profilo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($user){
        $user = User::findOrFail($user);

        $competenze = DB::select('select competence,level from ((competences inner join skills on competences.id=skills.competence_id) inner  join
            users on users.id=skills.user_id) where user_id='.$user->id.';');
        return view('profileview/profilo',[
            'user' => $user,
            'competenze' => $competenze
        ]);
    }


    /**
     * Il metodo permette di visualizzare lo storico dei progetti dell'utente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProjectArchive() {
        $user = Auth::user();

        $all_projects = DB::select('select projects.id,projects.name,users.username,leader_id,idea_start_at,end_date,ended from ((projects inner join users on projects.leader_id=users.id)
        inner join projects_archives on projects.id=projects_archives.project_id) where idea_start_at is not null;');

        $leader_projects = DB::select('select projects.id,projects.name,idea_start_at,end_date,ended from projects inner join projects_archives on projects.id=projects_archives.project_id
        where leader_id='.$user->id.' and idea_start_at is not null;');

        $teammate_projects = DB::select('select projects.id,projects.name,idea_start_at,end_date,ended,state from ((projects inner join projects_archives on projects.id=projects_archives.project_id)
        inner join requests on projects.id=requests.project_id) where requests.teammate_id='.$user->id.' and idea_start_at is not null;');

        return view('progetti.storicoprog',[
            'user' => $user,
            'all_projects' => $all_projects,
            'leader_projects' => $leader_projects,
            'teammate_projects' => $teammate_projects
        ]);
    }


    /**
     * Il metodo permette di visualizzare tutti i progetti attivi dell'utente, sia quelli in cui partecipa sia quelli
     * in cui è il leader
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showActiveProjects() {
        $user = Auth::user();

        $leader_projects = DB::select('select projects.id, projects.name,idea_start_at,leader_id from projects where id not in (select project_id from projects_archives where end_date is not null) and leader_id = '.$user->id.' and deleted_at is null');
        $teammate_projects = DB::select('select projects.id, projects.name,idea_start_at,leader_id from projects inner join teams on teams.project_id = projects.id where projects.deleted_at is null and projects.id not in (select project_id from projects_archives where end_date is not null) and teams.teammate_id ='.$user->id.';');


        return view('progetti.progettiattivi',[
            'user' => $user,
            'leader_projects' => $leader_projects,
            'teammate_projects' => $teammate_projects
        ]);
    }


    /**
     * Il metodo permette di ottenere la vista che fornisce tutte le richieste di partecipazione
     * effettuate dall'utente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPartecipationList() {

        $user = Auth::user();

        $all_requests = DB::select('select requests.id,projects.name,requests.description,state,sent_at,projects.city from ((requests inner join users on requests.teammate_id=users.id)
        inner join projects on requests.project_id=projects.id) where users.id='.$user->id.' order by requests.id asc;');


        return view('progetti.partecipazioni',[
            'user' => $user,
            'all_requests' => $all_requests
        ]);
    }



}
