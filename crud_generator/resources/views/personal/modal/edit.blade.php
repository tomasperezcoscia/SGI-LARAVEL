<div class="modal fade text-left" id="ModalEdit{{ $personal->id }}" tabindex="-1">
    <form method="POST" action="{{ route('Personal.update', $personal->id) }}" role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal header, body, and footer -->
                <div class="modal-header">
                    <!-- Header content -->
                </div>
                <div class="modal-body">
                    <!-- Include the form fields here -->
                    @include('personal.form')
                </div>
                <div class="modal-footer">
                    <!-- Footer content -->
                </div>
            </div>
        </div>
    </form>
</div>
