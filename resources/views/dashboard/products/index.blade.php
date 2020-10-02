@extends('layouts.master')
@section('title')
    الاقسام
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / المنتجات ( {{\App\Models\Product::count()}} )</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@stop
@section('content')

    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8">اضافة منتج</a>
                        <!-- Start Modal Add  -->
                        <div class="modal" id="modaldemo8">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">اضافة قسم</h6>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('products.store')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">اسم المنتج</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">اسم القسم</p>
                                                <select class="form-control select2" name="section_id">
                                                    <option label="Choose one">
                                                    </option>
                                                    @forelse($sections as $section)
                                                        <option value="{{$section->id}}">
                                                            {{$section->name}}
                                                            @empty
                                                                --
                                                        </option>
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="name">الملاحظات ( اختياري )</label>
                                                <textarea type="text" rows="3" class="form-control" id="description"
                                                          name="description"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn ripple btn-secondary"
                                                        data-dismiss="modal" type="button">إلغاء
                                                </button>
                                                <button class="btn ripple btn-primary" type="submit">
                                                    تأكيد
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Modal Add  -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="text-align: center;" id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">تم الانشاء بواسطة</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $index=>$product)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->section->name}}</td>
                                    <td>{{$product->description ?? '--'}}</td>
                                    <td>{{$product->created_by}}</td>
                                    <td>
                                        <!-- Start Modal Edit -->
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-toggle="modal" href="#exampleModalCenter{{$product->id}}">
                                            <i class="las la-pen m-1"></i>تعديل
                                        </a>
                                        <div class="modal fade" id="exampleModalCenter{{$product->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"> تعديل
                                                            منتج {{$product->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('products.update', $product->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="name">اسم المنتج</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$product->name}}" id="name" name="name"
                                                                       required>
                                                            </div>
                                                            <div class="form-group">
                                                                <p class="mg-b-10">اسم القسم</p>
                                                                <select class="form-control select2" name="section_id" required>
                                                                    <option label="Choose one">
                                                                    </option>
                                                                    @forelse($sections as $section)
                                                                        <option value="{{$section->id}}" @if ($section->id == $product->section->id) selected @endif>
                                                                            {{$section->name}}
                                                                            @empty
                                                                                --
                                                                        </option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">الملاحظات ( اختياري )</label>
                                                                <textarea type="text" rows="3" class="form-control"
                                                                          id="description"
                                                                          name="description">{{$product->description}}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn ripple btn-secondary"
                                                                        data-dismiss="modal" type="button">إلغاء
                                                                </button>
                                                                <button class="btn ripple btn-primary" type="submit">
                                                                    تأكيد
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit -->


                                        <!-- Start Modal Delete -->
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-toggle="modal" href="#modaldemo9{{$product->id}}" title="حذف">
                                            <i class="las la-trash m-1"></i>حذف
                                        </a>
                                        <div class="modal fade" id="modaldemo9{{$product->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">حذف منتج ( {{$product->name}} )</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="text-align: right">هل انت متاكد من الحذف ؟؟</p>
                                                    </div>
                                                        <form action="{{route('products.destroy', $product->id)}}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-footer">
                                                                <button class="btn ripple btn-secondary"
                                                                        data-dismiss="modal" type="button">إلغاء
                                                                </button>
                                                                <button class="btn ripple btn-danger" type="submit">
                                                                    تأكيد
                                                                </button>
                                                            </div>
                                                        </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Delete -->
                                    </td>
                                </tr>
                            @empty
                                لا يوجد بيانات
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    @include('sweetalert::alert')
@stop
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
@endsection
