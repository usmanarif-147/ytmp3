<div class="section-features mt-5" data-v-8fbc4ecc>
    <div class="container" data-v-8fbc4ecc>
        <div class="section-features-desc" data-v-8fbc4ecc>
            {{-- <h3 class="section-title" style="visibility: none" data-v-8fbc4ecc>
                text
            </h3> --}}
            {{-- <div class="text-center">
                <img src="{{ asset(isImageExist($page_content['feature_image'])) }}" style="height: 100px; width: 200px;"
                    class="img-fluid" alt="">
            </div> --}}
            @if ($termOfUseContent)
                {!! $termOfUseContent !!}
            @else
                <h2> Not Found </h2>
            @endif
        </div>
    </div>
</div>
