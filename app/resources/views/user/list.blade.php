@extends('layouts.app')

@section('content')
    <h2 class="flex text-center mt-3">Users</h2>
    <table class="table table-light mt-4">
        <thead>
            <tr>
                <td>
                    first name
                </td>
                <td>
                    surname
                </td>
                <td>
                    initials
                </td>
                <td>
                    Email
                </td>
                <td>
                    phone Number
                </td>
                <td>
                    Location
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="
                        @if($loop->odd)
                            table-secondary
                            @else table-light
                        @endif
                   ">
                    <td>
                        {{ $user->first_name }}
                    </td>
                    <td>
                        {{ $user->surname }}
                    </td>
                    <td>
                        {{ $user->initials }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->phone_number }}
                    </td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            data-bs-whatever="{{ $user->name }}"
                        >
                            Location
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // code from bootstrap but edited
        let userModal = document.getElementById('exampleModal')
        userModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = event.relatedTarget
            // Extract info from data-bs-* attributes
            let user = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            console.log(user)
            // Update the modal's content.
            let modalTitle = userModal.querySelector('.modal-title')
            let modalBodyInput = userModal.querySelector('.modal-body input')

            modalTitle.textContent = 'New message to ' + user
            modalBodyInput.value = userModal
        })
    </script>
@endsection
