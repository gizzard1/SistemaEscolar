<?php

namespace App\Http\Livewire;

use App\Models\carrera;
use App\Models\maestro;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Maestros extends Component
{
    public $search;
    public maestro $maestro;

    protected $rules = [
        'maestro.nombre' => 'required|min:2|max:255',
        'maestro.apellido_materno' => 'required|min:2|max:255',
        'maestro.apellido_paterno' => 'required|min:2|max:255',
        'maestro.grado' => 'required|min:1|max:255',
        'maestro.carrera_id' => 'required',
        'maestro.user_id' => 'required',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->maestro=new maestro;
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.maestros',['carreras' => carrera::all(),'usuarios' => User::where('role','maestro')->whereDoesntHave('maestro')->get()]);
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->maestro = $this->loadMaestros() ?? new maestro();
    }
    
    private function loadMaestros()
    {
        try{
            $query = maestro::when($this->search, function ($query) {
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
            $this->maestro->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->loadDefault();
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202maestros"] );
        } 
    }
    public function destroy()
    {
        try{
            $this->maestro->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203maestros"] );
        } 
        
    }
}



