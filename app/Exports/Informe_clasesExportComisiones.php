<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_clasesExportComisiones implements FromCollection
{
    public $desde;
    public $hasta;
  
    
    public function collection()
    {
       
        return DB::table('alumno_evento')
        ->join('alumnos_cursos','alumnos_cursos.id','=','alumno_evento.id_alumno_curso') 
        ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
        ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
        ->leftjoin('instructores','instructores.id','=','alumno_evento.id_instructor')
        ->whereBetween('alumno_evento.start_date',array($this->desde,$this->hasta))
        ->groupBy('alumnos.nombre', 'cursos.nombre_curso', 'instructores.nombre', 'instructores.monto_clase')
        ->select([
        'alumnos.nombre',
        'cursos.nombre_curso',
        'instructores.nombre as instructor',
        'instructores.monto_clase',
         DB::raw('COUNT(alumno_evento.id) AS cant_clases'),
         DB::raw('COUNT(alumno_evento.id)* instructores.monto_clase AS comisiones') ])
         ->get()  ;
      }
}