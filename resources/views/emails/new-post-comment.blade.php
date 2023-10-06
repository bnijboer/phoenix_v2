<x-mail::message>
# Nieuwe reactie van {{ $username }}

Er is een nieuwe reactie op
<x-mail::button :url="{{ $url }}">
{{ $title }}
</x-mail::button>

{{ config('app.name') }}
</x-mail::message>
