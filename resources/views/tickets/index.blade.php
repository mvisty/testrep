@extends('layout.basic')

@section('content')
    <div class="container">
        <a href="{{ route('ticket.create') }}" class="btn-sm btn-success m-4">
            {{ __('default.form.create_button') }}
        </a>
        @if (!empty($tickets['data']))
            @foreach ($tickets['data'] as $ticket)
                <div class="row m-2">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header @if($ticket->isExpire()) alert alert-danger @endif">
                                {{ $ticket->getTitle() }}
                            </div>
                            <div class="card-body">
                                {{ $ticket->getDescription() }}
                                @if ($ticket->isExpired())
                                    <div class="alert alert-danger">{{ __('default.ticket_expired') }}</div>
                                @elseif ($ticket->getDeadlineAt() && !$ticket->getFinished())
                                    <div class="alert alert-warning">
                                        {{ __('default.ticket_expire_at', [
                                            'deadline_at' => $ticket->getDeadlineAt()
                                        ]) }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <form method="post" action="{{ route('ticket.delete', ['id' => $ticket->getId()]) }}">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('ticket.edit', ['id' => $ticket->getId()]) }}" class="btn-sm btn-warning m-1">
                                        {{ __('default.form.edit_button') }}
                                    </a>
                                    <a href="{{ route('ticket.finish', ['id' => $ticket->getId()]) }}" class="btn-sm btn-dark m-1">
                                        {{ __('default.form.finish_button') }}
                                    </a>

                                    <button class="btn-sm btn-danger" type="submit">
                                        {{ __('default.form.delete_button') }}
                                    </button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-12 pagination align-content-center">
                    {{ $tickets['model']->links() }}
                </div>
            </div>
        @else
            {{ __('default.noting_to_show') }}
        @endif
    </div>
@endsection