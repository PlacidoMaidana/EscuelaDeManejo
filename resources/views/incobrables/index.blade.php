@extends('voyager::master')

@section('page_title', 'Incobrables')

@section('page_header')
    <h1 class="page-title"><i class="voyager-dollar"></i> Incobrables</h1>
@stop

@section('content')
<div class="page-content container-fluid">

    {{-- 1. Filtros y vista previa --}}
    <div class="panel panel-bordered">
        <div class="panel-body">
            <p>Da de baja como <strong>Incobrable</strong> el saldo de las cuentas con saldo pendiente inscriptas hace más de N meses.
               Primero se ve la lista; no se graba nada hasta confirmar.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
                </div>
            @endif

            <form method="GET" action="{{ route('incobrables.index') }}" class="form-inline">
                <input type="hidden" name="vista_previa" value="1">
                <div class="form-group" style="margin-right:15px">
                    <label for="sucursal">Sucursal</label>
                    <select name="sucursal" id="sucursal" class="form-control" required>
                        <option value="">Elegir…</option>
                        @foreach ($sucursales as $s)
                            <option value="{{ $s->id }}" @if ((string) $idSucursal === (string) $s->id) selected @endif>{{ $s->sucursal }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-right:15px">
                    <label for="meses">Antigüedad (meses)</label>
                    <input type="number" min="1" step="1" name="meses" id="meses" value="{{ $meses }}" class="form-control" style="width:90px" required>
                </div>
                <button type="submit" class="btn btn-primary">Vista previa</button>
            </form>
        </div>
    </div>

    @if ($cuentas !== null)
    <div class="panel panel-bordered">
        <div class="panel-body">
            <h4>Vista previa – inscriptos hasta el {{ \Illuminate\Support\Carbon::parse($fechaCorte)->format('d/m/Y') }}</h4>

            @if ($cuentas->isEmpty())
                <p>No hay cuentas con saldo pendiente para dar de baja con este criterio.</p>
            @else
                <p><strong>{{ $cuentas->count() }}</strong> cuentas por <strong>{{ number_format($cuentas->sum('saldo'), 0, ',', '.') }}</strong>.</p>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr><th>Alumno</th><th>Curso</th><th>Inscripción</th><th class="text-right">Precio</th><th class="text-right">Pagado</th><th class="text-right">Saldo</th></tr>
                    </thead>
                    <tbody>
                    @foreach ($cuentas as $c)
                        <tr>
                            <td>{{ $c->alumno }}</td>
                            <td>{{ $c->curso }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($c->fecha_inscripcion)->format('d/m/Y') }}</td>
                            <td class="text-right">{{ number_format($c->precio, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($c->pagado, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($c->saldo, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <form method="POST" action="{{ route('incobrables.confirmar') }}"
                      onsubmit="return confirm('¿Dar de baja {{ $cuentas->count() }} cuentas por {{ number_format($cuentas->sum('saldo'), 0, ',', '.') }}?');">
                    @csrf
                    <input type="hidden" name="sucursal" value="{{ $idSucursal }}">
                    <input type="hidden" name="meses" value="{{ $meses }}">
                    <input type="hidden" name="huella" value="{{ $huella }}">
                    <button type="submit" class="btn btn-danger">Confirmar baja</button>
                </form>
            @endif
        </div>
    </div>
    @endif

    {{-- 2. Lotes realizados --}}
    <div class="panel panel-bordered">
        <div class="panel-body">
            <h4>Lotes realizados</h4>
            @if ($lotes->isEmpty())
                <p>Todavía no hay lotes.</p>
            @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>Lote</th><th>Fecha</th><th>Sucursal</th><th>Meses</th><th>Usuario</th><th class="text-right">Cuentas</th><th class="text-right">Monto</th><th>Estado</th><th></th></tr>
                </thead>
                <tbody>
                @foreach ($lotes as $l)
                    <tr>
                        <td>{{ $l->id }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($l->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $l->sucursal }}</td>
                        <td>{{ $l->meses }}</td>
                        <td>{{ $l->usuario }}</td>
                        <td class="text-right">{{ $l->estado === 'Activo' ? $l->activas . ' de ' . $l->cantidad . ' activas' : $l->cantidad }}</td>
                        <td class="text-right">{{ number_format($l->monto, 0, ',', '.') }}</td>
                        <td>{{ $l->estado }}@if ($l->estado === 'Revertido') ({{ $l->revertido_por_nombre }}, {{ \Illuminate\Support\Carbon::parse($l->revertido_at)->format('d/m/Y H:i') }})@endif</td>
                        <td><a href="{{ route('incobrables.lote', $l->id) }}" class="btn btn-sm btn-default">Ver detalle</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@stop
