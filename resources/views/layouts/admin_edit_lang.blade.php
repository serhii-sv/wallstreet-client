@if(canEditLang() && checkRequestOnEdit())
  <div class="admin-edit-lang">
    <a href="{{ url()->current() }}">Перейти в обычный режим</a>
    <a href="#" target="_blank">Перейти в админку</a>
  </div>
@elseif(canEditLang())
  <div class="admin-edit-lang">
    <a href="{{ url()->current() . '?edit=true' }}">Редактировать текст</a>
    <a href="#" target="_blank">Перейти в админку</a>
  </div>
@endif
<style>
    .admin-edit-lang {
        height: 60px;
        background: #222535;
        color: white;
        font-size: 18px;
        text-align: center;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .admin-edit-lang a {
        margin: 0 50px;
        color: white !important;
        text-decoration: none !important;
        display: block;
        padding: 10px;
    }

    editor_block {
        -webkit-user-modify: read-write;
        overflow-wrap: break-word;
        -webkit-line-break: after-white-space;
    }

    editor_block[contenteditable="true"]:hover {
        outline: 1px solid #b7b7b7;
    }

    editor_block[contenteditable="true"]:focus {
        outline: 1px solid;
        -webkit-box-shadow: 0 0 5px 0 rgba(34, 37, 53, 0.49);
        -moz-box-shadow: 0 0 5px 0 rgba(34, 37, 53, 0.49);
        box-shadow: 0 0 5px 0 rgba(34, 37, 53, 0.49);
    }
</style>
