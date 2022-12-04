<?php

namespace App\Http\Controllers\Auth;

use App\City;
use App\Competence;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Skill;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller{

    protected const AVATAR = 'avatar';

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    const STRING = 'string';
    const OBBLIGATORIO = 'required';
    const MAX_LEN = 'max:255';
    const USER = 'username';
    const COGNOME = 'surname';
    const DATA_NASCITA = 'birth_date';
    const MAIL = 'email';
    const DATA = 'password';

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest');
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(){
        $listaCompetenze = DB::table('competences')->where('verified', 1)->get();
        return view('auth.register',['competenze' => $listaCompetenze, 'citta'=> City::all()]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){

        return Validator::make($data, [
           self::USER=>[self::OBBLIGATORIO, self::STRING, self::MAX_LEN, 'unique:users', 'regex: /^[A-Za-z0-9_-]{3,255}$/'],
            'name' => [self::OBBLIGATORIO, self::STRING, self::MAX_LEN],
            self::COGNOME =>[self::OBBLIGATORIO, self::STRING, self::MAX_LEN],
            self::DATA_NASCITA=>[self::OBBLIGATORIO, 'date', 'before:-13 years'],
            self::MAIL => [self::OBBLIGATORIO, self::STRING, self::MAIL, self::MAX_LEN, 'unique:users'],
            self::DATA => [self::OBBLIGATORIO, self::STRING, 'min:8', 'confirmed'],
            self::AVATAR =>['sometimes', 'image','mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User istanza dell'utente creato
     */
    protected function create(array $data){
        $citta = $data['city'];

        // controllo se è stata inserita l'immagine
        if(request()->has(self::AVATAR)){


            $file = request()->file(self::AVATAR);
            $extension = $file->getClientOriginalExtension();
            $nome= $data[self::USER].'.'.$extension;
            $file->storeAs('users-avatar', $nome,'public');


            //controllo se non ha inserito la città
            if($citta === 'Seleziona una città...') {
                $user = User::create([
                    self::USER => $data[self::USER],
                    'name' => $data['name'] . ' ' . $data[self::COGNOME],
                    self::DATA_NASCITA => $data[self::DATA_NASCITA],
                    self::MAIL => $data[self::MAIL],
                    self::DATA => Hash::make($data[self::DATA]),
                    self::AVATAR => $nome,
                ]);
                //ha inserito la città e l'immagine
            } else {
                $user = User::create([
                    self::USER => $data[self::USER],
                    'name' => $data['name'] . ' ' . $data[self::COGNOME],
                    self::DATA_NASCITA => $data[self::DATA_NASCITA],
                    self::MAIL => $data[self::MAIL],
                    self::DATA => Hash::make($data[self::DATA]),
                    self::AVATAR => $nome,
                    'city' => $citta,
                    ]);
            }
            //in caso l'utente non abbia inserito l'immagine
        } else {
            //controllo che l'utente non abbia inserito la città
            if ($citta === 'Seleziona una città...') {
                $user = User::create([
                    self::USER => $data[self::USER],
                    'name' => $data['name'] . ' ' . $data[self::COGNOME],
                    self::DATA_NASCITA => $data[self::DATA_NASCITA],
                    self::MAIL => $data[self::MAIL],
                    self::DATA => Hash::make($data[self::DATA]),
                ]);
                //l'utente ha inserito una città valida
            } else {
                $user = User::create([
                    self::USER => $data[self::USER],
                    'name' => $data['name'] . ' ' . $data[self::COGNOME],
                    self::DATA_NASCITA => $data[self::DATA_NASCITA],
                    self::MAIL => $data[self::MAIL],
                    self::DATA => Hash::make($data[self::DATA]),
                    'city' => $citta,
                ]);
            }
        }


        //competenze
        foreach ($data as $key => $value){
            if(self::controlValue($key)) {
                $competence= self::getCompetenza($key);
                Skill::create([
                    'user_id' => $user->id,
                    'competence_id' => $competence,
                    'level' => $value,
                ]);
            }
        }

        return $user;
    }


    /**
     * Controlla che una keyword sia diversa da quelle riservate ai dati personali dell'utente,
     * quindi essa è una competenza
     *
     * @param $element string  la chiave di cui si vuole conoscere se differisce dai token riservati
     * @return bool true se diverso (quindi rappresenta una competenza), false altrimenti
     *
     */
    public static function controlValue($element){
        $banned_keywords = ['_token', self::USER, 'name', self::AVATAR, self::COGNOME, self::DATA_NASCITA, 'city', self::MAIL, self::DATA,'otherCompetences', 'password_confirmation', 'competences', 'otherCompetences'];
        $flag = true;

        foreach ($banned_keywords as $prova) {
            if ($prova === $element) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    /**
     * Ricerca l'id della competenza passata in input, formattandola come nel db
     *
     * @param $key string valore della keyword da convertire
     *
     * @return int id della competenza
     */
    public static function getCompetenza($key){
        $competenza = str_replace('_', ' ', $key);

        $id = Competence::firstOrCreate(['competence' => $competenza]);

        return $id->id;
    }





}
