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
        </tr>
        @if($orders)
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->client->name }}</td>
                    @foreach($order->products as $product)
                        <td>{{ $product->name }}</td>
                    @endforeach
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->date }}</td>
                </tr>
            @endforeach
        @else
            <div>There is no order</div>
        @endif
    </table>
</div>

