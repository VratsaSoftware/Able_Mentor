<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#" class="no-js" itemscope itemtype="https://schema.org/WebPage">

<!-- head -->
@include('layouts.includes.registration-head')

<!-- body -->
<body class="page-template-default page page-id-1049 wpb-elementor-addons
 color-custom style-default button-stroke layout-full-width no-content-padding header-transparent minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-right menuo-no-borders logo-no-margin footer-sliding mobile-tb-hide mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-sticky be-2103 elementor-default elementor-kit-2157">
<!-- #Wrapper -->
<div id="Wrapper">
    <!-- #Content -->
    <div id="Content">
        <div class="section mcb-section mcb-section-4hsxxlqfr" style="background-color:#fef2f0">
            @if(env('APP_ENV') == 'local' || env('APP_ENV') == 'development' )
                <div style="text-align: center; background-color: #ff8d8d">
                    {{ env('APP_ENV') }}
                </div>
            @endif
            <div class="section_wrapper mcb-section-inner">
                <div class="wrap mcb-wrap mcb-wrap-jt3uygl14 one  valign-top clearfix" style="padding:5% 0 5% 0">
                    <div class="mcb-wrap-inner">
                        <div class="column mcb-column mcb-item-ns13d3qtk one-sixth column_placeholder">
                            <div class="placeholder">&nbsp;</div>
                        </div>
                        <div class="column mcb-column mcb-item-jpn9ucq2j two-third column_column">
                            <div class="column_attr clearfix" style=""><h3>Попълни регистрацията, за да участваш в ABLE
                                    Mentor!</h3>
                                <hr class="no_line"/>

                                <div role="form" class="wpcf7" id="wpcf7-f1196-p1049-o1" lang="en-US" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <!-- content -->
                                @yield('content')
                                <!-- content END -->
                                </div>
                            </div>
                            @include('layouts.includes.registration-flash')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section the_content no_content">
            <div class="section_wrapper">
                <div class="the_content_wrapper"></div>
            </div>
        </div>
        <div class="section section-page-footer">
            <div class="section_wrapper clearfix">
                <div class="column one page-pager">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
</body>
</html>
