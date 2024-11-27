<?php

namespace App\Http\Livewire;

use App\Models\alumno;
use App\Models\carrera;
use App\Models\grupo;
use App\Models\grupos_alumno;
use App\Models\materia;
use App\Models\prerregistro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Alumnos extends Component
{
    public $search;
    public alumno $alumno;
    public $selectedMaterias = [];
    public $materiaInputs = []; // Contendrá los índices dinámicos de los selects
    public $materias;
    public $grupos;

    protected $rules = [
        'alumno.nombre' => 'required|min:2|max:255',
        'alumno.apellido_materno' => 'required|min:2|max:255',
        'alumno.apellido_paterno' => 'required|min:2|max:255',
        'alumno.estado' => 'required|min:2|max:255',
        'alumno.fecha_nacimiento' => 'required',
        'alumno.carrera_id' => 'required',
        'alumno.user_id' => 'required',
    ];
    public function addMateriaInput()
    {
        $this->materiaInputs[] = count($this->materiaInputs); // Añade un nuevo índice
    }

    public function removeMateriaInput($index)
    {
        // Elimina el índice del arreglo materiaInputs
        unset($this->materiaInputs[$index]);

        // Reindexa el arreglo para evitar problemas en el foreach de Blade
        $this->materiaInputs = array_values($this->materiaInputs);

        // Limpia la selección de materia asociada
        unset($this->selectedMaterias[$index]);

    }

    public function storePre()
    {
        $alumno_id = Auth::user()->alumno->id;
        foreach($this->selectedMaterias as $materia){
            if($materia != ''){
                if(Auth::user()->alumno->materiasRegistradas->count()>0){
                    $grupo = grupo::with('alumnos')->find($materia);
                    if($grupo->alumnos>$grupo->alumnos()->count()){
                        $pre = new grupos_alumno;
                        $pre->alumno_id = $alumno_id;
                        $pre->grupo_id = $materia;
                    }else{
                        $this->dispatchBrowserEvent('noty-error',['msg'=>'Una o más materias no fue posible registrar']);
                    }
                }else{
                    $pre = new prerregistro;
                    $pre->alumno_id = $alumno_id;
                    $pre->materia_id = $materia;
                }
                $pre->save();
                $this->grupos = $this->loadGrupos();
                $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
                redirect()->to('/');
            }
        }
        $this->emit('refresh');
    }

    public function materiaSelected($materia_id, $index)
    {
        if(in_array($materia_id,$this->selectedMaterias)){
            $msj = Auth::user()->alumno->materiasRegistradas->count()>0 ? 'No es posible registrar la misma materia' : 'No es posible prerregistrar la misma materia';
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  $msj] );
            $this->removeMateriaInput($index);
            return;
        }

        // Guarda la materia seleccionada en la posición correspondiente
        $this->selectedMaterias[$index] = $materia_id;
    }

    private function loadMaterias()
    {
        return materia::where('carrera_id', Auth::user()->alumno->carrera_id)
            ->get();
    }
    private function loadGrupos()
    {
        $alumno = Auth::user()->alumno;
    
        return grupo::whereHas('materia', function ($query) use ($alumno) {
            $query->where('carrera_id', $alumno->carrera_id) // Materias de la misma carrera
                  ->whereHas('alumnosRegistrados', function ($query) use ($alumno) {
                      $query->where('alumno_id', $alumno->id); // Materias prerregistradas por el alumno
                  });
        })->get();
    }
    

    public function mount()
    {
        
        if(Auth::user()->role=="alumno"){
            // Actualiza las materias disponibles excluyendo las seleccionadas
            $this->materias = $this->loadMaterias();
            $this->grupos = $this->loadGrupos();

        }elseif(Auth::user()->role=="coordinador"){
            $this->loadDefault();
        }
    }
    
    private function loadDefault()
    {
        $this->alumno=new alumno;
        $this->emit('refresh');
    }
    public function render()
    {
        if(Auth::user()->role=="alumno"){
            if(Auth::user()->alumno->estado == 'activo'){
                if(Auth::user()->alumno->materiasRegistradas->count()>0&&grupos_alumno::where('alumno_id',Auth::user()->alumno->id)->count()==0){
                    return view('livewire.alumnos.registro',['grupos'=>$this->grupos]);
                }elseif(grupos_alumno::where('alumno_id',Auth::user()->alumno->id)->count()>0){
                    $grupos = Auth::user()->alumno->grupos()->with(['horario', 'salon', 'materia', 'maestro'])->get();
                    return view('livewire.horario', ['gruposRegistrados' => $grupos]);
                    
                }else{
                    return view('livewire.alumnos.prerregistro',['materias'=>$this->materias]);
                }
            }elseif(Auth::user()->alumno->estado == 'inactivo'){
                return view('livewire.alumnos.inactivo',['materias'=>$this->materias]);
            }
        }elseif(Auth::user()->role=="coordinador"){
            return view('livewire.alumnos.alumnos',['carreras' => carrera::all(),'usuarios' => User::where('role','alumno')->whereDoesntHave('alumno')->get()]);
        }elseif(Auth::user()->role=="maestro"){
            $grupos = Auth::user()->maestro->grupos()->with(['horario', 'salon', 'materia', 'maestro'])->get();
            return view('livewire.horario-maestro',['gruposRegistrados' => $grupos]);
        }
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->alumno = $this->loadAlumno() ?? new alumno();
    }
    
    private function loadAlumno()
    {
        try{
            $query = alumno::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where(DB::raw("CONCAT(nombre, ' ', apellido_materno, ' ',apellido_paterno)"), 'like', "%{$this->search}%")
                            ->orWhere('nombre', 'like', "%{$this->search}%")
                            ->orWhere('apellido_materno', 'like', "%{$this->search}%")
                            ->orWhere('apellido_paterno', 'like', "%{$this->search}%");
                    });
                })
                ->first();
            return $query;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 53201Marcas"] );
        }
    }
    
    public function delete()
    {
        $this -> destroy();
    }

    public function cancel()
    {
        $this->loadDefault();
    }

    public function store()
    {
        $this->validate($this->rules);
        try{
            $this->alumno->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->alumno=new alumno;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202alumnos"] );
        } 
    }
    public function destroy()
    {
        try{
            $this->alumno->estado = 'inactivo';
            $this->alumno->save();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'BAJA EFECTUADA']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203alumnos"] );
        } 
        
    }
}
