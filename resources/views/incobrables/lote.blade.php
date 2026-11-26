@extends('voyager::master')

@section('page_title', 'Incobrables – lote ' . $lote->id)

@section('page_header')
    <h1 class="page-title"><i class="voyager-dollar"></i> Incobrables – lote {{ $lote->id }}</h1>
    <a href="{{ route('incobrables.index') }}" class="btn btn-default">Volver</a>
@stop

@section('content')
<div class="page-content container-fluid">
    <div class="panel panel-bordered">
        <div class="panel-body">
            @php $activas = $cuentas->where('estado', 'Activa')->count(); @endphp
            <p>
                <strong>{{ $lote->sucursal }}</strong> · {{ $lote->meses }} meses (inscriptos hasta el {{ \Illuminate\Support\Carbon::parse($lote->fecha_corte)->format('d/m/Y') }})
                · creado por {{ $lote->usuario }} el {{ \Illuminate\Support\Carbon::parse($lote->created_at)->format('d/m/Y H:i') }}
                · {{ $lote->cantidad }} cuentas por {{ number_format($lote->monto, 0, ',', '.') }}
            </p>
            <p>
                Estado: <strong>{{ $lote->estado }}</strong>
                @if ($lote->estado === 'Activo')
                    – {{ $activas }} de {{ $lote->cantidad }} cuentas activas
                @else
                    por {{ $lote->revertido_por_nombre }} el {{ \Illuminate\Support\Carbon::parse($lote->revertido_at)->format('d/m/Y H:i') }}
                @endif
            </p>

            @if ($lote->estado === 'Activo' && $activas > 0)
                <form method="POST" action="{{ route('incobrables.revertir', $lote->id) }}"
                      onsubmit="return confirm('¿Revertir el lote {{ $lote->id }}? Las {{ $activas }} cuentas activas vuelven a tener saldo pendiente.');">
                    @csrf
                    <button type="submit" class="btn btn-warning">Revertir lote completo</button>
                </form>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>Alumno</th><th>Curso</th><th>Inscripción</th><th class="text-right">Saldo dado de baja</th><th>Estado</th><th></th></tr>
                </thead>
                <tbody>
                @foreach ($cuentas as $c)
                    <tr>
                        <td>{{ $c->alumno }}</td>
                        <td>{{ $c->curso }}</td>
                        <td>{{ $c->fecha_inscripcion ? \Illuminate\Support\Carbon::parse($c->fecha_inscripcion)->format('d/m/Y') : '' }}</td>
                        <td class="text-right">{{ number_format($c->saldo_dado_de_baja, 0, ',', '.') }}</td>
                        <td>
                            {{ $c->estado }}
                            @if ($c->estado === 'Reactivada')
                                ({{ $c->reactivado_por_nombre }}, {{ \Illuminate\Support\Carbon::parse($c->reactivado_at)->format('d/m/Y H:i') }})
                            @endif
                        </td>
                        <td>
                            @if ($lote->estado === 'Activo' && $c->estado === 'Activa')
                                <form method="POST" action="{{ route('incobrables.reactivar', [$lote->id, $c->id]) }}"
                                      onsubmit="return confirm('¿Reactivar la cuenta de {{ addslashes($c->alumno) }}? Vuelve a tener un saldo de {{ number_format($c->saldo_dado_de_baja, 0, ',', '.') }} y se le puede cobrar.');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Reactivar cuenta</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
