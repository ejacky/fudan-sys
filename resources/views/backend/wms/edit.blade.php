@extends("backend.layout.main")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('backend.wms.update',['id'=>$data->id])}}">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑操作</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">仓库名称</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="仓库名称" value="{{old('name',$data->name)}}">
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">
                            <i class="fa fa-arrow-left"></i>
                            返回
                        </a>
                        <button type="submit" class="btn btn-success pull-right btn-flat">
                            <i class="fa fa-save"></i>
                            修改
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection