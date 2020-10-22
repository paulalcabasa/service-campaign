@extends('layout.template')

@section('page-title','Inquiries')
@section('content')
<!-- Basic table -->
<div id="app">    
    <div class="card">
        <div class="card-body">
            <table class="table" id="list">
                <thead>
                    <tr>
                        <th>Inquiry No.</th>
                        <th>Registered owner</th>
                        <th>Contact person</th>
                        <th>Contact number</th>
                        <th>Email</th>
                        <th>CS No.</th>
                        <th>Engine No.</th>
                        <th>VIN</th>
                        <th>Selling dealer</th>
                        <th>Preferred selling dealer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in inquiries">
                        <td>@{{ row.id }}</td>
                        <td>@{{ row.registered_owner }}</td>
                        <td>@{{ row.contact_person }}</td>
                        <td>@{{ row.contact_number }}</td>
                        <td>@{{ row.email_address }}</td>
                        <td>@{{ row.cs_no }}</td>
                        <td>@{{ row.engine_no }}</td>
                        <td>@{{ row.vin }}</td>
                        <td>@{{ row.selling_dealer }}</td>
                        <td>@{{ row.preferred_servicing_dealer }}</td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
</div>
<!-- /basic table -->

<!-- /form layouts -->
@stop

@push('scripts')
<script>

    
     // Defaults
    var swalInit = swal.mixin({
        buttonsStyling: false,
        confirmButtonClass: 'btn btn-primary',
        cancelButtonClass: 'btn btn-light'
    });

     var DatatableButtonsHtml5 = function() {


        //
        // Setup module components
        //

        // Basic Datatable examples
        var _componentDatatableButtonsHtml5 = function() {
            if (!$().DataTable) {
                console.warn('Warning - datatables.min.js is not loaded.');
                return;
            }

            // Setting datatable defaults
            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                }
            });


            // Basic initialization
            $('#list').DataTable({
                buttons: {            
                    dom: {
                        button: {
                            className: 'btn btn-light'
                        }
                    },
                 
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-light',
                            title: 'Inquiries'
                        }
                    ],
                },
                scrollX : true
            });

        };

        // Select2 for length menu styling
        var _componentSelect2 = function() {
            if (!$().select2) {
                console.warn('Warning - select2.min.js is not loaded.');
                return;
            }

            // Initialize
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: 'auto'
            });
        };


        //
        // Return objects assigned to module
        //

        return {
            init: function() {
                _componentDatatableButtonsHtml5();
                _componentSelect2();
            }
        }
    }();

        // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function() {
        DatatableButtonsHtml5.init();
    });




    var vm =  new Vue({
        el : "#app",
        data: {
            inquiries : {!! json_encode($inquiries) !!},
        },
        created: function () {
            
        },
        mounted : function () {
           // Initialize plugin
           
        },
        methods :{
        
        }

    });

</script>
@endpush