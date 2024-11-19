<?php

namespace App\Http\Livewire;

use App\Models\carrera;
use App\Models\materia;
use Livewire\Component;

class Materias extends Component
{
    public $search;
    public materia $materia;
    public $carrera_id;

    protected $rules = [
        'materia.asignatura' => 'required',
        'materia.creditos' => 'required',
        'materia.semestre' => 'required',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->materia=new materia();
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.materias',['carreras' => carrera::all()]);
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->materia = $this->loadMateria() ?? new materia();
    }
    
    private function loadMateria()
    {
        try{
            $query = materia::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where('asignatura', 'like', "%{$this->search}%");
                    });
                })
                ->first();
            return $query;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 53201Marcas"] );
        }
    }
    
    public function delete($materia)
    {
        $this -> destroy($materia);
    }

    public function cancel()
    {
        $this->loadDefault();
    }

    public function store()
    {
        $this->validate($this->rules);
            
        try{
            $this->materia->carrera_id = $this->carrera_id;
            $this->materia->save();

            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->materia=new materia;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202materias"] );
        } 
    }
    public function destroy(): void
    {
        try{
            $this->materia->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203materias"] );
        } 
        
    }
}
