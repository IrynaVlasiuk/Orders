@extends('layouts.app')

<div class="container orders edit">
    <div class="title">New Order</div>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <div class="input-group">
            <label for="client-name">Client Name</label>
            <select name="client_id" id="client-name" type="text" >
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" >{{ $client->name }}</option>
                @endforeach
            </select>

        </div>

        <div class="input-group">
            <label for="product-name">Product Name</label>
            <select name="product_id" id="product-name" type="text">
                @foreach($products as $pr)
                    <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <label for="amount">Amount</label>
            <input name="amount" id="amount" type="number" value="{{ old('amount') }}">
        </div>
        <div class="input-group">
            <label for="date">Date</label>
            <input name="date" id="date" type="date" value="{{ old('date') }}">
        </div>
        <div class="button-block">
            <button type="submit" class="btn-submit">Save</button>
        </div>
    </form>
</div>




