<?php

namespace App\Http\Livewire;

use App\Models\alumno;
use App\Models\carrera;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Alumnos extends Component
{
    public $search;
    public alumno $alumno;

    protected $rules = [
        'alumno.nombre' => 'required|min:2|max:255',
        'alumno.apellido_materno' => 'required|min:2|max:255',
        'alumno.apellido_paterno' => 'required|min:2|max:255',
        'alumno.estado' => 'required|min:2|max:255',
        'alumno.fecha_nacimiento' => 'required',
        'alumno.carrera_id' => 'required',
        'alumno.user_id' => 'required',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->alumno=new alumno;
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.alumnos',['carreras' => carrera::all(),'usuarios' => User::where('role','alumno')->whereDoesntHave('alumno')->get()]);
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
            dd($th);
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
