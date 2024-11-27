<div class="container">
    @foreach($gruposRegistrados as $index => $grupo)
        {{-- Abrir un nuevo row cada 3 iteraciones --}}
        @if($index % 3 === 0)
            <div class="row">
        @endif
        
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    {{ $grupo->horario?->day_week ?? 'No definido' }}
                </div>
                <div class="card-body">
                    <p class="card-text">Grupo: {{ $grupo->nombre }}</p>
                    <p class="card-text">Salón: {{ $grupo->salon?->nombre ?? 'No definido' }}</p>
                    <p class="card-text">Edificio: {{ $grupo->salon?->edificio ?? 'No definido' }}</p>
                    <p class="card-text">Materia: {{ $grupo->materia?->asignatura ?? 'No definida' }}</p>
                    <p class="card-text">Profesor: 
                        {{ $grupo->maestro?->apellido_paterno ?? '' }} 
                        {{ $grupo->maestro?->apellido_materno ?? '' }} 
                        {{ $grupo->maestro?->nombre ?? 'No definido' }}
                    </p>
                    <p class="card-text">Horario: 
                        {{ $grupo->horario?->hora_inicio ?? 'No definido' }} - 
                        {{ $grupo->horario?->hora_fin ?? 'No definido' }}
                    </p>
                </div>
            </div>
        </div>
        
        {{-- Cerrar el row después de 3 columnas o al final del bucle --}}
        @if($index % 3 === 2 || $loop->last)
            </div>
        @endif
    @endforeach
</div>
