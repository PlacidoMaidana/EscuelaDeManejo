
<td class="no-sort no-click bread-actions">
                                                                                   
<a href="javascript:;" title="Delete" class="btn btn-sm btn-danger delete pato" onclick="borrar({{$idAlumnoCurso}})" data-id="{{$idAlumnoCurso}}" id="delete-{{$idAlumnoCurso}}">
<i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
</a> 
                                                                                                                                                                                              
<a href="{{url('admin/alumnos-cursos/'.$idAlumnoCurso.'/edit')}}" title="Edit" class="btn btn-sm btn-primary  edit">
<i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
</a>

<a href="{{url('/calendario/'.$idAlumnoCurso)}}" title="Clases" class="btn btn-primary ">Clases</a>

</td>


