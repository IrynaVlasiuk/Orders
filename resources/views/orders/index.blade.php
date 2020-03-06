@extends('layouts.app')

@section('content')
    <div class="container orders">
        <div class="row justify-content-center">
            <div class="navbar">
                <a class="new-order" href="{{ route('order.create') }}">
                    <button type="submit" class="add-order">
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
                Orders
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="title">Orders</div>
            <div class="section-search">
                <form action="{{ route('order.search') }}" method="GET">
                    <input name="keyword_value" placeholder="Keyword" class="keyword_value">
                    <select name="keyword">
                        <option value="all">All</option>
                        <option value="clients.name">Client</option>
                        <option value="products.name">Product</option>
                        <option value="orders.total">Total</option>
                        <option value="orders.date">Date</option>
                    </select>
                    <button type="submit" class="btn-search">Search</button>
                </form>
            </div>

            <div class="section-graphing">
                @if($orderChart)
                    {!! $orderChart->container() !!}
                @endif
            </div>

            <div class="email-section">
                <a href="{{ url('email/orderTable') }}">Email this report</a>
            </div>

            <div class="table-section">
                <table class="rwd-table">
                    <tr>
                        <th>
                            <div>
                                <div class="column-name">Client</div>
                                <div class="order">
                                    <a href={{ route('order.index', ['order' => 'asc', 'key' => 'clientName']) }}>
                                        <i class="fa fa-caret-up {{ request()->get('key') == 'clientName' ? request()->get('order') : '' }}"></i>
                                    </a>
                                    <a href={{ route('order.index', ['order' => 'desc', 'key' => 'clientName']) }}>
                                        <i class="fa fa-caret-down {{ request()->get('key') == 'clientName' ? request()->get('order') : '' }} "></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <div class="column-name">Product</div>
                                <div class="order">
                                    <a href={{ route('order.index', ['order' => 'asc', 'key' => 'productName']) }}>
                                        <i class="fa fa-caret-up {{ request()->get('key') == 'productName' ? request()->get('order') : '' }}"></i>
                                    </a>
                                    <a href={{ route('order.index', ['order' => 'desc', 'key' => 'productName']) }}>
                                        <i class="fa fa-caret-down {{ request()->get('key') == 'productName' ? request()->get('order') : '' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <div class="column-name">Total</div>
                                <div class="order">
                                    <a href={{ route('order.index', ['order' => 'asc', 'key' => 'total']) }}>
                                        <i class="fa fa-caret-up {{ request()->get('key') == 'total' ? request()->get('order') : '' }}"></i>
                                    </a>
                                    <a href={{ route('order.index', ['order' => 'desc', 'key' => 'total']) }}>
                                        <i class="fa fa-caret-down {{ request()->get('key') == 'total' ? request()->get('order') : '' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div>
                                <div class="column-name">Date</div>
                                <div class="order">
                                    <a href={{ route('order.index', ['order' => 'asc', 'key' => 'date']) }}>
                                        <i class="fa fa-caret-up {{ request()->get('key') == 'date' ? request()->get('order') : '' }}"></i>
                                    </a>
                                    <a href={{ route('order.index', ['order' => 'desc', 'key' => 'date']) }}>
                                        <i class="fa fa-caret-down {{ request()->get('key') == 'date' ? request()->get('order') : '' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th><div class="column-name">Actions</div></th>
                    </tr>

                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->client->name }}</td>
                            @foreach($order->products as $product)
                                <td>{{ $product->name }}</td>
                            @endforeach
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->date }}</td>
                            <td>
                                <a href="{{ route('order.edit', $order->id) }}">
                                    <button class="edit-order" type="button">Edit</button>
                                </a>
                                <form action="{{ route('order.destroy',$order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-order">Delete</button>
                                </form>
                            </td>
                        </tr>

                        @empty
                            <div>There is no order</div>
                        @endforelse
                </table>


                    {{ $orders->links() }}


            </div>
        </div>
    </div>

@endsection
