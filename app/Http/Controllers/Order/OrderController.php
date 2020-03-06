<?php

namespace App\Http\Controllers\Order;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Charts\OrderChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $paginationRecordsAmount = 10;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $orders = Order::whereHas('products');

        if($orders) {
            if($request->order && $request->key) {
                $orders = $orders->orderBy($request->key, $request->order);
            }

            $orderChart = $this->orderChart($orders);

            $orders = $orders->paginate($this->paginationRecordsAmount);
        }

        return view('orders.index', compact('orders', 'orderChart'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create(Order $order)
    {
        $product = $order->products->first();

        $clients = Client::all();
        $products = Product::all();

        return view('orders.create', compact( 'product', 'clients', 'products'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        //TODO validation for all fields
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|max:10000',
        ]);

        $product = Product::find($request->product_id);
        $client = Client::find($request->client_id);

        $price = $product->total*$request->amount;

        $order = new Order;
        $order->client()->associate($client->id);
        $order->total = (double)$price;
        $order->date = $request->date;

        $order->save();

        $order->products()->attach($request->product_id, ['order_id' => $order->id, 'amount' => $request->amount]);
        $order->save();

        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit(Order $order)
    {
        $product = $order->products->first();

        $clients = Client::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'product', 'clients', 'products'));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, Order $order)
    {
        //TODO validation for all fields
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $client = Client::find($request->client);
        $product = $order->products->first();

         $newPrice = $product->total*$request->amount;

         $order->update([
             'total' => (double)$newPrice,
             'date'  => $request->date,
         ]);

        $order->client()->associate($client);

        $order->products()->detach($product->id);
        $order->products()->attach($request->product, ['amount' => $request->amount]);

        $order->save();

        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show(Request $request)
    {
        $orders = null;
        if ($request->keyword == 'clients.name') {
            $orders = Order::whereHas('products', function ($q) use ($request) {
                $client_id = Client::where('name', 'LIKE', '%' . $request->keyword_value . '%')->pluck('id', 'id');
                $q->whereIn('client_id', $client_id);
            });
        } elseif ($request->keyword !== 'all') {
            $orders = Order::whereHas('products', function ($q) use ($request) {
                $q->where($request->keyword, 'LIKE', '%' . $request->keyword_value . '%');
            });
        } else {
            $orders = Order::with('products')->with('client')
                ->join('clients', 'clients.id', '=', 'orders.client_id')
                ->join('order_product', 'orders.id', '=', 'order_product.order_id')
                ->join('products', 'products.id', '=', 'order_product.product_id')
                ->select('orders.*', 'products.name AS products.name', 'clients.name AS clients.name')
                ->where('clients.name', 'LIKE', '%'.$request->keyword_value.'%')
                ->orWhere('products.name', 'LIKE', '%'.$request->keyword_value.'%')
                ->orWhere('orders.total', 'LIKE', '%'.$request->keyword_value.'%')
                ->orWhere('orders.date', 'LIKE', '%'.$request->keyword_value.'%');
        }

        $orderChart = $this->orderChart($orders);

        $orders = $orders->paginate($this->paginationRecordsAmount);

        return view('orders.index', compact('orders', 'orderChart'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();

        return redirect()->route('order.index')->with('success','Order deleted successfully');
    }

    /**
     * @param $orders
     * @return OrderChart
     */

    private function orderChart($orders)
    {
        $dataChart = $this->getDataForChart($orders->get());
        $labelsChart = $this->getLabelsForChart($orders->get());

        $ordersChart = new OrderChart;
        $ordersChart->labels($labelsChart);

        $ordersChart->dataset('', 'line',  $dataChart);

        return $ordersChart;
    }

    /**
     * @param $orders
     * @return array
     */
    private function getDataForChart($orders)
    {
        $dataChart = [];
        foreach ($orders as $order) {
            $date =  Carbon::parse($order->date);
            array_push($dataChart, $date->format('m'));
        }

        return array_unique($dataChart);
    }

    private function getLabelsForChart($orders)
    {
        $labelsChart = [];
        foreach ($orders as $order) {
            $date =  Carbon::parse($order->date);
            array_push($labelsChart, $date->format('F'));
        }

        return array_unique($labelsChart);
    }
}
