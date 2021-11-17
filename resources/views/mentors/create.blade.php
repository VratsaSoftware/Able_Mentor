@extends('layouts.registration')

@section('content')
    <form action="/mentors/#wpcf7-f1195-p1052-o1" method="post" class="wpcf7-form" enctype="multipart/form-data" novalidate="novalidate">
        <div style="display: none;">
            <input type="hidden" name="_wpcf7" value="1195" />
            <input type="hidden" name="_wpcf7_version" value="5.1.6" />
            <input type="hidden" name="_wpcf7_locale" value="en_US" />
            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1195-p1052-o1" />
            <input type="hidden" name="_wpcf7_container_post" value="1052" />
            <input type="hidden" name="_wpcf7cf_hidden_group_fields" value="" />
            <input type="hidden" name="_wpcf7cf_hidden_groups" value="" />
            <input type="hidden" name="_wpcf7cf_visible_groups" value="" />
            <input type="hidden" name="_wpcf7cf_repeaters" value="[]" />
            <input type="hidden" name="_wpcf7cf_steps" value="{}" />
            <input type="hidden" name="_wpcf7cf_options" value="{&quot;form_id&quot;:1195,&quot;conditions&quot;:[],&quot;settings&quot;:{&quot;animation&quot;:&quot;yes&quot;,&quot;animation_intime&quot;:200,&quot;animation_outtime&quot;:200,&quot;conditions_ui&quot;:&quot;normal&quot;,&quot;notice_dismissed&quot;:false}}" />
        </div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Име и фамилия:</h6>
            <p><label style="margin-right:15px"><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span> </label></div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Възраст:</h6>
            <p><label><span class="wpcf7-form-control-wrap your-age"><input type="text" name="your-age" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></label></div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Имейл:</h6>
            <p><label style="margin-right:15px"><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></span></label></div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Телефон:</h6>
            <p><label><span class="wpcf7-form-control-wrap your-number"><input type="text" name="your-number" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></label></div>
        <div class="column one-second">
            <h6 style="color:#4a4a4a; ">Пол</h6>
            <p><label style="margin-right:15px; margin-top:25px; font-weight: normal; "><span class="wpcf7-form-control-wrap your-gender"><span class="wpcf7-form-control wpcf7-radio"><span class="wpcf7-list-item first last"><input type="radio" name="your-gender" value="Мъж" /><span class="wpcf7-list-item-label">Мъж</span></span></span></span></label><br />
                <label style="margin-right:15px; font-weight: normal; "><span class="wpcf7-form-control-wrap your-gender"><span class="wpcf7-form-control wpcf7-radio"><span class="wpcf7-list-item first last"><input type="radio" name="your-gender" value="Жена" /><span class="wpcf7-list-item-label">Жена</span></span></span></span></label></div>
        <div class="column one-second">
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a; margin-top:50px;">Ако сте били ментор в програмата досега, моля отбележете в кой сезон.</h6>
            <p><span class="wpcf7-form-control-wrap menu-mentor-1"><select name="menu-mentor-1" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Не съм бил досега.">Не съм бил досега.</option><option value="Сезон 1">Сезон 1</option><option value="Сезон 2">Сезон 2</option><option value="Сезон 3">Сезон 3</option><option value="Сезон 4">Сезон 4</option><option value="Сезон 5">Сезон 5</option><option value="Сезон 6">Сезон 6</option><option value="Сезон 7">Сезон 7</option><option value="Сезон 8">Сезон 8</option><option value="Сезон 9">Сезон 9</option><option value="Сезон 10">Сезон 10</option><option value="Сезон 11">Сезон 11</option><option value="Сезон 12">Сезон 12</option><option value="сезон 13">сезон 13</option><option value="сезон 14">сезон 14</option><option value="сезон 15">сезон 15</option></select></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Град, в който ще участвате в ABLE Mentor:</h6>
            <p><span class="wpcf7-form-control-wrap menu-mentor-2"><select name="menu-mentor-2" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Благоевград">Благоевград</option><option value="Друг град (онлайн менторство)">Друг град (онлайн менторство)</option></select></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Образование (специалност, степен и име на учебно заведение):</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-3"><input type="text" name="text-mentor-3" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Месторабота:</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-4"><input type="text" name="text-mentor-4" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Професионален опит/интереси:</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-5"><input type="text" name="text-mentor-5" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Разкажете ни за Вашите интереси/хобита/компетенции, различни от професионалните Ви такива? Какъв е опитът Ви в тези сфери?</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-6"><input type="text" name="text-mentor-6" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Разкажете ни за трудна ситуация/проблем и как сте се справили?</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-7"><input type="text" name="text-mentor-7" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Желая да променя/подобря...</h6>
            <p><span class="wpcf7-form-control-wrap text-mentor-8"><input type="text" name="text-mentor-8" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Средно по колко часа седмично бихте отделяли на проекта? </h6>
            <p><span class="wpcf7-form-control-wrap menu-44"><select name="menu-44" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="">---</option><option value="1 час">1 час</option><option value="2 часа">2 часа</option><option value="3 часа">3 часа</option><option value="4 часа">4 часа</option><option value="повече">повече</option></select></span></p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">По какъв проект бихте работили със своя ученик? </h6>
            <p><span class="wpcf7-form-control-wrap checkbox-mentor10"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first"><input type="checkbox" name="checkbox-mentor10[]" value="социален проект - осъществяване на общественополезна инициатива" /><span class="wpcf7-list-item-label">социален проект - осъществяване на общественополезна инициатива</span></span><span class="wpcf7-list-item"><input type="checkbox" name="checkbox-mentor10[]" value="бизнес проект - развиване на бизнес план/бизнес идея" /><span class="wpcf7-list-item-label">бизнес проект - развиване на бизнес план/бизнес идея</span></span><span class="wpcf7-list-item last"><input type="checkbox" name="checkbox-mentor10[]" value="проект за личностно развитие - подобряване личните умения/качества на ученика" /><span class="wpcf7-list-item-label">проект за личностно развитие - подобряване личните умения/качества на ученика</span></span></span></span>
            </p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Моля, отбележете съгласието си в следните полета, за да продължите.</h6>
            <p><span class="wpcf7-form-control-wrap checkbox-637"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first last"><input type="checkbox" name="checkbox-637[]" value="Съгласен/а съм личните ми данни да бъдат използвани за осъществяването на програмата и свързването ми с подходящ за мен ученик." /><span class="wpcf7-list-item-label">Съгласен/а съм личните ми данни да бъдат използвани за осъществяването на програмата и свързването ми с подходящ за мен ученик.</span></span></span></span><br />
                <span class="wpcf7-form-control-wrap checkbox-638"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first last"><input type="checkbox" name="checkbox-638[]" value="Съгласен/а съм да бъда заснеман/а с видео и фотокамера по време на събития, свързани с протичането на програмата. Запознат съм, че заснетите материали ще бъдат използвани само и единствено за популяризиране на проекта." /><span class="wpcf7-list-item-label">Съгласен/а съм да бъда заснеман/а с видео и фотокамера по време на събития, свързани с протичането на програмата. Запознат съм, че заснетите материали ще бъдат използвани само и единствено за популяризиране на проекта.</span></span></span></span> </p></div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Моля, прикачете своята автобиография:</h6>
            <p><span class="wpcf7-form-control-wrap file-CVMentor"><input type="file" name="file-CVMentor" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".pdf,.txt,.jpg,.png,.jpeg" aria-required="true" aria-invalid="false" /></span></p>
            <p><small>Максимален размер на файл: 20MB (pdf,txt,jpg,png)</small></p>
        </div>
        <div class="column one">
            <h6 style="color:#4a4a4a;">Откъде разбрахте за програмата ABLE Mentor?</h6>
            <p><label style="margin-bottom:50px;"><span class="wpcf7-form-control-wrap your-message"><input type="text" name="your-message" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span> </label></div>
        <div class="column one"><input type="submit" value="Изпрати" class="wpcf7-form-control wpcf7-submit button_full_width" /></div>
        <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
@endsection
