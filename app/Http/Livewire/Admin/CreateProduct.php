<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateProduct extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $search;

    //PERSON
    public $quantity;
    public $price;

    public $type_palta;
    public $user_id;

    public $users = [];

    public $img_primary;
    public $img_secundary;
    public $img_tertiary;

    public $edit_img_primary;
    public $edit_img_secundary;
    public $edit_img_tertiary;

    public $rand_img_primary;
    public $rand_img_secundary;
    public $rand_img_tertiary;

    protected $listeners = ['delete'];

    public $status_type = 2;

    public $createForm = [
        'quantity' => null,
        'price' => null,
        'type_palta' => null,
        'user_id' => null,
        'img_primary' => null,
        'img_secundary' => null,
        'img_tertiary' => null,
    ];

    public $editForm = [
        'open' => false,
        'quantity' => null,
        'price' => null,
        'type_palta' => null,
        'user_id' => null,
        'img_primary' => null,
        'img_secundary' => null,
        'img_tertiary' => null,
    ];

    public $editImage;

    protected $rules = [
        'createForm.quantity' => 'required',
        'createForm.price' => 'required',
        'createForm.img_primary' => 'required|image|max:4096',
        'createForm.type_palta' => 'required',
        'createForm.user_id' => 'required',
    ];

    protected $validationAttributes = [
        'createForm.quantity' => 'cantidad de producto',
        'createForm.type_palta' => 'tipo de palta',
        'createForm.price' => 'precio',
        'createForm.user_id' => 'encargado',
        'createForm.img_primary' => 'imagen',
        'createForm.img_secundary' => 'imagen',
        'createForm.img_tertiary' => 'imagen',

        'editForm.quantity' => 'cantidad de producto',
        'editForm.type_palta' => 'tipo de palta',
        'editForm.price' => 'precio',
        'editForm.user_id' => 'encargado',
        'edit_img_primary' => 'imagen',
        'edit_img_secundary' => 'imagen',
        'edit_img_tertiary' => 'imagen',
    ];

    public function mount()
    {

        $this->rand_img_primary = rand();
        $this->rand_img_secundary = rand();
        $this->rand_img_tertiary = rand();
    }
    public function updatedCreateFormUserId($value)
    {
        // $this->subcategories = Subcategory::where('category_id', $value)->get();
        $this->createForm['user_id'] = $value;
    }
    public function updatedEditFormUserId($value)
    {
        $this->editForm['user_id'] = $value;
        // $this->getUsers();
    }

    public function save()
    {

        $rules = $this->rules;

        if ($this->createForm['img_secundary']) {
            $rules = [
                'createForm.img_secundary' => 'required|image|max:4096',
            ];

            $imageName2 = 'palta_secundary_' . time() . '.' . $this->createForm['img_secundary']->extension();
            $uploadedFileUrlLogo2 = $this->createForm['img_secundary']->storeAs('storage/products', $imageName2, 'public_uploads');
            $uploadedFileUrlLogo2 = 'products/' . $imageName2;
        } else {
            $uploadedFileUrlLogo2 = null;
        }

        if ($this->createForm['img_tertiary']) {
            $rules = [
                'createForm.img_tertiary' => 'required|image|max:4096',
            ];

            $imageName3 = 'palta_tertiary_' . time() . '.' . $this->createForm['img_tertiary']->extension();
            $uploadedFileUrlLogo3 = $this->createForm['img_tertiary']->storeAs('storage/products', $imageName3, 'public_uploads');
            $uploadedFileUrlLogo3 = 'products/' . $imageName3;
        } else {
            $uploadedFileUrlLogo3 = null;
        }

        $this->validate($rules);

        $imageName1 = 'palta_primary_' . time() . '.' . $this->createForm['img_primary']->extension();
        $uploadedFileUrlLogo1 = $this->createForm['img_primary']->storeAs('storage/products', $imageName1, 'public_uploads');
        $uploadedFileUrlLogo1 = 'products/' . $imageName1;

        // dd($this->createForm['user_id']);
        $product = new Product();
        $product->quantity = $this->createForm['quantity'];
        $product->type_palta = $this->createForm['type_palta'];
        $product->price = $this->createForm['price'];
        $product->user_id = $this->createForm['user_id'];

        $product->img_primary = $uploadedFileUrlLogo1;
        $product->img_secundary = $uploadedFileUrlLogo2;
        $product->img_tertiary = $uploadedFileUrlLogo3;

        $product->save();

        $this->status_type = 2;
        $this->reset('createForm');
        $this->resetPage();
        $this->getUsers();
    }

    public function getUsers()
    {
        // $this->users = User::all();
        $this->users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id',  3)
            ->get();
        // dd($this->users);
    }
    public function edit(Product $product)
    {

        $this->reset(['edit_img_primary']);
        $this->reset(['edit_img_secundary']);
        $this->reset(['edit_img_tertiary']);
        $this->resetValidation();

        $this->product = $product;

        $this->editForm['open'] = true;

        // $this->emit('select_edit');
        $this->getUsers();

        $this->editForm['quantity'] = $product->quantity;
        $this->editForm['type_palta'] = $product->type_palta;
        $this->editForm['price'] = $product->price;
        $this->editForm['user_id'] = $product->user_id;
        $this->editForm['img_primary'] = $product->img_primary;
        $this->editForm['img_secundary'] = $product->img_secundary;
        $this->editForm['img_tertiary'] = $product->img_tertiary;
        // $this->editForm['rol'] = $user->roles[0]->pivot->role_id;
        // dd($user->roles);
    }


    public function update()
    {
        $rules = [
            'editForm.quantity' => 'required',
            'editForm.price' => 'required',
            'editForm.type_palta' => 'required',
            'editForm.user_id' => 'required',
        ];

        if ($this->edit_img_primary) {
            $rules['edit_img_primary'] = 'required|image|max:4096';
        }

        if ($this->edit_img_secundary) {
            $rules['edit_img_secundary'] = 'required|image|max:4096';
        }
        if ($this->edit_img_tertiary) {
            $rules['edit_img_tertiary'] = 'required|image|max:4096';
        }

        $this->validate($rules);

        if ($this->edit_img_primary) {
            Storage::delete($this->editForm['img_primary']);

            $imageNameEdit1 = 'palta_primary_' . time() . '.' . $this->edit_img_primary->extension();
            $uploadedFileUrlEdit1 = $this->edit_img_primary->storeAs('storage/products', $imageNameEdit1, 'public_uploads');
            $uploadedFileUrlEdit1 = 'products/' . $imageNameEdit1;
            $this->editForm['img_primary'] = $uploadedFileUrlEdit1;
        }


        if ($this->edit_img_secundary) {
            Storage::delete($this->editForm['img_secundary']);

            $imageNameEdit2 = 'palta_secundary_' . time() . '.' . $this->edit_img_secundary->extension();
            $uploadedFileUrlEdit2 = $this->edit_img_secundary->storeAs('storage/products', $imageNameEdit2, 'public_uploads');
            $uploadedFileUrlEdit2 = 'products/' . $imageNameEdit2;
            $this->editForm['img_secundary'] = $uploadedFileUrlEdit2;
        }

        if ($this->edit_img_tertiary) {
            Storage::delete($this->editForm['img_tertiary']);

            $imageNameEdit3 = 'palta_tertiary_' . time() . '.' . $this->edit_img_tertiary->extension();
            $uploadedFileUrlEdit3 = $this->edit_img_tertiary->storeAs('storage/products', $imageNameEdit3, 'public_uploads');
            $uploadedFileUrlEdit3 = 'products/' . $imageNameEdit3;
            $this->editForm['img_tertiary'] = $uploadedFileUrlEdit3;
        }


        $this->product->quantity = $this->editForm['quantity'];
        $this->product->type_palta = $this->editForm['type_palta'];
        $this->product->price = $this->editForm['price'];
        $this->product->user_id = $this->editForm['user_id'];

        $this->product->img_primary = $this->editForm['img_primary'];
        $this->product->img_secundary = $this->editForm['img_secundary'];
        $this->product->img_tertiary = $this->editForm['img_tertiary'];

        $this->product->save();

        $this->reset(['editForm', 'edit_img_primary', 'edit_img_secundary', 'edit_img_tertiary']);

        // $this->getDepartments();
        // $this->getPlans();
    }


    public function delete(Product $product)
    {
        $product->delete();
        $this->getUsers();
    }

    public function render()
    {
        $h1 = "Producción";
        $small = "Lista Producción";

        $products =  Product::query()->paginate(20);
        $this->getUsers();
        // $usuarios = DB::table('users')
        //     ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        //     ->where('model_has_roles.role_id',  3)
        //     ->get();

        return view('livewire.admin.create-product', compact('products', 'h1', 'small'));
    }
}
