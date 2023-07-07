<div>
   
@php
   // dd($dataType);
@endphp

 <!-- Adding / Editing -->

 <div class="card">
    <img class="card-img-top" src="holder.js/100x180/" alt="">
    <div class="card-body">
        
        @foreach ($dataTypeContent as $item)

             {{-- public {{ $item->field}}; </br> --}}
            @if ( ( $item->field=='created_at')||( $item->field=='updated_at')
            ||( $item->field=='id')||( $item->field=='foto'))
                    @php
                        continue;
                    @endphp
            @else 
                <div class="form-group">
                    <label for="my-input">{{ $item->display_name}}</label>
                    <input wire:model="{{ $item->field}}" class="form-control" type="{{ $item->type}}" name="{{ $item->field}}">
                </div>
             @endif

        @endforeach
        <input wire:model="alumno_curso_id" class="form-control" type="hidden" name="alumno_curso_id" value="2">
             
        <button type="button" wire:click="guardar" id="guardar_alumno"class="btn btn-primary">Guardar </button>
    </div>
</div>


</div>




