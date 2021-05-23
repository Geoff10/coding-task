<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $this->authorize('viewAny', [Item::class, $user]);
        $items = Item::all();
        return Inertia::render('Items/Index.vue', compact('items', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', [Item::class, $user]);
        $request->validate([
            'name' => ['required'],
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->user_id = Auth::id();
        $item->save();

        return redirect()->route('users.items.index', [Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Item $item)
    {
        $this->authorize('update', [$item]);
        $request->validate([
            'purchased' => ['required', 'boolean'],
        ]);

        $item->purchased = $request->purchased;
        $item->save();

        return redirect()->route('users.items.index', [Auth::user()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Item $item)
    {
        $this->authorize('delete', [$item]);
        $item->delete();

        return redirect()->route('users.items.index', [Auth::user()]);
    }
}
