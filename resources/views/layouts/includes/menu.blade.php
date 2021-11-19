<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('mentors') }}" class="nav-link">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>Ментори</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('students.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>Студенти</p>
    </a>
</li>

<li class="nav-header mt-5">Управление на профила</li>
<li class="nav-item">
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
            Изход
        </p>
    </a>
</li>
