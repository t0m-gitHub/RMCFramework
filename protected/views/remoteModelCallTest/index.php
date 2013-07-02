<form action = '<?= $_SERVER["REQUEST_URI"]?>' method = POST>
    <textarea name = 'request' cols=200 rows=20><? if(isset($_POST['request'])): ?>
<?=$_POST['request'] ?>
        <? else: ?>{
    "modelName": "Me",
    "calledMethod": "getBaseInfo"
}
        <? endif ?>
    </textarea>
    <br />
    <input type = 'submit'>
</form>