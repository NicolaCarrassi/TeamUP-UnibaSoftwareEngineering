<?php

namespace App\Http\Controllers\Idea;

use App\Category;
use App\City;
use App\Competence;
use App\CompetencesForIdea;
use App\Level;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectualIdeaController extends AbstractIdeaController{

    const COMPETENCES = 'competences';
    const CATEGORY = 'category';
    const MANDATORY = 'required';
    const IDEA_NAME = 'nameIdea';
    const DESCRIPTION = 'description';
    const REQUIRED =  'numberOfComponentsRequired';
    const NOT_MANDATORY = 'sometimes';
    const IMAGE = 'image';
    const MEET_NEEDING = 'needToMeet';

    /**
     * ProjectualIdeaController constructor.
     */
    public function __construct(){
        Parent::__construct();
        $this->middleware('auth');
    }

    /** Metodo che consente la visualizzazione della schermata di creazione di un'idea progettuale

     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function create(){
        $listaCompetenze = DB::table(self::COMPETENCES)->where('verified', '=', 1)->get();
        $listaCategorie = Category::all();
        $listaCitta = City::all();
        return view('idea/createProjectualIdea', ['competenze'=>$listaCompetenze, 'categorie'=>$listaCategorie, 'citta'=>$listaCitta]);
    }

    /** Metodo che consente la visualizzazione della schermata di modifica di un'idea progettuale

     * @param Id $id Id del dell'idea da modificare
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function modify($id)
    {
        return $this->loadData($id, 'idea/modifyProjectualIdea');
    }

    /** Metodo che consente la visualizzazione della schermata di cancellazione di un'idea progettuale

     * @param Id $id Id dell'idea da cancellare
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function delete($id)
    {
        return $this->loadData($id, 'idea/deleteProjectualIdea');
    }

    /** Il metodo permette il caricamento di un form che visualizzi tutte le informazioni dell'idea progettuali comprese le
     *  competenze richieste dallo stessa
     *
     * @param $id Id dell'idea progettuale
     * @param $pathView Path della view da restituire
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    private function loadData($id, $pathView){
        $project = Project::findOrFail($id);
        $this->authorize('update', $project);
        $listaCompetenze = DB::table(self::COMPETENCES)->where('verified', '=', 1)->get();
        $listaCategorie = Category::all();
        $listaCitta = City::all();
        $category_name = DB::table('categories')->where('id', '=', $project->category_id)->pluck(self::CATEGORY)->first();
        $competences_required = DB::table(self::COMPETENCES)
            ->join('competences_for_ideas', 'competences.id', '=', 'competences_for_ideas.competence_id')
            ->select('competences.competence', 'competences_for_ideas.level')
            ->where('competences_for_ideas.project_id', '=', $project->id)
            ->get();
        $this->substituteLevel($competences_required);
        $project->category_id = $category_name;
        return view($pathView, ['progetto' => $project, 'competenze_richieste' => $competences_required, 'competenze' => $listaCompetenze, 'categorie' => $listaCategorie, 'citta' => $listaCitta]);
    }

    /** Metodo di validazione dei dati inseriti nella creazione o modifica di un'idea progettuale
     *
     * @param array $data Dati acquisiti dal form
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            self::IDEA_NAME => [self::MANDATORY, 'string', 'max:50', 'min:2'],
            self::DESCRIPTION => [self::MANDATORY, 'string', 'max:300'],
            self::CATEGORY => self::MANDATORY,
            self::REQUIRED => [self::MANDATORY, 'numeric', 'max:100', 'min:2'],
            self::COMPETENCES => '',
            self::IMAGE => [self::NOT_MANDATORY, self::IMAGE, 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
            self::MEET_NEEDING => self::NOT_MANDATORY,
            'city' => self::NOT_MANDATORY,
        ]);

    }

    /** Metodo che si occupa del salvataggio dei dati inseriti dall'utente circa l'idea progettuale, sia
     *  nel caso di inserimento dell'idea sia in caso di modifica della stessa
     *
     * @param $tipology tipologia di salvataggio (0 in caso di inserimento, 1 in caso di modifica idea)
     * @param $id id dell'idea utile nel caso di aggiornamento dell'idea
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($tipology, $id) {
        $data = request()->all();
        $this->validator($data)->validate();

        if((int)$tipology === 0){
            $obligatory = $this->setObligatoryFields(0, null, $data);
        }else{
            $obligatory = $this->setObligatoryFields(1, $id, $data);
        }
        if(request()->has(self::IMAGE) && !request()->has(self::MEET_NEEDING)){
            $imagePath = request(self::IMAGE)->store('uploads', 'public');
            $notObligatory = array_merge($this->setImage($imagePath), [self::MEET_NEEDING=>null, 'city'=>null]);
        }else if(request()->has(self::MEET_NEEDING) && !request()->has(self::IMAGE)){
            $notObligatory = $this->setNeedToMeedAndCity($data);
        }else if(request()->has(self::MEET_NEEDING) && request()->has(self::IMAGE)){
            $imagePath = request(self::IMAGE)->store('uploads', 'public');
            $notObligatory = array_merge($this->setImage($imagePath), $this->setNeedToMeedAndCity($data));
        }else{
            $notObligatory = array(self::MEET_NEEDING=>null, 'city'=>null);
        }
        $save = array_merge($obligatory, $notObligatory);
        if((int)$tipology == 0){
            $save['idea_proposal_at'] = now();
            $project = Project::Create($save);
            $id = $project->id;
        }else{
            $project = Project::updateOrCreate(['id'=>$id], $save);
            $competences_for_delete = CompetencesForIdea::where('project_id', $id);
            $competences_for_delete->forceDelete();
        }
        foreach ($data as $key => $value){
            if($this->controlValue($key)) {
                $competence = $this->getCompetence($key);
                CompetencesForIdea::Create([
                    'competence_id' => $competence,
                    'project_id' => $project->id,
                    'level' => $value,
                ]);
            }
        }
        return redirect()->route('riepilogativePage', $id);
    }

    /** Metodo che si occupa di settare i campi obbligatori di un'idea progettuale, tra cui nome, categoria, id
     *  del leader, numero di componenti richiesti e numero di componenti attuali
     *
     * @param $tipology Tipologia di salvataggio (0 per inserimento, 1 per modifica)
     * @param $id Id dell'idea progettuale nel caso sia già noto
     * @param $data Dati inseriti dall'utente nel form
     * @return array Array contenente i vari dati validati da memorizzare sfruttando le classi model
     */
    private function setObligatoryFields($tipology, $id, $data){
        if((int)$tipology === 0){
            $numberOfComponentsActual = 1;
        }else{
            $numberOfComponentsActual = Project::find($id)->numberOfComponentsActual;
        }
        return array(
            'name' => $this->convertInputString($data[self::IDEA_NAME]),
            self::DESCRIPTION => $this->convertInputString($data[self::DESCRIPTION]),
            'category_id' => DB::table('categories')->where(self::CATEGORY, $data[self::CATEGORY])->pluck('id')->first(),
            'leader_id' => auth()->user()->id,
            self::REQUIRED => $data[self::REQUIRED],
            'numberOfComponentsActual' => $numberOfComponentsActual,
        );
    }

    /** Metodo che si occupa di settare il campo facoltativo dell'immagine
     *
     * @param $imagePath Path di memorizzazione dell'immagine
     * @return array Array contenente l'associazione tra la chiave 'image' e il path dell'immagine
     */
    private function setImage($imagePath){
        return array(
            self::IMAGE => $imagePath
        );
    }

    /** Metodo che si occupa di settare i campi facoltativi di necessitò di incontro e città di incontro
     *
     * @param $data Dati inseriti dall'utente nel form
     * @return array Array contenente i vari dati validati da memorizzare sfruttando le classi model
     */
    private function setNeedToMeedAndCity($data){
        return array(
            self::MEET_NEEDING => 1,
            'city' => $data['city']
        );
    }

    /** Metodo che si occupa di controllare che una keyword sia diversa da quelle riservate ai dati dell'idea
     *  progettuale, cioè che essa sia una competenza
     *
     * @param $element string  la chiave di cui si vuole conoscere se differisce dai token riservati
     * @return bool true se diverso (quindi rappresenta una competenza), false altrimenti
     *
     */
    private function controlValue($element){
        $banned_keywords = ['_token', self::IDEA_NAME, self::DESCRIPTION, self::CATEGORY, self::REQUIRED, self::COMPETENCES, self::IMAGE, self::MEET_NEEDING, 'city', 'otherCompetences'];
        $flag = true;
        foreach ($banned_keywords as $prova) {
            if ($prova === $element) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    /** Metodo che ricerca l'id della competenza passata in input, formattandola come nel db
     *
     * @param $key string valore della keyword da convertire
     * @return int id della competenza
     */
    private function getCompetence($key){
        $competenza = str_replace('_', ' ', $key);
        $id = Competence::firstOrCreate(['competence' => ($this->convertInputString($competenza))]);
        return $id->id;
    }


}
