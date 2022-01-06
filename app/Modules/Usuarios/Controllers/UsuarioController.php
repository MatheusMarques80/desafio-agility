<?php
namespace App\Modules\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Services\UsuarioService;

class UsuarioController extends Controller {
    private $usuarioService;

    public function __construct(UsuarioService $usuarioService) {
        $this->usuarioService = $usuarioService;
    }

    public function viewListaUsuarios () {
        return view('usuarios');
    }

    public function index () {
        try {
            $usuarios = $this->usuarioService->listarTodosUsusarios();
            return response()->json($usuarios, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu uma falha ao listar os usuários',
                'technicalMessage' => $e->getMessage()
            ], 400);
        }
    }
}