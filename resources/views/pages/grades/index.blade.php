@extends('layouts.master')
@section('css')
@section('title')
    المراحل الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    المراحل الدراسية
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-header">
                            <h5 class="card-title mb-0">المراحل الدراسية</h5>
                        </div>
                        <button type="button" class="btn btn-primary add-btn" data-toggle="modal"
                            data-target="#exampleModal">
                            اضافة مرحلة جديدة
                        </button>
                        <div class="card-body">
                            <div class="table-responsive table-dark">
                                <table id="buttons-datatables" class="display table table-bordered">
                                    <thead class="bg-info-subtle" style="text-align: center">
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المرحلة</th>
                                            <th>ملاحظات</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($grades as $grade)
                                            <tr style="text-align: center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $grade->name }}</td>
                                                <td>{{ $grade->notes }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-toggle="modal" data-target="#edit{{ $grade->id }}"
                                                        title=" تعديل المرحلة"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal" data-target="#delete{{ $grade->id }}"
                                                        title="حذف المرحلة"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <!-- edit_modal_Grade -->
                                            <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                تعديل المرحلة
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <form action="{{ route('grades.update', $grade->id) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="Name" class="mr-sm-2"
                                                                            style="color: black">اسم
                                                                            المرحلة
                                                                            :</label>
                                                                        <input id="name" type="text"
                                                                            name="name" class="form-control"
                                                                            value="{{ $grade->name }}" required>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlTextarea1"
                                                                        style="color: black">ملاحظات
                                                                        :</label>
                                                                    <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes }}</textarea>
                                                                </div>
                                                                <br><br>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">الغاء العملية</button>
                                                                    <button type="submit" class="btn btn-success">تعديل
                                                                        المرحلة </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete_modal_Grade -->
                                            <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="exampleModalLabel">
                                                                حذف المرحلة
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('grades.destroy', $grade->id) }}"
                                                                method="post">
                                                                {{ method_field('Delete') }}
                                                                @csrf
                                                                <span style="color: black">
                                                                    هل انت متاكد من حذف هذه المرحلة :
                                                                    {{ $grade->name }}
                                                                </span>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $grade->id }}">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">الغاء العملية</button>
                                                                    <button type="submit" class="btn btn-danger">حذف
                                                                        المرحلة</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- add_modal_Grade -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            اضافة المرحلة
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form action="{{ route('grades.store') }}" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="name" class="mr-sm-2"
                                                                        style="color: black">اسم
                                                                        المرحلة
                                                                        :</label>
                                                                    <input id="name" type="text"
                                                                        name="name" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1"
                                                                    style="color: black">ملاحظات
                                                                    :</label>
                                                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                            <br><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">الغاء العملية</button>
                                                        <button type="submit" class="btn btn-success">اضافة
                                                            المرحلة</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        @endsection
        @section('script')

        @endsection
