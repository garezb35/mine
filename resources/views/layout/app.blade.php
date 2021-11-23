<x-layouts.base>


    @if(in_array(request()->route()->getName(), ['dashboard', 'profile', 'profile-example', 'users', 'bootstrap-tables', 'transactions',
    'buttons', 'index',
    'forms', 'modals', 'notifications', 'typography', 'upgrade-to-pro']))

    {{-- Nav --}}
    @include('layout.nav')
    {{-- SideNav --}}
    @include('layout.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layout.topbar')
        {{ $slot }}
        {{-- Footer --}}
        @include('layout.footer')
    </main>

    @elseif(in_array(request()->route()->getName(), ['register', 'register-example', 'login', 'login-example',
    'forgot-password', 'forgot-password-example', 'reset-password','reset-password-example']))

    {{ $slot }}
    {{-- Footer --}}
    @include('layout.footer2')


    @elseif(in_array(request()->route()->getName(), ['404', '500', 'lock']))

    {{ $slot }}

    @endif
</x-layouts.base>
