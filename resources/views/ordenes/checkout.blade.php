@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-2xl font-bold text-gray-800 text-center mb-5">Checkout</h1>

    <div class="card shadow-lg mt-4 rounded-lg max-w-2xl mx-auto">
        <div class="card-header bg-indigo-800 text-white p-4 rounded-t-lg">
            <h2 class="font-semibold text-lg">Finalizar Compra</h2>
        </div>
        <div class="card-body bg-white p-6">
            <div class="mb-6">
                <table class="table table-bordered table-striped w-full mb-4">
                    <tbody>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Total</th>
                            <td class="p-3 text-gray-800 font-semibold text-lg">${{ number_format($total, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Envío</th>
                            <td class="p-3">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $total >= 50000 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $total >= 50000 ? 'Gratis' : '$5000.00' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Total a pagar</th>
                            <td class="p-3 text-gray-800 font-bold text-xl">${{ number_format($total >= 50000 ? $total : $total + 5000, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <form method="POST" action="{{ route('ordenes.guardar') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="direccion_envio" class="block text-sm font-medium text-gray-700 mb-2">Dirección de Envío</label>
                        <textarea 
                            name="direccion_envio" 
                            id="direccion_envio" 
                            class="form-control p-2 w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                            required
                        ></textarea>
                    </div>
                    <input type="hidden" name="total" value="{{ $total >= 50000 ? $total : $total + 5000 }}">
                    <div class="mt-6">
                        <button 
                            type="submit" 
                            class="btn btn-success px-6 py-3 rounded-lg shadow-md text-white bg-indigo-800 hover:bg-indigo-900 transition duration-200 w-full"
                        >
                            Finalizar Compra
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection