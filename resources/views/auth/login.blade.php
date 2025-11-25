<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="#" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <x-Logo class="h-20 mr-2" />
        </a>
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('Sign In') }} 
            </h2>
            <form class="mt-8 space-y-6" action="{{ route('authenticate') }}" method="POST">
                @csrf
                <x-input icon="identification" type="text" name="cui" :value="old('cui')" label="Dpi *" placeholder="xxxxxxxxxxxxx" required />
                <x-password icon="key" type="password" name="password" :value="old('password')"  :label="__('Password') .' *' " placeholder="••••••••" required />
                <div class="flex items-start">
                    <x-checkbox aria-describedby="remember" name="remember" :label="__('Remember me')"/>
                    <a href="#" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">{{ __('Lost Password?') }}</a>
                </div>
                <x-button :text="__('Login to your account')" icon="arrow-right-end-on-rectangle" round type="submit"/>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Not registered? <a class="text-primary-700 hover:underline dark:text-primary-500">Create account</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>