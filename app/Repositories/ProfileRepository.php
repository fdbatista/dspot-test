<?php

namespace App\Repositories;

use App\Models\Entities\Profile;
use App\Repositories\_Core\Abstraction\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;

class ProfileRepository extends AbstractRepository
{
    #[Pure]
    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model::query()
            /*->join('permissao_sistema', 'cao_usuario.co_usuario', '=', 'permissao_sistema.co_usuario')
            ->where('permissao_sistema.co_sistema', 1)
            ->where('permissao_sistema.in_ativo', 1)
            ->whereIn('permissao_sistema.co_tipo_usuario', UserConstants::CONSULTANT_TYPES)
            ->orderBy('cao_usuario.no_usuario')
            ->select(['cao_usuario.co_usuario', 'cao_usuario.no_usuario', 'cao_usuario.ds_endereco', 'cao_usuario.no_email', 'cao_usuario.nu_telefone'])*/
            ->get();
    }
}
