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
        $user->links()->create($request->validated());

        return to_route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
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
        $link->delete();

        return to_route('dashboard')->with('message', 'Link deletado com sucesso!');
    }

    public function moveUp(Link $link)
    {
        /** @var User $user */
        $user = auth()->user();

        $currentOrderNum = $link->order_num;
        $swapLink = $user->links()->where('order_num', $currentOrderNum - 1)->first();
        $link->fill(['order_num' => $swapLink->order_num])->save();
        $swapLink->fill(['order_num' => $currentOrderNum])->save();

        return to_route('dashboard')->with('message', 'Link moved up successfully!');
    }

    public function moveDown(Link $link)
    {
        /** @var User $user */
        $user = auth()->user();

        $currentOrderNum = $link->order_num;
        $swapLink = $user->links()->where('order_num', $currentOrderNum + 1)->first();
        $link->fill(['order_num' => $swapLink->order_num])->save();
        $swapLink->fill(['order_num' => $currentOrderNum])->save();

        return to_route('dashboard')->with('message', 'Link moved down successfully!');
    }
}
