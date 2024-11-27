<?php

namespace App\Http\Livewire;

use App\Models\carrera;
use App\Models\grupo;
use App\Models\horario;
use App\Models\maestro;
use App\Models\materia;
use App\Models\room;
use Livewire\Component;

class Grupos extends Component
{    public $search;
    public grupo $grupo;
    public $maestros=[],$materias=[],$horarios=[],$salones=[];

    protected $rules = [
        'grupo.nombre' => 'required|min:2|max:255',
        'grupo.semestre' => 'required|min:1|max:255',
        'grupo.alumnos' => 'required',
        'grupo.ciclo' => 'required|min:1|max:50',
        'grupo.duracion' => 'required|min:1|max:50',
        'grupo.carrera_id' => 'required',
        'grupo.maestro_id' => 'required',
        'grupo.materia_id' => 'required',
        'grupo.room_id' => 'required',
        'grupo.horario_id' => 'required',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    public function updatedGrupoCarreraId()
    {
        $this->maestros = maestro::where('carrera_id',$this->grupo->carrera_id)->get();
        $this->materias = materia::where('carrera_id',$this->grupo->carrera_id)->get();
    }
    public function updatedGrupoMaestroId()
    {
        // Obtenemos los horarios ocupados por los grupos del maestro
        $horariosOcupados = grupo::where('maestro_id', $this->grupo->maestro_id)
        ->pluck('horario_id'); // Lista de IDs de horarios ocupados

        // Obtenemos los horarios disponibles (no ocupados)
        $this->horarios = horario::whereNotIn('id', $horariosOcupados)->get();
    }
    public function updatedGrupoHorarioId()
    {
        // Obtener los IDs de los salones ocupados en el horario elegido
        $salonesOcupados = grupo::where('horario_id', $this->grupo->horario_id)
        ->pluck('room_id'); // Lista de IDs de salones ocupados

        // Obtener los salones disponibles (no ocupados)
        $this->salones = room::whereNotIn('id', $salonesOcupados)->get();
    }
    private function loadDefault()
    {
        $this->grupo=new grupo;
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.grupos',['carreras' => carrera::all()]);
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->grupo = $this->loadGrupos() ?? new grupo();
    }
    
    private function loadGrupos()
    {
        try{
            $query = grupo::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where('nombre', 'like', "%{$this->search}%")
                            ->orWhere('semestre', 'like', "%{$this->search}%")
                            ->orWhere('ciclo', 'like', "%{$this->search}%")
                            ->orWhere('duracion', 'like', "%{$this->search}%")
                            ->orWhere('alumnos', 'like', "%{$this->search}%");
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
        $this->destroy();
    }

    public function cancel()
    {
        $this->loadDefault();
    }

    public function store()
    {
        $this->validate($this->rules);
        try{
            $this->grupo->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->loadDefault();
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202grupos"] );
        } 
    }
    public function destroy()
    {
        try{
            $this->grupo->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203grupos"] );
        } 
        
    }
}
