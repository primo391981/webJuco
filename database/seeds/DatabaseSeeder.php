<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		/*DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('tipo_contenedors')->truncate();
		DB::table('contenedors')->truncate();
		DB::table('contenidos')->truncate();
		DB::table('contenido_contenedor')->truncate();
		DB::table('datos_contenidos')->truncate();
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
		
		
		
        $this->call([
		
			TipodocTableSeeder::class,
			TipoContenedorsTableSeeder::class,
			ContenedorsTableSeeder::class,
			
			ContenidosTableSeeder::class,
			
			UsersTableSeeder::class,
			RolesTableSeeder::class,
			UserRoleTableSeeder::class,
			MenuitemsTableSeeder::class,
			
			ContenidosContenedorsTableSeeder::class,
			EmpresaTableSeeder::class,
			
			TipoArchivoTableSeeder::class,
			TipoExpedienteTableSeeder::class,
			TipoPasoTableSeeder::class,
			TipoPermisoTableSeeder::class,
			TipoNotificacionTableSeeder::class,
			EstadosTableSeeder::class,
			RemuneracionesTableSeeder::class,
			CargosTableSeeder::class,
			SalarioMinimoTableSeeder::class,
			TransicionTableSeeder::class,
			ExpedientesTableSeeder::class,
			
			TipoHoraTableSeeder::class,
			EstadoCivilTableSeeder::class,
			PersonaTableSeeder::class,
			DiasTableSeeder::class,
			RegistrosTableSeeder::class,
			TipoPagoTableSeeder::class,
			ParametrosGeneralesTableSeeder::class,
			BajaMotivosTableSeeder::class,
			//Prueba Horarios
			EmpleadosTableSeeder::class,
			HorariosEmpleadoTableSeeder::class,
			HorariosPorDiaTableSeeder::class,
			//Prueba PAGOS
			PagosViaticosTableSeeder::class,
			PagosAdelantosTableSeeder::class,
			PagosPartidasExtrasTableSeeder::class,
			TipoRecibosTableSeeder::class,
			ConceptoRecibosTableSeeder::class
		]);	
    }
}
