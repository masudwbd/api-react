@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
        integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            background: #428bca;
            ;
            border: 1px solid white;
            padding: 1 6px;
            padding-left: 2px;
            margin-right: 2px;
            color: white;
            border-radius: 4px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">EDIT PRODUCT</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add
                                New</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content  bg-light">
            <div class="container-fluid">
                <form action="{{route('product.update')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Your Product</h3>
                                </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="product_name">Product Name</label>
                                                <input type="text" class="form-control" value="{{$product->name}}" name="name"
                                                    id="product_name">
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="product_code">Product Code</label><span class="text-danger">
                                                    *</span>
                                                <input type="text" class="form-control" value="{{$product->code}}" id="code"
                                                    name="code">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="subcategory_id">Category/Subcategory</label><span
                                                    class="text-danger"> *</span>
                                                <select class="form-control"  id="subcategory_id" value="{{old ('subcategory_id')}}" name="subcategory_id" id="">
                                                    @foreach ($categories as $row)
                                                        @php
                                                            $subcategories = DB::table('subcategories')
                                                                ->where('category_id', $row->id)
                                                                ->get();
                                                        @endphp
                                                        <option value="" disabled >{{ $row->category_name }}</option>
                                                        @foreach ($subcategories as $row)
                                                            <option @if($product->subcategory_id==$row->id) selected="" @endif value="{{ $row->id }}">
                                                                ---{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="product_code">Child Category</label><span class="text-danger">
                                                    *</span>
                                                <select class="form-control" name="childcategory_id"  id="childcategory_id">
                                                    @foreach ($childcategories as $row)
                                                    <option @if($product->childcategory_id==$row->id) selected="" @endif value="{{ $row->id }}">
                                                    {{ $row->childcategory_name }}</option>
                                                        @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="brands">Brands</label><span class="text-danger"> *</span>
                                                <select class="form-control" name="brand_id" value="{{old('brand_id')}}" id="">
                                                    @foreach ($brands as $row)
                                                        <option  @if($product->brand_id==$row->id) selected="" @endif  value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="exampleInputPassword1">Pickup Point</label>
                                                <select class="form-control" name="pickup_point_id">
                                                  @foreach($pickup_points as $row)
                                                    <option  @if($product->pickup_point_id==$row->id) selected="" @endif  value="{{ $row->id }}">{{ $row->pickup_point_name  }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label for="purchase_price">Purchase Price</label><span class="text-danger">
                                                    *</span>
                                                <input type="text" class="form-control" value="{{$product->purchase_price}}" name="purchase_price"
                                                    value="">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="selling_price">Selling Price</label><span class="text-danger">
                                                    *</span>
                                                <input type="text" class="form-control" name="selling_price"
                                                    value="{{$product->selling_price}}">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="discount_price">Discount Price</label><span class="text-danger">
                                                    *</span>
                                                <input type="text" class="form-control" name="discount_price"
                                                    value="{{$product->discount_price}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="unit">Unit</label><span class="text-danger">
                                                    *</span>
                                                <input type="text" class="form-control" name="unit"
                                                    value=" {{$product->unit}}">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="tags" data-role="tagsinput">Tags</label><span class="text-danger">
                                                    *</span>
                                                <input type="tags"  value="{{$product->tags}}" class="form-control" name="tags"
                                                value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="warehouses">Warehouse</label><span class="text-danger"> *</span>
                                                <select class="form-control" name="warehouse" id="">
                                                    @foreach ($warehouses as $row)
                                                        <option value="{{ $row->id }}">{{ $row->warehouse_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="stock">Stock</label><span class="text-danger"> *</span>
                                                <input type="text" class="form-control" name="stock"
                                                    value="{{$product->stock_quantity}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="color" data-role="tagsinput" >Color</label><span class="text-danger"> *</span>
                                                <input type="text" value="{{$product->color}}" class="form-control" name="color"
                                                    value="">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="size">Size</label><span class="text-danger"> *</span>
                                                <input type="text" value="{{$product->size}}" class="form-control" name="size"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="description">Description</label><span class="text-danger">
                                                    *</span>
                                                <textarea class="form-control textarea" name="description">{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="video">Video</label><span class="text-danger">
                                                    *</span>
                                                <textarea  class="form-control" name="video">{{$product->video}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <img src="{{asset($product->thumbnail)}}" style="height: 50px; width:50px;">
                                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                                    <input type="file" name="main_thumbnail"  accept="image/*" class="dropify">
                                    <input type="hidden" name="old_thumbnail" value="{{ $product->thumbnail }}" >
                                </div>
                                <div class="">
                                    <table class="table table-bordered" id="dynamic_field">
                                        <div class="card-header">
                                            <h3 class="card-title">More Images (Click Add For More Image)</h3>
                                        </div>
                                        <tr>
                                            @php
                                            $images = json_decode($product->images,true);
                                         @endphp
                                         @if(!$images)
                                         @else
                                         <div class="row" >
                                          @foreach($images as $key => $image)
                                            <div class="col-md-4" >
                                               <img alt="" src="{{asset('backend/files/products/' .$image)}}" style="width: 100px; height: 80px; padding: 10px;"/>
                                               <input type="hidden" name="old_images[]" value="{{ $image }}">
                                               <button type="button" class="remove-files" style="border: none;">X</button>
                                            </div>
                                          @endforeach
                                          </div>
                                         @endif
                                            <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="switch-boxes">
                                    <div class="card p-4">
                                        <h6>Featured Product</h6>
                                        <input type="checkbox" id="chkToggle" value="1" name="featured" checked data-toggle="toggle" data-width="100" data-height="30" data-onstyle="secondary" data-offstyle="success">
                                    </div>
                                    <div class="card p-4">
                                        <h6>Today Deal</h6>
                                        <input type="checkbox" id="chkToggle" value="1" name="today_deal" checked data-toggle="toggle" data-width="100" data-height="30" data-onstyle="secondary" data-offstyle="success">
                                    </div>
                                    <div class="card p-4">
                                        <h6>Product Slider</h6>
                                        <input type="checkbox" id="chkToggle" value="1" name="product_slider" checked data-toggle="toggle" data-width="100" data-height="30" data-onstyle="secondary" data-offstyle="success">
                                    </div>
                                    <div class="card p-4">
                                        <h6>Status</h6>
                                        <input type="checkbox" value="1" name="status" id="chkToggle" checked data-toggle="toggle" data-width="100" data-height="30" data-onstyle="secondary" data-offstyle="success">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script>
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('input[name=tags]');
    var input1 = document.querySelector('input[name=color]');
    var input2 = document.querySelector('input[name=size]');
    // initialize Tagify on the above input node reference
    new Tagify(input)
    new Tagify(input1)
    new Tagify(input2)
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script>
        $('.dropify').dropify();

        $(function(){
          $('#chkToggle').bootstrapToggle();
        });
      </script>
    <script>
        

        
    $(document).ready(function(){      
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;  


       $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       });  

       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
       });  
     }); 

    //getting childcategory using subcategory_id
     $('#subcategory_id').change(function(){
        var id = $(this).val();
        $.ajax({
            url:"{{url("/get-child-category/")}}/"+id,
            type:'get',
            success: function(data){
                $('select[name="childcategory_id"]').empty();
                   $.each(data, function(key,data){
                      $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
                });
                    
            }
        });
     });


      
    //edit product imahe remove by cros btn
    $('.remove-files').on('click', function(){
         $(this).parents(".col-md-4").remove();
     });


    </script>
    


@endsection
