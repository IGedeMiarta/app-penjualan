@extends('dashboard.partials.app');
@push('style')
    <!-- page css -->
    <link href="{{ asset('app') }}/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- dropify -->
    <link rel="stylesheet" href="{{ asset('dropify/css/dropify.css') }}">
@endpush
@section('content')
    <button class="btn btn-success mb-3 text-end" data-toggle="modal" data-target="#modalAdd"><i
            class="anticon anticon-plus-square mr-2"></i>Add
        {{ $title }}</button>
    <div class="card">
        <div class="card-body">
            <h4>All {{ $title ?? '' }}</h4>
            <div>
                <div class="table-responsive">
                    <table id="data-table" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Tags</th>
                                <th>Created At</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($table as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $t->product_name }}</td>
                                    <td>{{ $t->category->category_name }}</td>
                                    <td>Rp {{ number_format($t->price, 0, '.', ',') }}</td>
                                    <td>{!! $t->tags() !!}</td>
                                    <td>{{ $t->created_at->diffForHumans() }}</td>
                                    <td class="text-end">
                                        <form action="/tags/{{ $t->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-info btn-sm mb-2"><i
                                                    class="anticon anticon-eye  mr-2"></i>See</button>
                                            <button class="btn btn-warning btn-sm btnEdit mb-2"
                                                data-id="{{ $t->id }}" data-name="{{ $t->tag_name }}"><i
                                                    class="anticon anticon-edit mr-2"></i>
                                                Edit</button>
                                            <button type="submit" class="btn btn-danger btn-sm mb-2"><i
                                                    class="anticon anticon-delete mr-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add-->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="product_name" placeholder="tags name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="select2 form-select" name="category">
                                    <option selected disabled>- Select Category</option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="numbers" class="form-control inpNumber" name="price" placeholder="00,000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Desciption</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Images
                                <button type="button"
                                    class="btn btn-info d-flex justify-content-center mt-2 btnAddDropify"><i
                                        class="anticon anticon-plus-square"></i></button>
                            </label>
                            <div class="col-sm-10" id="dropImage">
                                <input type="file" class="dropify" name="images[]" data-height="100" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Tags</label>
                            <div class="col-sm-10">
                                <select class="select2-tags form-select" id="tags" name="tags[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit-->
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="" method="POST" id="updateForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="category name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
    {{-- select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- dropify --}}
    <script src="{{ asset('dropify/js/dropify.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $('.select2').select2({
                theme: 'bootstrap-5'
            });
            $('#tags').select2({
                tags: true,
                theme: 'bootstrap-5'
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to add commas as a separator to the input value
            function addCommas(input) {
                return input.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Function to remove commas from the input value
            function removeCommas(input) {
                return input.replace(/,/g, '');
            }

            // Event listener for input changes
            $('.inpNumber').on('input', function() {
                // Get the input value without commas
                var inputValue = removeCommas($(this).val());

                // Add commas to the input value
                var formattedValue = addCommas(inputValue);

                // Set the formatted value back to the input
                $(this).val(formattedValue);
            });
        });
    </script>
    <script>
        $('#data-table').DataTable();
        $('.btnEdit').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const name = $(this).data('name');

            $('#modalEdit').modal('show');
            $('#name').val(name);
            $('#updateForm').attr('action', `/tags/${id}`);
        })
        $('.btnAddDropify').on('click', function(e) {
            e.preventDefault();
            var newDropifyInput = $('<input>', {
                type: 'file',
                class: 'dropify',
                name: 'images[]',
                'data-height': 100
            });

            const html =
                // ` <div class="col-md-4">${newDropifyInput}</div>`;
                $('#dropImage').append(newDropifyInput);
            newDropifyInput.dropify();
        })
    </script>
@endpush
