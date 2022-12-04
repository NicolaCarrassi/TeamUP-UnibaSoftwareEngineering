<?php

namespace App\Http\Controllers\idea;

use App\Category;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerShowIdeas extends Controller{
    const CAT_ERROR = -1;
    const SEARCH_TITLE = 'name';
    const SEARCH_CATEGORY = 'category_id';
    const SELECT_NAME = "name like '%";
    const SELECT_CATEGORY = 'category_id = ';

    const NOT_LEADER = ' != leader_id and ';
    const FREE_SPACE = 'numberOfComponentsActual < numberOfComponentsRequired and deleted_at is null and ';
    const NOT_REPORTED = 'id not in (SELECT project_id from report_projects where ';
    const NOT_USER = ' = user_id)';
    const NO_ACTIVE_REQUESTS = ' and id not in (SELECT project_id from requests where ' ;
    const NO_TEAMMATE = ' = teammate_id and state = 0)';
    const NOT_IN_TEAM = 'and id not in (SELECT project_id from teams where teammate_id = ';

    const PROGETTI = 'projects';
    const ORDINAMENTO = 'sponsored desc, idea_proposal_at desc';

    const TITLE_ALL = "Tutti i progetti disponibili";
    const TITLE_ONLY_NAME = "Hai cercato: ";
    const TITLE_CATEGORY_ONLY = "Hai ricercato tutti i progetti in: ";
    const TITLE_FULL_SEARCH_1 = "Hai ricercato: ";
    const TITLE_FULL_SEARCH_2 = " nella categoria ";

    /**
     * Il metodo permette di visualizzare la vista della ricerca delle idee all'interno dell'applicazione
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSearchView(){
        $query = self::FREE_SPACE . Auth::id() . self::NOT_LEADER;
        $query = $query.self::NOT_REPORTED. Auth::id() . self::NOT_USER;
        $query = $query.self::NO_ACTIVE_REQUESTS. Auth::id() . self::NO_TEAMMATE;
        $query = $query.self::NOT_IN_TEAM.Auth::id().')';

        $lista_progetti = DB::table(self::PROGETTI)
            ->whereRaw($query)->orderByRaw(self::ORDINAMENTO)->take(3)->get();
        $lista_categorie = Category::all();

        return view('searchIdeas.searchIdeas',['ideas'=>$lista_progetti , 'categorie'=>$lista_categorie]);
    }


    /**
     *
     * Il metodo permette di effettuare la ricerca delle idee in tre modalità:
     *                  Per titolo
     *                  Per categoria
     *                  Per titolo e categoria
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $query = self::FREE_SPACE . Auth::id() . self::NOT_LEADER;
        $query = $query.self::NOT_REPORTED. Auth::id() . self::NOT_USER;
        $query = $query.self::NO_ACTIVE_REQUESTS. Auth::id() . self::NO_TEAMMATE;
        $query = $query.self::NOT_IN_TEAM.Auth::id().')';

        $data = $request->all();
        $item = 0;


        if($data[self::SEARCH_TITLE] != null){
            $item += 1;
        }
        if($data[self::SEARCH_CATEGORY] != self::CAT_ERROR) {
            $item += 2;
        }

        switch($item){
            case 1 :
                $select = self::SELECT_NAME . $data[self::SEARCH_TITLE] ."%'" ;
                $title = self::TITLE_ONLY_NAME . $data[self::SEARCH_TITLE];
                break;
            case 2:
                $select = self::SELECT_CATEGORY . $data[self::SEARCH_CATEGORY];
                $title = self::TITLE_CATEGORY_ONLY . Category::getLabelFromNuber($data[self::SEARCH_CATEGORY]);
                break;
            default:
                $select = self::SELECT_NAME . $data[self::SEARCH_TITLE] ."%' and ". self::SELECT_CATEGORY . $data[self::SEARCH_CATEGORY];
                $title = self::TITLE_FULL_SEARCH_1 . $data[self::SEARCH_TITLE] . self::TITLE_FULL_SEARCH_2 . Category::getLabelFromNuber($data[self::SEARCH_CATEGORY]);
        }


        $searchedItems = DB::table(self::PROGETTI)
            ->whereRaw($query. ' and '. $select)->orderByRaw(self::ORDINAMENTO)->simplePaginate(5);


        return view('searchIdeas.allIdeas',[self::PROGETTI=> $searchedItems, 'title' => $title]);
    }



    /**
     * Il metodo genera la view contenente tutte le idee progettuali in cui l'utente che ricerca non ha
     * creato l'idea e in cui il numero di componenti dell'idea è minore di quelli richiesti dal leader dell'idea
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllAvailableIdeas(){
        if(Auth::id() !== null) {
            $query = self::FREE_SPACE . Auth::id() . self::NOT_LEADER;
            $query = $query . self::NOT_REPORTED . Auth::id() . self::NOT_USER;
            $query = $query . self::NO_ACTIVE_REQUESTS . Auth::id() . self::NO_TEAMMATE;
            $query = $query . self::NOT_IN_TEAM . Auth::id() . ')';


            $listaIdee = DB::table(self::PROGETTI)->whereRaw($query)
                ->orderByRaw(self::ORDINAMENTO)->simplePaginate(5);

        }else{
            $listaIdee = Project::where('deleted_at', null)->simplePaginate(5);
        }
        return view('searchIdeas.allIdeas',[self::PROGETTI=> $listaIdee, 'title' => self::TITLE_ALL]);
    }


}
