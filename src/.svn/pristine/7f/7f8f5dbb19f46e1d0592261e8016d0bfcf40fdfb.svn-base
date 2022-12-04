<?php

namespace App\Http\Controllers\admin;

use App\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class AdminLoginController extends AbstractAdminController
{
    const EMAIL = 'email';
    const DATA = 'password';

    /**
     * Il metodo permette di visualizzare la pagina di login dell'admin
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginAdmin() {
        return view('auth.adminlogin');
    }

    /**
     * Il metodo permette di visualizzare la pagina di registrazione dell'admin
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterAdmin() {
        return view('auth.adminregister');
    }

    /**
     * Il metodo permette di registrare un nuovo admin e successivamente visualizzare la home dell'admin registrato
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerAdmin(Request $request) {

        $data = $request->all();

        $request->validate(
            [   self::EMAIL => 'required | string | email | unique:admins',
                self::DATA => 'required | string | min:8 | confirmed']
        );

        $email = $data[self::EMAIL];
        $password = Hash::make($data[self::DATA]);

        $admin = Admins::create([
            self::EMAIL => $email,
            self::DATA => $password
        ]);

        return redirect()->route('adminhome',$admin->id);
    }

    /**
     * Il metodo permette di effettuare il login di un admin e successivamente visualizzare la home dell'admin loggato
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAdmin(Request $request) {

        $data = $request->all();

        $all_password = DB::select('select password from admins;');
        $password_is_present = false;

        $email = $data[self::EMAIL];
        $password = $data[self::DATA];

        foreach($all_password as $passwords) {
            if(Hash::check($password,$passwords->password)) {
                $password_is_present = true;
            }
        }

        if($password_is_present===true) {
            $request->validate([
                self::EMAIL => 'required | '.self::EMAIL.'| exists:admins,'.self::EMAIL]);
        } else {
             $request->validate([
                self::EMAIL => 'required | '.self::EMAIL.' | max:0']);
        }

        $admin = Admins::where(self::EMAIL,$email)->first();

        return redirect()->route('adminhome',$admin->id);
    }


    /**
     * Il metodo permette di visualizzare la home di un determinato admin
     *
     * @param $idadmin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home($idadmin) {

        $all_reports_projects = $this->getProgettiSegnalati(2);
        $all_reports_users = $this->getUtentiSegnalati(2);
        $all_idea = $this->getIdee(2);
        $admin = Admins::find($idadmin);

        return view('admin.adminhome', [
            'admin' => $admin,
            'all_reports_users' => $all_reports_users,
            'all_reports_projects' => $all_reports_projects,
            'all_idea' => $all_idea
        ]);
    }
}
