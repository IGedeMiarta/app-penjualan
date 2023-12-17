@extends('dashboard.partials.app')
@push('style')
    <!-- page css -->
    <link href="{{ asset('app') }}/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .bg-grey {
            background-color: #c0c5ce
        }
    </style>
@endpush
@section('content')
    @php
        $filter = $_GET['filter'] ?? 'all';
    @endphp
    <div class="card">
        <div class="card-body">
            <h4>All {{ $title ?? '' }}</h4>
            <hr>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Filer By:</label>
                    <select name="" id="filter" class="form-control">
                        <option value="all" @if ($filter == 'all') selected @endif>All</option>
                        <option value="daily" @if ($filter == 'daily') selected @endif>Daily</option>
                        <option value="weekly" @if ($filter == 'weekly') selected @endif>Weekly</option>
                        <option value="year" @if ($filter == 'year') selected @endif>Year</option>
                    </select>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">

                </div>

            </div>
            <hr>
            <div class="table-responsive ">
                <table id="data-table" class="table nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>TRX</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($table as $t)
                            <tr>
                                <td><button class="btn btn-info btn-sm btnUpdate" data-id="{{ $t->id }}"
                                        data-info="{{ $t->info }}" data-status="{{ $t->status }}"
                                        data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit"></i></button>
                                </td>
                                <td>{!! $t->status() !!}</td>
                                <td><a href="{{ url('invoice/' . $t->Invoice) }}" target="_blank">{{ $t->Invoice }}</a>
                                    <br>
                                    <span style="color: gray"> {{ dt($t->created_at) }}</span>
                                </td>
                                <td>{{ $t->customers->name }}</td>
                                <td>{{ nb($t->amount) }}</td>
                                <td>
                                    <ul class="list-group">
                                        <table class="table table-bordered">
                                            @foreach ($t->details as $d)
                                                <tr>
                                                    <td>{{ $d->product->product_name }}.</td>
                                                    <td>{{ $d->qty }}</td>
                                                    <td>{{ '@' . nb($d->price) }}</td>
                                                    <td>{{ nb($d->total) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </ul>
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update {{ $title ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formUpdate">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Notes <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea name="info" class="form-control" id="info" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Payment Status<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2-tags form-select form-control" name="status" id="status">
                                    <option disabled>- Select Payment Status</option>
                                    <option value="1">WAIT FOR PAYMENT</option>
                                    <option value="2">PAYMENT APPROVE</option>
                                    <option value="3">PAYMENT REJECT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- page js -->
    <script src="{{ asset('app') }}/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('app') }}/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $('#data-table').DataTable();
        $('#filter').on('change', function(e) {
            const filter = $(this).val();
            const url = "{{ Request::url() }}?filter=" + filter;
            window.location.href = url;
        })
        $('.btnUpdate').on('click', function(e) {
            const id = $(this).data('id');
            const url = `{{ url('admin/transaction/${id}') }}`;
            $('#info').val($(this).data('info'))
            $('#status').val($(this).data('status'))
            $('#formUpdate').attr('action', url);
        })
    </script>
@endpush
