<div class="section-faq" data-v-8fbc4ecc>
    <div class="row" data-v-8fbc4ecc>
        <div class="col-8 offset-2">
            <h3 class="section-title" data-v-8fbc4ecc>
                <strong>FAQ of YTMP3.ch</strong>
            </h3>
            <div class="accordion" id="accordionExample">
                @foreach ($page_faqs['page_faqs'] as $key => $faq)
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button style="height: 50px" class="accordion-button" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne_{{ $key }}"
                                aria-expanded="true" aria-controls="collapseOne">
                                {{ $loop->index + 1 }}. {{ $faq['question'] }}
                            </button>
                        </h3>
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
</div>
