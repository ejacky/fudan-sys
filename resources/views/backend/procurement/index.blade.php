@extends("backend.layout.main")

@inject('fudanPresenter','App\Presenters\FudanPresenter')

@section("content")
    @include('backend.components.handle',$handle = $fudanPresenter->getProcurementHandle())
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">采购单列表</h3>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>采购单ID</th>
                            <th>采购单名称</th>
                            <th>供应商</th>
                            <th>采购商品</th>
                            <th>采购人</th>
                            <th>采购数量</th>
                            <th>操作</th>
                        </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$fudanPresenter->getSupplierById($item->supplier_id)}}</td>
                                <td>{{$fudanPresenter->getProductById($item->product_id)}}</td>
                                <td>{{$fudanPresenter->getBuyerById($item->buyer_id)}}</td>
                                <td>{{$item->amount}}</td>
                                <td>
                                    <a href="{{route('backend.procurement.edit',['id'=>$item->id])}}" class="btn btn-primary btn-flat">编辑</a>
                                    <button class="btn btn-danger btn-flat"
                                            data-url="{{URL::to('backend/procurement/'.$item->id)}}"
                                            data-toggle="modal"
                                            data-target="#delete-modal"
                                    >
                                        删除
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @if($data->render())
                    <div class="box-footer clearfix">
                        {!! $data->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section("after.js")
    @include('backend.components.modal.delete',['title'=>'操作提示','content'=>'你确定要删除这个采购单吗?'])
@endsection
