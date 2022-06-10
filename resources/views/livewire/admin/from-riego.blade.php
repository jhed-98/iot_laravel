<?php
use Illuminate\Support\Facades\DB;
use App\Models\Fertilizer;
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

            <!-- /.row -->
            <x-table-responsive-up>
                <div class="box-header px-4">
                    <input x-model="status_type" type="radio" value="2" name="status_type" class="text-gray-600">
                    <h3 class="px-4 box-title">Responsive Table Riego</h3>


                    {{-- <x-jet-input wire:model="search" type="text" class="w-full mx-3 my-3"
                        placeholder="Escriba el nombre del Producción para filtrar" /> --}}

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding  ">
                    @if ($humidities->count())
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Nivel humidity</th>
                                <th>Fecha </th>
                                <th>Options</th>
                            </tr>
                            @foreach ($humidities as $item)
                                <tr>

                                    <td>{{ $item->id }}</td>

                                    <td> {{ $item->humidity }} </td>
                                    <td>
                                        @if (Fertilizer::where('sensor_id', $item->id)->first())
                                            <div class="flex flex-col">
                                                <div class="flex justify-start items-center">
                                                    <x-jet-label value="Registrado:" />
                                                    <span
                                                        class="px-2">{{ date('d/m/Y g:i a', strtotime(Fertilizer::where('sensor_id', $item->id)->value('created_at'))) }}
                                                    </span>
                                                </div>
                                                <div class="flex justify-start items-center">
                                                    <x-jet-label value="Actualizado:" />
                                                    <span class="px-2">
                                                        {{ date('d/m/Y g:i a', strtotime(Fertilizer::where('sensor_id', $item->id)->value('updated_at'))) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                    <td>

                                        @switch($item->status_humidity)
                                            @case(0)
                                                <button
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-red-200 active:bg-blue-600 disabled:opacity-25 transition"
                                                    wire:click="create('{{ $item->id }}')">
                                                    <i class="fa fa-fw fa-edit"></i> Registro Riego
                                                </button>
                                            @break

                                            @case(1)
                                                <button
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-red-200 active:bg-blue-600 disabled:opacity-25 transition"
                                                    wire:click="edit('{{ $item->id }}')">
                                                    <i class="fa fa-fw fa-edit"></i> Actualizar Riego
                                                </button>
                                            @break

                                            @case(2)
                                                <button
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-red-200 active:bg-blue-600 disabled:opacity-25 transition"
                                                    wire:click="edit('{{ $item->id }}')">
                                                    <i class="fa fa-fw fa-edit"></i> Ver Report
                                                </button>
                                            @break

                                            @default
                                        @endswitch



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
                    @if ($humidities->hasPages())
                        <div class="px-6 py-4">
                            {{ $humidities->links() }}
                        </div>
                    @endif
                </div>
            </x-table-responsive-up>


        </div>


        <x-dialog-modal-small wire:model="createForm.open">

            <x-slot name="title">
                Formulario de riego
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
                                            <div class="px-2 py-2 ">
                                                <div>
                                                    <label for="input_encargado">Encargado</label>
                                                    {{-- <select class="w-full form-control select2edit" --}}
                                                    <select class="w-full form-control" wire:model="createForm.user_id">
                                                        <option value="" selected>Seleccione un encargado</option>
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <x-jet-input-error for="createForm.user_id" />
                                            </div>

                                            <div class="px-2 py-2">
                                                <label for="days">Cantidad de dias</label>
                                                <input wire:model.defer="createForm.days" type="text"
                                                    class="form-control" id="days"
                                                    onkeypress='javascript: return isNumber (event)'>
                                                <x-jet-input-error for="createForm.days" />
                                            </div>
                                        </div>


                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <div class="px-2 py-2">
                                                <label for="comment">Comentario</label>
                                                <input wire:model.defer="createForm.comment" type="text"
                                                    class="form-control" id="comment">
                                                <x-jet-input-error for="createForm.comment" />
                                            </div>


                                            <div class="px-2">
                                                <label for="image">{{ __('Imagen Contenido') }}
                                                    (370 x 370)</label>
                                                @if ($createForm['image'] != null)
                                                    <div class="flex justify-center">
                                                        <img class="w-auto h-40 object-cover object-center"
                                                            src="{{ $createForm['image']->temporaryUrl() }}" alt="">
                                                    </div>
                                                @endif
                                                <input id="image" wire:model="createForm.image" accept="image/*"
                                                    type="file" class="form-control block mt-1 w-full" name="image">
                                                <x-jet-input-error for="createForm.image" />
                                            </div>

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

                    <x-jet-button wire:loading.attr="disabled"
                        wire:target="edit_img_primary,edit_img_secundary,edit_img_tertiary,update" wire:click="save"
                        class="btn btn-block btn-success">
                        <i class="fa fa-fw fa-save"></i> Guardar
                    </x-jet-button>

                </div>
            </x-slot>

        </x-dialog-modal-small>


        <x-dialog-modal-small wire:model="editForm.open">

            <x-slot name="title">
                Editar Dato de Abono
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

                                    <!-- form start -->
                                    <div class="box-body">

                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <div class="px-2 py-2 ">
                                                <div>
                                                    <label for="input_encargado">Encargado</label>
                                                    {{-- <select class="w-full form-control select2edit" --}}
                                                    <select class="w-full form-control" wire:model="editForm.user_id">
                                                        <option value="" disabled selected>Seleccione un encargado
                                                        </option>
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <x-jet-input-error for="editForm.user_id" />
                                            </div>

                                            <div class="px-2 py-2">
                                                <label for="days">Cantidad de dias</label>
                                                <input wire:model.defer="editForm.days" type="text"
                                                    class="form-control" id="days"
                                                    onkeypress='javascript: return isNumber (event)'>
                                                <x-jet-input-error for="editForm.days" />
                                            </div>
                                        </div>


                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <div class="px-2 py-2">
                                                <label for="comment">Comentario</label>
                                                <input wire:model.defer="editForm.comment" type="text"
                                                    class="form-control" id="comment">
                                                <x-jet-input-error for="editForm.comment" />
                                            </div>


                                            <div class="px-2">
                                                <label for="avatar">{{ __('Imagen Contenido') }}
                                                    (370 x 370)</label>
                                                @if ($editImage)
                                                    <div class="flex justify-center">
                                                        <img class="w-auto h-40 object-cover object-center"
                                                            src="{{ $editImage->temporaryUrl() }}" alt="">
                                                    </div>
                                                @else
                                                    <div class="flex justify-center">
                                                        <a href="{{ Storage::url($editForm['image']) }}"
                                                            target="_blank">
                                                            <img class="w-auto h-40 object-cover object-center"
                                                                src="{{ Storage::url($editForm['image']) }}" alt="">
                                                        </a>
                                                    </div>
                                                @endif

                                                <input id="image" wire:model="editImage" accept="image/*" type="file"
                                                    class="form-control block mt-1 w-full" name="image">

                                                <x-jet-input-error for="editImage" />
                                            </div>

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

                    <x-jet-button wire:loading.attr="disabled"
                        wire:target="edit_img_primary,edit_img_secundary,edit_img_tertiary,update" wire:click="update"
                        class="btn btn-block btn-success">
                        <i class="fa fa-fw fa-save"></i> Actualizar
                    </x-jet-button>

                </div>
            </x-slot>

        </x-dialog-modal-small>


    </div>
    <!-- ./wrapper -->
