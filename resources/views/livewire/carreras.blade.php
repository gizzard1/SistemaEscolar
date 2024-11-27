@if(Auth::user()->role=="coordinador")
<div class="container">
    <div class="search-section text-center">
      <h2>Carreras</h2>
    </div>

    <div class="input-section">

      <div class="mb-3">
        <label for="nombre_carrera" class="form-label">Nombre</label>
        
        <input wire:model="carrera.nombre" type="text" id="nombre_carrera" class="form-control" placeholder="Nombre">
        @error('carrera.nombre') <span class = "text-danger">Corrige este campo</span>@enderror
      </div>

      <div class="mb-3">
        <label for="numero_semestres" class="form-label">Número De Semestres</label>
        <input wire:model="carrera.semestres" type="number" id="numero_semestres" class="form-control" min="1" max="20" step="1" placeholder="Cantidad de semestres">
        @error('carrera.semestres') <span class = "text-danger">Corrige este campo</span>@enderror
      </div>



      <div class="mb-3 row">
        <div class="col-auto">
          <button class="btn btton" id="guardar" wire:click = "store">Guardar</button>
        </div>
        <div class="col-auto">
          <button class="btn btton" id="cancelar" wire:click = "cancel">Cancelar</button>
        </div>
        @if($carrera->alumnos->count()==0&&$carrera->maestros->count()==0)
        <div class="col-auto">
          <button class="btn btton" id="baja" wire:click = "delete">Baja</button>
        </div>
        @endif
      </div>
    </div>
  </div>

@endif
