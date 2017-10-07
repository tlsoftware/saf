<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Laracasts\Flash\Flash;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'ASC')->paginate(10);
        return view('admin.products.index')->with('products', $products);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $product = new Product($request->all());
        $product->save();

        Flash::success("Se ha registrado " . $product->name . " de forma exitosa!");

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit')->with('product', $product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->fill($request->all());
        $product->save();

        Flash::warning('EL Producto ' . $product->name . ' ha sido editado con Exito!!');

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        dd($product->toArray());

        if (!count($product->managements)) {
            $product->delete();
            Flash::error('El producto ' . $product->name . ' ha sido borrado de forma Exitosa!!');
            return redirect()->route('products.index');
        }
        Flash::error('El producto ' . $product->name . ' no se pudo eliminar "Tiene Ventas Asociadas"!!');
        return redirect()->route('products.index');
    }
}
