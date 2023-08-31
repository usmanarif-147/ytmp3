<x-guest-layout>
    <section class="background">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-lg-5 p-0 colon">
                    <div class="p-5" style="background-color: #313338">
                        <h2 class="text-white text-center">Welcome back!</h2>
                        <p class="text-white text-center">
                            We're so excited to see you again
                        </p>
                        <p>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </p>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1"
                                    class="form-label text-white text-uppercase">Email*</label>
                                <input type="email" name="email" class="form-control bg-dark border-0 text-white"
                                    required :value="old('email')" placeholder="Enter your email" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1"
                                    class="form-label text-white text-uppercase">Password*</label>
                                <input type="password" id="password" name="password" required
                                    class="form-control bg-dark border-0 text-white" autocomplete="current-password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>

                            {{-- <a href="#" style="color: #0992d8">Forget your password?</a> --}}
                            <br />
                            <button type="submit" class="btn btn-primary w-100 my-3 border-0 py-2">
                                Log In
                            </button>
                            {{-- <p class="text-white">
                                Need an account?
                                <a href="#" style="color: #0992d8">Register</a>
                            </p> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
