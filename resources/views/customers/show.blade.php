@extends('layouts.app')
@section('content')

    <h1 class="text-primary">Cliente seleccionado {{ $customer->customer }}</h1>

    <form action="{{ route('customers.show', $customer->idcustomer) }}" method="GET" class="row g-3">
        @method('POST')

        @csrf
        <div class="col-md-3">
            <label for="idcustomer">Cliente ID</label>
            <input id="idcustomer" name="idcustomer" class="form-control" type="text" disabled
                value="{{ isset($customer) ? $customer->idcustomer : '' }}" aria-describedby="idcustomerHelp"
                placeholder="Introduce el Id">
            <small id="idcustomerlHelp" class="form-text text-muted">Identificador único del cliente.</small>
        </div>
        <div class="col-md-9">
            <label for="customer">Cliente</label>
            <input id="customer" class="form-control" name="customer" type="text" disabled
                value="{{ isset($customer) ? $customer->customer : '' }}" aria-describedby="customerHelp"
                placeholder="Nombre del cliente">
        </div>
        <div class="col-md-12">
            <label for="identerprise">Empresa</label>
            <input id="customer" class="form-control" name="customer" type="text" disabled
                value="{{ $customer->identerprise }}" aria-describedby="customerHelp" placeholder="Nombre del cliente">
        </div>

        <div class="col-md-6">
            <label for="contact"">Nombre cliente</label>
                        <input  id=" contact" class="form-control" name="contact" type="text" disabled
                value="{{ isset($customer) ? $customer->contact : '' }}">
        </div>
        <div class="col-md-6">
            <label for="customeralias">Alias</label>
            <input id="customeralias" class="form-control" name="customeralias" type="text" disabled
                value="{{ isset($customer) ? $customer->customeralias : '' }}">
        </div>
        <div class="col-md-3">
            <label for="customerstate">Estado</label>
            <input id="idcustomerstate" class="form-control" name="customerstate" type="text" disabled
                value="{{ isset($customer) ? $customer->customerstate : '' }}">
        </div>
        <div class="form-group col-md-2">
            <label for="sale">Saldo</label>
            <input id="idsale" class="form-control" name="sale" type="text" disabled
                value="{{ isset($customer) ? $customer->sale : '' }}">
        </div>
    </form>
    <hr>
    <a class="btn btn-secondary" role="button" href="{{ route('customers.index') }}">Volver al índice</a>
    @if (isset($customer))
        @if ($customer->idcustomer)
            <a class="btn btn-secondary" role="button"
                href="{{ route('customers.show', $customer->idcustomer) }}">Recargar</a>
        @endif
    @endif
@stop