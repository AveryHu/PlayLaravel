<!-- Styles -->
<style>
    #about_ul{
        list-style-type: none;           
        padding:0;
    }
    #about_li{
        border-right: 3px solid gray; 
        height:50px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding:10px;
    }        
    #about_li:hover{
        border-right: 3px solid #bf715b;            
    }
    #about_li a{
        text-decoration: none;            
        font-size: 1rem;
        color: gray;
    }
    #about_li a:hover{
        text-decoration: none;
        color: #bf715b;
    }
    .col-fixed-150{
        width:150px;
        position:fixed;
        height:100%;
        z-index:1;
    }
    .col-offset-100{
        padding-left:200px;
        z-index:0;
    }
</style>

<div class="col-fixed-150">
    <ul id="about_ul">
        @foreach ($abouts as $about)
            <li id="about_li">
                <a href={{url('about/'.$about->route)}}>{{$about->title}}</a>
            </li>
        @endforeach
    </ul>
</div>
