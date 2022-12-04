<?php

namespace App\Http\Controllers\admin;

use App\Admins;
use App\Http\Controllers\Idea\ProjectController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

abstract class AbstractAdminController extends Controller {

    /**
     * Il metodo permette di prelevare gli utenti che sono stati segnalati.
     * Se $limit è uguale a -1 vengono prelevati tutti gli utenti
     * altrimenti vengono prelevati un numero di utenti uguale a $limit
     * @param $limit
     * @return array
     */
    protected function getUtentiSegnalati($limit) {
        if($limit!==-1) {
            return DB::select('select A.username as user1_username,B.username as user2_username,B.id as user2_id,report_users.id,reason,description from ((report_users inner join users as A on report_users.user1_id=A.id)
            inner join users as B on report_users.user2_id=B.id) where managed=0 limit ' . $limit . ';');
        }else {
            return DB::select('select A.username as user1_username,B.username as user2_username,B.id as user2_id,report_users.id,reason,description from ((report_users inner join users as A on report_users.user1_id=A.id)
            inner join users as B on report_users.user2_id=B.id) where managed=0;');
        }
    }

    /**
     * Il metodo permette di prelevare i progetti che sono stati segnalati.
     * Se $limit è uguale a -1 vengono prelevati tutti i progetti
     * altrimenti vengono prelevati un numero di progetti uguale a $limit
     * @param $limit
     * @return array
     */
    public function getProgettiSegnalati($limit){
        if ($limit !== -1) {
            return DB::select('select report_projects.id,projects.id as project_id,projects.name,report_projects.description,reason,users.username as username,idea_start_at from (((projects left join projects_archives on projects.id=projects_archives.project_id)
            inner join report_projects on projects.id=report_projects.project_id) inner join users on report_projects.user_id=users.id) where deleted_at is null and end_date is null limit ' . $limit . ';');
        } else {
            return DB::select('select report_projects.id,projects.id as project_id,projects.name,report_projects.description,reason,users.username as username,idea_start_at from (((projects left join projects_archives on projects.id=projects_archives.project_id)
            inner join report_projects on projects.id=report_projects.project_id) inner join users on report_projects.user_id=users.id) where deleted_at is null and end_date is null;');
        }
    }

    /**
     * Il metodo permette di prelevare i progetti attivi che sono stati segnalati.
     * Se $limit è uguale a -1 vengono prelevati tutti i progetti attivi
     * altrimenti vengono prelevati un numero di progetti attivi uguale a $limit
     * @param $limit
     * @return array
     */
    protected function getProgettiAttivi($limit){
        if ($limit !== -1) {
            return DB::select('select projects.id,projects.name,description from projects left join projects_archives on projects.id=projects_archives.project_id
            where idea_start_at is not null and deleted_at is null and end_date is null limit ' . $limit . ';');
        } else {
            return DB::select('select projects.id,projects.name,description from projects left join projects_archives on projects.id=projects_archives.project_id where idea_start_at is not null and deleted_at is null and end_date is null;');
        }
    }

    /**
     * Il metodo permette di prelevare le idee che sono stati segnalate.
     * Se $limit è uguale a -1 vengono prelevate tutti le idee
     * altrimenti vengono prelevate un numero di idee uguale a $limit
     * @param $limit
     * @return array
     */
    protected function getIdee($limit) {
        if($limit!==-1) {
            return DB::select('select id,name,description from projects where idea_start_at is null and deleted_at is null limit   ' . $limit . ';');
        }else {
            return DB::select('select id,name,description from projects where idea_start_at is null and deleted_at is null;');
        }
    }

    /**
     * Il metodo permette di eliminare un progetto o un'idea progettuale
     * specificato/a tramite l'id passato come parametro
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function deleteProject($id) {

        $project_controller = new ProjectController();
        $project_controller->removeForLeaderAndAdmin($id);
        DB::insert('insert into projects_archives(project_id,end_date,ended) values ('.$id.',timestamp("'.now()->toDateString().'"),0);');

        return redirect()->back();
    }

}
