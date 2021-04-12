@component('mail::message')
# Introduction

Dear {{ $mailData['name'] }}, CAAB assigned you a role in HCC system. Your login credentials are Username:  {{ $mailData['username'] }} and Password: 123123. You can change your password.


Thanks,<br>
{{ config('app.name') }} <br>
CAAB
@endcomponent
