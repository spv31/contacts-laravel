@extends('layouts.app')

@vite(['resources/css/app.css'])

@section('content')
  <div class="container pt-4 p-3">
    <div class="row">

      @if ($contacts->count() == 0)
        <div class="col-md-4 mx-auto">
          <div class="card card-body text-center">
            <p>No contacts saved yet</p>
            <a href="{{ route('contacts.create') }}">Add One!</a>
          </div>
        </div>
      @else
        @foreach ($contacts as $contact)
          <div class="col-md-4 mb-3">
            <div class="card text-center">
              <div class="card-body">
                <div class="d-flex justify-content-center mb-2">
                  <a href="{{ route('contacts.show', $contact->id) }}">
                    <img src="{{ Storage::url($contact->profile_picture) }}" class="profile_picture" style="width: 5rem; height: 4.5rem">
                  </a>
                </div>
                <a class="text-decoration-none text-info" href="{{ route('contacts.show', $contact->id) }}">
                  <h3 class="card-title text-capitalize">{{ $contact->name }}</h3>
                </a>
                <p class="m-2">{{ $contact->phone_number }}</p>
                <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-primary mb-2">See Contact</a>
                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-secondary mb-2">Edit Contact</a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger mb-2">Delete Contact </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection
