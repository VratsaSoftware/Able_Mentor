@extends('layouts.registration')

@section('subtitle')
Попълни регистрацията, за да участваш в ABLE Mentor!
@endsection

@section('content')
    <form action="{{ route('students.store') }}" method="post" class="wpcf7-form">
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Име и фамилия:</h6>
            <p>
                <label style="margin-right:15px">
                    <span class="wpcf7-form-control-wrap name">
                        <input type="text" name="name" size="40"
                               class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                               aria-required="true" aria-invalid="false" value="{{ Request::get('name') }}" required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Възраст:</h6>
            <p>
                <label>
                    <span class="wpcf7-form-control-wrap age">
                        <input type="text" name="age" size="40" minlength="1" maxlength="2"
                               class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                               aria-required="true" value="{{ Request::get('age') }}" aria-invalid="false"  required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Имейл:</h6>
            <p>
                <label style="margin-right:15px">
                    <span class="wpcf7-form-control-wrap email">
                        <input type="email" name="email" value="{{ Request::get('email') }}" size="40"
                               class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false"  required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Телефон:</h6>
            <p>
                <label>
                    <span class="wpcf7-form-control-wrap number">
                       <input type="text" name="phone" value="{{ Request::get('phone') }}" size="40"
                              class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Пол:</h6>
            <p>
                @foreach($genders as $gender)
                    <label style="margin-right:15px; margin-top:25px; font-weight: normal;">
                        <span class="wpcf7-form-control-wrap gender">
                            <span class="wpcf7-form-control wpcf7-radio">
                                <span class="wpcf7-list-item first last">
                                    <input type="radio" name="gender_id"
                                           value="{{ $gender->id }}" {{ $loop->first ? 'required' : '' }}
                                        {{ Request::get('gender_id') == $gender->id ? 'checked' : null }}>
                                    <span class="wpcf7-list-item-label">{{ $gender->gender }}</span>
                                </span>
                            </span>
                        </span>
                    </label>
                @endforeach
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a; margin-top:50px;">Удобен формат за участие:</h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-cities">
                    <select name="city_id" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" required>
                       <option value="">---</option>
                       @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ Request::get('city_id') == $city->id ? 'selected' : null }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Училище и населено място:</h6>
            <p>
                <label>
                    <span class="wpcf7-form-control-wrap students1">
                    <input type="text" name="school" value="{{ Request::get('school') }}" size="40" class="wpcf7-form-control wpcf7-text"
                           aria-invalid="false"/>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Последно завършен клас:</h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-english_students">
                    <select name="class_id" class="wpcf7-form-control wpcf7-select" aria-invalid="false" required>
                        <option value="">---</option>
                        @foreach($schoolClass as $class)
                            @if($class->id >= 9 && $class->id <= 11)
                                <option value="{{ $class->id }}" {{ Request::get('class_id') == $class->id ? 'selected' : null }}>{{ $class->class_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        
        <div class="column one">
            <h6 style="color:#4a4a4a;">Ниво на английски език:</h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-english_students">
                    <select name="english_level_id"
                        class="wpcf7-form-control wpcf7-select" aria-invalid="false">
                        <option value="">---</option>
                        @foreach($englishLevels as $englishLevel)
                            <option value="{{ $englishLevel->id }}" {{ Request::get('english_level_id') == $englishLevel->id ? 'selected' : null }}>{{ $englishLevel->level }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Любими спортове:</h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-cities">
                    <select name="sport_ids[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" multiple="multiple" required>
                       @foreach($sports as $sport)
                            <option value="{{ $sport->id }}"
                            {{ Request::get('sport_ids') && in_array($sport->id, Request::get('sport_ids')) ? 'selected' : null }}>{{ $sport->name }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Любими предмети и дейности в училище:</h6>
            <p><label>
                <span class="wpcf7-form-control-wrap students3">
                    <input type="text" name="favorite_subjects" value="{{ Request::get('favorite_subjects') }}" size="40"
                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                        aria-required="true" aria-invalid="false" required>
                </span>
            </label>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Интереси извън училище:</h6>
            <p>
                <label>
                    <span class="wpcf7-form-control-wrap students4">
                        <input type="text" name="hobbies" value="{{ Request::get('hobbies') }}" size="40"
                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Какво ще правиш след гимназията?</h6>
            <p>
                <span class="wpcf7-form-control-wrap students6">
                    <input type="text"
                        name="after_school_plans"
                        value="{{ Request::get('after_school_plans') }}"
                        size="40"
                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                        aria-required="true"
                        aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">
                <div>Сфери, които са ти интересни и в които искаш да се развиваш?</div>
                <div style="font-size:14px">(Избери до 3)</div>
            </h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-cities">
                    <select name="spheres[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" multiple="multiple" required>
                       @foreach($spheres as $sphere)
                            <option value="{{ $sphere->id }}"
                            {{ Request::get('spheres') && in_array($sphere->id, Request::get('spheres')) ? 'selected' : null }}>{{ $sphere->name }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        
        <div class="column one">
            <h6 style="color:#4a4a4a;">
                Ментор в каква професионална сфера би бил най-полезен за теб?
                <div style="font-size:14px">(Избери до 3)</div>
            </h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-cities">
                    <select name="mentor_work_sphere_ids[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" multiple="multiple" required>
                       @foreach($spheres as $sphere)
                            <option value="{{ $sphere->id }}"
                            {{ Request::get('mentor_work_sphere_ids') && in_array($sphere->id, Request::get('mentor_work_sphere_ids')) ? 'selected' : null }}>{{ $sphere->name }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Кои свои качества искаш да промениш/подобриш?
            </h6>
            <p>
                <span class="wpcf7-form-control-wrap students8">
                    <textarea name="qualities_to_change"
                        value="{{ Request::get('qualities_to_change') }}"
                        rows="3"
                        cols="40"
                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                        aria-required="true"
                        aria-invalid="false" required></textarea>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Как се забавляваш в свободното си време?</h6>
            <p>
                <span class="wpcf7-form-control-wrap students9">
                    <input type="text"
                        name="free_time_activities"
                        value="{{ Request::get('free_time_activities') }}"
                        size="40"
                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                        aria-required="true"
                        aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Разкажи ни за свое лично предизвикателство/проблем и как го превъзмогна:</h6>
            <p>
                <span class="wpcf7-form-control-wrap students10">
                    <textarea name="difficult_situations"
                        value="{{ Request::get('difficult_situations') }}"
                        rows="3"
                        cols="40"
                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                        aria-required="true"
                        aria-invalid="false" required></textarea>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Каква идея искаш да осъществиш в рамките на ABLE Mentor? Разкажи ни.
            </h6>
            <p>
                <label>
                    <span class="wpcf7-form-control-wrap students11">
                        <textarea name="program_achievments" rows="3" cols="40"
                            value="{{ Request::get('program_achievments') }}"
                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" required></textarea>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Желая да променя/подобря:</h6>
            <p>
                <span class="wpcf7-form-control-wrap students12">
                    <textarea name="want_to_change"
                        rows="3"
                        cols="40"
                        value="{{ Request::get('want_to_change') }}"
                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                        aria-required="true"
                        aria-invalid="false" required></textarea>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Средно по колко часа седмично можеш да отделиш на проекта?
            </h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-time">
                    <select name="hours"
                            class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                            aria-required="true"
                            aria-invalid="false" required>
                        <option value="">---</option>
                        <option value="1" {{ Request::get('hours') == '1' ? 'selected' : null }}>1 час</option>
                        <option value="2" {{ Request::get('hours') == '2' ? 'selected' : null }}>2 часа</option>
                        <option value="3" {{ Request::get('hours') == '3' ? 'selected' : null }}>3 часа</option>
                        <option value="4" {{ Request::get('hours') == '4' ? 'selected' : null }}>4 часа</option>
                        <option value="5" {{ Request::get('hours') == '5' ? 'selected' : null }}>повече</option>
                    </select>
                 </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">По какъв проект би работил/а със своя ментор?</h6>
            <p>
                <span class="wpcf7-form-control-wrap checkbox-mentor10">
                    <span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required">
                        <span class="wpcf7-list-item first checkbox-group required">
                            @foreach($projectTypes as $projectType)
                                <label>
                                    <input type="checkbox" name="project_type_ids[]"
                                           value="{{ $projectType->id }}"
                                           {{ Request::get('project_type_ids') && in_array($projectType->id, Request::get('project_type_ids')) ? 'checked' : null }}>
                                           {{ $projectType->type }}
                                </label>
                            @endforeach
                        </span>
                    </span>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Моля, отбележи съгласието си в следните полета,
                за да продължиш
            </h6>
            <p>
                <span class="wpcf7-form-control-wrap checkbox-637">
                    <span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required">
                        <span class="wpcf7-list-item first last">
                            <label>
                                <input type="checkbox" required>
                                Съгласявам се личните ми данни да бъдат използвани за осъществяването на програмата и свързването ми с подходящ за мен ментор.
                            </label>
                            <label>
                                <input type="checkbox" required>
                                Съгласявам се да ме заснемат с видео и фотокамера по време на събития, свързани с протичането на програмата. Наясно съм, че заснетите материали ще бъдат използвани само и единствено за популяризиране на проекта.
                                </label>
                        </span>
                    </span>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Откъде разбрахте за програмата ABLE Mentor?</h6>
            <p>
                <label style="margin-bottom:50px;">
                    <span class="wpcf7-form-control-wrap message">
                        <input type="text" name="able_mentor_info_source" value="{{ Request::get('able_mentor_info_source') }}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one">
            <input type="submit" value="Изпрати" class="wpcf7-form-control wpcf7-submit submit button_full_width">
        </div>
        <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
@endsection
