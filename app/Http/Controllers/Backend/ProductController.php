<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Wms;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(config('repository.page-limit'));

        return view('backend.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplierList = Supplier::Lists('name', 'id')->all();
        $wmsList = Wms::Lists('name', 'id')->all();

        return view('backend.product.create', compact('supplierList', 'wmsList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Form\RoleCreateForm $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (Product::create($request->all())) {
                return $this->successRoutTo("backend.product.index", "新增角色成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $supplierList = Supplier::Lists('name', 'id')->all();
        $wmsList = Wms::Lists('name', 'id')->all();

        return view('backend.product.edit', compact('data','supplierList', 'wmsList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Form\RoleCreateForm $request
     * @param  int                                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Product::find($id);
        $role->name = $request['name'];

        try {
            if ($role->save()) {
                return $this->successBackTo("编辑产品成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Product::destroy($id)) {
                return $this->successBackTo("删除产品成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }
}
