<form method="POST" action="{{ route('user.store') }}">
    @method('POST')
    @csrf

    <x-form-input-group :inputId="'first_name'" :inputText="'First Name:'" :placeholder="'John'"></x-form-input-group>

    <x-form-input-group :inputId="'surname'" :inputText="'Surname:'" :placeholder="'Doe'"></x-form-input-group>

    <x-form-input-group :inputId="'initials'" :inputText="'Initials'" :placeholder="'J.D.'"></x-form-input-group>

    <x-form-input-group :type="'password'" :inputId="'password'" :inputText="'Password:'"></x-form-input-group>
    <x-form-input-group :type="'password'" :inputId="'confirm_password'" :inputText="'Confirm Password:'"></x-form-input-group>

    <x-form-input-group :type="'email'" :inputId="'email'" :inputText="'Email:'"></x-form-input-group>

    <x-form-input-group :inputId="'postal_code'" :inputText="'Postal Code:'"></x-form-input-group>

    <x-form-input-group :type="'number'" :inputId="'house_number'" :inputText="'House Number:'"></x-form-input-group>

    <x-form-input-group :type="'number'" :inputId="'phone_number'" :inputText="'Phone Number:'"></x-form-input-group>

    <button type="submit" class="btn btn-outline-success btn-lg">Sign Up</button>
</form>
