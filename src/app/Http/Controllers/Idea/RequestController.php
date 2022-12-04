<?php

namespace App\Http\Controllers\Idea;

use App\Http\Controllers\Controller;
use App\Http\Controllers\utility\NotificationController;
use App\Project;
use App\Request as MyRequest;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class RequestController extends Controller{

    const ID_REQUEST = 'id';
    const TEAMMATE = 'teammate_id';
    const PROJECT = 'project_id';
    const DESCRIPTION = 'description';
    const DATA_INVIO = 'sent_at';
    const STATE = 'state';

    /**
     * Il metodo permette di effettuare una richiesta di partecipazione ad un'idea progettuale
     * controllando che essa non sia già stata effettuata e non vi sia stata una risposta per essa
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeRequest(Request $request){
        $data = $request->all();
        $isAlreadyMade = DB::table('requests')->where([
            [self::PROJECT, $data[self::PROJECT]],
            [self::TEAMMATE, Auth::id()],
            [self::STATE, 0],
        ])->exists();


        if(!$isAlreadyMade) {
            if ($data[self::DESCRIPTION] == null) {
                MyRequest::create([
                    self::PROJECT => $data[self::PROJECT],
                    self::TEAMMATE => Auth::id(),
                    self::DATA_INVIO => now()
                ]);
            } else {
               MyRequest::create([
                    self::PROJECT => $data[self::PROJECT],
                    self::TEAMMATE => Auth::id(),
                    self::DATA_INVIO => now(),
                    self::DESCRIPTION => $data[self::DESCRIPTION]
                ]);
            }

            self::sendMail($data);
        }

        if(redirect()->back()->getTargetUrl() === route('effettuaRicerca')){
            return redirect()->route('searchPane');
        }


        return redirect()->back();
    }

    /** Il metodo permette il set dell'esito della richieste di partecipazione da parte del leader (accetto o rifiuto)
     *  ricevute in ambito di un progetto o di un'idea progettuale
     *
     * @param $id Id del progetto di cui si vogliono settare gli esiti delle richieste
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setRequestResult($id){
        $data = request()->all();
        $project = Project::find($id);
        $componentiRichiesti = $project->numberOfComponentsRequired;
        $componentiAttuali = $project->numberOfComponentsActual;
        foreach($data as $key => $value){
            if($key != '_token' && $componentiAttuali < $componentiRichiesti) {
                $richiesta = MyRequest::find($key);
                $richiesta->state = $value;
                $richiesta->save();
                if ((int)$richiesta->state === 1) {
                    Team::create([
                        'project_id' => $id,
                        'teammate_id' => $richiesta->teammate_id,
                        'join_date' => now(),
                    ]);
                    $componentiAttuali++;
                    $teammate = User::find($richiesta->teammate_id);
                    $mail = [
                        NotificationController::EMAIL => $teammate->email,
                        NotificationController::TEAMMATE => $teammate->username,
                        NotificationController::IDEA => $project->name,
                    ];
                    NotificationController::mailSend(NotificationController::ACCETTAZIONE_TEAM, $mail);
                }
            }
            if($componentiAttuali === $componentiRichiesti){
                break;
            }
        }
        $project->numberOfComponentsActual = $componentiAttuali;
        $project->save();
        return redirect('/idea/'.$project->id);
    }


    /**
     * Il metodo privato permette di inviare una mail in seguito alla richiesta di partecipazione di un utente per
     * l'idea
     *
     * @param $data
     */
    private static function sendMail($data){
            //fetch dati per email
        $leader = DB::table('users')->whereRaw('id = (select leader_id from projects where id = ' .$data[self::PROJECT].')')->first();
        $idea = DB::table('projects')->whereRaw('id  = '.$data[self::PROJECT])->pluck('name')->first();

        $array = [
            'email' => $leader->email,
            'nomeLeader' => $leader->username,
            'nomeTeammate' => Auth::user()->username,
            'nomeIdea' => $idea
        ];
        NotificationController::mailSend(NotificationController::RICHIESTA_PARTECIPAZIONE, $array);
    }

}
