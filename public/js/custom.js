/* let table = new DataTable('#customerTable');
 */
function baseUrl(){
    return location.protocol + "//" + location.host + "";
    /* http://127.0.0.1:8000 */
}
new DataTable('#customerTable', {
    ajax: baseUrl()+'/customers/list',
    processing: true,
    serverSide: true,
    columnDefs: [
        { targets: '_all', visible: true},
    ],
    columns: [
        {
            data: 'customer_id',
            name: 'customer_id',
            title: 'ID'
        },
        {
            data: 'first_name',
            name: 'first_name',
            title: 'First Name'
        },
        {
            data: 'last_name',
            name: 'last_name',
            title: 'Last Name'
        },
        {
            data: 'email',
            name: 'email',
            title: 'Email'
        },
        {
            data: 'phone',
            name: 'phone',
            title: 'Phone'
        },
        {
            data: 'address',
            name: 'address',
            title: 'Address'
        },
        {
            data: null,
            title: 'Actions',
            sortable:false,
            render: function(data, type, row) {
                    return `
                    <div id="table-action">

                            <a href="javascript:void(0)" class="table-action editCustomerModal" title="Edit Data" data-id="${data.customer_id}" data-fname="${data.first_name}" data-lname="${data.last_name}" data-modal-target="crud-modal" data-modal-toggle="crud-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>


                    </div>
                    `;

            }
        }


    ]
});
$('#customerTable').on('click', '.editCustomerModal', function() {
    $('#fname').val($(this)[0].getAttribute('data-fname'));
    $('#lname').val($(this)[0].getAttribute('data-lname'));
    $('#id').val($(this)[0].getAttribute('data-id'));
    $('#name').text($(this)[0].getAttribute('data-fname')+" "+$(this)[0].getAttribute('data-lname'));


    showModal();
});
$('.close-modal').on('click',function(){
    hideModal();
})

const openBtn = document.getElementById('open-modal');
const modal = document.getElementById('crud-modal');
const backdrop = document.getElementById('modal-backdrop');

// Function to show modal and backdrop
function showModal() {
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  backdrop.classList.remove('hidden');
}

// Function to hide modal and backdrop
function hideModal() {
  modal.classList.add('hidden');
  modal.classList.remove('flex');
  backdrop.classList.add('hidden');
}


$("#updateCustomer").click(function(){
    $("#updateCustomerForm").submit();
});
$("#updateCustomerForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type:'post',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:  baseUrl()+'/customer/update',
        data:{
            id: $('#id').val(),
            fname: $('#fname').val(),
            lname: $('#lname').val(),
        },
        success:function(response){
            if (response.status === 'success') {
                alert(response.message);
                // Optionally update table or UI here
            }
        }, error:function(err){
            console.log(err);

        }
    });
});


new DataTable('#accountTable', {
    ajax: baseUrl()+'/accounts/list',
    processing: true,
    serverSide: true,
    columnDefs: [
        { targets: '_all', visible: true},
    ],
    columns: [
        {
            data: 'account_id',
            name: 'account_id',
            title: 'ID'
        },
        {
            data: 'first_name',
            name: 'first_name',
            title: 'First Name'
        },
        {
            data: 'last_name',
            name: 'last_name',
            title: 'Last Name'
        },
        {
            data: 'branch_name',
            name: 'branch_name',
            title: 'Branch'
        },
        {
            data: 'account_type',
            name: 'account_type',
            title: 'Account_type'
        },
        {
            data: 'balance',
            name: 'balance',
            title: 'Balance'
        },


    ]
});
