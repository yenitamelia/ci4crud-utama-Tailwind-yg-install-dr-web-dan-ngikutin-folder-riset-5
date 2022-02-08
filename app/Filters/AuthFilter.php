<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->log){
            if (session()->auth_groups_id == 1) {
                
                return redirect()->to(base_url('Kepala/Surat'));
            } elseif (session()->auth_groups_id == 2) {
                
                return redirect()->to(base_url('Kasubag/Surat'));
            } elseif (in_array(session()->auth_groups_id, [3, 4, 5])) {
                
                return redirect()->to(base_url('Tim/Surat'));
            }
        }else{
            return redirect()->to('Home');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}