<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreatePerson extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $search;

    //PERSON
    public $name;
    public $num_doc;
    public $phone;
    public $email;
    public $gender;
    public $rol;

    protected $listeners = ['delete'];

    public $status_type = 2;

    public $createForm = [
        'name' => null,
        'num_doc' => null,
        'phone' => null,
        'email' => null,
        'gender' => null,
        'rol' => null,
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
        'num_doc' => null,
        'phone' => null,
        'email' => null,
        'gender' => null,
        'rol' => null,
    ];

    public $editImage;

    protected $rules = [
        'createForm.name' => 'required',
        'createForm.rol' => 'required',
        'createForm.gender' => 'required',
        'createForm.email' => 'required|string|max:255|unique:users,email',
        'createForm.phone' =>  'required|string|max:9|unique:users,phone',
        'createForm.num_doc' =>  'required|string|max:8|unique:users,num_doc',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name',
        'createForm.num_doc' => 'numero documento',
        'createForm.phone' => 'telefono',
        'createForm.gender' => 'genero',
        'createForm.email' => 'correo',
        'createForm.rol' => 'rol',

        'editForm.name' => 'name',
        'editForm.num_doc' => 'numero documento',
        'editForm.phone' => 'telefono',
        'editForm.gender' => 'genero',
        'editForm.email' => 'correo',
        'editForm.rol' => 'rol',
    ];


    public function save()
    {

        $rules = $this->rules;
        $this->validate($rules);

        $user = new User;
        $user->name = $this->createForm['name'];
        $user->email = $this->createForm['email'];
        $user->num_doc = $this->createForm['num_doc'];
        $user->phone = $this->createForm['phone'];
        $user->gender = $this->createForm['gender'];
        $user->password = bcrypt($this->createForm['num_doc']);
        $user->current_team_id = "1";
        $user->save();

        if ($this->createForm['rol'] == "1") {
            $user->assignRole('admin');
        } else if ($this->createForm['rol'] == "2") {
            $user->assignRole('employee');
        } else if ($this->createForm['rol'] == '3') {
            $user->assignRole('user');
        }

        // $user->createAsStripeCustomer();

        $userRegister = User::where('email', $this->createForm['email'])->first();

        $this->status_type = 2;
        $this->reset('createForm');
        $this->resetPage();
    }

    public function edit(User $user)
    {

        $this->resetValidation();

        $this->user = $user;

        $this->editForm['open'] = true;

        $this->editForm['name'] = $user->name;
        $this->editForm['num_doc'] = $user->num_doc;
        $this->editForm['phone'] = $user->phone;
        $this->editForm['gender'] = $user->gender;
        $this->editForm['email'] = $user->email;
        // $this->editForm['rol'] = $user->roles[0]->pivot->role_id;
        // dd($user->roles);
    }

    public function assignRole(User $user, $value)
    {
        // dd($rol);

        $rol = DB::table('model_has_roles')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', $user->id)->value('name');

        if ($rol) {
            $user->removeRole($rol);
        }

        if ($value == '1') {
            $user->assignRole('admin');
        } else if ($value == '2') {
            $user->assignRole('employee');
        } else if ($value == '3') {
            $user->assignRole('user');
        }
    }

    public function update()
    {
        $rules = [
            'editForm.name' => 'required',
            'editForm.gender' => 'required',
            'editForm.email' => 'required|string|max:255|unique:users,email,' . $this->user->id,
            'editForm.phone' =>  'required|string|max:9|unique:users,phone,' . $this->user->id,
            'editForm.num_doc' =>  'required|string|max:8|unique:users,num_doc,' . $this->user->id,
        ];

        $this->validate($rules);

        // $this->specialty->update($this->editForm);
        $this->user->name = $this->editForm['name'];
        $this->user->email = $this->editForm['email'];
        $this->user->num_doc = $this->editForm['num_doc'];
        $this->user->phone = $this->editForm['phone'];
        $this->user->gender = $this->editForm['gender'];
        $this->user->password = bcrypt($this->editForm['num_doc']);


        $this->user->save();

        $this->reset(['editForm']);

        // $this->getDepartments();
        // $this->getPlans();
    }

    public function render()
    {
        $h1 = "Personas";
        $small = "Lista Personas";

        $users =  User::where('email', '<>', auth()->user()->email)
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
                // $query->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })->paginate(20);


        return view('livewire.admin.create-person', compact('users', 'h1', 'small'));
    }
}
