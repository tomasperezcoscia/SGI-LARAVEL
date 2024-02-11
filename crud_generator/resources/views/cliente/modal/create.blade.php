<div class="modal fade text-left" id="ModalCreate" tabindex="-1">
    <form method="POST" action="{{ route('Cliente.store') }}" role="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal header, body, and footer -->
                <div class="modal-header">
                    <!-- Header content -->
                </div>
                <div class="modal-body">
                    <!-- Include the form fields here -->
                    @include('cliente.form')
                </div>
                <div class="modal-footer">
                    <!-- Footer content -->
                </div>
            </div>
        </div>
    </form>
</div>