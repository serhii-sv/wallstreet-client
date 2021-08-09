<div class="breadcrumbs">
  <div class="container">
    <a href="{{ route('customer.main') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
        <editor_block data-name="Home" contenteditable="true">{{ __('Home') }}</editor_block>
      @else
        {{ __('Home') }}
      @endif</a>
    <span>/</span>
    <span id="current_page_title"></span>
  </div>
</div>
<script>document.getElementById("current_page_title").innerHTML = document.title</script>
