@if(Auth::user()->role=="coordinador")
<div class="container">
    <div class="search-section text-center">
      <h2>Salon</h2>
    </div>
    <div class="input-section">
        <div class="mb-3">
        <label for="nombre_salon" class="form-label">Nombre de Salón</label>
        <input type="text" id="nombre_salon" class="form-control" wire:model.defer="room.nombre">
            @error('room.nombre') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>

        <div class="mb-3">
        <label for="nombre_edificio" class="form-label">Edficio</label>
        <input type="text" id="nombre_edificio" class="form-control" wire:model.defer="room.edificio">
            @error('room.edificio') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        
        <div class="mb-3 row">
        <div class="col-auto">
          <button class="btn btton" id="guardar" wire:click = "store">Guardar</button>
        </div>
        <div class="col-auto">
          <button class="btn btton" id="cancelar" wire:click = "cancel">Cancelar</button>
        </div>
        <div class="col-auto">
          <button class="btn btton" id="baja" wire:click = "delete">Baja</button>
        </div>
      </div>
  </div>
</div>
@endif