@extends("backend.layout.main")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('backend.product.store')}}">
                {!! csrf_field() !!}
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增产品</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">产品名称</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="产品名称" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="standard">供应商<em>*</em></label>
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                @foreach($supplierList as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                             <label for="standard">仓库<em>*</em></label>
                             <select name="wms_id" id="wms_id" class="form-control">
                                 @foreach($wmsList as $key => $value)
                                     <option value="{{$key}}">{{$value}}</option>
                                 @endforeach
                             </select>
                          </div>
                    </div>


                    <div class="box-footer clearfix">
                        <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">
                            <i class="fa fa-arrow-left"></i>
                            返回
                        </a>
                        <button type="submit" class="btn btn-success pull-right btn-flat">
                            <i class="fa fa-plus"></i>
                            新 增
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection