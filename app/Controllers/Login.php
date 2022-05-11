<?php

namespace App\Controllers;

use App\Models\UserModel;
use Google_Client;
use Google_Service;
use Google_Service_Oauth2;

class Login extends BaseController
{

    public function index()
    {

        $client = new Google_Client();
        $clientId = '737735284563-n8o0p7nhqq49vkhjoq7qadctmg5ke810.apps.googleusercontent.com';
        $clientSecret = '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';
        $redirectUri = base_url('Login');

        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope('profile');
        $client->addScope('email');

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            $service = new Google_Service_Oauth2($client);
        } else {
            return redirect()->to($client->createAuthUrl());
        }
        $respond = [
            'email' => $service->userinfo->get()->getEmail(),
            'fullname' => $service->userinfo->get()->getName(),
            'user_image' => $service->userinfo->get()->getPicture(),
            'auth_groups_id' => 3,
            'active' => 0,
        ];
        $userModel = new UserModel();
        $user = $userModel->where('email', $respond['email'])->get()->getRowArray();
        if ($user) {
            session()->set($user);
            session()->set('log', true);
            if ($user['auth_groups_id'] == 1) {

                return redirect()->to(base_url('Kepala/Surat'));
            } elseif ($user['auth_groups_id'] == 2) {

                return redirect()->to(base_url('Kasubag/Surat'));
            } elseif (in_array($user['auth_groups_id'], [3, 4, 5, 6, 7, 8])) {

                return redirect()->to(base_url('Tim/Surat'));
            } elseif ($user['auth_groups_id'] == 9) {

                return redirect()->to(base_url('Admin/User'));
            }
        } else {
            $userModel = new UserModel();
            $userModel->save($respond);
            session()->set('log', true);
            $user = $userModel->where('email', $respond['email'])->get()->getRowArray();
            if ($user['auth_groups_id'] == 1) {

                return redirect()->to(base_url('Kepala/Surat'));
            } elseif ($user['auth_groups_id'] == 2) {

                return redirect()->to(base_url('Kasubag/Surat'));
            } elseif (in_array($user['auth_groups_id'], [3, 4, 5, 6, 7, 8])) {

                $email = ($service->userinfo->get()->getEmail());
                $userModel = new UserModel();
                $user = $userModel->where('email', $email)->get()->getRowArray();
                if ($user) {
                    session()->set($user);
                    if ($user['auth_groups_id'] == 1) {

                        return redirect()->to(base_url('Kepala/Surat'));
                    } elseif ($user['auth_groups_id'] == 2) {

                        return redirect()->to(base_url('Kasubag/Surat'));
                    } elseif (in_array($user['auth_groups_id'], [3, 4, 5])) {

                        return redirect()->to(base_url('Tim/Surat'));
                    } elseif ($user['auth_groups_id'] == 9) {

                        return redirect()->to(base_url('Admin/User'));
                    }
                }
            }
        }
    }
}
