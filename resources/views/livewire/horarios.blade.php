@if(Auth::user()->role=="coordinador")
<div class="container">
    <div class="search-section text-center">
      <h2>Horarios</h2>
    </div>

    <div class="input-section">

      <!-- ComboBox!!!!!!!!!!!!!!! -->
      <div class="mb-3">
        <label for="comboBox" class="form-label">Turno</label>
        <select wire:model="horario.turno" class="form-select form-control" id="comboBox">
          <option value="matutino">Seleccionar</option>
          <option value="matutino">Matutino</option>
          <option value="vespertino">Vespertino</option>
      </select>
          @error('horario.turno') <span class = "text-danger">Corrige este campo</span>@enderror
      </div>

      <div class="mb-3 row">
        <div class="col">
            <label for="hora_inicio" class="form-label">Hora inicio</label>
            <input wire:model="horario.hora_inicio" type="time" id="hora_inicio" class="form-control">
            @error('horario.hora_inicio') <span class = "text-danger">Corrige este campo</span>@enderror 
          </div>
          <div class="col">
            <label for="hora_fin" class="form-label">Hora fin</label>
            <input  wire:model="horario.hora_fin" type="time" id="hora_fin" class="form-control">
            @error('horario.hora_fin') <span class = "text-danger">Corrige este campo</span>@enderror 
          </div>
      </div>
      
      
      


      <div class="mb-3">
        <label for="dia" class="form-label">Día</label>
        <input wire:model="horario.day_week" class="form-control" list="Options" id="dia" placeholder="Dia de la semana...">
        @error('horario.day_week') <span class = "text-danger">Corrige este campo</span>@enderror
        <datalist id="Options">
          <option value="Lunes">
          <option value="Martes">
          <option value="Miercoles">
          <option value="Jueves">
          <option value="Viernes">
          <option value="Sabado">
          <option value="Domingo">
        </datalist>
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
</div>

@endif
