@extends('layouts.registration')

@section('content')
    <form action="{{ route('students-store') }}" method="post" class="wpcf7-form" novalidate="novalidate">
        @csrf
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Име и фамилия:</h6>
            <p><label style="margin-right:15px">
                    <span class="wpcf7-form-control-wrap name">
                        <input type="text" name="name" size="40" class="wpcf7-form-control
                         wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" required>
                    </span>
                </label>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Възраст:</h6>
            <p><label><span class="wpcf7-form-control-wrap age">
         <input type="text" name="age" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                aria-required="true" aria-invalid="false"  required>
                    </span></label>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Имейл:</h6>
            <p>
                <label style="margin-right:15px">
                    <span class="wpcf7-form-control-wrap email">
                        <input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false"  required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Телефон:</h6>
            <p>
                <label>
         <span class="wpcf7-form-control-wrap number">
         <input type="text" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false"/>
         </span>
                </label>
            </p>
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Пол</h6>
            <p><label style="margin-right:15px; margin-top:25px; font-weight: normal;"><span
                        class="wpcf7-form-control-wrap gender"><span
                            class="wpcf7-form-control wpcf7-radio"><span
                                class="wpcf7-list-item first last">
            <input type="radio" name="gender_id" value="Мъж"/><span
                                    class="wpcf7-list-item-label">Мъж</span></span></span></span></label><br/>
                <label style="margin-right:15px; font-weight: normal;"><span
                    class="wpcf7-form-control-wrap gender"><span
                        class="wpcf7-form-control wpcf7-radio"><span
                            class="wpcf7-list-item first last">
         <input type="radio" name="gender_id" value="Жена"/><span
                                    class="wpcf7-list-item-label">Жена</span></span></span></span></label>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a; margin-top:50px;">Град, в който ще участваш в ABLE
                Mentor:
            </h6>
            <p>
         <span class="wpcf7-form-control-wrap menu-cities">
            <select
                name="city_id"
                class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                aria-required="true" aria-invalid="false">
               <option value="">---</option>
               @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
         </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Училище и населено място:</h6>
            <p><label><span class="wpcf7-form-control-wrap students1">
         <input type="text" name="school" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false"/></span></label>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Завършен клас</h6>
            <p>
            <span class="wpcf7-form-control-wrap menu-english_students">
                <select name="class_id" class="wpcf7-form-control wpcf7-select" aria-invalid="false">
                    <option value="">---</option>
                    @foreach($schoolClass as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
             </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Любими предмети и дейности в училище:</h6>
            <p><label><span class="wpcf7-form-control-wrap students3"><input
                            type="text" name="favorite_subjects" size="40"
                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false"/></span></label>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Интереси извън училище:</h6>
            <p><label><span class="wpcf7-form-control-wrap students4"><input
                            type="text" name="hobbies" value="" size="40"
                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false"/></span></label>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Ниво на английски език</h6>
            <p>
            <span class="wpcf7-form-control-wrap menu-english_students">
                <select name="english_level_id"
                    class="wpcf7-form-control wpcf7-select" aria-invalid="false">
                    <option value="">---</option>
                    @foreach($englishLevels as $englishLevel)
                        <option value="{{ $englishLevel->id }}">{{ $englishLevel->level }}</option>
                    @endforeach
                </select>
             </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Спорт</h6>
            <p><span class="wpcf7-form-control-wrap students5"><input type="text"
                                                                      name="sport_id"
                                                                      size="40"
                                                                      class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                      aria-required="true"
                                                                      aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Какво ще правя след гимназията?</h6>
            <p><span class="wpcf7-form-control-wrap students6"><input type="text"
                                                                      name="after_school_plans"
                                                                      size="40"
                                                                      class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                      aria-required="true"
                                                                      aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">В кои сфери имаш силен интерес да се развиваш и в
                кои по-слаб?
            </h6>
            <p><span class="wpcf7-form-control-wrap students7"><input type="text"
                                                                      name="strong_weak_sides"
                                                                      value=""
                                                                      size="40"
                                                                      class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                      aria-required="true"
                                                                      aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Кои свои качества искаш да
                промениш/подобриш?
            </h6>
            <p><span class="wpcf7-form-control-wrap students8"><input type="text"
                                                                      name="qualities_to_change"
                                                                      size="40"
                                                                      class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                      aria-required="true"
                                                                      aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Как се забавляваш в свободното си време? </h6>
            <p><span class="wpcf7-form-control-wrap students9"><input type="text"
                                                                      name="free_time_activities"
                                                                      size="40"
                                                                      class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                      aria-required="true"
                                                                      aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Разкажи ни за трудна ситуация/проблем и как си се
                справил/а?
            </h6>
            <p><span class="wpcf7-form-control-wrap students10"><input type="text"
                                                                       name="difficult_situations"
                                                                       size="40"
                                                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                       aria-required="true"
                                                                       aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Каква идея искаш да осъществиш в рамките на ABLE
                Mentor? Разкажи ни
            </h6>
            <p><label><span class="wpcf7-form-control-wrap students11"><input
                            type="text" name="program_achievments" size="40"
                            class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false"/></span></label>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Желая да променя</h6>
            <p><span class="wpcf7-form-control-wrap students12"><input type="text"
                                                                       name="want_to_change"
                                                                       size="40"
                                                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                       aria-required="true"
                                                                       aria-invalid="false"/></span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Средно по колко часа седмично би отделял/а на
                проекта?
            </h6>
            <p>
            <span class="wpcf7-form-control-wrap menu-time">
                <select name="hours"
                        class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                        aria-required="true"
                        aria-invalid="false">
                   <option value="1 час">1 час</option>
                   <option value="2 часа">2 часа</option>
                   <option value="3 часа">3 часа</option>
                   <option value="4 часа">4 часа</option>
                   <option value="повече">повече</option>
                </select>
             </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">По какъв проект би работил/а със своя
                ментор?
            </h6>
            <p><span class="wpcf7-form-control-wrap checkbox-mentor10">
                <span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span
                        class="wpcf7-list-item first">
                @foreach($projectTypes as $projectType)
                    <label>
                        <input type="checkbox" name="project_type_ids[]" value="{{ $projectType->id }}"/>
                        {{ $projectType->type }}
                    </label>
                @endforeach
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Моля, отбележи съгласието си в следните полета,
                за да продължиш
            </h6>
            <p>
                <span class="wpcf7-form-control-wrap checkbox-637"><span
                        class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span
                            class="wpcf7-list-item first last">
                            <label>
                                <input type="checkbox" name="verify_1" required>
                                Съгласен/а съм личните ми данни да бъдат използвани за осъществяването на програмата и свързването ми с подходящ за мен ментор.
                            </label>
                            <label>
                                <input type="checkbox" name="verify_2" required>
                                Съгласен/а съм да бъда заснеман/а с видео и фотокамера по време на събития, свързани с протичането на програмата. Запознат съм, че заснетите материали ще бъдат използвани само и единствено за популяризиране на проекта.
                            </label>
                        </span>
                    </span>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Откъде разбрахте за програмата ABLE Mentor?</h6>
            <p><label style="margin-bottom:50px;"><span class="wpcf7-form-control-wrap message">
         <input type="text" name="able_mentor_info_source" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false"/>
         </span>
                </label>
        </div>
        <div class="column one">
            <input type="submit" value="Изпрати" class="wpcf7-form-control wpcf7-submit button_full_width"/>
        </div>
        <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
@endsection
