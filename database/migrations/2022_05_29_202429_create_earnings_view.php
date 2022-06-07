<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        create or replace view v_earnings
        as
        select
          `year_month`,
          `month_year`,
          `username`,
          `full_name`,
          `net_earnings`,
          `fixed_cost`,
          `commission`,
          round(`net_earnings` + `fixed_cost` + `commission`, 2) `profit`
          from (
            select
              date_format(cao_fatura.data_emissao, '%Y-%m') `year_month`,
              date_format(cao_fatura.data_emissao, '%b %Y') `month_year`,
              cao_os.co_usuario `username`,
              cao_usuario.no_usuario `full_name`,
              round(sum(cao_fatura.valor - (cao_fatura.valor * cao_fatura.total_imp_inc / 100)), 2) `net_earnings`,
              cao_salario.brut_salario * -1 fixed_cost,
              round(sum((cao_fatura.valor - (cao_fatura.valor * cao_fatura.total_imp_inc / 100)) * cao_fatura.comissao_cn / 100), 2) * -1 commission
              from cao_fatura
                join cao_cliente on (cao_fatura.co_cliente = cao_cliente.co_cliente)
                join cao_sistema on (cao_fatura.co_sistema = cao_sistema.co_sistema)
                join cao_os on (cao_os.co_os = cao_fatura.co_os)
                join cao_salario on (cao_salario.co_usuario = cao_os.co_usuario)
                join cao_usuario on (cao_usuario.co_usuario = cao_salario.co_usuario)
                group by date_format(cao_fatura.data_emissao, '%Y-%m'), cao_os.co_usuario
                order by cao_os.co_usuario, cao_fatura.data_emissao
           ) c1
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists earnings_view");
    }
};
