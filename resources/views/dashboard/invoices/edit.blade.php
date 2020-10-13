@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet"/>
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{route('invoices.update', $invoice->id)}}" method="POST" enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'invoice_number' @endphp
                                    <label for="inputName" class="control-label">رقم الفاتورة</label>
                                    <input type="text" class="form-control @error($input) is-invalid @enderror" id="inputName" name="{{$input}}" value="{{$invoice->$input}}" title="يرجي ادخال رقم الفاتورة">
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'invoice_date' @endphp
                                    <label>تاريخ الفاتورة</label>
                                    <input class="form-control fc-datepicker @error($input) is-invalid @enderror" name="invoice_date" value="{{$invoice->$input}}" placeholder="YYYY-MM-DD" type="text" >
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'due_date' @endphp
                                    <label>تاريخ الاستحقاق</label>
                                    <input class="form-control fc-datepicker @error($input) is-invalid @enderror" name="due_date" value="{{$invoice->$input}}" placeholder="YYYY-MM-DD" type="text" >
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">القسم</label>
                                    <select name="section_id" id="section" class="form-control SlectBox"
                                            onclick="console.log($(this).val())"
                                            onchange="console.log('change is firing')">
                                        <!--placeholder-->
                                        <option value="" selected disabled>حدد القسم</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}" @if($invoice->section->id == $section->id) selected @endif> {{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'product' @endphp
                                    <label for="inputName" class="control-label">المنتج</label>
                                    <select id="product" name="product" class="form-control @error($input) is-invalid @enderror">
                                        <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                    </select>
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'amount_collection' @endphp
                                    <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                    <input type="text" class="form-control @error($input) is-invalid @enderror" value="{{$invoice->$input}}" id="inputName" name="amount_collection" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'amount_commission' @endphp
                                    <label for="inputName" class="control-label">مبلغ العمولة</label>
                                    <input type="text" class="form-control form-control-lg @error($input) is-invalid @enderror" value="{{$invoice->$input}}" id="Amount_Commission" name="amount_commission" title="يرجي ادخال مبلغ العمولة " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">الخصم</label>
                                    <input type="text" class="form-control form-control-lg" id="discount" value="{{$invoice->$input ?? 0}}" name="discount" title="يرجي ادخال مبلغ الخصم " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    @php $input = 'rate_vat' @endphp
                                    <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                    <select name="rate_vat" id="rate_vat" class="form-control @error($input) is-invalid @enderror" onchange="myFunction()">
                                        <!--placeholder-->
                                        <option value="" selected disabled>حدد نسبة الضريبة</option>
                                        <option value="5%"  {{$invoice->rate_vat == '5%' ? 'selected' : ''}}>5%</option>
                                        <option value="10%" {{$invoice->rate_vat == '10%' ? 'selected' : ''}}>10%</option>
                                        <option value="15%" {{$invoice->rate_vat == '15%' ? 'selected' : ''}}>15%</option>
                                        <option value="20%" {{$invoice->rate_vat == '20%' ? 'selected' : ''}}>20%</option>
                                    </select>
                                    @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    @php $input = 'value_vat' @endphp
                                    <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                    <input type="text" class="form-control" value="{{$invoice->$input}}" id="value_vat" name="value_vat" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @php $input = 'total' @endphp
                                    <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                    <input type="text" class="form-control" value="{{$invoice->$input}}" id="total" name="total" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    @php $input = 'note' @endphp
                                    <label for="exampleTextarea">ملاحظات</label>
                                    <textarea class="form-control" id="exampleTextarea" name="note" rows="6">{{$invoice->$input}}</textarea>
                                </div>
                            </div>
                        </div>

                        <br>

                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                   data-height="70"/>
                        </div>
                        <br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function () {
            $('select[id="section"]').on('change', function () {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="product"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>


    <script>

        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var discount = parseFloat(document.getElementById("discount").value);
            var rate_vat = parseFloat(document.getElementById("rate_vat").value);
            var value_vat = parseFloat(document.getElementById("value_vat").value);

            var Amount_Commission2 = Amount_Commission - discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * rate_vat / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("value_vat").value = sumq;

                document.getElementById("total").value = sumt;

            }

        }

    </script>


@endsection
