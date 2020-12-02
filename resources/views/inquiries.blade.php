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
                        <th>Action</th>
                        <th>Inquiry No.</th>
                        <th>Registered owner</th>
                        <th>Contact person</th>
                        <th>Contact number</th>
                        <th>Email</th>
                        <th>CS No.</th>
                        <th>Engine No.</th>
                        <th>VIN</th>
                        <th>Selling dealer</th>
                        <th>Preferred servicing dealer</th>
                        <th>Receiving manner</th>
                        <th>Completion Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in inquiries">
                        <td><a href="#" @click.prevent="updateData(row, index)"><i class="icon-pencil3"></i></a></td>
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
                        <td>@{{ row.receiving_manner == 'OTHERS' ? row.others : row.receiving_manner }}</td>
                        <td>@{{ (row.completion_date_display) }}</td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>

<!-- /basic table -->
 <!-- Modal with basic title -->
 <div id="data_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="font-weight-semibold modal-title">@{{ curInquiry.cs_no + ' |  ' + curInquiry.contact_person }}</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form action="#">
                    <div class="form-group">
                        <label class="d-block">Manner of Receive:</label>
                        <div class="form-check form-check-inline" v-for="(data, index) in mannerOfReceiveList">
                            <label class="form-check-label">
                                <input type="radio" :checked="data.name.trim() == form.mannerOfReceive.trim() ? 'checked' : ''" class="form-input-styled" name="receivingManner" v-model="form.mannerOfReceive" :value="data.name" data-fouc="">
                                    @{{ data.name  }}
                            </label>
                        </div>


                        <input v-if="form.mannerOfReceive == 'OTHERS'" type="text" placeholder="Others..." v-model="form.others" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label>Completion date</label>
                        <input type="date" class="form-control" placeholder="" v-model="form.completionDate"/>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn bg-primary" @click="update">Save</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /modal with basic title -->
<!-- /form layouts -->
</div>
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
            mannerOfReceiveList : [
                {
                    'name' : 'NEWSPAPER'
                },
                {
                    'name' : 'LETTER'
                },
                {
                    'name' : 'WEBSITE'
                },
                {
                    'name' : 'WALK-IN'
                },
                {
                    'name' : 'OTHERS'
                }
            ],
            form : {
                mannerOfReceive : '',
                completionDate : '',
                inquiryId : '',
                others : ''
            },
            curInquiry : '',
            curIndex : ''
        },
        created: function () {
            
        },
        mounted : function () {
           // Initialize plugin
           
        },
        methods :{
            updateData(inquiry, index){
                this.curInquiry = inquiry;
                this.curIndex = index;
                this.form.inquiryId = inquiry.id;
                this.form.mannerOfReceive = inquiry.receiving_manner;
                this.form.others = inquiry.others;
                this.form.completionDate = inquiry.completion_date;
                $('.form-input-styled').uniform();
                $("#data_modal").modal('show');

            },
            update(){
                this.inquiries[this.curIndex].receiving_manner = this.form.mannerOfReceive;
                this.inquiries[this.curIndex].others = this.form.others;
                this.inquiries[this.curIndex].completion_date = this.form.completionDate;
                axios.post('api/inquiry/update', this.form).then(res => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#data_modal").modal('hide');
                }).catch(err => {
                    alert("Error occured!, Please try again");
                    console.log(err);
                });
            },
        }

    });

</script>
@endpush