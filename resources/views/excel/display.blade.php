<html lang="en">
<head>
    <title> diplay data</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
       <link href=" https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
      <body>
         <div class="container">

               <h2>Imported data</h2>
               <div align="center">
               <button type="button" name="add" id="add_data" class="btn btn-success btn-lg">Add New Data</button>
               </div>
               <table class="table table-bordered" id="table">
                  <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>faculty</th>
                        <th>subject</th>
                        <th>total_marks</th>
                        <th>obtained_marks</th>
                        <th>remarks</th>
                        <th>Action</th>
                  </thead>
               </table>
         </div>
         <div id="studentModal" class="modal fade" role="dialog">
                 <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" id="student_form">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                               <h4 class="modal-title">Add Data</h4>
                             </div>
                            <div class="modal-body">
                                {{csrf_field()}}
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <label>Enter Name</label>
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Enter faculty</label>
                                    <input type="text" name="faculty" id="faculty" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Enter subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Enter total_marks</label>
                                    <input type="text" name="total_marks" id="total_marks" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Enter obtained_marks</label>
                                    <input type="text" name="obtained_marks" id="obtained_marks" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Enter remarks</label>
                                    <input type="text" name="remarks" id="remarks" class="form-control"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="button_action" id="button_action" value="insert" />
                                <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                  </div>
                 </div>
               </div>

       <script>
            $(document).ready(function() {
                  $('#table').DataTable({
                     processing: true,
                     serverSide: true,
                     lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
                     ajax: '{{ url('getdata') }}',
                     columns: [
                              { data: 'id'},
                              { data: 'name' },
                              { data: 'faculty'},
                              { data: 'subject'},
                              { data: 'total_marks'},
                              { data: 'obtained_marks'},
                              { data: 'remarks'},
                              { data: 'action'}
                              ]
                  });
         $('#add_data').click(function(){
         //window.alert(5 + 6);
         $('#studentModal').modal('show');
        $('#student_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#action').val('Add');
    });

    $('#student_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ route('ajaxdata.postdata') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                if(data.error.length > 0)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#form_output').html(error_html);
                }
                else
                {
                    $('#form_output').html(data.success);
                    $('#student_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert');
                    $('#student_table').DataTable().ajax.reload();
                }
            }
        })
    });

            });
       </script>
   </body>
</html>
