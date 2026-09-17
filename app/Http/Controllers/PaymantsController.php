<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paymant;

class PaymantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $payments = Paymant::with(['user', 'programOption']) // Ambil relasi user dan programOption
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                })
                    ->orWhere('program_option_id', 'like', "%$search%")
                    ->orWhere('merchant_order_id', 'like', "%$search%")
                    ->orWhere('payment_method', 'like', "%$search%")
                    ->orWhere('amount', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc') // Menampilkan data terbaru terlebih dahulu
            ->paginate(10);

        return view('admin.pembayaran.index', compact('payments', 'search'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
