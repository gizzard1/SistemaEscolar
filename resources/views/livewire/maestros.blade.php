@if(Auth::user()->role=="coordinador")
    <div class="container">

    
        <div class="input-section">
            <div class= "mb-3 row">
                <div class="col-auto">
                    <label for="nombre" class="form-label">Nombre: </label>
                    <input wire:model.defer="maestro.nombre" type="text" id="nombre" class="form-control" placeholder="Ingresa un nombre...">
                    @error('maestro.nombre') <span class = "text-danger">Corrige este campo</span>@enderror
                </div>
    
                <div class="col-auto">
                    <label for="apellido_paterno" class="form-label">A. paterno: </label>
                    <input wire:model.defer="maestro.apellido_paterno" type="text" id="apellido_paterno" class="form-control" placeholder="Ingresa un apellido...">
                    @error('maestro.apellido_paterno') <span class = "text-danger">Corrige este campo</span>@enderror
                </div>
    
                <div class="col-auto">
                    <label for="apellido_materno" class="form-label">A. materno: </label>
                    <input wire:model.defer="maestro.apellido_materno" type="text" id="apellido_materno" class="form-control" placeholder="Ingresa un apellido...">
                    @error('maestro.apellido_materno') <span class = "text-danger">Corrige este campo</span>@enderror
                </div>

                <div class="col-auto">
                    <label for="grado" class="form-label">Grado: </label>
                    <input wire:model.defer="maestro.grado" type="text" id="grado" class="form-control" placeholder="Ingresa un apellido...">
                    @error('maestro.grado') <span class = "text-danger">Corrige este campo</span>@enderror
                </div>

            </div>

            <div class="mb-3">
                <div class="mb3">
                    <label for="" class = "form-label">Carrera: </label><br>
                    <select wire:model="maestro.carrera_id" name="carrera" id="carrera">
                        <option value="">--Seleccionar--</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                    @error('maestro.carrera_id') <span class = "text-danger">Corrige este campo</span>@enderror
                </div>
                
            </div>
            
            <div class="mb-3">
                    <label for="">Usuario: </label><br>
                    <select wire:model="maestro.user_id" name="usuario" id="usuario">
                        <option value="">--Seleccionar--</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{$usuario->name}}</option>
                        @endforeach
                    </select>
                    @error('maestro.user_id') <span class = "text-danger">Corrige este campo</span>@enderror
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