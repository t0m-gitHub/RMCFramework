<form action = 'index.php?action=RemoteModelCallTest' method = POST>
    <textarea name = 'request' cols="100" rows=20>{
    "modelName": "TestModel",
    "calledMethod": "testMethod",
    "modelProperties":
    {
       "testProperty": "Hello World"
    }

}
    </textarea>
    <br />
    <input type = 'submit'>
</form>