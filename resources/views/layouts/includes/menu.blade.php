<li class="nav-item has-treeview {{ Request::routeIs('mentors*') ? 'menu-open' : null }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Ментори
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('mentors.index', config('consts.MENTOR_STATUS.current_season')) }}" class="nav-link {{ Request::routeIs('mentors.index') && Request::segment(2) == config('consts.MENTOR_STATUS.current_season') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Текущ сезон</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mentors.index', config('consts.MENTOR_STATUS.new_season_approved')) }}" class="nav-link {{ Request::routeIs('mentors.index') && Request::segment(2) == config('consts.MENTOR_STATUS.new_season_approved') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Престоящ - свързани</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mentors.index', config('consts.MENTOR_STATUS.new_season_pending')) }}" class="nav-link {{ Request::routeIs('mentors.index') && Request::segment(2) == config('consts.MENTOR_STATUS.new_season_pending') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Престоящ - нови</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mentors.index', config('consts.MENTOR_STATUS.archive')) }}" class="nav-link {{ Request::routeIs('mentors.index') && Request::segment(2) == config('consts.MENTOR_STATUS.archive') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Архив</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview {{ Request::routeIs('students*') ? 'menu-open' : null }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>
            Ученици
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('students.index', config('consts.STUDENT_STATUS.current_season')) }}" class="nav-link {{ Request::routeIs('students.index') && Request::segment(2) == config('consts.STUDENT_STATUS.current_season') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Текущ сезон</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('students.index', config('consts.STUDENT_STATUS.new_season_approved')) }}" class="nav-link {{ Request::routeIs('students.index') && Request::segment(2) == config('consts.STUDENT_STATUS.new_season_approved') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Престоящ - свързани</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('students.index', config('consts.STUDENT_STATUS.new_season_pending')) }}" class="nav-link {{ Request::routeIs('students.index') && Request::segment(2) == config('consts.STUDENT_STATUS.new_season_pending') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Престоящ - нови</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('students.index', config('consts.STUDENT_STATUS.archive')) }}" class="nav-link {{ Request::routeIs('students.index') && Request::segment(2) == config('consts.STUDENT_STATUS.archive') ? 'active' : null }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Архив</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('seasons.index') }}" class="nav-link">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Сезони</p>
    </a>
</li>

@if (Auth::user()->isAdmin())
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Потребители</p>
        </a>
    </li>
@endif

<li class="nav-header mt-5">Управление на профила</li>
<li class="nav-item">
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
            Изход
        </p>
    </a>
</li>
