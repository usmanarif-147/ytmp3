<div>
    {{-- Header section Start --}}
    @include('livewire.home.partials.header')
    {{-- Header section End --}}

    <div data-warden-g-parm="eyJ1cmxfdHlwZSI6InNlcnZpY2UifQ==" class="main-section section" style="min-height: 800px"
        data-v-8fbc4ecc>

        {{-- Download Section Start --}}
        @include('livewire.home.partials.download-section')
        {{-- Donload Section End --}}

        {{-- Help Section Start --}}
        @include('livewire.home.partials.help-section')
        {{-- Help Section End --}}

        {{-- Feature Section Start --}}
        @include('livewire.home.partials.feature-section')
        {{-- Feature Section End --}}

        {{-- Faq Section Start --}}
        @if (count($page_faqs['page_faqs']))
            @include('livewire.home.partials.faq-section')
        @endif
        {{-- Faq Section End --}}

        {{-- Post Section Start --}}
        @include('livewire.home.partials.post-section')
        {{-- Post Section End --}}
    </div>

    {{-- Share Comp Section Start --}}
    {{-- @include('livewire.home.partials.share-comp') --}}
    {{-- Share Comp Section End --}}

    {{-- Footer Section Start --}}
    @include('livewire.home.partials.footer')
    {{-- Footer Section End --}}
</div>
