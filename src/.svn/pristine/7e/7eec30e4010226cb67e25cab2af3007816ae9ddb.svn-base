<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Controllers\Auth\RegisterController;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ModProfileController extends Controller{

    const AVATAR = 'avatar';
    const USERNAME = 'username';
    const MAIL = 'email';
    const IMAGE_UPDATE = 'ImageUpdate';
    const BIRTH_DATE = 'birth_date';
    const CITY = 'city';
    const OLD = 'oldPassword';
    const NEW = 'password';

    const WRONG_PASS = "Password errata";
    const NOT_MATCHING = 'Le password non corrispondono';
    const LEN_ERROR = 'La password deve essere lunga almeno 8 caratteri';
    const UPDATE_SUCCESS = 'password modificata con successo';
    const ALERT = 'alert';
    const STRING = 'string';
    const MANDATORY = 'required';
    const NOT_MANDATORY = 'sometimes';
    const MAX_LEN = 'max:255';
    const MIN_AGE = 'before:-13 years';
    const MAX_DIMENSION = 'max:5000';
    const IMG = 'image';
    const ALLOWED_FORMAT = 'mimes:jpg,jpeg,bmp,svg,png';

    const USER_UNIQUE = 'unique:users';
    const REGULAR_EXPRESSION = 'regex: /^[A-Za-z0-9_-]{3,255}$/';


    /**
     * Il metodo permette di effettuare la modifica dei dati,
     * considerando che alcuni di essi quali username ed email sono obbligatori ed unici per ogni utente
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confermamodifica(Request $request){

        //prendo dati utente autenticato
        $user = Auth::user();
        //prendo numero di competenze precedentemente associate all'utente
        $numcomp = DB::table('skills')->where('user_id', $user->id)->count();

        //passo tutti i dati della richiesta di cui ho bisogno in array
        $data = $request->all();


        //se vi è più di una competenza le elimino dal database prima di reinserirle
        if ($numcomp > 1) {
            DB::delete('delete from skills where user_id=' . $user->id . ';');
        }


        $uniqueDataUpdated = $this->showModifiedUniqueDatas($data, $user);


        //effettuo la validazione dei campi eventualmente modificati dall'utente
        $this->validateFields($request, $uniqueDataUpdated);


        //inserisco i dati modificati dall'utente (solo i dati unici
        switch ($uniqueDataUpdated){
            case 1:
                $user->username = $data[self::USERNAME];
                break;
            case 2:
                $user->email = $data[self::MAIL];
                break;
            case 3:
                $user->username = $data[self::USERNAME];
                $user->email = $data[self::MAIL];
                break;
            default:
                break;
        }

        // il nome completo viene modificato solo se differente
        if($data['name'] !== $user->name) {
            $user->name = $data['name'];
        }

        $this->checkImage($request, $data, $user);

        $this->checkDataAndCity($data, $user);

            //rimuovo il riferimento al bottone nascosto in quanto provocherebbe un errore
          unset($data[self::IMAGE_UPDATE]);

        foreach ($data as $key=> $valore) {
            if (RegisterController::controlValue($key)) {
                $competence = RegisterController::getCompetenza($key);
                Skill::create([
                    'user_id' => $user->id,
                    'competence_id' => $competence,
                    'level' => $valore
                ]);
            }
        }
        $user->save();
        return redirect()->route('profile',$user->id);
    }


    /**
     * Il metodo permette di visualizzare la schermata di modifica del profilo
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function modprofile() {
        $user = Auth::user();
        $usercomp= DB::select('select competence,skills.id,level from ((competences inner join skills on competences.id=skills.competence_id) inner  join
                 users on users.id=skills.user_id) where user_id='.$user->id.';');
        $competenze = DB::table('competences')->where('verified', 1)->get();
        return view('profileview.modprofilo',[
            'user' => $user,
            'usercomp'=> $usercomp,
            'allcompetenze' => $competenze,
            'citta' => City::all(),
        ]);
    }

    /**
     * Il metodo si occupa della modifica della password, permettendone la gestione
     *
     * @param Request $request richiesta della modifica della password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modificaPassword(Request $request){

        $data = $request->all();
        $user = Auth::user();
        $check = 0;


        if($request->has(self::OLD) && (!Hash::check($data[self::OLD], $user->password))){
                $check = 1;
        }
        if($check === 0) {
            if (strcmp($data[self::NEW], $data['password_confirmation']) !== 0) {
                $check = 2;
            } else if (strlen($data[self::NEW]) < 8) {
                $check = 3;
            } else {
                $user->password = Hash::make($data[self::NEW]);
                $user->save();
            }
        }
        switch ($check){
            case 0:
                $message = self::UPDATE_SUCCESS;
                break;
            case 1:
                $message = self::WRONG_PASS;
                break;
            case 2:
                $message = self::NOT_MATCHING;
                break;
            default:
                $message = self::LEN_ERROR;
                break;
        }


        return redirect()->back()->with(self::ALERT, $message);
    }




    /**
     * Il metodo permette di eliminare il profilo dell'utente, rimuovendone i dati
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancellaProfilo() {
        $user = Auth::user();

        DB::delete('delete from users where id='.$user->id.';');

        return redirect()->route('home');
    }


    /**
     * Il metodo permette di effettuare la validazione dei dati inseriti dall'utente
     *
     *
     * @param $request Request dati inviati dall'utente
     * @param int $modifiedFields valore della configurazione di cui si richiede il controllo
     */
    private function validateFields(Request $request, int $modifiedFields){
        //in base ai campi modificati effettuo la validazione degli elementi
        switch($modifiedFields){
            //modifica allo username, non alla email
            case 1 :
                $request->validate([
                    self::USERNAME=>[self::MANDATORY, self::STRING, self::MAX_LEN, self::USER_UNIQUE,self::REGULAR_EXPRESSION],
                    self::BIRTH_DATE=>[self::NOT_MANDATORY, 'date', self::MIN_AGE],
                    self::MAIL => [self::NOT_MANDATORY, self::STRING, self::MAIL, self::MAX_LEN],
                    self::AVATAR =>[self::NOT_MANDATORY, self::IMG,self::ALLOWED_FORMAT, self::MAX_DIMENSION],
                    ]);
                break;
            //modifica della email, non dello username
            case 2 :

                 $request->validate([
                        self::USERNAME=>[self::NOT_MANDATORY, self::STRING, self::MAX_LEN, self::REGULAR_EXPRESSION],
                        self::BIRTH_DATE=>[self::NOT_MANDATORY, 'date', self::MIN_AGE],
                        self::MAIL => [self::MANDATORY, self::STRING, self::MAIL, self::MAX_LEN, self::USER_UNIQUE],
                        self::AVATAR =>[self::NOT_MANDATORY, self::IMG,self::ALLOWED_FORMAT, self::MAX_DIMENSION],
                ]);
                break;
            //modifica di username ed email
            case 3:
                $request->validate([
                    self::USERNAME=>[self::MANDATORY, self::STRING, self::MAX_LEN, self::USER_UNIQUE,self::REGULAR_EXPRESSION],
                    self::BIRTH_DATE=>[self::NOT_MANDATORY, 'date', self::MIN_AGE],
                    self::AVATAR =>[self::NOT_MANDATORY, self::IMG,self::ALLOWED_FORMAT, self::MAX_DIMENSION],
                    self::MAIL => [self::MANDATORY, self::STRING, self::MAIL, self::USER_UNIQUE, self::MAX_LEN],
                ]);
                break;
            //username ed email non modificati
            default:
                 $request->validate([
                    self::BIRTH_DATE=>[self::NOT_MANDATORY, 'date', self::MIN_AGE],
                    self::AVATAR =>[self::NOT_MANDATORY,self::ALLOWED_FORMAT, self::MAX_DIMENSION],
                ]);
                break;
        }
    }

    /**
     * Il metodo permette di vedere quali dati unici sono stati modificati, essi saranno poi
     * validati in base alle modifiche apportate dall'utente nella schermata apposita
     *
     * @param $arr array di parametri passato per il controllo
     * @param $user User profilo dell'utente per il confronto dei dati
     * @return int  configurazione per la validazione secondo le modifiche apportate dall'utente
     */
    private function showModifiedUniqueDatas($arr, $user){
        $uniqueDataUpdated = 0;

        //controllo che username e/o email siano stati modificati e che siano diversi da null, in caso opposto non effettuo la modifica dei campi
        if($arr[self::USERNAME] !== $user->username && $arr[self::USERNAME] !== null) {
            $uniqueDataUpdated++;
        }
        if($arr[self::MAIL] !== $user->email && $arr[self::MAIL] !== null) {
            $uniqueDataUpdated += 2;
        }

        return $uniqueDataUpdated;
    }


    /**
     * Il metodo permette di effettuare la modifica dei parametri relativi alla data di nascita ed
     * alla città dell'utente in caso essi vengano modificati
     *
     * @param $source array fonte dei dati che l'utente invia con la richiesta di modifica del profilo
     * @param $dest User dati dell'utente presenti nel sistema
     */
    private function checkDataAndCity($source, $dest){

        if($source[self::CITY] !== $dest->city) {
            if ($source[self::CITY] === 'Seleziona una città...') {
                $dest->city = null;
            }
        }
        else {
            $dest->city = $source[self::CITY];
        }

        if($source[self::BIRTH_DATE] !== $dest->birth_date) {
            $dest->birth_date = $source[self::BIRTH_DATE];
        }
    }

    /**
     * Il metodo permette di verificare che sia stata inserita un'immagine e in caso affermativo di modificarla
     *
     * @param Request $request richiesta della modifica
     * @param $data array contenente i dati della richiesta
     * @param $user User utente di cui si vuole modificare l'immagine
     */
    private function checkImage(Request $request, $data, $user){
        //se l'immagine è diversa valuto la possibilità che l'utente abbia deciso di rimuovere la sua immagine e in caso affermativo gli assegno l'immagine di default, altrimenti viene salvata la nuova immagina
        if ($request->has(self::AVATAR)) {
            if ($data[self::AVATAR] !== $user->avatar && $data[self::IMAGE_UPDATE] === 'yes') {
                if ($data[self::AVATAR] !== null) {
                    $file = request()->file(self::AVATAR);
                    $extension = $file->getClientOriginalExtension();
                    $nome = $data[self::USERNAME] . '.' . $extension;
                    $file->storeAs('users-avatar', $nome, 'public');

                    $user->avatar = $nome;
                } else {
                    $user->avatar = config('chatify.user_avatar.default');
                }
            }
        } else {
            if ($data[self::IMAGE_UPDATE] === 'yes') {
                $user->avatar = config('chatify.user_avatar.default');
            }
        }
    }



}
