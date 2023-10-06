<x-mail::message>
# Nieuwe blogpost

<x-mail::panel>
Ik heb een nieuwe post gepubliceerd op mijn blog.
</x-mail::panel>

<x-mail::button :url="{{ $viewPostUrl }}">
Je kan 'm hier lezen
</x-mail::button>

Liefs, Hermine<br>
{{ config('app.name') }}

<x-mail::button :url="{{ $unsubscribeUrl }}">
Afmelden voor deze e-mail
</x-mail::button>
</x-mail::message>
