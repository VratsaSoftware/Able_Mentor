@extends('layouts.registration')

@section('content')
    <form action="{{ route('mentors.store') }}" method="post" class="wpcf7-form" enctype="multipart/form-data">
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
            <h6 style="color:#4a4a4a;">Възраст:</h6>
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
            <h6 style="color:#4a4a4a; ">Пол</h6>
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
        <div class="column one-second">
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a; margin-top:50px;">Ако сте били ментор в програмата досега, моля отбележете в кой сезон.</h6>
            <p>
                <span class="wpcf7-form-control-wrap menu-mentor-1">
                    <select name="previous_season_id" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" required>
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}" {{ Request::get('season') == $season->id ? 'selected' : null }}>{{ $season->name }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a; margin-top:50px;">Град, в който ще участваш в ABLE Mentor:</h6>
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
            <h6 style="color:#4a4a4a;">Образование (специалност, степен и име на учебно заведение):</h6>
            <p>
                <span class="wpcf7-form-control-wrap text-mentor-3">
                    <input type="text" name="work" value="{{ Request::get('work') }}" size="40"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                           aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Месторабота:</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-4">
                    <input type="text" name="education" value="{{ Request::get('education') }}" size="40"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                           aria-required="true" aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Сфера, в която имате опит и експертиза?</h6>
            <p>
               <span class="wpcf7-form-control-wrap menu-cities">
                    <select name="spheres[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                            aria-required="true" aria-invalid="false" multiple="multiple" required>
                       <option value="">---</option>
                       @foreach($spheres as $sphere)
                            <option value="{{ $sphere->id }}"
                            {{ Request::get('spheres') && in_array($sphere->id, Request::get('spheres')) ? 'selected' : null }}>{{ $sphere->name }}</option>
                        @endforeach
                    </select>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Разкажете ни за Вашите интереси/хобита/компетенции, различни от професионалните Ви такива? Какъв е опитът Ви в тези сфери?</h6>
            <p>
                <span class="wpcf7-form-control-wrap text-mentor-6">
                    <input type="text" name="expertise" value="{{ Request::get('expertise') }}" size="40"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                           aria-required="true" aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Разкажете ни за трудна ситуация/проблем и как сте се справили?</h6>
            <p>
                <span class="wpcf7-form-control-wrap text-mentor-7">
                    <input type="text" name="difficult_situations" value="{{ Request::get('difficult_situations') }}" size="40"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                           aria-required="true" aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Желая да променя/подобря...</h6>
            <p>
                <span class="wpcf7-form-control-wrap text-mentor-8">
                    <input type="text" name="want_to_change" value="{{ Request::get('want_to_change') }}" size="40"
                           class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                           aria-required="true" aria-invalid="false" required>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Средно по колко часа седмично би отделял/а на проекта?</h6>
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
            <h6 style="color:#4a4a4a;">По какъв проект бихте работили със своя ученик? </h6>
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
                                Съгласен/а съм личните ми данни да бъдат използвани за осъществяването на програмата и свързването ми с подходящ за мен ментор.
                            </label>
                            <label>
                                <input type="checkbox" required>
                                Съгласен/а съм да бъда заснеман/а с видео и фотокамера по време на събития, свързани с протичането на програмата. Запознат съм, че заснетите материали ще бъдат използвани само и единствено за популяризиране на проекта.
                            </label>
                        </span>
                    </span>
                </span>
            </p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Моля, прикачете своята автобиография:</h6>
            <p>
                <span class="wpcf7-form-control-wrap file-CVMentor">
                    <input type="file" name="cv" size="40"
                           class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required"
                           accept=".pdf,.txt,.jpg,.png,.jpeg" aria-required="true" aria-invalid="false" required>
                </span>
            </p>
            <p><small>Максимален размер на файл: 20MB (pdf,txt,jpg,png)</small></p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Откъде разбрахте за програмата ABLE Mentor?</h6>
            <p>
                <label style="margin-bottom:50px;">
                    <span class="wpcf7-form-control-wrap message">
                        <input type="text" name="able_mentor_info" value="{{ Request::get('able_mentor_info') }}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" required>
                    </span>
                </label>
            </p>
        </div>
        <div class="column one"><input type="submit" value="Изпрати" class="wpcf7-form-control wpcf7-submit button_full_width" /></div>
        <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
@endsection
