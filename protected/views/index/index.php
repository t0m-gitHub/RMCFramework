<form action='index.php' method = 'post'>
    <textarea rows = 20 cols = 60 name='json'><? $defaultJson = '{"jsonrpc": "2.0", "method": "ClientModel_getBaseInfo", "params": [], "id": 1}'; ?><?= isset($_POST['json']) ? $_POST['json'] : $defaultJson ?>
    </textarea>
    <br />
    <input type="submit">
</form>