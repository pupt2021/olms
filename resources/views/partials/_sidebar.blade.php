<aside class="main-sidebar sidebar-light-danger elevation-4">
    <!-- Brand Logo -->
    @if(Auth::user()->role_id == 1)
        <a href="{{ route('Dashboard') }}" class="brand-link text-center">
    @else
        <a href="{{ route('student_dashboard') }}" class="brand-link text-center">
    @endif

    @if(Auth::user()->role_id == 1)
    <a href="{{ route('Dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('img/Logo3.0.png') }}" alt="System Logo" style="height:15%;width:100%;">
    </a>
    @else
    <a href="{{ route('student_dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('img/Logo3.0.png') }}" alt="System Logo" style="height:15%;width:100%;">
    </a>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
        <br>
        @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
            @include('partials.links.admin_links')
        @else
            @include('partials.links.student_links')
        @endif
    </div>
    <!-- /.sidebar -->
</aside>
