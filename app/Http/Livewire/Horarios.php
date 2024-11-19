<?php

namespace App\Http\Livewire;

use App\Models\horario;
use Livewire\Component;

class Horarios extends Component
{
    public $search;
    public horario $horario;

    protected $rules = [
        'horario.hora_inicio' => 'required|date_format:H:i',
        'horario.hora_fin' => 'required|date_format:H:i|after:horario.hora_inicio',
        'horario.turno' => 'required',
        'horario.day_week' => 'required',
    ];

    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->horario=new horario();
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.horarios');
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->horario = $this->loadHorario() ?? new horario();
    }
    
    private function loadHorario()
    {
        try{
            $query = horario::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where('day_week', 'like', "%{$this->search}%")
                            ->orWhere('turno', 'like', "%{$this->search}%")
                            ->orWhere('hora_fin', 'like', "%{$this->search}%")
                            ->orWhere('hora_inicio', 'like', "%{$this->search}%");
                    });
                })
                ->first();
            return $query;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 53201Marcas"] );
        }
    }
    
    public function delete($horario)
    {
        $this -> destroy($horario);
    }

    public function cancel()
    {
        $this->loadDefault();
    }

    public function store()
    {
        $this->validate($this->rules);
            
        try{
            $exists = $this->validateHorario();
            if($exists){
                $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Existe ya un horario en el rango elegido"] );
                return;
            }
            $this->horario->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->emit('refresh');
            $this->horario=new horario;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202horarios"] );
        } 
    }
    private function validateHorario()
    {
        $exists = Horario::where('day_week', $this->horario->day_week)
            ->where('turno', $this->horario->turno)
            ->where(function ($query) {
                $query->whereBetween('hora_inicio', [$this->horario->hora_inicio, $this->horario->hora_fin])
                    ->orWhereBetween('hora_fin', [$this->horario->hora_inicio, $this->horario->hora_fin])
                    ->orWhere(function ($q) {
                        $q->where('hora_inicio', '<=', $this->horario->hora_inicio)
                            ->where('hora_fin', '>=', $this->horario->hora_fin);
                    });
            })
            ->exists();

        return $exists;
    }
    public function destroy(): void
    {
        try{
            $this->horario->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203horarios"] );
        } 
        
    }
}
