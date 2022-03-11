<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        // NOTE GET /api/transactions
        if(myRole() == 'Customer') {
            $data   = Transaction::join('products', 'products.id', '=', 'transactions.product_id')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select([
                    'transactions.*', 'products.name as product', 'users.name as user'
                ])
                ->where('transactions.user_id', me()->id)
                ->orderBy('transactions.created_at', 'DESC')
                ->paginate(5);
        } else {
            $data   = Transaction::join('products', 'products.id', '=', 'transactions.product_id')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->select([
                    'transactions.*', 'products.name as product', 'users.name as user'
                ])
                ->orderBy('transactions.created_at', 'DESC')
                ->paginate(5);
        }
        return Response::json($data, 200);
    }

    public function show($uuid)
    {
        // NOTE GET /api/transactions/{uuid}
        $data   = Transaction::join('products', 'products.id', '=', 'transactions.product_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select([
                'transactions.*', 'products.name as product', 'users.name as user'
            ])
            ->where('transactions.uuid', $uuid)
            ->first();

        if(!$data) {
            $data   = [
                'message' => 'data not found'
            ];
        } else {
            if(myRole() == 'Customer') {
                if($data->user_id !== me()->id) {
                    $data   = [
                        'message' => 'anda tidak bisa mengakses data ini'
                    ];
                }
            }
        }

        return Response::json($data, 200);
    }

    public function store(Request $request)
    {
        // NOTE POST /api/transactions
        if(myRole() == 'Customer') {
            $this->validate($request, [
                'uuid'      => 'required',
            ]);

            $uuid = $request->uuid;

            $product = Product::where('uuid', $uuid)
                ->first();

            if(!$product) {
                $data   = [
                    'message' => 'data not found'
                ];
            } else {
                $testStock = $product->quantity;

                if($testStock == 0) {
                    $data   = [
                        'message' => 'barang kosong'
                    ];
                } else {
                    try{
                        $price      = $product->price;
                        $tax        = intval((10 / 100) * $price);
                        $admin_fee  = intval((5 / 100) * ($price + $tax));
                        $product_id = $product->id;
                        $user_id    = me()->id;
                        $amount     = 1;
                        $total      = intval($price + $tax + $admin_fee);

                        $data   = [
                            'uuid'          => Str::uuid(),
                            'user_id'       => $user_id,
                            'product_id'    => $product_id,
                            'amount'        => $amount,
                            'tax'           => $tax,
                            'admin_fee'     => $admin_fee,
                            'total'         => $total,
                        ];

                        $transaction = Transaction::create($data);

                        $quantity = ($testStock - 1);

                        $data   = [
                            'quantity'  => $quantity,
                        ];

                        Product::where('uuid', $uuid)
                            ->update($data);

                        $data   = [
                            'message'       => 'Transaction successfully created',
                            'transaction'   => $transaction
                        ];
                    } catch(Exception $e) {
                        $data   = [
                            'message'   => 'error',
                            'error'     => $e
                        ];
                    }
                }
            }
        } else {
            $data   = [
                'message' => 'Unauthorized'
            ];
        }

        return Response::json($data, 200);
    }
}
