<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- 2カラム --}}
        <div class="grid grid-cols-2 gap-4">

            {{-- ユーザー名 --}}
            <div>
                <x-input-label for="name" value="ユーザー名" />
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Eメール --}}
            <div>
                <x-input-label for="email" value="Eメール" />
                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="mt-1 block w-full"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>

            {{-- 名前（漢字） --}}
            <div>
                <x-input-label for="name_kanji" value="名前（漢字）" />
                <x-text-input
                    id="name_kanji"
                    name="name_kanji"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name_kanji', $user->name_kanji)"
                />
                <x-input-error class="mt-2" :messages="$errors->get('name_kanji')" />
            </div>

            {{-- 名前（カナ） --}}
            <div>
                <x-input-label for="name_kana" value="名前（カナ）" />
                <x-text-input
                    id="name_kana"
                    name="name_kana"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name_kana', $user->name_kana)"
                />
                <x-input-error class="mt-2" :messages="$errors->get('name_kana')" />
            </div>

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
