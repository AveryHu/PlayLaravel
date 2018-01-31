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
            <a href="#">
                <img src="{!! asset('/icon/icon-pack/svg/pie-chart.svg') !!}" title="Vote result"  width="40" height="40"/>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="{!! asset('/icon/icon-pack/svg/edit.svg') !!}" title="Testing"  width="40" height="40"/>
            </a>
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