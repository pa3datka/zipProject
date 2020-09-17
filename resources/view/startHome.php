<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/view/layouts/header.php' ?>
<div id="instruction">
    <h3>Инструкция:</h3>
    <p>1) Архив должен иметь ".zip" расширение.</p>
    <p>2) В корне архива должен находиться файл "index.html"</p>
</div>
<?php
try {
  if ($e);
} catch (Exception $e) {
    die($e->getMessage());
}
?>

<form id="add-zip" action="/addZip" method="post" enctype="multipart/form-data">
    <blockquote class="blockquote">
        <p class="mb-0">Выберите файл</p>
    </blockquote>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-success" type="submit" name="save" id="inputGroupFileAddon03" disabled>Загрузить</button>
        </div>
        <div class="custom-file">
            <label class="custom-file-label" for="inputGroupFile03">
                <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                <input type="file" name="file" class="custom-file-input" id="inputGroupFile03" accept="application/x-zip-compressed" aria-describedby="inputGroupFileAddon03">

        </div>
    </div>
</form>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/resources/view/layouts/foote.php' ?>
