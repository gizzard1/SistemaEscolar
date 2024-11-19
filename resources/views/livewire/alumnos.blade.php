@if(Auth::user()->role=="coordinador")
<div class="container">
    <div class="search-section text-center">
      <h2>Alumnos</h2>
    </div>
    <div class="input-section">
        <div class="mb-3">
            <label for="">Nombre: </label><br>
            <input wire:model="alumno.nombre" type="text" id="nombre_usuario">
            @error('alumno.nombre') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Usuario: </label><br>
            <select wire:model="alumno.user_id" name="usuario" id="usuario">
                <option value="">--Seleccionar--</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{$usuario->name}}</option>
                @endforeach
            </select>
            @error('alumno.user_id') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Apellido Paterno: </label><br>
            <input wire:model="alumno.apellido_paterno" type="text" id="apellido1_usuario">
            @error('alumno.apellido_paterno') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Apellido Materno: </label><br>
            <input wire:model="alumno.apellido_materno" type="text" id="apellido2_usuario">
            @error('alumno.apellido_materno') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Estado: </label><br>
            <select wire:model="alumno.estado" name="estado" id="estado">
                <option value="">--Seleccionar--</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
            @error('alumno.estado') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Fecha de nacimiento: </label><br>
            <input wire:model="alumno.fecha_nacimiento" type="date" id="fecha_nac">
            @error('alumno.fecha_nacimiento') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Carrera: </label><br>
            <select wire:model="alumno.carrera_id" name="carrera" id="carrera">
                <option value="">--Seleccionar--</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{$carrera->nombre}}</option>
                @endforeach
            </select>
            @error('alumno.carrera_id') <span class = "text-danger">Corrige este campo</span>@enderror
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

@endif

@if(Auth::user()->role=="alumno")
<div id="input-section">
        <div class="mb-3">
            <label for="">Carrera: </label><br>
            <select wire:model="alumno.carrera_id" name="carrera" id="carrera">
                <option value="">--Seleccionar--</option>
            </select>
            @error('alumno.carrera_id') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Materia: </label><br>
            <select wire:model="materia.asignatura" name="materia" id="materia">
                <option value="">--Seleccionar--</option>
            </select>
            @error('materia.asignatura') <span class = "text-danger">Corrige este campo</span>@enderror
            <input type="text" name="" id="materias" readonly>
        </div>

</div>
@endif