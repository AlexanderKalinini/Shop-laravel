<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityException;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Notifications\OrderNotification;
use Faker\Core\Number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Ramsey\Uuid\Type\Integer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::where("user_id", Auth::user()->id)
            ->orWhere('email', Auth::user()->email)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */




    public function store(OrderRequest $request)
    {
        $user = $request->safe()->except("cart");
        $cart = json_decode($request->safe()->only("cart")['cart'], true);
        $promo = $request->safe()->only('promo');
        $status = "Заказ создан";
        // Добавление данных заказчика в БД

        $order = Order::create(
            array_merge($user, [
                "user_id" => Auth::user()->id ?? null,
                "status" => $status,
            ])
        );

        $queryQuantityIds = [];

        foreach ($cart as $product) {
            // Проверка на наличие товара и довавление квери,id, опций в массив или выброс ошибки
            $queryQuantityIds[] = $this->checkQuantity($product);
        }

        foreach ($cart as $key => $product) {
            // Добавление товара к заказу
            $orderItem = OrderItem::create(
                [
                    'order_id' => $order['id'],
                    'product_id' => $product['id'],
                    'promo_code_id' => $promo['promo'] ?? null,
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]
            );


            foreach ($queryQuantityIds[$key] as $item) {
                // Уменьшение товара на складе
                $item['query']->decrement('quantity', $item['quantity']);
                // Добавление опций к заказу
                $orderItem->optionValues()->attach($item['id']);
            }
        }

        Notification::route('mail', $order['email'])
            ->notify(new OrderNotification($order));

        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $orderId)
    {
        return OrderResource::collection(
            OrderItem::where('order_id', $orderId)
                ->with('optionValues')
                ->with('product')
                ->get()
        );
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
        $order = Order::find($id);
        return $order->delete();
    }


    protected function checkQuantity($product)
    {;
        $queryQuantityIds = [];

        foreach ($product['options'] as  $option => $valueOpt) {
            $sortedOption = Option::where('title', $option)->first();

            $optionValue = OptionValue::where('option_id', $sortedOption->id)
                ->where('value', $valueOpt)
                ->first();

            $optionValueProduct = DB::table('option_value_product')
                ->where('product_id', $product['id'])
                ->where('option_value_id', $optionValue->id);

            // Проверка наличия товара и списание товара со склада

            if (($productQuantity = $optionValueProduct->first('quantity')->quantity) < $product['quantity']) {
                return throw new QuantityException(
                    $product['title'],
                    $sortedOption->title,
                    $optionValue->value,
                    $productQuantity
                );
            } else {
                $queryQuantityIds[] = ['query' => $optionValueProduct, 'quantity' => $product['quantity'], 'id' => $optionValue->id];
            }
        }

        return $queryQuantityIds;
    }
}