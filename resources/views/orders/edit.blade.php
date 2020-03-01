@extends('layouts.app')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container orders edit">
    <div class="title">Edit</div>
    <form action="{{ route('order.update', [$order->id] ) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input-group">
            <label for="client-name">Client Name</label>
            <select name="client" id="client-name" type="text" >
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $order->client->id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <label for="product-name">Product Name</label>
            <select name="product" id="product-name" type="text">
                @foreach($products as $pr)
                    <option value="{{ $pr->id }}" {{ $product->id == $pr->id ? 'selected' : '' }}>{{ $pr->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <label for="amount">Amount</label>
            <input name="amount" id="amount" type="number" value="{{ $order->products[0]->pivot->amount }}">
        </div>
        <div class="input-group">
            <label for="date">Date</label>
            <input name="date" id="date" type="date" value="{{ $order->date }}">
        </div>
        <div class="button-block">
            <button type="submit" class="btn-submit">Save</button>
        </div>
    </form>
</div>



