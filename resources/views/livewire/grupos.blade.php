
@if(Auth::user()->role=="coordinador")
<div class="container">
    <div class="search-section text-center">
      <h2>Grupos</h2>
    </div>

    <div class="input-section">

      <div class="mb-3 row">
        <div class="col">
          <label for="nombre_grupo" class="form-label">Nombre Grupo</label>
          <input wire:model="grupo.nombre" type="text" id="nombre_grupo" class="form-control">
          @error('grupo.nombre') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="col">
          
        <label for="ciclo" class="form-label">Ciclo</label>
          <input wire:model="grupo.ciclo" type="text" id="ciclo" class="form-control">
          @error('grupo.ciclo') <span class = "text-danger">Corrige este campo</span>@enderror
          </div>
      </div>

      <div class="mb-3 row">
        <div class="col">
          <label for="duracion" class="form-label">Duración</label>
          <select wire:model="grupo.duracion" class="form-select form-control" id="duracion">
            <option value="">--Seleccionar--</option>
            <option value="semestre">Semestre</option>
            <option value="cuatrimestre">Cuatrimestre</option>
            <option value="año">Año</option>
            <select id="duracion" class="form-select form-control">
            </select>
            @error('grupo.duracion') <span class = "text-danger">Corrige este campo</span>@enderror


          </div>
          <div class="col">
          <label for="alumnos" class="form-label">Cupo</label>
          <input wire:model="grupo.alumnos" type="text" id="alumnos" class="form-control">
          @error('grupo.alumnos') <span class = "text-danger">Corrige este campo</span>@enderror
            </div>
      </div>

      <div class="mb-3 row">
        <div class="col">
          <label for="semestre" class="form-label">Semestre</label>
          <input wire:model="grupo.semestre" type="text" id="semestre" class="form-control">
          @error('grupo.semestre') <span class = "text-danger">Corrige este campo</span>@enderror
            </div>
        <div class="col">
        <label for="carrera" class="form-label">Carrera</label>
          <select wire:model="grupo.carrera_id" class="form-select form-control" id="carrera">
            <option value="">--Seleccionar--</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{$carrera->nombre}}</option>
                @endforeach
            <select id="carrera" class="form-select form-control">
            @error('grupo.carrera_id') <span class = "text-danger">Corrige este campo</span>@enderror
            </select>

          </div>
      </div>

      <div class="mb-3 row">
        <div class="col">
          
        <label for="maestro" class="form-label">Maestro</label>
          <select wire:model="grupo.maestro_id" class="form-select form-control" id="maestro">
            <option value="">--Seleccionar--</option>
                @foreach ($maestros as $maestro)
                    <option value="{{ $maestro->id }}">{{$maestro->apellido_paterno}} {{$maestro->apellido_materno}} {{$maestro->nombre}}</option>
                @endforeach
            </select>
            @error('grupo.maestro_id') <span class = "text-danger">Corrige este campo</span>@enderror
            </div>
        <div class="col">
          <label for="materia" class="form-label">Materia</label>
          <select wire:model="grupo.materia_id" class="form-select form-control" id="materia">
            <option value="">--Seleccionar--</option>
                @foreach ($materias as $materia)
                    <option value="{{ $materia->id }}">{{$materia->asignatura}} | Semestre: {{$materia->semestre}} | Créditos: {{$materia->creditos}}</option>
                @endforeach
            </select>
            @error('grupo.materia_id') <span class = "text-danger">Corrige este campo</span>@enderror
            </div>
      </div>

      <div class="mb-3 row">
        <div class="col">
      <label for="horario_id" class="form-label">Horario</label>
          <select wire:model="grupo.horario_id" class="form-select form-control" id="horario_id">
            <option value="">--Seleccionar--</option>
                @foreach ($horarios as $horario)
                    <option value="{{ $horario->id }}">{{$horario->hora_inicio}} - {{$horario->hora_fin}} | Día: {{$horario->day_week}} | Turno: {{$horario->turno}}</option>
                @endforeach
            </select>
            @error('grupo.horario_id') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>

        <div class="col">
      <label for="salon_id" class="form-label">Salon</label>
        <select wire:model="grupo.room_id" class="form-select form-control" id="salon_id">
            <option value="">--Seleccionar--</option>
                @foreach ($salones as $salon)
                    <option value="{{ $salon->id }}">{{$salon->nombre}} | Edificio: {{$salon->edificio}}</option>
                @endforeach
          </select>
          @error('grupo.room_id') <span class = "text-danger">Corrige este campo</span>@enderror
            </div>

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
