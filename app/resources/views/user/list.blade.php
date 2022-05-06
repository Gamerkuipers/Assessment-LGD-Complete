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
                            data-bs-target="#userModal"
                            data-bs-locationData="{{ $user->spikkl_data }}"
                            data-bs-googleMapsKey="{{ config('app.google_maps_key') }}"
                            data-bs-user="{{ $user }}"
                        >
                            Location
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="modal fade text-dark" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="userModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // code from bootstrap but edited
        let userModal = document.getElementById('userModal')
        userModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let buttonEl = event.relatedTarget

            // Extract info from data-bs-* attributes
            let user = JSON.parse(buttonEl.getAttribute('data-bs-user'))
            let locationData = JSON.parse(buttonEl.getAttribute('data-bs-locationData'))
            let googleMapsKey = buttonEl.getAttribute('data-bs-googleMapsKey')

            let modalBodyEl = document.getElementById('userModalBody')
            let modalTitleEl = document.getElementById('userModalLabel')

            modalBodyEl.innerHTML = ''

            modalTitleEl.textContent = `Location of ${user.first_name} ${user.surname}`

            let infoEl = createElement();

            let countryEl = createElement('div',{},`<strong>Country</strong>: ${locationData.country}`)
            let cityEl = createElement('div',{},`<strong>City</strong>: ${locationData.city}`)
            let streetNameEl = createElement('div',{},`<strong>Street</strong>: ${locationData.street_name} ${user.house_number}`)
            let postalCodeEl = createElement('div',{},`<strong>Postal Code</strong>: ${user.postal_code}`)

            infoEl.appendChild(countryEl)
            infoEl.appendChild(cityEl)
            infoEl.appendChild(streetNameEl)
            infoEl.appendChild(postalCodeEl)

            /**
             * google maps elements
             */

            console.log(googleMapsKey)

            let coordinates = locationData.coordinates;
            coordinates = coordinates.replace('[','')
            coordinates = coordinates.replace(']','')
            let mapsEl = createElement(
                'iframe',
                {
                    'width': '200',
                    'height': '200',
                    'style': 'border:0',
                    'loading': 'lazy',
                    'allowfullscreen': '',
                    'class': 'mt-2',
                    'referrerpolicy': 'no-referrer-when-downgrade',
                    'src': `https://www.google.com/maps/embed/v1/place?key=${googleMapsKey}&q=${coordinates}`
                }
            )

            let mapDivEl = createElement('div',{'class':'d-flex flex-column'},'<strong>Maps Location</strong>')

            mapDivEl.appendChild(mapsEl)

            modalBodyEl.appendChild(infoEl)
            modalBodyEl.appendChild(mapDivEl)

        })

        function createElement(element = 'div', attributes = {}, text = '') {
            let el = document.createElement(element);

            if(typeof attributes === 'object') {
                for (let key in attributes) {
                    el.setAttribute(key, attributes[key]);
                }
            }

            if (typeof text != "undefined") {
                el.innerHTML = text;
            }
            return el;
        }
    </script>
@endsection
