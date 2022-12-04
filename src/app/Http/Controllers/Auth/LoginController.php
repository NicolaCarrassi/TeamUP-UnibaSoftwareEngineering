<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Lista dei providers con i quali è possibile effettuare il login
     *
     * @const  array di providers
     */
    const PROVIDERS = ['github', 'google'];

    const EMAIL = 'email';


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->username = $this->findUsername();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? self::EMAIL : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($driver){

        if(!self::usedProviders($driver)) {
            abort(403, 'Non è possibile accedere attraverso questo provider');
        }

        return Socialite::driver($driver)->redirect();
    }


    /**
     * @param $driver
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback($driver){
        $dataFromSocial = Socialite::driver($driver)->user();


        $user = self::manageData($dataFromSocial, $driver);

        //effettuo l'autenticazione dell'utente
        Auth::login($user,true);


        //rimando l'utente alla pagina successiva
        return redirect($this->redirectTo);
    }


    /**
     * Il metodo permette di effettuare il controllo dei dati dell'utente.
     * Viene effettuato il controllo rispetto al vincolo di unicità della mail, per tanto un'utente che cerca di inserire i propri dati
     * effettuando una autenticazione mediante social, dopo essere già registrato con la medesima mail farà il login con il proprio profilo
     * analogamente ad un tentativo di login che avviene tramite le proprie credenziali, il sistema effettua anche un controllo relativo ad
     * secondo accesso tramite social (indipendentemente da quale social viene utilizzato dall'utente, ad es. primo accesso con github, secondo accesso
     * con google con la stessa email).
     * In caso la mail dell'utente non venga trovata fra i record degli utenti già registrati, viene creato il profilo utente, conservando l'informazione relativa al provider con il quale
     * ha provato ad accedere (Utile solo per motivi di interfaccia in altri punti del codice)
     * In caso contrario verranno caricati i dati dell'utente con mail corrispondente a quella utilizzata per il login con il provider
     *
     * @param $userData mixed dati dell'utente prelevati dal provider
     * @param $driver string nome del provider
     * @return User istanza dell'utente prelevata dal db o creata
     */
    private static function manageData($userData, $driver){
        $email = $userData->getEmail();
        $user = new User();

        if(self::emailCheck($email)) {

            switch($driver){
                //in base al provider con il quale l'utente prova a fare il login il sistema preleva le credenziali utili e genera lo username in caso esso non venga
                // fornito (es. google)
                case self::PROVIDERS[0] :
                    $user = self::fillNewUserData($userData, self::PROVIDERS[0]);
                    break;
                case self::PROVIDERS[1] :
                    $user = self::fillNewUserData($userData, self::PROVIDERS[1]);
                    break;

                // il seguente caso non dobrebbe essere mai raggiunto, aggiunto per correttezza formale del codice.
                default:
                    abort(404, 'Pagina non trovata');
            }


        } else {
            $temp = User::where(self::EMAIL, $email)->get();
            $user = $temp[0];
        }

        return $user;
    }





    /**
     * Il metodo statico permette di generare uno username in caso il
     * metodo di login utilizzato non fornisca il login (es. google)
     * In questo caso viene generato uno username con il nome completo dell'utente
     * in cui gli spazi vengono sostituiti da underscore e a cui viene aggiunto in coda
     * una sequenza di 5 cifre randomica (ponendo rimedio al problema dell'omonimia avendo a disposizione 100000
     * casi differenti in caso di omonimia), prima di inviare la risposta viene caricata la lista degli username
     * disponibili, in quanto se non vi è nessun utente con lo username generato solo dal nome non vi è la necessità
     * di aggiungere le cifre in coda. Inoltre se dovesse essere generato due volte lo stesso username (in caso il nome
     * sia uguale vi sarebbe una probabilità dello 0,001%) esso verrebbe controllato prima di essere passato per la
     * creazione dello username e dunque verrebbe generato nuovamente.
     *
     *
     * @param $name string contiene il nome dell'utente sul quale verrano eseguite le operazioni o lo username se presente
     * @return mixed lo username che viene generato dal sistema
     */
    private static function generateUsername($name){
        $usernameList = User::all()->pluck('username')->toArray();
        $username = str_replace(' ','_', $name);
        $alreadyAdded = false;
        $nameLen = strlen($username);



        //ripeto l'iterazione
        while(in_array($username, $usernameList, true)){
            //svuoto la stringa dei numeri generati
            $numberGenerated = '';

            if($alreadyAdded) {
                $username = substr($username, 0, $nameLen);
            }

            //aggiungo numeri randomici
            for($i = 0; $i<5;$i++) {
                $numberGenerated = $numberGenerated . rand(0, 9);
            }

            $username = $username.'_'.$numberGenerated;


            if(!$alreadyAdded) {
                $alreadyAdded = true;
            }

        }

        return $username;
    }

    /**
     * @param $email string  email dell'utente che cerca di effettuare il login con un provider
     * @return bool true se l'email non è presente, false altrimenti
     */
    private static function emailCheck($email){
        $count = DB::table('users')->where(self::EMAIL, $email)->count();

        if($count === 0) {
            $res = true;
        }else {
            $res = false;
        }

        return $res;
    }


    /**
     * Il metodo permette di inserire i dati del nuovo utente in caso esso non sia registrato nella piattaforma
     *
     *
     * @param $userData mixed dati dell'utente da creare
     * @param $provider string nome del provider da cui sono prese le informazioni
     * @return User utente creato dalla piattaforma
     */
    private static function fillNewUserData($userData, $provider){
        $user = new User;


        if($userData->getNickname()) {
            $user->username = self::generateUsername($userData->getNickname());
        }else {
            $user->username = self::generateUsername($userData->getName());
        }


        $user->name = $userData->getName();
        $user->email = $userData->getEmail();
        $user->avatar = $userData->getAvatar();
        $user->provider = $provider;
        $user->save();

        return $user;
    }

    /**
     * Il metodo effettua un controllo nella lista dei providers supportati, in caso l'utente
     * provi ad indirizzarsi ad un provider differente rispetto a quelli permessi dalla
     * piattaforma (es. l'utente inserisce il seguente url: 127.0.0.1:8000/login/facebook)
     * l'utente verrà reindirizzato ad una pagina di errore
     *
     * @param $provider string nome del provider da cui si cerca di accedere
     * @return bool
     */
    private static function usedProviders($provider){
        return in_array($provider, self::PROVIDERS, true);
    }




}
