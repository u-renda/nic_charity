<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">User - Lists</div>
            </div>
            <div class="form-header">
                <form role="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="user_create" role="button">Tambah Penyumbang</a>
								<a class="btn bg-red-google" href="barang_create_many" role="button">Tambah Barang</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="portlet-body">
                <div id="multipleSort"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function ()
{
    $('.delete').live("click",function() {
        var id = $(this).attr("id");
        var dataString = 'id='+ id +'&action=user_delete'
        $.ajax(
        {
            type: "POST",
            url: 'user_delete',
            data: dataString, 
            cache: false,
			beforeSend: function()
			{
				$('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
			},
			success: function(data)
			{
				$('.'+id+'-delete').html('<i class="fa fa-times fg-color-red fg-font19"></i>');
				$('.modal-dialog').removeClass('modal-lg');
				$('.modal-dialog').addClass('modal-sm');
                $('.modal-title').text('Confirm Delete');
				$('.modal-body').html(data);
				$('#myModal').modal('show');
            }
        });
        return false;
    });
	
	$("#multipleSort").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: "user_get",
                    dataType: "json",
                    type: "POST",
					data: {
                        dropbox : $('#dropbox').val(),
                        user_gender : $('#user_gender').val()
                    }
                }
            },
            schema: {
                data: "results",
                total: "total"
            },
            pageSize: 20,
            serverPaging: true,
            serverSorting: true,
			serverFiltering: true,
            cache: false
        },
        sortable: {
            mode: "single",
            allowUnsort: true
        },
        pageable: {
            buttonCount: 5,
            input: true,
            pageSizes: true,
            refresh: true
        },
        filterable: {
            extra: false,
            operators: {
                string: {
                    contains: "Mengandung kata"
                }
            }
        },
        selectable: "row",
		resizable: true,
        columns: [{
            field: "no",
            title: "No",
            sortable: false,
            filterable: false,
            width: 60
        },
        {
            field: "username",
            title: "Name"
        },
        {
            field: "action",
            title: "Action",
            sortable: false,
            filterable: false,
            width: 100,
            template: "#= data.action #"
        }]
    });
});
</script>