@if(Auth::user()->role=="coordinador")
<div class = "container">
<h2>Materias</h2>

    <div id="input-section">
        <div class="mb-3">
            <label for="" class= "form-label">Asignatura: </label><br>
            <input wire:model="materia.asignatura" type="text" id="asignatura">
            @error('materia.asignatura') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="" class= "form-label">Creditos: </label><br>
            <input wire:model="materia.creditos" type="text" id="creditos">
            @error('materia.creditos') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb3">
            <label for="" class = "form-label">Semestre: </label><br>
            <input wire:model="materia.semestre" type="text" id="semestre">
            @error('materia.semestre') <span class = "text-danger">Corrige este campo</span>@enderror 
        </div>
        <div class="mb3">
            <label for="" class = "form-label">Carrera: </label><br>
            <select wire:model="carrera_id" name="carrera" id="carrera">
                <option value="">--Seleccionar--</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{$carrera->nombre}}</option>
                @endforeach
            </select>
            @error('carrera_id') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>

    </div>
    <div class="mb-3 row">
        <div class="col-auto">
          <button class="btn btton" id="guardar" wire:click = "store">Guardar</button>
        </div>
        <div class="col-auto">
          <button class="btn btton" id="cancelar" wire:click = "cancel">Cancelar</button>
        </div>
        @if($materia->grupos->count()==0 || $materia->alumnosRegistrados->count()==0)
        <div class="col-auto">
          <button class="btn btton" id="baja" wire:click = "delete">Baja</button>
        </div>
        @endif
    </div>
</div>
@endif