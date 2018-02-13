<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .pagination {
                
                margin:0;
                
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                   
                    <div id="todolist">
            
                    </div>
                    <div id="modals">
                        
                    </div>  
                </div>
            </div>
        </div>
        <!-- jQuery -->
          <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script type="text/javascript">
            $(function(){
                $.get('{{ URL::to("tasks")}}', function(data) {
                    $('#todolist').empty().append(data);
                });
                $('#todolist').on('click','#btnAddTask', function(){
                   $.get('{{ URL::to("todo/create")}}', function(data) {
                        $('#modals').empty().append(data);
                        $('#addTodoTask').modal('show');
                    });
                });
                $('#todolist').on('click','.btnManage', function(){
                    var id = $(this).data('task');
                   $.get('{{ URL::to("todo/edit")}}/'+id, function(data) {
                        $('#modals').empty().append(data);
                        $('#editTodoTask').modal('show');
                    });
                });
                $('#modals').on('click','#btnDelete', function(){
                    var id = $(this).data('task');
                   $.get('{{ URL::to("todo/destroy")}}/'+id, function(data) {
                       $('#todolist').empty().append(data);
                    });
                });
                $('#modals').on('submit','#frmAddTask', function(e){
                    e.preventDefault();
                    var frmData = $(this).serialize();
                    $.ajax({
                        url: '{{ URL::to("todo/save")}}',
                        type: 'POST',
                        data: frmData,
                    })
                    .done(function(data) {
                         $("#modals #errors").empty().append('<li class="alert alert-success">Task Added Successfully....</li>');
                        $('#todolist').empty().append(data);
                    })
                    .fail(function(error) {
                        var error = error.responseJSON;
                        $("#modals #errors").empty();
                        error.name.forEach(function(element, index){
                            $("#modals #errors").append('<li class="alert alert-danger">'+element+'</li>');
                        });
                        
                    });
                    
                });
                $('#modals').on('submit','#frmEditTask', function(e){
                    e.preventDefault();
                    var frmData = $(this).serialize();
                    $.post('{{ URL::to("todo/update")}}',frmData, function(data, xhrStatus, xhr){
                         $('#todolist').empty().append(data);
                    });
                });
                $("#todolist").on('click','.pagination a',function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                     $.get(url, function(data) {
                        $('#todolist').empty().append(data);
                    });
                });
                $('#todolist').on('keyup','#searchTodo', function(){
                    $(this).autocomplete({
                      source: "{{URL::to('todo/search')}}"
                    });
                })
                 
            });

        </script>
    </body>
</html>