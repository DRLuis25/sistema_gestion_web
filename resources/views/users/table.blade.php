<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-striped table-hover ajaxTable datatable data-table" id="users-table">
            <thead>
                <tr>
                    <th style="color:white">x</th>
                    <th>@lang('models/users.fields.dni')</th>
                    <th>@lang('models/users.fields.lastNamePat')</th>
                    <th>@lang('models/users.fields.lastNameMat')</th>
                    <th>@lang('models/users.fields.names')</th>
                    <th>@lang('models/users.fields.email')</th>
                    <th>@lang('models/users.fields.role')</th>
                    <th width="100px">@lang('crud.action')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>
        $(function () {
            let table = $('.data-table').DataTable({
                responsive: true,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                select:true,
                columnDefs: [ {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0,
                    data: null,
                } ],
                select: {
                    style:    'multi',
                    selector: 'td:first-child'
                },
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',
                    'selectAll',
                    'selectNone',
                    'colvis',
                    {

                        extend: 'copyHtml5',
                        title: '',
                        text: 'Copiar',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                    return false;
                                return true;
                            }
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: '',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                    return false;
                                return true;
                            }
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: '',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                    return false;
                                return true;
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: '',
                        exportOptions: {
                            columns: function (idx, data, node) {
                                if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                    return false;
                                return true;
                            }
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        title: '',
                        exportOptions: {
                            columns: ':visible'/*
                            columns: function (idx, data, node) {
                                if (node.innerHTML == "x" || node.innerHTML == "Roles" || node.innerHTML == "Acciones" || node.hidden)
                                    return false;
                                return true;
                            }*/
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index')}}",
                columns: [
                    { "data":null, render:function(){return "";}},
                    { data: 'dni', name: 'dni'},
                    { data: 'lastNamePat', name: 'lastNamePat'},
                    { data: 'lastNameMat', name: 'lastNameMat'},
                    { data: 'names', name: 'names'},
                    { data: 'email', name: 'email'},
                    { data: 'rol', name: 'rol'},
                    { data: 'action', name: 'Action', orderable: false, searchable: false},
                ],
                orderCellsTop: true,
                order: [[ 2, 'asc' ]],
                pageLength: 10,
            });
        })
    </script>
@endpush
