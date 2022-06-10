<x-app-layout>

    @push('style')
        <style>
            @media (min-width: 640px) {
                .sm\:flex {
                    display: flex !important;
                }
            }
        </style>
    @endpush
    @livewire('admin.from-abono')

    @push('script')
        <script>
            function isNumber(evt) {
                // console.log(evt.keyCode);
                var iKeyCode = (evt.which) ? evt.which : evt.keyCode
                if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                    return false;

                return true;
            }
        </script>
        {{-- <script>
            Livewire.on('deletePlan', planId => {

                Swal.fire({
                    title: 'Estas segur@ ?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // alert("hola");
                        // Livewire.emitTo('admin.create-plan', 'delete', planId)

                        Swal.fire(
                            '¡Eliminado!',
                            'Su archivo ha sido eliminado.',
                            'success'
                        )
                    }
                })

            });
        </script> --}}
    @endpush

</x-app-layout>
