@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <h1 class="text-secondary">Lista de Clientes</h1>
            @if ($message = Session::get('customer-success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"># Id Cliente</th>
                        <th scope="col">Cliente</th>
                        <th scope="col" class="text-center">Contacto</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">País</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td scope="row">{{ $customer->idcustomer }}</td>
                            <td>{{ $customer->customer }}</td>
                            <td class="text-center">{{ $customer->contacto }}</td>
                            <td class="text-center">{{ $customer->customerstate }}</td>
                            <td class="text-center">{{ $customer->country }}</td>
                            <td class="text-center">
                                <a href="{{ route('customers.show', $customer->idcustomer) }}"
                                    class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th scope="col"># Id Cliente</th>
                    <th scope="col">Cliente</th>
                    <th scope="col" class="text-center">Contacto</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">País</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tfoot>
            </table>
        </div>
    </div>
@stop