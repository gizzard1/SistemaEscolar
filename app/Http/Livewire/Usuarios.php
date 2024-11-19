<?php

namespace App\Http\Livewire;

use App\Models\alumno;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Rules\Password;

class Usuarios extends Component
{
    public $search;
    public User $user;

    public $password;
    
    protected $rules = [
        'user.name' => 'required|min:2|max:255|unique:users,name',
        'password' => 'required|min:6|max:255|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        'user.email' => 'required|min:2|max:255|unique:users,email',
        'user.role' => 'required|min:2|max:255',
    ];
    
    public function mount()
    {
        $this->loadDefault();
    }
    
    private function loadDefault()
    {
        $this->user=new User;
        $this->password = null;
        $this->emit('refresh');
    }
    public function render()
    {
        return view('livewire.usuarios');
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete','store'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
        $this->user = $this->loadUser() ?? new User();
    }
    
    private function loadUser()
    {
        try{
            $query = User::when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where('name', 'like', "%{$this->search}%")
                            ->orWhere('email', 'like', "%{$this->search}%");
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
        $this->rules['user.name'] = $this->user->id > 0 ? "required|min:2|max:55|unique:users,name,{$this->user->id}" : 'required|min:2|max:55|unique:users,name';
        $this->rules['user.email'] = $this->user->id > 0 ? "nullable|min:2|max:55|unique:users,email,{$this->user->id}" : 'nullable|min:2|max:55|unique:users,email';
        $this->validate($this->rules);
        try{
            $this->user->password = Hash::make($this->password);
            $this->user->save();
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);
            $this->loadDefault();
            $this->emit('refresh');
        }catch(\Throwable $th){
            dd($th);
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202alumnos"] );
        } 
    }
    public function destroy()
    {
        try{
            $this->usuario->delete();
            $this->loadDefault();
            $this->dispatchBrowserEvent('noty',['msg'=>'ALUMNO ELIMINADO']);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203alumnos"] );
        } 
        
    }
}
