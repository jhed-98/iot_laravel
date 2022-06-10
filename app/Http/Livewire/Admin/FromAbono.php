<?php

namespace App\Http\Livewire\Admin;

use App\Models\Risk;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class FromAbono extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $users = [];
    public $sensor;

    public $editImage;

    public $createForm = [
        'open' => false,
        'user_id' => null,
        'days' => null,
        'risk_name' => null,
        'risk_quantity' => null,
        'comment' => null,
        'image' => null,
    ];

    public $editForm = [
        'open' => false,
        'user_id' => null,
        'days' => null,
        'risk_name' => null,
        'risk_quantity' => null,
        'comment' => null,
        'image' => null,
    ];

    protected $rules = [
        // 'createForm.slug' => 'required|unique:user,slug',
        'createForm.user_id' => 'required',
        'createForm.days' => 'required',
        'createForm.risk_name' => 'required',
        'createForm.risk_quantity' => 'required',
        'createForm.comment' => 'required',
        'createForm.image' => 'image|max:2048',

    ];

    protected $validationAttributes = [
        'createForm.user_id' => 'Usuario',
        'createForm.days' => 'Cantidad de dia',
        'createForm.risk_name' =>  'Abono para emplear',
        'createForm.risk_quantity' => 'Cantidad de abono',
        'createForm.comment' => 'Comentario',
        'createForm.image' => 'Image',

        'editForm.user_id' => 'Usuario',
        'editForm.days' => 'Cantidad de dia',
        'editForm.risk_name' =>  'Abono para emplear',
        'editForm.risk_quantity' => 'Cantidad de abono',
        'editForm.comment' => 'Comentario',
        'editImage' => 'Image',
    ];


    public function create(Sensor $sensor)
    {
        $this->createForm['open'] = true;

        $this->sensor = $sensor;
    }

    public function save()
    {
        // dd(strtotime($this->createForm['time_nac']));
        $rules = $this->rules;
        $this->validate($rules);

        if ($this->createForm['image']) {
            $imageName = 'risks_' . time() . '.' . $this->createForm['image']->extension();
            $uploadedFileUrl = $this->createForm['image']->storeAs('storage/risks', $imageName, 'public_uploads');
            $uploadedFileUrl = 'risks/' . $imageName;
        }


        $risk = new Risk();
        $risk->user_id = $this->createForm['user_id'];
        $risk->sensor_id = $this->sensor->id;
        $risk->days = $this->createForm['days'];
        $risk->risk_name = $this->createForm['risk_name'];
        $risk->risk_quantity = $this->createForm['risk_quantity'];
        $risk->comment = $this->createForm['comment'];
        $risk->image = $uploadedFileUrl;

        $risk->save();

        $this->sensor->status_alkalinity = 1;
        $this->sensor->save();

        $this->reset('createForm');
    }


    public function edit(Sensor $sensor)
    {
        $this->resetValidation();

        $this->sensor = $sensor;
        $sensor_id = $sensor->id;

        $this->editForm['open'] = true;
        $this->editForm['user_id'] = Risk::where('sensor_id', $sensor_id)->value('user_id');
        $this->editForm['days'] = Risk::where('sensor_id', $sensor_id)->value('days');
        $this->editForm['risk_name'] = Risk::where('sensor_id', $sensor_id)->value('risk_name');
        $this->editForm['risk_quantity'] = Risk::where('sensor_id', $sensor_id)->value('risk_quantity');
        $this->editForm['comment'] = Risk::where('sensor_id', $sensor_id)->value('comment');
        $this->editForm['image'] = Risk::where('sensor_id', $sensor_id)->value('image');
    }

    public function update()
    {

        $rules = [
            'editForm.user_id' => 'required',
            'editForm.days' => 'required',
            'editForm.risk_name' => 'required',
            'editForm.risk_quantity' => 'required',
            'editForm.comment' => 'required',
        ];
        if ($this->editImage) {
            $rules['editImage'] = 'required|image|max:2048';
        }

        $this->validate($rules);


        // $risk = Risk::find($this->sensor->id); 
        // // Make sure you've got the Page model
        // if ($risk) { 
        if ($this->editImage) {
            $imageName = 'risks_' . time() . '.' . $this->editImage->extension();
            $uploadedFileUrl = $this->editImage->storeAs('storage/risks', $imageName, 'public_uploads');
            $uploadedFileUrl = 'risks/' . $imageName;

            Risk::where('sensor_id', $this->sensor->id)->update(
                [
                    'image' => $uploadedFileUrl,
                ]
            );
        }

        //     $risk->user_id = $this->editForm['user_id'];
        //     $risk->days = $this->editForm['days'];
        //     $risk->risk_name = $this->editForm['risk_name'];
        //     $risk->risk_quantity = $this->editForm['risk_quantity'];
        //     $risk->comment = $this->editForm['comment'];
        //     // $risk->updated = $time_up;

        //     $risk->save();
        // }

        Risk::where('sensor_id', $this->sensor->id)->update(
            [
                'user_id' => $this->editForm['user_id'],
                'days' => $this->editForm['days'],
                'risk_name' => $this->editForm['risk_name'],
                'risk_quantity' => $this->editForm['risk_quantity'],
                'comment' => $this->editForm['comment'],
            ]
        );

        // $this->sensor->status_alkalinity = 2;
        // $this->sensor->save();

        $this->reset('editForm');
        $this->resetPage();
    }

    public function getUsers()
    {
        // $this->users = User::all();
        $this->users = User::whereHas('roles', function (Builder $query) {
            $query->where('name', '=', 'user');
        })->get();
        // dd($this->users);
    }

    public function render()
    {
        $h1 = "Report Abono";
        $small = "Lista Abono limite Ph inferior a 4.8";
        $alkalinitiesQuery =  Sensor::where('alkalinity', '<=', 4.8);
        $alkalinities = $alkalinitiesQuery->orderBy('id', 'desc')->paginate(20);

        $this->getUsers();

        return view('livewire.admin.from-abono', compact('alkalinities', 'h1', 'small'));
    }
}
