<?php
namespace App\Modules\Usuarios\Repositories;

class UsuarioRepository {
    public function getUsuariosEndpoint ($usuarios) {
        $usuarios = collect($usuarios->user);
        
        if (request()->name) {
            $usuarios = $usuarios->filter(function ($item) {
                return false !== stristr($item->name, request()->name);
            });
        }

        if (request()->customer) {
            $usuarios = $usuarios->filter(function ($item) {
                return false !== stristr($item->customer, request()->customer);
            });
        }

        if (request()->email) {
            $usuarios = $usuarios->filter(function ($item) {
                return false !== stristr($item->email, request()->email);
            });
        }

        return $usuarios->sortBy('customer')->values()->all();
    }
}