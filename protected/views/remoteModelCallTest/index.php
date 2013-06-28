<form action = 'index.php?action=RemoteModelCallTest' method = POST>
    <textarea name = 'request' cols="100" rows=20><? if(isset($_POST['request'])): ?>
<?=$_POST['request'] ?>
        <? else: ?>{
    "modelName": "TestModel",
    "calledMethod": "testMethod",
    "modelProperties":
    {
       "testProperty": "Hello World"
    }

}
        <? endif ?>
    </textarea>
    <br />
    <input type = 'submit'>
</form>