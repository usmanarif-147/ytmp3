<div id="footer" class="section-footer" data-v-32865e22>
    <div class="container" data-v-32865e22>
        <div class="foot-links" data-v-32865e22>
            <div class="link-clomuns" data-v-32865e22>
                <a href="{{ route('terms-of-use', session('lang')) }}" class="link-clomuns-cell" data-v-32865e22>
                    Terms of Use
                </a>
                <a href="{{ route('cookies-policy', session('lang')) }}" class="link-clomuns-cell" data-v-32865e22>
                    Cookies Policy
                </a>
            </div>
            <div class="link-clomuns" data-v-32865e22>
                <a href="{{ route('leagal-disclaimer', session('lang')) }}" class="link-clomuns-cell" data-v-32865e22>
                    Legal Disclaimer
                </a>
                <a href="{{ route('copyright-act', session('lang')) }}" class="link-clomuns-cell" data-v-32865e22>
                    DMCA
                </a>
            </div>
            <div class="link-clomuns" data-v-32865e22>
                <a href="{{ route('privacy-policy', session('lang')) }}" class="link-clomuns-cell" data-v-32865e22>
                    Privacy Policy
                </a>
                <a href="#" class="link-clomuns-cell" data-v-32865e22>
                    Contact Us
                </a>
            </div>
            <div class="link-clomuns" data-v-32865e22>
                <a href="{{ App\Models\YtmLink::first() ? App\Models\YtmLink::first()->link : 'javascript:void(0)' }}"
                    target="_blank" class="link-clomuns-cell" data-v-32865e22>
                    YouTubeToMP3
                </a>
                <a href="{{ App\Models\YadLink::first() ? App\Models\YadLink::first()->link : 'javascript:void(0)' }}"
                    target="_blank" class="link-clomuns-cell" data-v-32865e22>
                    YouTube Audio Downloader
                </a>
                <a href target="_blank" class="link-clomuns-cell" data-v-32865e22>
                </a>
            </div>
        </div>
    </div>
    <div class="page-copyright container" data-v-32865e22>
        <span data-v-32865e22>Copyright © 2023 ytmp3.ch. All rights reserved.</span>
    </div>
</div>
