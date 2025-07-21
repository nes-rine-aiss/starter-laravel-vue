<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGoodRequest;
use App\Http\Requests\UpdateGoodRequest;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goods = (new Good)->newQuery();

        if (request()->has('search')) {
            $goods->where('title', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $goods->orderBy($attribute, $sort_order);
        } else {
            $goods->latest();
        }

        $goods = $goods->with('user')->paginate(config('admin.paginate.per_page'))
            ->onEachSide(config('admin.paginate.each_side'))
            ->appends(request()->query());


        return Inertia::render('Good/List', [
            'goods' => $goods,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('good create'),
                'edit' => Auth::user()->can('good edit'),
                'delete' => Auth::user()->can('good delete'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Good $good)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoodRequest $request, Good $good)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Good $good)
    {
        //
    }
}
