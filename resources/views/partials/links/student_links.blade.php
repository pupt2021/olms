<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach($user_links_parent as $parent_link)
            @if(in_array($parent_link -> user_role , array('2')))
            <li class="nav-item menu-open">
                <a href="" class="nav-link active">
                    <i class="nav-icon fas {{ $parent_link -> icon}}"></i>
                    <p>
                        {{ $parent_link -> user_link_parent_name }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                @foreach($user_links as $link)
                    @if($link -> parent_link_id == $parent_link -> id && $link->display_status == 1)
                        @foreach($permission as $perm_link)
                            @if(($perm_link -> link_id == $link -> id || $perm_link -> link_id == 0) && $perm_link -> status == "On")
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="{{ route($link -> slug_name ) ? route($link -> slug_name ) : ''}}" class="nav-link {{ (Route::currentRouteName() == $link -> slug_name ) ? 'active' : '' }}  ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ $link -> link_name }}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </li>
            @endif
        @endforeach
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li> --}}
    </ul>
</nav>
