@extends('layouts.master')

@section('title', '投票結果')

@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        <link href="{!! asset('/theme/article_template/vendor/bootstrap/css/bootstrap.min.css')!!}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{!! asset('/theme/article_template/css/4-col-portfolio.css')!!}" rel="stylesheet">
        <style type="text/css">
            .txtGradient {
                z-index: 2;
                position: relative;
                height: 80px; 
                margin-top: -80px;
                overflow: hidden;
                background: -moz-linear-gradient(
                    bottom, 
                    rgb(255, 255, 255) 15%,
                
                    rgba(255, 255, 255, 0) 100%
                ); 
                background: -webkit-gradient(
                    linear,
                    bottom,
                    top,
                    color-stop(15%, rgb(255, 255, 255)),
                    color-stop(100%, rgba(255, 255, 255, 0))
                );
                background: -webkit-linear-gradient(
                    bottom,
                    rgb(255,255,255) 15%,
                    rgba(255, 255, 255, 0) 100%
                );
                background: -o-linear-gradient(
                    bottom,
                    rgb(255,255,255) 15%,
                    rgba(255, 255, 255, 0) 100%
                );
                background: -ms-linear-gradient(
                    bottom,
                    rgb(255,255,255) 15%,
                    rgba(255, 255, 255, 0) 100%
                );
                
                background: linear-gradient(
                    bottom,
                    rgb(255, 255, 255) 15%,
                    rgba(255, 255, 255, 0) 100%
                );
            }
            @font-face{
                font-family:rbicon;
                src:url(chrome-extension://dipiagiiohfljcicegpgffpbnjmgjcnf/fonts/rbicon.woff2) format("woff2");
                font-weight:400;
                font-style:normal
                }
        </style>
    </head>

    <body style="padding-top:0;">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">觀看投票結果</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>                
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        @if($current == null)
                        <li class="nav-item active">
                        @else
                        <li class="nav-item">
                        @endif
                            <a class="nav-link" href="/results">全部文章
                                @if($current == null)
                                    <span class="sr-only">(current)</span>
                                @endif
                            </a>
                        </li>   
                        @foreach( $cates as $cate)
                            @if($current == $cate->id)
                            <li class="nav-item active">
                            @else
                            <li class="nav-item">
                            @endif
                                <a class="nav-link" href="{{ route('results', ['cateid' => $cate->id]) }}">
                                    {{$cate->name}}
                                    @if($current == $cate->id)
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <!-- Page Heading -->
            <h1 class="my-4">Page Heading
                <small>Secondary Text</small>
            </h1>
            
            <?php $i = 0; ?>
            @foreach( $votes as $key => $vote)
                @if(($i%3)==0)
                    <div class="row">
                @endif
                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                        <div class="card h-80">
                            @if($vote->image == '')
                                <a href="#">
                                    <img class="card-img-top" src="http://placehold.it/700x400" alt="">
                                </a>
                            @else
                                <a href="#">
                                    <img class="card-img-top" src="{{asset('/upload_img/'.$vote->image)}}" alt="">
                                </a>
                            @endif
                            <div class="card-body">
                                <div style="background-color:coral; text-align:center; color:white;" >
                                    <small>{{$cates->where('id', $vote->cateid)->first()->name}}</small>
                                </div>
                                <h4 class="card-title">
                                    <a href="{{ route('votes.show', $vote) }}">{{$vote->title}}</a>                                
                                </h4>
                                <p class="card-text" style="height:100px; overflow:hidden;">{{$vote->content}}</p>
                                <div class="txtGradient" id="txtGradient"></div>
                            </div>
                        </div>
                    </div>
                @if(($i%3)==2)
                    </div>
                @elseif( ($i+1)==count($votes) )
                    </div>
                @endif
                <?php $i++; ?>
            @endforeach
            
            
            <!-- /.row -->

            <!-- Pagination -->
            <!-- I don't like this-->
            <!--
            <ul class="pagination justify-content-center">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                @for ($i=0;$i<count($votes)/4;$i++)
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
            -->
        </div>
        <!-- /.container -->

        
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright © Your Website 2018</p>
            </div>
        <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="{!! asset('/theme/article_template/vendor/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('/theme/article_template/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script> 


        <div id="rememberry__extension__root"></div>
    </body>

@endsection