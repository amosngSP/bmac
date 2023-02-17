@component('mail::message')
# {{ $subject }}

Dear **{{ $full_name }}**,

{!! $content !!}

@lang('Regards'),

**{{ config('mail.from.name', config('app.name')) }}**
@break
This mailbox is not being monitored. Please do not reply to this email. If you have any queries please direct them to the VATSIM Community Discord which you may join at https://community.vatsim.net
@endcomponent
