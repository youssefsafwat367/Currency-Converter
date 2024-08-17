@extends('layouts.master')

@section('css')

@endsection

@section('title')
    Currency Management
@stop
<br>
<br>
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        Currency Management
    @stop
    <!-- breadcrumb -->


@endsection

@section('content')
    <!-- row -->
    <div class="row mt-4">
        @if ($errors->any())
            <div class="alert alert-danger w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg d-block w-100 bold  add-btn mb-4" data-toggle="modal"
                            data-target="#addCurrencyModal">
                        Add New Currency
                    </button>
                    <div class="table-responsive">
                        <table id="currencies-table" class="table table-bordered table-hover">
                            <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>#</th>
                                <th>Currency Code</th>
                                <th>Exchange Rate</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($currencies as $currency => $rate)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $currency }}</td>
                                    <td>{{ $rate }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editCurrencyModal{{ $currency }}" title="Edit Currency">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteCurrencyModal{{ $currency }}"
                                                title="Delete Currency">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Currency Modal -->
                                <div class="modal fade" id="editCurrencyModal{{ $currency }}" tabindex="-1"
                                     role="dialog" aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCurrencyModalLabel">Edit Currency</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/currencies/' . $currency) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="currency-code">Currency Code:</label>
                                                        <input type="text" name="currency" id="currency-code"
                                                               class="form-control" value="{{ $currency }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exchange-rate">Exchange Rate:</label>
                                                        <input type="text" name="rate" id="exchange-rate"
                                                               class="form-control" value="{{ $rate }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-success">Save changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Currency Modal -->
                                <div class="modal fade" id="deleteCurrencyModal{{ $currency }}" tabindex="-1"
                                     role="dialog" aria-labelledby="deleteCurrencyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteCurrencyModalLabel">Delete
                                                    Currency</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/currencies/' . $currency) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>Are you sure you want to delete the currency {{ $currency }}?</p>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Currency Modal -->
                    <div class="modal fade" id="addCurrencyModal" tabindex="-1" role="dialog"
                         aria-labelledby="addCurrencyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCurrencyModalLabel">Add New Currency</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/currencies') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="new-currency-code">Currency Code:</label>
                                            <input type="text" name="currency" id="new-currency-code"
                                                   class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new-exchange-rate">Exchange Rate:</label>
                                            <input type="text" name="rate" id="new-exchange-rate" class="form-control"
                                                   required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-success">Add Currency</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('script')
    <!-- Add any additional JavaScript here -->
@endsection
