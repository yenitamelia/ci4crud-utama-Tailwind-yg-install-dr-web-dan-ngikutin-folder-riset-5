<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->log) {
            if (session()->auth_groups_id == 1) {
                if ($request->getUri()->getSegment(1) != 'Kepala') {
                    return redirect()->to(base_url('Kepala/Surat'));
                }
            } elseif (session()->auth_groups_id == 2) {
                if ($request->getUri()->getSegment(1) != 'Kasubag') {
                    return redirect()->to(base_url('Kasubag/Surat'));
                }
            } elseif (in_array(session()->auth_groups_id, [3, 4, 5, 6, 7])) {
                if ($request->getUri()->getSegment(1) != 'Tim') {
                    return redirect()->to(base_url('Tim/Surat'));
                }
            } elseif (session()->auth_groups_id == 8) {
                if ($request->getUri()->getSegment(1) != 'AnggotaTim') {
                    return redirect()->to(base_url('AnggotaTim/Surat'));
                }
            } elseif (session()->auth_groups_id == 9) {
                if ($request->getUri()->getSegment(1) != 'Admin') {
                    return redirect()->to(base_url('Admin/User'));
                }
            }
        } else {
            return redirect()->to('Login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
