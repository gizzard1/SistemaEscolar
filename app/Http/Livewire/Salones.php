<?php

namespace App\Http\Livewire;

use App\Models\room;
use Livewire\Component;

class Salones extends Component
{
    public $search;
    public room $room;

    protected $rules = [
        'room.nombre' => 'required|min:2|max:255|unique:rooms,name',
        'room.edificio' => 'required|min:2|max:255',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->room=new room;
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.salones');
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->room = $this->loadRooms() ?? new room();
    }
    
    private function loadRooms()
    {
        try{
            $query = room::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where('nombre', 'like', "%{$this->search}%")
                            ->orWhere('edificio', 'like', "%{$this->search}%");
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
        $this->rules['room.nombre'] = $this->room->id > 0 ? "nullable|min:2|max:255|unique:rooms,nombre,{$this->room->id}" : 'nullable|min:2|max:255|unique:rooms,nombre';
        $this->validate($this->rules);
            
        try{
            $this->room->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->room=new room;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202rooms"] );
        } 
    }
    public function destroy()
    {
        try{
            $this->room->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203rooms"] );
        } 
        
    }
}


