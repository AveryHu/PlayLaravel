<style>
    a:focus {outline:none;} 
</style>
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Vote Blog
            </a>
        </li>
        <li>
            <a href="/votes">
                <img src="{!! asset('/icon/icon-pack/svg/house.svg') !!}" title="Home Page"  width="40" height="40"/>
            </a>
        </li>
        <li>
            <a href="/results">
                <img src="{!! asset('/icon/icon-pack/svg/pie-chart.svg') !!}" title="Vote result"  width="40" height="40"/>
            </a>
        </li>
        <li>
            @if(Auth::check())
                <a href="/votes/create">
                    <img src="{!! asset('/icon/icon-pack/svg/edit.svg') !!}" title="Vote create"  width="40" height="40"/>
                </a>
            @else
                <a data-toggle="modal" href="#myModal">
                    <img src="{!! asset('/icon/icon-pack/svg/edit.svg') !!}" title="Vote create"  width="40" height="40"/>
                </a>
            @endif 
        </li>        
        <li>            
            @if(Auth::check())
                <a href="/logout">
                    <img src="{!! asset('/icon/icon-pack/svg/logout.svg') !!}" title="Log out"  width="40" height="40"/>
                </a>
            @else
                <a href="/login">
                    <img src="{!! asset('/icon/icon-pack/svg/avatar.svg') !!}" title="Log in"  width="40" height="40"/>
                </a>
            @endif            
        </li>
        <li>
            <a href="/about">
                <img src="{!! asset('/icon/icon-pack/svg/book.svg') !!}" title="About"  width="40" height="40"/>
            </a>
        </li>
    </ul>
</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Log in</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                Oops ! This function only for the member.. If you want to create a new vote,
                you have to log in ! Come and join us for using this exciting function !
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
                <a href="/login" class="btn btn-primary">Go to login</a>
            </div>
        </div>
    </div>
</div>