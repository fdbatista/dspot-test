<?php

namespace App\Repositories;

use App\Models\Constants\UserConstants;
use App\Models\Entities\CaoUsuario;
use App\Repositories\_Core\Abstraction\AbstractRepository;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class UserRepository extends AbstractRepository
{
    #[Pure]
    public function __construct(CaoUsuario $model)
    {
        parent::__construct($model);
    }

    public function getConsultants(): Collection
    {
        return $this->model::join('permissao_sistema', 'cao_usuario.co_usuario', '=', 'permissao_sistema.co_usuario')
            ->where('permissao_sistema.co_sistema', 1)
            ->where('permissao_sistema.in_ativo', 1)
            ->whereIn('permissao_sistema.co_tipo_usuario', UserConstants::CONSULTANT_TYPES)
            ->orderBy('cao_usuario.no_usuario')
            ->select(['cao_usuario.co_usuario', 'cao_usuario.no_usuario', 'cao_usuario.ds_endereco', 'cao_usuario.no_email', 'cao_usuario.nu_telefone'])
            ->get();
    }
}
