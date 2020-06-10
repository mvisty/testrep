<?php

namespace App\Http\Controllers;

use App\Facades\TicketFacade;
use App\Http\Requests\Ticket\DestroyTicketRequest;
use App\Http\Requests\Ticket\EditTicketRequest;
use App\Http\Requests\Ticket\ShowTicketRequest;
use App\StaticParams\TicketStaticParam;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = TicketFacade::getPaginated(TicketStaticParam::PER_PAGE);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditTicketRequest $request)
    {
        TicketFacade::make($request->validated())->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowTicketRequest $request, $id)
    {
        $ticket = TicketFacade::getById($id);

        return view('tickets.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShowTicketRequest $request, $id)
    {
        $ticket = TicketFacade::getById($id);

        return view('tickets.edit_form', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTicketRequest $request, $id)
    {
        TicketFacade::getById($id)
            ->fill($request->validated())
            ->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyTicketRequest $request, $id)
    {
        TicketFacade::getById($id)->delete();

        return redirect('/');
    }

    /**
     * @param ShowTicketRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function finish(ShowTicketRequest $request, $id)
    {
        TicketFacade::getById($id)->setFinishedAt(now())->save();

        return redirect('/');
    }
}
