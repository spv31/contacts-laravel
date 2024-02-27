@extends('layouts.app')

@vite(['resources/css/app.css'])

@section('content')
  <div class="container">
    @forelse ($contacts as $contact)
      <div class="d-flex justify-content-between bg-dark mb-3 rounded px-4 py-2">
        <div>
          <a href="{{ route('contacts.show', $contact->id) }}">
            <img src="{{ Storage::url($contact->profile_picture) }}" class="profile_picture">
          </a>
        </div>
        <div class="d-flex align-items-center">
          <p class="me-2 mb-0"> {{ $contact->name }} </p>
          <p class="me-2 mb-0 d-none d-md-block">
            <a href="mailto:{{ $contact->email }}">
              {{ $contact->email }}
            </a>
          </p>
          <p class="me-2 mb-0 d-none d-md-block"">
            <a href="tel:{{ $contact->phone_number }}">
              {{ $contact->phone_number }}
            </a>
          </p>
          <a class="btn btn-secundary mb-0" href="{{ route('contacts.edit', $contact->id) }}">
            <x-icon icon="pencil" />

          </a>
          <form class="mb-0" action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secundary">
              <x-icon icon="trash" />
            </button>
          </form>
        </div>
      </div>
    @empty
      <div class="col-md-4 mx-auto">
        <div class="card card-body text-center">
          <p>No contacts saved yet</p>
          <a href="{{ route('contacts.create') }}">Add One!</a>
        </div>
      </div>
    @endforelse
    {{ $contacts->links()}}
  </div>
@endsection
