<div class="container">
    <div id="input-section">
        <h2>Registro {{isset($grupos) ? '' : 'fuera de tiempo'}}</h2>

        @if(isset($grupos))

        @foreach($materiaInputs as $index)
            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1">
                    <label for="">Grupo: </label><br>
                    <select 
                        wire:change="materiaSelected($event.target.value, {{ $index }})" 
                        name="materia" 
                        id="materia{{ $index }}"
                    >
                        <option value="">--Seleccionar--</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}" 
                                {{ isset($selectedMaterias[$index]) && $selectedMaterias[$index] == $grupo->id ? 'selected' : '' }}
                            >
                                {{ $grupo->materia->asignatura }} | Maestro: {{ $grupo->maestro->apellido_paterno }} {{ $grupo->maestro->apellido_materno }} {{ $grupo->maestro->nombre }} | Horario: {{ $grupo->horario->day_week }} {{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button 
                    type="button" 
                    class="btn btn-danger ms-2" 
                    wire:click="removeMateriaInput({{ $index }})"
                >
                    Eliminar
                </button>
            </div>
        @endforeach

        <button type="button" wire:click="addMateriaInput" class="btn btn-primary mt-3">
            Agregar Materia
        </button>
        <button type="button" wire:click="storePre" class="btn btn-success mt-3">
            Guardar Registro
        </button>
        @endif
    </div>
</div>
