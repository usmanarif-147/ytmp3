<div class="section-features" data-v-8fbc4ecc>
    <div class="container" data-v-8fbc4ecc>
        <h2 class="section-title  " data-v-8fbc4ecc>
            <strong>{{ $page_content['feature_title'] }}</strong>
        </h2>
        <div class="text-center">
            <img src="{{ asset(isImageExist($page_content['feature_image'])) }}" style="height: 100px; width: 200px;"
                class="img-fluid" alt="">
        </div>
        <div class="section-features-desc" data-v-8fbc4ecc>
            {!! $page_content['feature_description'] !!}
        </div>
    </div>
</div>
