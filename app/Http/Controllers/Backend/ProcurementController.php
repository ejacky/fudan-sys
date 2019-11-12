<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\Supplier;
use App\Models\Buyer;
use App\Models\Product;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Procurement::paginate(config('repository.page-limit'));

        return view('backend.procurement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplierList = Supplier::Lists('name', 'id')->all();
        $buyerList = Buyer::Lists('name', 'id')->all();
        $productList = Product::Lists('name', 'id')->all();


        return view('backend.procurement.create', compact('supplierList', 'buyerList', 'productList'));
    }

    public function product($supplierId)
    {
        $result = [
            'status' => 200,
            'data'   => []
        ];
        try {
            $product = Product::where('supplier_id', $supplierId)->lists('name', 'id')->all();
            $result['data'] = $product;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $result['status'] = 500;
        }
        echo json_encode($result);
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
            if (Procurement::create($request->all())) {
                return $this->successRoutTo("backend.procurement.index", "新增采购单成功");
            }
        }
        catch (\Exception $e) {
            \Log::error($e->getMessage());
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
        $data = Procurement::find($id);
        $supplierList = Supplier::Lists('name', 'id')->all();
        $buyerList = Buyer::Lists('name', 'id')->all();
        $productList = Product::Lists('name', 'id')->all();

        return view('backend.procurement.edit', compact('data', 'supplierList', 'buyerList', 'productList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dump($request);
        $procure = Procurement::find($id);
        //dump($procure);
        $procure->name = $request['name'];
        $procure->supplier_id = $request['supplier_id'];
        $procure->product_id = $request['product_id]'];
        $procure->buyer_id = $request['buyer_id'];
        $procure->amount = $request['amount'];
//dump($procure);exit;
        try {
            if ($procure->save()) {
                return $this->successBackTo("编辑采购单成功");
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
            if (Procurement::destroy($id)) {
                return $this->successBackTo("删除采购单成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }
}
