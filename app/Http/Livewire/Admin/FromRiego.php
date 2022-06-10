<?php

namespace App\Http\Livewire\Admin;

use App\Models\Fertilizer;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FromRiego extends Component
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
        'comment' => null,
        'image' => null,
    ];

    public $editForm = [
        'open' => false,
        'user_id' => null,
        'days' => null,
        'comment' => null,
        'image' => null,
    ];

    protected $rules = [
        // 'createForm.slug' => 'required|unique:user,slug',
        'createForm.user_id' => 'required',
        'createForm.days' => 'required',
        'createForm.comment' => 'required',
        'createForm.image' => 'image|max:2048',

    ];

    protected $validationAttributes = [
        'createForm.user_id' => 'Usuario',
        'createForm.days' => 'Cantidad de dia',
        'createForm.comment' => 'Comentario',
        'createForm.image' => 'Image',

        'editForm.user_id' => 'Usuario',
        'editForm.days' => 'Cantidad de dia',
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
            $imageName = 'fertilizers_' . time() . '.' . $this->createForm['image']->extension();
            $uploadedFileUrl = $this->createForm['image']->storeAs('storage/fertilizers', $imageName, 'public_uploads');
            $uploadedFileUrl = 'fertilizers/' . $imageName;
        }


        $risk = new Fertilizer();
        $risk->user_id = $this->createForm['user_id'];
        $risk->sensor_id = $this->sensor->id;
        $risk->days = $this->createForm['days'];
        $risk->comment = $this->createForm['comment'];
        $risk->image = $uploadedFileUrl;

        $risk->save();

        $this->sensor->status_humidity = 1;
        $this->sensor->save();

        $this->reset('createForm');
    }


    public function edit(Sensor $sensor)
    {
        $this->resetValidation();

        $this->sensor = $sensor;
        $sensor_id = $sensor->id;

        $this->editForm['open'] = true;
        $this->editForm['user_id'] = Fertilizer::where('sensor_id', $sensor_id)->value('user_id');
        $this->editForm['days'] = Fertilizer::where('sensor_id', $sensor_id)->value('days');
        $this->editForm['comment'] = Fertilizer::where('sensor_id', $sensor_id)->value('comment');
        $this->editForm['image'] = Fertilizer::where('sensor_id', $sensor_id)->value('image');
    }

    public function update()
    {

        $rules = [
            'editForm.user_id' => 'required',
            'editForm.days' => 'required',
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
            $imageName = 'fertilizers_' . time() . '.' . $this->editImage->extension();
            $uploadedFileUrl = $this->editImage->storeAs('storage/fertilizers', $imageName, 'public_uploads');
            $uploadedFileUrl = 'fertilizers/' . $imageName;

            Fertilizer::where('sensor_id', $this->sensor->id)->update(
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

        Fertilizer::where('sensor_id', $this->sensor->id)->update(
            [
                'user_id' => $this->editForm['user_id'],
                'days' => $this->editForm['days'],
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
        $h1 = "Report Riego";
        $small = "Lista Riego, limite de nivel de humedad inferior a 40%";
        $humiditiesQuery =  Sensor::where('humidity', '<=', 40);
        $humidities = $humiditiesQuery->orderBy('id', 'desc')->paginate(20);

        $this->getUsers();

        return view('livewire.admin.from-riego', compact('humidities', 'h1', 'small'));
    }
}
