<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class Informe_ventasExportComisiones implements FromCollection
{
    public $desde;
    public $hasta;
    protected $title;
    
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }
    // Método para obtener los títulos de las columnas
    private function getColumnHeaders(): array
    {
        return [
            'FECHA',
            'ALUMNO',
            'NOMBRE CURSO',
            'VENDEDOR',
            'SUCURSAL',
            'IMPORTE'
        ];
    }
    public function collection()
    {
        $informe= DB::table('alumnos_cursos')
        ->join('cursos','cursos.id','=','alumnos_cursos.id_curso')
        ->join('alumnos','alumnos.id','=','alumnos_cursos.id_alumno')
        ->leftjoin('empleados','empleados.id','=','alumnos_cursos.id_vendedor')
        ->leftjoin('sucursales','sucursales.id','=','alumnos_cursos.id_sucursal')
        ->whereBetween('alumnos_cursos.fecha_inscripcion',array($this->desde,$this->hasta)  )
        ->select(['alumnos_cursos.fecha_inscripcion',
        'alumnos.nombre',
        'cursos.nombre_curso',
        'empleados.nombre as vendedor',
        'sucursales.sucursal as sucursal',
        'alumnos_cursos.precio',
        'cursos.monto_comision'  ])
        ->get()  ;

          // Agregar el título como la primera fila en la colección
          $informe->prepend($this->getColumnHeaders());

          return $informe;


        
    }
}