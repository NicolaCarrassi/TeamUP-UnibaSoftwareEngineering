<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    const LEADER = 'leader_id';

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        $flag = false;
        foreach($project->teammates as $teammate){
            if($teammate->id === $user->id){
                $flag = true;
                break;
            }
        }
        return $flag || $user->id === $project->leader_id[self::LEADER];
    }

    /**
     * Il metodo determina se l'utente può segnalare o meno il progetto
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function report(User $user, Project $project){
        $flag = true;
        $i = 0 ;
        if($user->id !== $project->leader_id[self::LEADER]) {
            if (count($project->teammates) !== 0) {
                do {
                    if ($user->id === $project->teammates[$i]->id) {
                        $flag = false;
                    } else {
                        $i++;
                    }
                } while ($flag && $i < count($project->teammates));
            }
        } else {
            $flag = false;
        }
        return $flag;
    }



    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        if(is_array($project->leader_id)){
            return $user->id === $project->leader_id[self::LEADER];
        }else{
            return $user->id === $project->leader_id;
        }
    }

}
