<div class="section-faq" data-v-8fbc4ecc>
    <div class="container" data-v-8fbc4ecc>
        <h4 class="section-title" data-v-8fbc4ecc>FAQ of YTMP3.ch</h4>
        <div class="accordion" id="accordionExample">
            @foreach ($page_faqs['page_faqs'] as $key => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button style="height: 50px" class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne_{{ $key }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            1. {{ $faq['question'] }}
                        </button>
                    </h2>
                    <div id="collapseOne_{{ $key }}" class="accordion-collapse collapse show"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
