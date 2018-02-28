@extends('forms.forminclude')

@section('form')

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Vote" />
    <meta property="og:description" content="Your description" />
    <meta property="og:image" content="url({!! asset('/upload_img/'.$vote->image) !!})" />
    <meta property="fb:admins" content="100001167213643"/>
    <meta property="fb:app_id" content="190730861515668"/>
</head>

<style>
    // The code is a bit of a mess at the moment! Sorry about that.

    body {
      padding: 1rem;
      color: hsla(215, 5%, 50%, 1);
    }
    h1 {
      color: hsla(215, 5%, 10%, 1);
      margin-bottom: 2rem;
    }
    section {
      display: flex;
      flex-flow: row wrap;
    }
    section > div {
      flex: 1;
      padding: 0.5rem;
    }
    input[type="radio"] {
      display: none;
      &:not(:disabled) ~ label {
        cursor: pointer;
      }
      &:disabled ~ label {
        color: hsla(150, 5%, 75%, 1);
        border-color: hsla(150, 5%, 75%, 1);
        box-shadow: none;
        cursor: not-allowed;
      }
    }
    label {
      //height: 100%;
      display: block;
      background: white;
      border: 2px solid hsla(150, 75%, 50%, 1);
      border-radius: 20px;
      padding: 1rem;
      margin-bottom: 1rem;
      //margin: 1rem;
      text-align: center;
      box-shadow: 0px 3px 10px -2px hsla(150, 5%, 65%, 0.5);
      position: relative;
    }
    input[type="radio"]:checked + label {
      background: hsla(150, 75%, 50%, 1);
      color: hsla(215, 0%, 100%, 1);
      box-shadow: 0px 0px 20px hsla(150, 100%, 50%, 0.75);
      &::after {
        color: hsla(215, 5%, 25%, 1);
        font-family: FontAwesome;
        border: 2px solid hsla(150, 75%, 45%, 1);
        content: "\f00c";
        font-size: 24px;
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        height: 50px;
        width: 50px;
        line-height: 50px;
        text-align: center;
        border-radius: 50%;
        background: white;
        box-shadow: 0px 2px 5px -2px hsla(0, 0%, 0%, 0.25);
      }
    }
    input[type="radio"]#control_05:checked + label {
      background: red;
      border-color: red;
    }
    p {
      font-weight: 900;
    }
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 12px;
    }
    
    
    @media only screen and (max-width: 700px) {
      section {
        flex-direction: column;
      }
    }
</style>

<?php
    use Carbon\Carbon;
    $totalticket = 0;
    foreach( $choices as $choice)
        $totalticket += $choice->ticket;
    if($totalticket==0)
        $totalticket = 1;
?>
<div class="limiter">
    <div class="container-login100" style="background-image: url({!! asset('/upload_img/'.$vote->image) !!});">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="box-shadow:4px 4px 12px 4px rgba(20%,20%,40%,0.5);">
            @if($vote->end>Carbon::now())
                <h1 style="">{{$vote->title}} ( 截止時間 : {{$vote->end}})</h1>
            @else
                <h1 style="">{{$vote->title}} ( 已截止 )</h1>
            @endif
            <div class="fb-like" data-href="{{Request::url()}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            <input class="button" type="button" style="background-color:red" value="{{$cate->name}}"></input>
            <p id="fullcontent" style="height:20px; overflow:hidden;">{{$vote->content}}</p>
            <div style="text-align:right;">                
                <input class="button" type="button" id="show" value="顯示全文"></input>
            </div>
            <form name="vote_form" id="vote_form">           
                <section>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                    </div>
                    <div class="alert alert-success print-success-msg" style="display:none">
                    <ul></ul>
                    </div>
                    @foreach( $choices as $key => $choice)  
                        <div>
                            <input type="radio" id="control_0{{$key*2}}" name="select" value="{{$choice->id}}" class="choice" checked>
                            <label for="control_0{{$key*2}}">
                                <h2>{{$choice->name}}</h2>
                                <div class="progress" style="height:10px;">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                    aria-valuenow="{{(($choice->ticket)/$totalticket)*100}}" aria-valuemin="0" aria-valuemax="100" style="width:{{(($choice->ticket)/$totalticket)*100}}%">
                                        {{floor((($choice->ticket)/$totalticket)*100)}}%
                                    </div>
                                </div>
                                @if($choice->image == '')
                                    <img style="width:150px;height:150px;background-color:#DDDDDD;">
                                @else
                                    <img src="{{asset('/upload_img/'.$choice->image)}}" alt="" style="width:150px;height:150px;">
                                @endif
                            </label>
                        </div>
                    @endforeach
                </section>
                @if($vote->end>Carbon::now())
                    <input type="button" name="submit" id="submit" value="Submit" style="width:100%;height:50px"></input>
                @endif
            </form>
            <div class="fb-comments" data-href="{{Request::url()}}" data-numposts="5"></div>
        </div>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.12&appId=190730861515668&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
    $(document).ready(function(){
        var postURL = "<?php echo url('votes/'.$vote->id); ?>";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#show').click(function(){
            if($("#show").val()=="顯示全文")
            {
                $("#show").val("隱藏全文");
                $("#fullcontent").css('height','auto');
            }
            else
            {
                $("#show").val("顯示全文");
                $("#fullcontent").css('height','20px');
            }
        }); 
        $('#submit').click(function(){ 
            $.ajax({  
                url:postURL,  
                method:"POST",
                data:$('#vote_form').serialize(),
                type:'json',
                success:function(data)
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        $(".print-success-msg").find("ul").html('');
                        $("#vote_form")[0].reset();
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
                $(".print-error-msg").find("ul").append('<li>'+key+'</li>'+'<li>'+value+'</li>');
            });
        }
    });  
</script>
