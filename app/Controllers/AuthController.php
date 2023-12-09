<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function attemptLogin()
    {
        $validation = \Config\Services::validation();
        $credentials = [
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if ($validation->setRules($rules)->withRequest($this->request)->run() === false) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $loginAttempt = auth()->attempt($credentials);

        if (! $loginAttempt->isOK()) {
            return redirect()->back()->with('error', $loginAttempt->reason());
        } else {
            if(auth()->user()->inGroup('admin')){
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/');
            }
        }
    }
}
