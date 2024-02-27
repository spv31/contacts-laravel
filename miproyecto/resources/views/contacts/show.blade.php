@extends('layouts.app')

@vite(['resources/css/app.css'])

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Contact Information</div>

          <div class="card-body">
            <div class="mb-4">
              <a href="{{ route('contacts.show', $contacts->id) }}">
                <img src="{{ Storage::url($contacts->profile_picture) }}" class="profile_picture"
                  style="border-radius:25%; height: 4.5rem">
              </a>
            </div>
            <p>Name: {{ $contacts->name }}</p>
            <p>Email: <a href="mailto:{{ $contacts->email }}">
                {{ $contacts->email }}</a>
            </p>
            <p>Age: {{ $contacts->age }}</p>
            <p>Phone Number: <a href="tel:{{ $contacts->phone_number }}">
                {{ $contacts->phone_number }}</a>
            </p>
            <p>Created at: {{ $contacts->created_at }}</p>
            <p>Last updated at: {{ $contacts->updated_at }}</p>
            <div class="d-flex justify-content-center">
              <a href="{{ route('contacts.edit', $contacts->id) }}" class="btn btn-primary mb-3 me-2">Edit Contact</a>
              <form action="{{ route('contacts.destroy', $contacts->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Contact </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
