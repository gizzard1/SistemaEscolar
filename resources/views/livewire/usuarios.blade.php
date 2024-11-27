@if(Auth::user()->role=="coordinador")
<div class="container">
    <div class="search-section text-center">
      <h2>Usuarios</h2>
    </div>
    <div id="input-section">
        <div class="mb-3">
            <label for="">Nombre de usuario: </label><br>
            <input wire:model.defer="user.name" type="text" id="name_usuario">
            @error('user.name') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label>Contraseña: </label><br>
            <input wire:model="password" type="password">
            @error('password') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>
        <div class="mb-3">
            <label for="">Email: </label><br>
            <input  wire:model.defer="user.email" type="email" id="email">
            @error('user.email') <span class = "text-danger">Corrige este campo</span>@enderror 
        </div>
        <div class="mb-3">
            <label for="">Perfil: </label><br>
            <select wire:model.defer="user.role" name="user_type" id="usertype">
                <option value="">Elige una opción</option>
                <option value="alumno">Alumno</option>
                <option value="maestro">Maestro</option>
                <option value="coordinador">Coordinador</option>
            </select>
            @error('user.role') <span class = "text-danger">Corrige este campo</span>@enderror
        </div>

    </div>

    <div class="mb-3 row">
        <div class="col-auto">
          <button class="btn btton" id="guardar" wire:click = "store">Guardar</button>
        </div>
        <div class="col-auto">
          <button class="btn btton" id="cancelar" wire:click = "cancel">Cancelar</button>
        </div>
    </div>
</div>
@endif