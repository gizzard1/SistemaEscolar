<?php

namespace App\Http\Livewire;

use App\Models\carrera;
use Livewire\Component;

class Carreras extends Component
{
    public $search;
    public carrera $carrera;

    protected $rules = [
        'carrera.nombre' => 'required|min:2|max:255|unique:carreras,name',
        'carrera.semestres' => 'required',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->carrera=new carrera;
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.carreras');
    }    
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->carrera = $this->loadCarrera() ?? new carrera();
    }
    
    private function loadCarrera()
    {
        try{
            $query = carrera::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->Where('nombre', 'like', "%{$this->search}%");
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
        $this->rules['carrera.nombre'] = $this->carrera->id > 0 ? "nullable|min:2|max:255|unique:carreras,nombre,{$this->carrera->id}" : 'nullable|min:2|max:255|unique:carreras,nombre';
        $this->validate($this->rules);
            
        try{
            $this->carrera->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->carrera=new carrera;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202carreras"] );
        } 
    }
    public function destroy()
    {
        try{
            $this->carrera->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203carreras"] );
        } 
        
    }
}

