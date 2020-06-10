@extends('layout.basic')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-header">
                {{ __('default.title.create_ticket', ['title' => $ticket->getTitle()]) }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('ticket.update', ['id' => $ticket->getId()]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">{{ __('default.form.title') }}</label>
                        <input
                                name="title"
                                type="text"
                                class="form-control"
                                id="title"
                                value="{{ old('title', $ticket->getTitle()) }}"
                                class="@error('title') is-invalid @enderror"
                        >
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('default.form.description') }}</label>
                        <textarea
                                class="form-control"
                                id="description"
                                rows="3"
                                name="description"
                        >{{ old('description', $ticket->getDescription()) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deadline_at">{{ __('default.form.deadline_at') }}</label>
                        <input
                                name="deadline_at"
                                type="datetime-local"
                                class="form-control"
                                id="deadline_at"
                                value="{{ old('deadline_at', $ticket->getDeadlineAt()) }}"
                        >
                        @if ($ticket->getDeadlineAt())
                            <small>
                                {{ __('default.message.deadline', ['deadline_at' => $ticket->getDeadlineAt()]) }}
                            </small>
                        @endif
                        @error('deadline_at')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('default.form.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection