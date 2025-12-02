<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use App\Models\User;

class LinkController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
        // Link::query()->create(
        //     array_merge(
        //         $request->validated(),
        //         ['user_id' => auth()->id()]
        //     )
        // );

        /** @var User $user */
        $user = auth()->user();
        $order_num = ($user->links()->max('order_num') ?? 0) + 1;
        $user->links()->create(
            array_merge(
                $request->validated(),
                ['order_num' => $order_num]
            )
        );

        return to_route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        $this->authorize('edit', $link);
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link->update($request->validated());

        return to_route('dashboard')->with('message', 'Link atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $this->authorize('delete', $link);
        while ($link->order_num !== $link->user->links()->max('order_num')) {
            $link->move('down');
        }
        $link->delete();

        return to_route('dashboard')->with('message', 'Link deletado com sucesso!');
    }

    public function moveUp(Link $link)
    {
        $link->move('up');

        return back()->with('message', 'Link moved up!');
    }

    public function moveDown(Link $link)
    {
        $link->move('down');

        return back()->with('message', 'Link moved down!');
    }
}
