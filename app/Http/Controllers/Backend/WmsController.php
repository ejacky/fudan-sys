<?php

namespace App\Http\Controllers\Backend;

use App\Facades\MenuRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Form\MenuCreateForm;
use Illuminate\Http\Request;
use App\Models\Wms;

class WmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Wms::paginate(config('repository.page-limit'));

        return view('backend.wms.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.wms.create');
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
            if (Wms::create($request->all())) {
                return $this->successRoutTo("backend.wms.index", "新增采购单成功");
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
        $data = Wms::find($id);

        return view('backend.wms.edit', compact('data'));
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
        $role = Wms::find($id);
        $role->name = $request['name'];

        try {
            if ($role->save()) {
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
            if (Wms::destroy($id)) {
                return $this->successBackTo("删除采购单成功");
            }
        }
        catch (\Exception $e) {
            return $this->errorBackTo(['error' => $e->getMessage()]);
        }
    }
}
