<style>
.maintain {text-align: center;width: 50%;padding-left: calc(100% - 75vw);padding-top: 39vh;font-size: 47px;font-weight: bold;color: red;}
.maintain_login {padding-left: calc(100% - 55vw);text-decoration: none;color: orange;font-weight: bold;font-size: 25px;}
</style>
<div class="maintain">{{ $site[0]->site_maintain_caption }}</div>
@guest
<a href="/login" class="maintain_login">[快速登入]</a>
@else
    @if(Auth::user()->type=='A' and Auth::user()->type=='G')
    <a href="/login" class="maintain_login">[快速登入]</a>
    @else
    <a href="/home" class="maintain_login">[前往後台]</a>
    @endif
@endguest
