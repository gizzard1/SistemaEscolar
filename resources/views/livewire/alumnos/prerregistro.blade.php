<div class="container">
    <div id="input-section">
        <h2>Prerregistro</h2>

        @foreach($materiaInputs as $index)
            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1">
                    <label for="">Materia: </label><br>
                    <select 
                        wire:change="materiaSelected($event.target.value, {{ $index }})" 
                        name="materia" 
                        id="materia{{ $index }}"
                    >
                        <option value="">--Seleccionar--</option>
                        @foreach($materias as $materia)
                            <option value="{{ $materia->id }}" 
                                {{ isset($selectedMaterias[$index]) && $selectedMaterias[$index] == $materia->id ? 'selected' : '' }}
                            >
                                {{ $materia->asignatura }}
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
            Guardar Prerregistro
        </button>
    </div>
</div>
