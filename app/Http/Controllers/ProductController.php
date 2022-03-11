<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // NOTE GET /api/products
        $data = Product::orderBy('created_at', 'DESC')
            ->paginate(5);

        return Response::json($data, 200);
    }

    public function delete($uuid)
    {
        // NOTE DELETE /api/product/{uuid}
        if(myRole() == 'Admin') {
            $testProductAvaliability = Product::where('uuid', $uuid)
                ->first();

            if(!$testProductAvaliability) {
                $data   = [
                    'message' => 'data not found'
                ];
            } else {
                $delete = Product::where('uuid', $uuid)
                    ->delete();

                if($delete) {
                    $data   = [
                        'message' => 'product successfully deleted'
                    ];
                } else {
                    $data   = [
                        'message' => 'product failed to be deleted'
                    ];
                }
            }
        } else {
            $data   = [
                'message' => 'Unauthorized'
            ];
        }

        return Response::json($data, 200);
    }

    public function show($uuid)
    {
        // NOTE GET /api/products/{uuid}
        $data = Product::where('uuid', $uuid)
            ->first();

        if(!$data) {
            $data   = [
                'message' => 'data not found'
            ];
        }

        return Response::json($data, 200);

    }

    public function store(Request $request)
    {
        // NOTE POST /api/products
        if(myRole() == 'Admin') {
            $this->validate($request, [
                'name'      => 'required',
                'type'      => 'required',
                'price'     => 'required|numeric',
                'quantity'  => 'required|numeric',
            ]);

            try{
                $uuid       = Str::uuid();
                $name       = $request->name;
                $type       = $request->type;
                $price      = $request->price;
                $quantity   = $request->quantity;

                $data   = [
                    'uuid'      => $uuid,
                    'name'      => $name,
                    'type'      => $type,
                    'price'     => $price,
                    'quantity'  => $quantity,
                ];
                
                $product   = Product::create($data);

                $message = 'Product successfully added';

                $data   = [
                    'message' => $message,
                    'product' => $product,
                ];
            } catch(Exception $e) {
                $data   = [
                    'message'   => 'error',
                    'error'     => $e
                ];
            }
        } else {
            $data   = [
                'message' => 'Unauthorized'
            ];
        }

        return Response::json($data, 200);
    }

    public function update(Request $request, $uuid)
    {
        // NOTE POST /api/products/{uuid}
        if(myRole() == 'Admin') {
            $testProductAvaliability = Product::where('uuid', $uuid)
                ->first();

            if(!$testProductAvaliability) {
                $data   = [
                    'message' => 'data not found'
                ];
            } else {
                $this->validate($request, [
                    'name'      => 'required',
                    'type'      => 'required',
                    'price'     => 'required|numeric',
                    'quantity'  => 'required|numeric',
                ]);

                try{
                    $name       = $request->name;
                    $type       = $request->type;
                    $price      = $request->price;
                    $quantity   = $request->quantity;
        
                    $data   = [
                        'name'      => $name,
                        'type'      => $type,
                        'price'     => $price,
                        'quantity'  => $quantity,
                    ];
        
                    Product::where('uuid', $uuid)
                        ->update($data);

                    $message = 'Product successfully updated';

                    $data   = [
                        'message' => $message,
                        'product' => $testProductAvaliability,
                    ];
                } catch(Exception $e) {
                    $data   = [
                        'message'   => 'error',
                        'error'     => $e
                    ];
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
