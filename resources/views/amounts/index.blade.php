@extends('layouts.master')

@section('css')
@endsection

@section('title')
    Amounts Management
@stop

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        Amounts Management
    @stop
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row  mt-4">
        @if ($errors->any())
            <div class="alert alert-danger w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-xl-12 mb-30 ">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg d-block w-100 bold  add-btn mb-4"
                            data-toggle="modal"
                            data-target="#addAmountModal">
                        Add New Amount
                    </button>

                    <div class="table-responsive">
                        <table id="amounts-table" class="table table-bordered table-hover">
                            <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>#</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Exchange Value</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($amounts as $amount)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $amount->currency }}</td>
                                    <td>{{ $amount->amount }}</td>
                                    <td>{{ $amount->exchange_value }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editAmountModal{{ $amount->id }}" title="Edit Amount">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteAmountModal{{ $amount->id }}" title="Delete Amount">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Amount Modal -->
                                <div class="modal fade" id="editAmountModal{{ $amount->id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="editAmountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAmountModalLabel">Edit Amount</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('amounts.update', $amount->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="currency">Currency:</label>
                                                        <select name="currency" id="currency" class="form-control">
                                                            @foreach(config('currency_rates') as $code => $name)
                                                                <option
                                                                    value="{{ $code }}" @selected( $amount->currency == $code ) >
                                                                    {{ $code  }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount:</label>
                                                        <input type="number" name="amount" id="amount"
                                                               class="form-control" value="{{ $amount->amount }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exchange_value">Exchange Value:</label>
                                                        <input type="text" name="exchange_value" id="exchange_value"
                                                               class="form-control"
                                                               value="{{ $amount->exchange_value }}">
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

                                <!-- Delete Amount Modal -->
                                <div class="modal fade" id="deleteAmountModal{{ $amount->id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="deleteAmountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteAmountModalLabel">Delete Amount</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('amounts.destroy', $amount->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>Are you sure you want to delete this amount for
                                                        currency {{ $amount->currency }}?</p>
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
                        {{$amounts->links()}}
                    </div>

                    <!-- Add Amount Modal -->
                    <div class="modal fade" id="addAmountModal" tabindex="-1" role="dialog"
                         aria-labelledby="addAmountModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addAmountModalLabel">Add New Amount</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('amounts.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="new_currency">Currency:</label>


                                            <select name="currency" id="new_currency" class="form-control" required>
                                                @foreach(config('currency_rates') as $code => $name)
                                                    <option value="{{ $code }}">{{ $code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_amount">Amount Of Currency That you Selected:</label>
                                            <input type="number" name="amount" id="new_amount" class="form-control"
                                                   required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-success">Add Amount</button>
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
