<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">Website Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>
                                <span>
                                    <img src="/assets/us-flag.gif" style="height: 13px; width: 20px" alt="" />
                                    {{ $page_content['lang_name'] }}
                                </span>
                                <span></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($langs as $lang)
                                <li>
                                    <a class="dropdown-item" href="{{ route('home.page', $lang->page_slug) }}">
                                        <span>
                                            <img src="{{ asset(isImageExist($lang->flag)) }}"
                                                style="height: 13px; width: 20px" alt="" />
                                            {{ $lang->name }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach


                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">YouTube to
                            MP4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Posts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
