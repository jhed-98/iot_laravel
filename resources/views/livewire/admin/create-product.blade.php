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
                        <h3 class="px-4 box-title">Crear Producción</h3>

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
                                                    <label for="input_quantity">Cantidad de producto</label>
                                                    <input wire:model.defer="createForm.quantity" type="text"
                                                        class="form-control" id="input_quantity"
                                                        onkeypress='javascript: return isNumber (event)'>
                                                    <x-jet-input-error for="createForm.quantity" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="input_price">Precio</label>
                                                    <input wire:model.defer="createForm.price" type="text"
                                                        class="form-control" id="input_price"
                                                        onkeypress='javascript: return isNumber (event)'>
                                                    <x-jet-input-error for="createForm.price" />
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2">
                                                <div class="px-2 py-2 flex flex-col">
                                                    <div wire:ignore>
                                                        <label for="input_encargado">Encargado</label>
                                                        <select class="w-full form-control select2"
                                                            wire:model="createForm.user_id">
                                                            <option value="" selected>Seleccione un encargado</option>
                                                            @foreach ($users as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </option>
                                                                {{-- <option value="{{ $item->id_users }}">
                                                                    {{ $item->name_users }}
                                                                </option> --}}
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <x-jet-input-error for="createForm.user_id" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="input_encargado">Tipo palta</label>
                                                    <select class="w-full form-control"
                                                        wire:model="createForm.type_palta">
                                                        <option value="" selected>Seleccione tipo de palta</option>

                                                        <option value="1"> Duro </option>
                                                        <option value="2"> Hass </option>

                                                    </select>
                                                    <x-jet-input-error for="createForm.type_palta" />
                                                </div>

                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3">
                                                <div class="px-2 py-2">
                                                    <label for="img_primary">{{ __('Imagen Primary') }}
                                                        (370 x 370)</label>
                                                    @if ($createForm['img_primary'] != null)
                                                        <div class="flex justify-center">
                                                            <img class="w-auto h-40 object-cover object-center"
                                                                src="{{ $createForm['img_primary']->temporaryUrl() }}"
                                                                alt="">
                                                        </div>
                                                    @elseif($createForm['img_primary'] == null)
                                                    @else
                                                    @endif
                                                    <input id="img_primary" wire:model="createForm.img_primary"
                                                        accept="image/*" type="file"
                                                        class="form-control block mt-1 w-full" name="img_primary">
                                                    <x-jet-input-error for="createForm.img_primary" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="img_secundary">{{ __('Imagen Secundary') }}
                                                        (370 x 370)</label>
                                                    @if ($createForm['img_secundary'] != null)
                                                        <div class="flex justify-center">
                                                            <img class="w-auto h-40 object-cover object-center"
                                                                src="{{ $createForm['img_secundary']->temporaryUrl() }}"
                                                                alt="">
                                                        </div>
                                                    @elseif($createForm['img_secundary'] == null)
                                                    @else
                                                    @endif
                                                    <input id="img_secundary" wire:model="createForm.img_secundary"
                                                        accept="image/*" type="file"
                                                        class="form-control block mt-1 w-full" name="img_secundary">
                                                    <x-jet-input-error for="createForm.img_secundary" />
                                                </div>

                                                <div class="px-2 py-2">
                                                    <label for="img_tertiary">{{ __('Imagen Tertiary') }}
                                                        (370 x 370)</label>
                                                    @if ($createForm['img_tertiary'] != null)
                                                        <div class="flex justify-center">
                                                            <img class="w-auto h-40 object-cover object-center"
                                                                src="{{ $createForm['img_tertiary']->temporaryUrl() }}"
                                                                alt="">
                                                        </div>
                                                    @elseif($createForm['img_tertiary'] == null)
                                                    @else
                                                    @endif
                                                    <input id="img_tertiary" wire:model="createForm.img_tertiary"
                                                        accept="image/*" type="file"
                                                        class="form-control block mt-1 w-full" name="img_tertiary">
                                                    <x-jet-input-error for="createForm.img_tertiary" />
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
                    <h3 class="px-4 box-title">Responsive Table Producción</h3>


                    {{-- <x-jet-input wire:model="search" type="text" class="w-full mx-3 my-3"
                        placeholder="Escriba el nombre del Producción para filtrar" /> --}}

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding hidden" :class="{ 'hidden': status_type != 2 }">
                    @if ($products->count())
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Img</th>
                                <th>
                                    <div class="flex flex-col">
                                        <div>Cant. Prod.</div>
                                        <div>Precio</div>
                                    </div>
                                </th>
                                <th>Tipo de palta</th>
                                <th>Options</th>
                            </tr>
                            @foreach ($products as $item)
                                <tr>

                                    <td>{{ $item->id }}</td>

                                    <td class="px-2 py-4">
                                        {{-- <td class="px-6 py-4 whitespace-nowrap"> --}}
                                        <div class="flex items-center">
                                            @if ($item->img_primary)
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Storage::url($item->img_primary) }}" alt="">
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="https://images.pexels.com/photos/4883800/pexels-photo-4883800.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                    alt="">
                                            @endif

                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex flex-col">
                                            <div> {{ number_format($item->quantity, 2) }} /u</div>
                                            <div> S/{{ number_format($item->price, 2) }}</div>
                                        </div>
                                    </td>

                                    @switch($item->type_palta)
                                        @case(1)
                                            <td><span class="label label-success" style="font-size: 14px">Palta Dura</span></td>
                                        @break

                                        @case(2)
                                            <td><span class="label label-success" style="font-size: 14px">Palta Hass</span></td>
                                        @break

                                        @default
                                    @endswitch


                                    <td>

                                        <div class="col-md-3 col-sm-4 flex">
                                            <button
                                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-red-200 active:bg-blue-600 disabled:opacity-25 transition"
                                                wire:click="edit('{{ $item->id }}')">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </button>
                                            <x-danger-button
                                                wire:click="$emit('deleteProduct', '{{ $item->id }}')">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </x-danger-button>

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
                    @if ($products->hasPages())
                        <div class="px-6 py-4">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </x-table-responsive-up>


        </div>


        <x-dialog-modal-small wire:model="editForm.open">

            <x-slot name="title">
                Editar Dato de Producto
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
                                                <label for="input_quantity">Cantidad de producto</label>
                                                <input wire:model.defer="editForm.quantity" type="text"
                                                    class="form-control" id="input_quantity"
                                                    onkeypress='javascript: return isNumber (event)'>
                                                <x-jet-input-error for="editForm.quantity" />
                                            </div>

                                            <div class="px-2 py-2">
                                                <label for="input_price">Precio</label>
                                                <input wire:model.defer="editForm.price" type="text"
                                                    class="form-control" id="input_price"
                                                    onkeypress='javascript: return isNumber (event)'>
                                                <x-jet-input-error for="editForm.price" />
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <div class="px-2 py-2 flex flex-col">
                                                <div wire:ignore>
                                                    <label for="input_encargado">Encargado</label>
                                                    {{-- <select class="w-full form-control select2edit" --}}
                                                    <select class="w-full form-control" wire:model="editForm.user_id">
                                                        <option value="" selected>Seleccione un encargado</option>
                                                        @foreach ($users as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                            {{-- <option value="{{ $item->id_users }}">
                                                                {{ $item->name_users }}
                                                            </option> --}}
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <x-jet-input-error for="editForm.user_id" />
                                            </div>

                                            <div class="px-2 py-2">
                                                <label for="input_encargado">Tipo palta</label>
                                                <select class="w-full form-control" wire:model="editForm.type_palta">
                                                    <option value="" selected>Seleccione tipo de palta</option>

                                                    <option value="1"> Duro </option>
                                                    <option value="2"> Hass </option>

                                                </select>
                                                <x-jet-input-error for="editForm.type_palta" />
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3">

                                            {{-- Imagen Primary --}}

                                            <div class="px-2 py-2">
                                                <label for="img_primary">{{ __('Imagen Primary') }}
                                                    (370 x 370)</label>


                                                @if ($edit_img_primary)
                                                    <div class="flex justify-center">
                                                        <img class="w-auto h-40 object-cover object-center"
                                                            src="{{ $edit_img_primary->temporaryUrl() }}" alt="">
                                                    </div>
                                                @else
                                                    @if ($editForm['img_primary'])
                                                        <div class="flex justify-center">
                                                            <a href="{{ Storage::url($editForm['img_primary']) }}"
                                                                target="_blank">
                                                                <img class="w-auto h-40 object-cover object-center"
                                                                    src="{{ Storage::url($editForm['img_primary']) }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    @endif

                                                @endif

                                                <input wire:model="edit_img_primary" accept="image/*" type="file"
                                                    class="form-control block mt-1 w-full" name="img_tertiary"
                                                    id="{{ $rand_img_primary }}">
                                                <x-jet-input-error for="edit_img_primary" />
                                            </div>

                                            {{-- Imagen Secundary --}}

                                            <div class="px-2 py-2">
                                                <label for="img_secundary">{{ __('Imagen Secundary') }}
                                                    (370 x 370)</label>


                                                @if ($edit_img_secundary)
                                                    <div class="flex justify-center">
                                                        <img class="w-auto h-40 object-cover object-center"
                                                            src="{{ $edit_img_secundary->temporaryUrl() }}" alt="">
                                                    </div>
                                                @else
                                                    @if ($editForm['img_secundary'])
                                                        <div class="flex justify-center">
                                                            <a href="{{ Storage::url($editForm['img_secundary']) }}"
                                                                target="_blank">
                                                                <img class="w-auto h-40 object-cover object-center"
                                                                    src="{{ Storage::url($editForm['img_secundary']) }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    @endif

                                                @endif


                                                <input wire:model="edit_img_secundary" accept="image/*" type="file"
                                                    class="form-control block mt-1 w-full" name="img_secundary"
                                                    id="{{ $rand_img_secundary }}">
                                                <x-jet-input-error for="edit_img_secundary" />
                                            </div>

                                            {{-- Imagen Tertiary --}}

                                            <div class="px-2 py-2">
                                                <label for="img_tertiary">{{ __('Imagen Tertiary') }}
                                                    (370 x 370)</label>


                                                @if ($edit_img_tertiary)
                                                    <div class="flex justify-center">
                                                        <img class="w-auto h-40 object-cover object-center"
                                                            src="{{ $edit_img_tertiary->temporaryUrl() }}" alt="">
                                                    </div>
                                                @else
                                                    @if ($editForm['img_tertiary'])
                                                        <div class="flex justify-center">
                                                            <a href="{{ Storage::url($editForm['img_tertiary']) }}"
                                                                target="_blank">
                                                                <img class="w-auto h-40 object-cover object-center"
                                                                    src="{{ Storage::url($editForm['img_tertiary']) }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                    @endif

                                                @endif
                                                <input wire:model="edit_img_tertiary" accept="image/*" type="file"
                                                    class="form-control block mt-1 w-full" name="img_tertiary"
                                                    id="{{ $rand_img_tertiary }}">
                                                <x-jet-input-error for="edit_img_tertiary" />
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

        @push('script')
            <script>
                document.addEventListener('livewire:load', function() {
                    $(".select2").select2();
                    $(".select2").on('change', function() {
                        @this.set('createForm.user_id', this.value);
                    });
                });
                // Livewire.on('select_edit', () => {
                //     $(".select2edit").select2();
                //     $(".select2edit").on('change', function() {
                //         @this.set('editForm.user_id', this.value);
                //     });
                // });
            </script>
        @endpush
    </div>
    <!-- ./wrapper -->
