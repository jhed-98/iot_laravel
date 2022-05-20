 <?php
 use Illuminate\Support\Facades\DB;
 ?>
 <div>

     <section class="content-header">
         <h1>
             {{ $h1 }}
             <small>{{ $small }}</small>
         </h1>
         <ol class="breadcrumb">
             <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
             <li class="active">{{ $h1 }}</li>
         </ol>
     </section>

     <!-- Main content -->
     <div class="content">

         <div x-data="{ status_type: @entangle('status_type') }">
             <!-- Create item content -->
             <div class="bg-white shadow-xl rounded-lg p-6 mb-4">
                 <div class="box box-default ">
                     {{-- <div class="box box-default collapsed-box"> --}}
                     <div class="box-header with-border">
                         <input x-model="status_type" type="radio" value="1" name="status_type" class="text-gray-600">
                         <h3 class="px-4 box-title">Crear Personal</h3>

                         {{-- <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div> --}}
                         <!-- /.box-tools -->
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body hidden " :class="{ 'hidden': status_type != 1 }">

                         <!-- create item -->

                         <section class=" ">
                             <div class=" ">
                                 <!-- left column -->
                                 <div class=" ">
                                     <!-- general form elements -->
                                     <div class="box box-primary">

                                         <!-- form start -->
                                         <div class="box-body">

                                             <div class="grid grid-cols-1 md:grid-cols-2">
                                                 <div class="px-2 py-2">
                                                     <label for="input_name">Nombre y Apellido</label>
                                                     <input wire:model.defer="createForm.name" type="text"
                                                         class="form-control" id="input_name">
                                                     <x-jet-input-error for="createForm.name" />
                                                 </div>

                                                 <div class="px-2 py-2">
                                                     <label for="input_email">Correo Electronico</label>
                                                     <input wire:model.defer="createForm.email" type="text"
                                                         class="form-control" id="input_email">
                                                     <x-jet-input-error for="createForm.email" />
                                                 </div>
                                             </div>

                                             <div class="grid grid-cols-1 md:grid-cols-2">
                                                 <div class="px-2 py-2">
                                                     <label for="input_num_doc">Num. Documento</label>
                                                     <input wire:model.defer="createForm.num_doc" type="text"
                                                         class="form-control" id="input_num_doc"
                                                         onkeypress='javascript: return isNumber (event)'>
                                                     <x-jet-input-error for="createForm.num_doc" />
                                                 </div>

                                                 <div class="px-2 py-2">
                                                     <label for="input_phone">Telefono</label>
                                                     <input wire:model.defer="createForm.phone" type="text"
                                                         class="form-control" id="input_phone"
                                                         onkeypress='javascript: return isNumber (event)'>
                                                     <x-jet-input-error for="createForm.phone" />
                                                 </div>
                                             </div>

                                             <div class="grid grid-cols-1 md:grid-cols-2">
                                                 <div class="px-2 py-2">
                                                     <label for="input_gender">Sexo</label>
                                                     <!-- radio -->
                                                     <div class="form-group" id="input_gender">
                                                         <label>
                                                             <input type="radio" value="1" name="gender"
                                                                 class="minimal"
                                                                 wire:model.defer="createForm.gender">
                                                             Hombre
                                                         </label>
                                                         <label style="margin-left:10px">
                                                             <input type="radio" value="2" name="gender"
                                                                 class="minimal"
                                                                 wire:model.defer="createForm.gender">
                                                             Mujer
                                                         </label>
                                                     </div>
                                                     <x-jet-input-error for="createForm.gender" />
                                                 </div>

                                                 <div class="px-2 py-2">
                                                     <label for="input_rol">Rol</label>
                                                     <!-- radio -->
                                                     <div class="form-group" id="input_rol">
                                                         <label>
                                                             <input type="radio" value="1" name="rol"
                                                                 class="minimal"
                                                                 wire:model.defer="createForm.rol">
                                                             Admin
                                                         </label>
                                                         <label style="margin-left:10px">
                                                             <input type="radio" value="2" name="rol"
                                                                 class="minimal"
                                                                 wire:model.defer="createForm.rol">
                                                             Empleado
                                                         </label>
                                                         <label style="margin-left:10px">
                                                             <input type="radio" value="3" name="rol"
                                                                 class="minimal"
                                                                 wire:model.defer="createForm.rol">
                                                             Ninguno
                                                         </label>
                                                     </div>
                                                     <x-jet-input-error for="createForm.rol" />
                                                 </div>

                                             </div>

                                         </div>
                                     </div>
                                     <!-- /.box-body -->

                                     <div class="box-footer">

                                         <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save"
                                             class="btn btn-block btn-success">
                                             <i class="fa fa-fw fa-save"></i> Guardar
                                         </x-jet-button>

                                     </div>
                                 </div>
                                 <!-- /.box -->

                             </div>
                             <!--/.col (left) -->
                             <!-- /.row -->
                         </section>

                     </div>
                     <!-- /.box-body -->
                 </div>

             </div>

             <!-- /.row -->
             <x-table-responsive-up>
                 <div class="box-header px-4">
                     <input x-model="status_type" type="radio" value="2" name="status_type" class="text-gray-600">
                     <h3 class="px-4 box-title">Responsive Table Personal</h3>


                     <x-jet-input wire:model="search" type="text" class="w-full mx-3 my-3"
                         placeholder="Escriba el nombre del personal para filtrar" />

                 </div>
                 <!-- /.box-header -->
                 <div class="box-body table-responsive no-padding hidden" :class="{ 'hidden': status_type != 2 }">
                     @if ($users->count())
                         <table class="table table-hover">
                             <tr>
                                 <th>ID</th>
                                 <th>Nombre Y Apellido</th>
                                 <th>Num. Doc.</th>
                                 <th>Correo</th>
                                 <th>Telefono</th>
                                 <th>Gender</th>
                                 <th>Rol</th>
                                 <th>Edit Rol</th>
                                 <th>Options</th>
                             </tr>
                             @foreach ($users as $item)
                                 <tr>
                                     <td>{{ $item->id }}</td>
                                     <td> {{ $item->name }} </td>
                                     <td> {{ $item->num_doc }} </td>
                                     <td> {{ $item->email }} </td>
                                     <td> {{ $item->phone }} </td>

                                     @switch($item->gender)
                                         @case(1)
                                             <td><span class="label label-danger">Hombre</span></td>
                                         @break

                                         @case(2)
                                             <td><span class="label label-success">Mujer</span></td>
                                         @break

                                         @default
                                     @endswitch


                                     @if (count($item->roles))
                                         @switch($item->roles[0]->pivot->role_id)
                                             @case(1)
                                                 <td><span class="label label-danger">Admin</span></td>
                                             @break

                                             @case(2)
                                                 <td><span class="label label-success">Empleado</span></td>
                                             @break

                                             @case(3)
                                                 <td><span class="label label-info">No tiene rol </span></td>
                                             @break

                                             @default
                                         @endswitch
                                     @else
                                         <td><span class="label label-info">No tiene rol </span></td>
                                     @endif

                                     <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                         <label>
                                             <input
                                                 {{ count($item->roles) && $item->roles[0]->pivot->role_id == '1' ? 'checked' : '' }}
                                                 value="1" type="radio" name="{{ $item->email }}"
                                                 wire:change="assignRole({{ $item->id }}, $event.target.value)">
                                             Admin
                                         </label>

                                         <label class="ml-2">
                                             <input
                                                 {{ count($item->roles) && $item->roles[0]->pivot->role_id == '2' ? 'checked' : '' }}
                                                 value="2" type="radio" name="{{ $item->email }}"
                                                 wire:change="assignRole({{ $item->id }}, $event.target.value)">
                                             Empleado
                                         </label>

                                         <label class="ml-2">
                                             <input
                                                 {{ count($item->roles) && $item->roles[0]->pivot->role_id == '3' ? 'checked' : '' }}
                                                 value="3" type="radio" name="{{ $item->email }}"
                                                 wire:change="assignRole({{ $item->id }}, $event.target.value)">
                                             Ningun Rol
                                         </label>

                                         {{-- <label class="ml-2">
                                            <input {{ count($item->roles) ? '' : 'checked' }} value="3" type="radio"
                                                name="{{ $item->email }}"
                                                wire:change="assignRole({{ $item->id }}, $event.target.value)">
                                            Ningun Rol
                                        </label> --}}
                                         {{-- @else
                                             <label>
                                                 <input value="1" type="radio" name="{{ $item->email }}"
                                                     wire:change="assignRole({{ $item->id }}, $event.target.value)">
                                                 Admin
                                             </label>

                                             <label class="ml-2">
                                                 <input value="2" type="radio" name="{{ $item->email }}"
                                                     wire:change="assignRole({{ $item->id }}, $event.target.value)">
                                                 Empleado
                                             </label>
                                         @endif --}}

                                     </td>
                                     <td>

                                         <div class="col-md-3 col-sm-4 flex">
                                             <a class="btn btn-default" wire:click="edit('{{ $item->id }}')">
                                                 <i class="fa fa-fw fa-edit"></i>
                                             </a>
                                             {{-- <x-danger-button wire:click="$emit('deleteitem', '{{ $item->id }}')">
                                                 <i class="fa fa-fw fa-trash"></i>
                                             </x-danger-button> --}}

                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         </table>
                     @else
                         <div class="alert alert-warning alert-dismissible">
                             {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
                             <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                             No hay ningún registro coincidente
                         </div>
                     @endif

                 </div>
                 <div class="box-footer clearfix">
                     @if ($users->hasPages())
                         <div class="px-6 py-4">
                             {{ $users->links() }}
                         </div>
                     @endif
                 </div>
             </x-table-responsive-up>


         </div>


         <x-dialog-modal wire:model="editForm.open">

             <x-slot name="title">
                 Editar Dato Personal
             </x-slot>

             <x-slot name="content">

                 <div class="space-y-3">


                     <section class=" ">
                         <div class=" ">
                             <!-- left column -->
                             <div class="w-full">
                                 <!-- general form elements -->
                                 <div class="box box-primary">

                                     <!-- form start -->
                                     <div class="box-body">

                                         <div class="grid grid-cols-1 md:grid-cols-2">
                                             <div class="px-2 py-2">
                                                 <label for="input_name">Nombre y Apellido</label>
                                                 <input wire:model.defer="editForm.name" type="text"
                                                     class="form-control" id="input_name">
                                                 <x-jet-input-error for="editForm.name" />
                                             </div>

                                             <div class="px-2 py-2">
                                                 <label for="input_email">Correo Electronico</label>
                                                 <input wire:model.defer="editForm.email" type="text"
                                                     class="form-control" id="input_email">
                                                 <x-jet-input-error for="editForm.email" />
                                             </div>
                                         </div>

                                         <div class="grid grid-cols-1 md:grid-cols-2">
                                             <div class="px-2 py-2">
                                                 <label for="input_num_doc">Num. Documento</label>
                                                 <input wire:model.defer="editForm.num_doc" type="text"
                                                     class="form-control" id="input_num_doc"
                                                     onkeypress='javascript: return isNumber (event)'>
                                                 <x-jet-input-error for="editForm.num_doc" />
                                             </div>

                                             <div class="px-2 py-2">
                                                 <label for="input_phone">Telefono</label>
                                                 <input wire:model.defer="editForm.phone" type="text"
                                                     class="form-control" id="input_phone"
                                                     onkeypress='javascript: return isNumber (event)'>
                                                 <x-jet-input-error for="editForm.phone" />
                                             </div>
                                         </div>

                                         <div class="grid grid-cols-1 md:grid-cols-2">
                                             <div class="px-2 py-2">
                                                 <label for="input_gender">Sexo</label>
                                                 <!-- radio -->
                                                 <div class="form-group" id="input_gender">
                                                     <label>
                                                         <input type="radio" value="1" name="gender"
                                                             class="minimal" wire:model.defer="editForm.gender">
                                                         Hombre
                                                     </label>
                                                     <label style="margin-left:10px">
                                                         <input type="radio" value="2" name="gender"
                                                             class="minimal" wire:model.defer="editForm.gender">
                                                         Mujer
                                                     </label>
                                                 </div>
                                                 <x-jet-input-error for="editForm.gender" />
                                             </div>

                                             {{-- <div class="px-2 py-2">
                                                 <label for="input_rol">Rol</label>
                                                 <!-- radio -->
                                                 <div class="form-group" id="input_rol">
                                                     <label>
                                                         <input type="radio" value="1" name="rol" class="minimal"
                                                             wire:model.defer="editForm.rol">
                                                         Admin
                                                     </label>
                                                     <label style="margin-left:10px">
                                                         <input type="radio" value="2" name="rol" class="minimal"
                                                             wire:model.defer="editForm.rol">
                                                         Empleado
                                                     </label>
                                                     <label style="margin-left:10px">
                                                         <input type="radio" value="3" name="rol" class="minimal"
                                                             wire:model.defer="editForm.rol">
                                                         Ninguno
                                                     </label>
                                                 </div>
                                                 <x-jet-input-error for="editForm.rol" />
                                             </div> --}}

                                         </div>

                                     </div>
                                 </div>
                                 <!-- /.box-body -->

                             </div>
                             <!-- /.box -->

                         </div>
                         <!--/.col (left) -->
                         <!-- /.row -->
                     </section>
                 </div>
             </x-slot>

             <x-slot name="footer">
                 {{-- <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
                Actualizar
            </x-jet-danger-button> --}}

                 <div class="box-footer">

                     <x-jet-button wire:loading.attr="disabled" wire:target="update" wire:click="update"
                         class="btn btn-block btn-success">
                         <i class="fa fa-fw fa-save"></i> Actualizar
                     </x-jet-button>

                 </div>
             </x-slot>

         </x-dialog-modal>

     </div>
     <!-- ./wrapper -->
