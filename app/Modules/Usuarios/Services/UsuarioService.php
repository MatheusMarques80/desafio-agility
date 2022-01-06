<?php
namespace App\Modules\Usuarios\Services;

use App\Modules\Base\Services\GuzzleHttpService;
use App\Modules\Usuarios\Repositories\UsuarioRepository;

class UsuarioService {

    private $guzzleHttpService;
    private $usuarioRepository;

    public function __construct (GuzzleHttpService $guzzleHttpService, UsuarioRepository $usuarioRepository) {
        $this->guzzleHttpService = $guzzleHttpService;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function listarTodosUsusarios () {
        $usuarios_get = $this->guzzleHttpService->consultarEndpoint('GET', 'https://review-rf-teste-0zys8s.somosagility.com.br/getTeste');
        $usuarios_post = $this->guzzleHttpService->consultarEndpoint('POST', 'https://review-rf-teste-0zys8s.somosagility.com.br/postTeste', [
            'form_params' => [
                'key' => '@57v9yRoC#M56y0wT'
            ]
        ]);
        $usuarios = $usuarios_get['dados'];
        foreach ($usuarios_post['dados']->user->entries as $usuario) {
            array_push($usuarios->user, $usuario);
        }
        $usuario_repository = $this->usuarioRepository->getUsuariosEndpoint($usuarios);
        return $usuario_repository;
    }
}