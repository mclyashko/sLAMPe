<html lang="en">
<head>
    <title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>

<p>T1</p>
<label for="T1"></label><input id="T1" type="number"/>
<button onclick="window.open(`drawer/drawer.php?var=${document.getElementById('T1').value}`)">T1</button>

<p>T2</p>
<label for="T2"></label><input id="T2" type="text"/>
<button onclick="window.open(`sorter/sorter.php?var=${document.getElementById('T2').value}`)">T2</button>

<p>T3</p>
<form>
    <label for="T3"></label><select id="T3">
        <option value="ls">ls</option>
        <option value="ps">ps</option>
        <option value="whoami">whoami</option>
        <option value="id">id</option>
        <option value="uname">uname</option>
    </select>
</form>
<button onclick="window.open(`adminer/adminer.php?var=${document.getElementById('T3').value}`)">T3</button>

</body>
</html>