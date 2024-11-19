<?php

namespace App\Http\Livewire;

use App\Models\marca;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Marcas extends Component
{
    public $search, $editing, $records;
    public $action=1;
    public marca $marca;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'marca.name' => 'required|min:2|max:55|unique:marcas,name',
        'marca.contact_name' => 'nullable|min:2|max:55',
        'marca.phone_number' => 'nullable|min:2|max:15',
        'marca.email' => 'nullable|min:2|max:55|unique:marcas,email',
        'marca.rfc' => 'nullable|min:2|max:15|unique:marcas,rfc',
    ];

    public function mount($search=null)
    {
        $this->search=$search;
        $this->loadDefault();
    }

    private function loadDefault()

    {
        $this->marca=new marca();
        $this->editing=false; 
        $this->emit('refresh');
    }
    protected $listeners = [
        'refresh' => '$refresh',
        'search' => 'searching',
        'Delete'
    ];

    public function searching($searchText)
    {
        $this->search = trim($searchText);
    }

    public function render()
    {
        try{
            return view('livewire.marcas.marcas',[
                'marcas' => $this->loadBrands()
            ]);
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 43200Marcas"] );
        }
    }

    function loadBrands(){
        try{
            
            $query = Marca::orderBy('name', 'asc')
                ->where('name', '!=', 'Marca eliminada')
                ->where('salon_id', Auth::user()->salon->id)
                ->when($this->search, function ($query) {
                    // Aplica la búsqueda solo si $this->search no está vacío
                    $query->where(function ($query) {
                        $query->where('name', 'like', "%{$this->search}%")
                            ->orWhere('contact_name', 'like', "%{$this->search}%");
                    });
                })
                ->paginate(7);


            $this->records = $query->total();
            return $query;
        }catch(\Throwable $th){
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 53201Marcas"] );
        }
    }

    public function Add()
    {
        $this->resetValidation();
        $this->resetExcept('marca');
        $this->marca = new marca();
    }
    public function Delete($marca)
    {
        $this -> destroy($marca);
    }

    public function Edit(marca $marca){
        $this->marca = $marca;
        $this->editing = true;
    } 

    public function cancelEdit()
    {
        $this->resetValidation();
        $this->marca = new marca();
        $this->editing = false;
    }

    public function Store(){
            $this->rules['marca.name'] = $this->marca->id > 0 ? "required|min:2|max:55|unique:marcas,name,{$this->marca->id}" : 'required|min:2|max:55|unique:marcas,name';
            $this->rules['marca.email'] = $this->marca->id > 0 ? "nullable|min:2|max:55|unique:marcas,email,{$this->marca->id}" : 'nullable|min:2|max:55|unique:marcas,email';
            $this->rules['marca.rfc'] = $this->marca->id > 0 ? "nullable|min:2|max:15|unique:marcas,rfc,{$this->marca->id}" : 'nullable|min:2|max:15|unique:marcas,rfc';
            $this->validate($this->rules);
            
        try{
            $this->marca->salon_id=Auth::user()->salon->id;

            $this->marca->save();
            if($this->action==0){
                $this->emit('enviarProveedor',$this->marca->id);
                $this->emit('closeModalBrand');
                return;
            }
            $this->dispatchBrowserEvent('noty',['msg'=>'SOLICITUD PROCESADA CON ÉXITO']);

            $this->emit('refresh');
            
            $this->marca=new marca;
        }catch(\Throwable $th){
            dd($th);
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 96202Marcas"] );
        } 
    }
    public function destroy($marcaId)
    {
        try{
            $marca = Marca::with('products','gastos')->find($marcaId);
            $marca->products()->update(['brand_id' => null]); 
            // Verifica si tiene compras sin cargar todas las relaciones
            if ($marca->compras->count() > 0 || $marca->gastos->count() > 0 ) {
                // Si tiene compras, solo cambia el nombre y guarda
                $marca->name = "Marca eliminada";
                $marca->save();
            } else {
                // Si no tiene compras, desvincula y elimina el marca
                $marca->delete();
            }
            $this->loadDefault();

            $this->dispatchBrowserEvent('noty',['msg'=>'PROVEEDOR ELIMINADO']);
        }catch(\Throwable $th){
            dd($th);
            $this->dispatchBrowserEvent('noty-error', ['msg' =>  "Código de error: 112203Marcas"] );
        } 
        
    }
}