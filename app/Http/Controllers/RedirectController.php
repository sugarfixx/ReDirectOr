<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 12/05/2021
 * Time: 00:03
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function processForm(Request $request)
    {
        $token = new \stdClass();
        $token->session = $request->post('session');
        $token->auth = $request->post('auth');
        return $this->returnTarget($token);

    }

    public function returnTarget($token)
    {
        var_dump($token); exit;
        setcookie('Mediabank_', $token->session, time() + (3600 * 6), "/", '.mediabank.me');
        setcookie('auth', $token->auth, time() + (3600 * 6), "/", '.mediabank.me');
        return redirect()->to($this->getTargetFromAuth($token->auth));
    }

    private function getTargetFromAuth($auth)
    {
        return 'https://www.mediabank.me/apps/dashboard/';
    }
}
