@extends('layouts.master')

@section('title', '建立投票')

@section('content')

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="container">
            <h2 align="center">新增投票</h2>  
            <div class="form-group">
                <form name="add_name" id="add_name" enctype="multipart/form-data">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                    </div>
                    <div class="alert alert-success print-success-msg" style="display:none">
                    <ul></ul>
                    </div>                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>
                                    <label for="title">投票主題 ：</label>
                                    <input type="text" placeholder="Title" name="title">
                                </td>
                                <td>
                                    <label for="category">投票種類 ：</label>
                                    <select name="category">
                                        @foreach ($categorys as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <label for="content">投票內文 ：</label>
                                    <textarea cols="50" rows="5" placeholder="Content" name="content"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="startdate">投票起始日期：</label>
                                    <input type="date" id="startdate" name="start">                                
                                </td>
                                <td>
                                    <label for="enddate">投票結束日期：</label>
                                    <input type="date" id="enddate" name="end">
                                </td>
                                <td>
                                    <label for="mainimage">主題圖片: </label>
                                    <input type="file" id="mainimage1" name="mainimage">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>投票選項：</label>                                
                                </td>
                            </tr>  
                            <tr>
                                <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td>
                                <td><input type="file" name="image[]" /></td>  
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                            </tr>  
                        </table>  
                        <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit"/>  
                    </div>
                </form>
                <h2 align="center">新增關於我們</h2>
                <form action='/about' method="POST">
                    {{csrf_field()}}
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <td>
                                <label for="route">網址路由 ：</label>
                                <input type="text" placeholder="Route" name="route"/>
                            </td>
                            <td>
                                <label for="title">關於我們主題 ：</label>
                                <input type="text" placeholder="Title" name="title"/>
                            </td>
                            <td>
                                <label for="content">關於我們內文 ：</label>
                                <textarea type="text" cols="50" rows="5" placeholder="Content" name="content"></textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" class="btn btn-info"> 
                </form>
            </div> 
        </div>        

        <script type="text/javascript">
            $(document).ready(function(){
                var postURL = "<?php echo url('votes'); ?>";                 
                var i=1;
                $('#add').click(function(){
                    i++;  
                    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="file" name="image[]" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
                });
                $(document).on('click', '.btn_remove', function(){  
                    var button_id = $(this).attr("id");   
                    $('#row'+button_id+'').remove();  
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#submit').click(function(){ 
                    var formData = new FormData($('#add_name')[0]);    
                    $.ajax({  
                        url:postURL,  
                        method:"POST",
                        data:formData,
                        type:'json',
                        cache: false,                        
                        contentType: false,
                        processData: false,
                        success:function(data)
                        {
                            if(data.error){
                                printErrorMsg(data.error);
                            }else{
                                i=1;
                                $('.dynamic-added').remove();
                                $('#add_name')[0].reset();
                                $(".print-success-msg").find("ul").html('');
                                $(".print-success-msg").css('display','block');
                                $(".print-error-msg").css('display','none');
                                $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                            }
                        }
                    });  
                }); 
                function printErrorMsg (msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $(".print-success-msg").css('display','none');
                    $.each( msg, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
            });  
        </script>
    </body>
</html>

@endsection