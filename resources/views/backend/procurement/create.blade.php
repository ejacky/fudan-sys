@extends("backend.layout.main")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('backend.procurement.store')}}">
                {!! csrf_field() !!}
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增采购单</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">采购单名称</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="采购单名称" value="{{old('name')}}">
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
                         <label for="standard">产品<em>*</em></label>
                         <select name="product_id" id="product_id" class="form-control">
                             @foreach($productList as $key => $value)
                                 <option value="{{$key}}">{{$value}}</option>
                             @endforeach
                         </select>
                       </div>
                      <div class="form-group">
                         <label for="standard">采购员<em>*</em></label>
                         <select name="buyer_id" id="buyer_id" class="form-control">
                             @foreach($buyerList as $key => $value)
                                 <option value="{{$key}}">{{$value}}</option>
                             @endforeach
                         </select>
                       </div>

                          <div class="form-group">
                              <label for="name">数量</label>
                              <input type="text" class="form-control" id="amount" name="amount" placeholder="数量" value="{{old('amount')}}">
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

@section("after.js")
    <script>
        $(function () {
            $('#supplier_id').change(function (){
                $.getJSON('/backend/procurement/product/' + $(this).val(), function (ret) {
                    if (ret.status == 200) {
                        var option
                        for  (var key in ret.data) {
                            option += '<option value=' + key + '>' + ret.data[key] + '</option>'
                        }
                        $('#product_id').html(option)


                    }
                });
            });
        });
    </script>
@endsection