<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Главно мени</li>

            <li class="treeview {{ (Request::segment(2) == 'activities')  ? 'active' : '' }}"><a href="#activities"
                                                                                                 data-toggle="collapse"
                                                                                                 aria-expanded="false"
                                                                                                 class="dropdown-toggle">
            {{--<i class="fa fa-archive"></i> <span>Активности</span></a>--}}
            {{--<ul class="treeview-menu" id="activities">--}}
            {{--<li class="{{ (Request::segment(3) == 'dehelmetization')  ? 'active' : '' }}"><a--}}
            {{--href="{{ url('/admin/activities/dehelmetization') }}">--}}
            {{--<i class="fa fa-archive text-red"></i> <span>Дехелметизација</span></a>--}}
            {{--</li>--}}

            {{--<li class="{{ (Request::segment(3) == 'vaccine_for_large_animals')  ? 'active' : '' }}"><a--}}
            {{--href="{{ url('/admin/activities/vaccine_for_large_animals') }}">--}}
            {{--<i class="fa fa-archive text-yellow"></i> <span>Вакцина на големи животни</span></a></li>--}}

            {{--<li class="{{ (Request::segment(3) == 'vaccine_for_small_animals')  ? 'active' : '' }}"><a--}}
            {{--href="{{ url('/admin/activities/vaccine_for_small_animals') }}">--}}
            {{--<i class="fa fa-archive text-aqua"></i> <span>Вакцина на мали животни</span></a></li>--}}

            {{--<li class="{{ (Request::segment(3) == 'insemination')  ? 'active' : '' }}"><a--}}
            {{--href="{{ url('/admin/activities/insemination') }}">--}}
            {{--<i class="fa fa-archive text-purple"></i> <span>Вештачко осеменување</span></a>--}}
            {{--</li>--}}

            {{--<li class="{{ (Request::segment(3) == 'therapy')  ? 'active' : '' }}"><a--}}
            {{--href="{{ url('/admin/activities/therapy') }}">--}}
            {{--<i class="fa fa-archive   text-orange"></i>--}}
            {{--<span>Терапија</span></a></li>--}}

            {{--<li class="{{ (Request::segment(3) == 'disinfection_of_rbo')  ? 'active' : '' }}"><a--}}
            {{--href="{{ url('/admin/activities/disinfection_of_rbo') }}">--}}
            {{--<i class="fa fa-archive  text-green"></i>--}}
            {{--<span>Дезинфекција на RBO</span></a></li>--}}
            {{--</ul>--}}

            {{--</li>--}}
            <li class="{{ (Request::segment(2) == 'animals') ? 'active' : '' }}"><a href=""><i class="fa fa-archive text-green"></i> <span>Федерации</span></a></li>
            <li class="{{ (Request::segment(2) == 'examination')  ? 'active' : '' }}"><a href=""><i class="fa fa-archive  text-red"></i> <span>Клубови</span></a></li>
            {{--            @if($is_admin==true)--}}
            <li class="{{ (Request::segment(2) == 'users')  ? 'active' : '' }}"><a href=""><i class="fa fa-users"></i> <span>Судии</span></a></li>
            {{--            @endif--}}
            <li class="{{ (Request::segment(2) == 'vets') ? 'active' : '' }}"><a href=""><i class="fa fa-users text-blue"></i> <span>Спортисти</span></a></li>
            <li class="{{ (Request::segment(2) == 'holdings') ? 'active' : '' }}"><a href=""><i class="fa fa-building  text-orange"></i> <span>Спортски објекти</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
