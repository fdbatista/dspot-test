<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CaoUsuario
 *
 * @property string $co_usuario
 * @property string $no_usuario
 * @property string $ds_senha
 * @property string|null $co_usuario_autorizacao
 * @property int|null $nu_matricula
 * @property Carbon|null $dt_nascimento
 * @property Carbon|null $dt_admissao_empresa
 * @property Carbon|null $dt_desligamento
 * @property Carbon|null $dt_inclusao
 * @property Carbon|null $dt_expiracao
 * @property string|null $nu_cpf
 * @property string|null $nu_rg
 * @property string|null $no_orgao_emissor
 * @property string|null $uf_orgao_emissor
 * @property string|null $ds_endereco
 * @property string|null $no_email
 * @property string|null $no_email_pessoal
 * @property string|null $nu_telefone
 * @property Carbon $dt_alteracao
 * @property string|null $url_foto
 * @property string|null $instant_messenger
 * @property int|null $icq
 * @property string|null $msn
 * @property string|null $yms
 * @property string|null $ds_comp_end
 * @property string|null $ds_bairro
 * @property string|null $nu_cep
 * @property string|null $no_cidade
 * @property string|null $uf_cidade
 * @property Carbon|null $dt_expedicao
 *
 * @property Collection|CaoConhecimento[] $cao_conhecimentos
 * @property Collection|CaoHistOcorrenciasO[] $cao_hist_ocorrencias_os
 * @property CaoPermissao $cao_permissao
 * @property Collection|CaoPontosConhecimento[] $cao_pontos_conhecimentos
 * @property Collection|CaoSalarioPag[] $cao_salario_pags
 *
 * @package App\Models\Entities
 */
class CaoUsuario extends Model
{
	protected $table = 'cao_usuario';
	protected $primaryKey = 'co_usuario';
	public $incrementing = false;
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'nu_matricula' => 'int',
		'icq' => 'int',
        'dt_nascimento' => 'datetime:d-m-Y H:i:s',
        'dt_admissao_empresa' => 'datetime:d-m-Y H:i:s',
        'dt_desligamento' => 'datetime:d-m-Y H:i:s',
        'dt_inclusao' => 'datetime:d-m-Y H:i:s',
        'dt_expiracao' => 'datetime:d-m-Y H:i:s',
        'dt_alteracao' => 'datetime:d-m-Y H:i:s',
        'dt_expedicao' => 'datetime:d-m-Y H:i:s',
	];

	protected $dates = [
		'dt_nascimento',
		'dt_admissao_empresa',
		'dt_desligamento',
		'dt_inclusao',
		'dt_expiracao',
		'dt_alteracao',
		'dt_expedicao'
	];

	protected $fillable = [
		'no_usuario',
		'ds_senha',
		'co_usuario_autorizacao',
		'nu_matricula',
		'dt_nascimento',
		'dt_admissao_empresa',
		'dt_desligamento',
		'dt_inclusao',
		'dt_expiracao',
		'nu_cpf',
		'nu_rg',
		'no_orgao_emissor',
		'uf_orgao_emissor',
		'ds_endereco',
		'no_email',
		'no_email_pessoal',
		'nu_telefone',
		'dt_alteracao',
		'url_foto',
		'instant_messenger',
		'icq',
		'msn',
		'yms',
		'ds_comp_end',
		'ds_bairro',
		'nu_cep',
		'no_cidade',
		'uf_cidade',
		'dt_expedicao'
	];

	public function cao_conhecimentos()
	{
		return $this->hasMany(CaoConhecimento::class, 'usuario');
	}

	public function cao_hist_ocorrencias_os()
	{
		return $this->hasMany(CaoHistOcorrenciasO::class, 'co_usuario');
	}

	public function cao_permissao()
	{
		return $this->hasOne(CaoPermissao::class, 'co_usuario');
	}

	public function cao_pontos_conhecimentos()
	{
		return $this->hasMany(CaoPontosConhecimento::class, 'co_coordenador');
	}

	public function cao_salario_pags()
	{
		return $this->hasMany(CaoSalarioPag::class, 'co_usuario');
	}
}
