<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * SRS – Registro de Incobrables en Informe de Cobranzas.
 * Lotes de incobrables, vínculo en ingresos_cursos, permiso y menú solo para el rol Sistemas.
 */
class CreateIncobrables extends Migration
{
    public function up()
    {
        Schema::create('incobrables_lotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sucursal');
            $table->integer('meses');
            $table->date('fecha_corte');
            $table->bigInteger('id_usuario');
            $table->integer('cantidad')->default(0);
            $table->decimal('monto', 12, 0)->default(0);
            $table->string('estado', 15)->default('Activo'); // Activo | Revertido
            $table->bigInteger('revertido_por')->nullable();
            $table->timestamp('revertido_at')->nullable();
            $table->timestamps();
        });

        Schema::create('incobrables_lotes_cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_lote')->index();
            $table->bigInteger('id_alumno_curso')->index();
            $table->bigInteger('id_ingreso')->nullable();
            $table->decimal('saldo_dado_de_baja', 10, 0);
            $table->string('estado', 15)->default('Activa'); // Activa | Reactivada | Revertida
            $table->bigInteger('reactivado_por')->nullable();
            $table->timestamp('reactivado_at')->nullable();
            $table->timestamps();
        });

        Schema::table('ingresos_cursos', function (Blueprint $table) {
            $table->bigInteger('id_lote_incobrable')->nullable()->index();
        });

        // Permiso que filtra el menú: solo lo tiene el rol Sistemas.
        $sistemas = DB::table('roles')->where('name', 'Sistemas')->value('id');
        $permisoId = DB::table('permissions')->insertGetId([
            'key' => 'browse_incobrables', 'table_name' => 'incobrables',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        if ($sistemas) {
            DB::table('permission_role')->insert(['permission_id' => $permisoId, 'role_id' => $sistemas]);
        }

        $menu = DB::table('menus')->where('name', 'admin')->value('id');
        if ($menu) {
            DB::table('menu_items')->insert([
                'menu_id' => $menu, 'title' => 'Incobrables', 'url' => '/admin/incobrables', 'target' => '_self',
                'icon_class' => 'voyager-dollar', 'color' => '#000000', 'parent_id' => null,
                'order' => (int) DB::table('menu_items')->where('menu_id', $menu)->whereNull('parent_id')->max('order') + 1,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // pato pasa al rol Sistemas (RF-02).
        if ($sistemas) {
            DB::table('users')->where('id', 81)->where('name', 'pato')->update(['role_id' => $sistemas]);
        }

        Cache::forget('voyager_menu_admin');
    }

    public function down()
    {
        $admin = DB::table('roles')->where('name', 'admin')->value('id');
        if ($admin) {
            DB::table('users')->where('id', 81)->where('name', 'pato')->update(['role_id' => $admin]);
        }
        DB::table('menu_items')->where('url', '/admin/incobrables')->delete();
        $permisoId = DB::table('permissions')->where('key', 'browse_incobrables')->value('id');
        if ($permisoId) {
            DB::table('permission_role')->where('permission_id', $permisoId)->delete();
            DB::table('permissions')->where('id', $permisoId)->delete();
        }
        Schema::table('ingresos_cursos', function (Blueprint $table) {
            $table->dropIndex(['id_lote_incobrable']);
            $table->dropColumn('id_lote_incobrable');
        });
        Schema::dropIfExists('incobrables_lotes_cuentas');
        Schema::dropIfExists('incobrables_lotes');
        Cache::forget('voyager_menu_admin');
    }
}
