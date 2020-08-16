<? require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/view/layouts/header.php' ?>

    <div class="input-group mb-3" id="show-url">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Ваша ссылка:</span>
        </div>
        <input type="text" class="form-control" value="<?=$wars['url']?>" aria-label="Имя пользователя" aria-describedby="basic-addon1" readonly>
    </div>
<? require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/view/layouts/foote.php' ?>