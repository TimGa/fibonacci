<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fibonacci Check UI</title>
</head>
<body>
<h4>This Form is to check Fibonacci calculation API</h4>
<div>
<form id="form">
    <label for="from">From</label>
    <input id="from" type="text" name="from">
    <label for="to">To</label>
    <input id="to" type="text" name="to">
    <input type="submit">
</form>
</div>
<div style="padding-top: 30px">
    Fibonacci calculation result: <span id="result">...</span>
</div>
<div style="padding-top: 20px; color: red" id="errors">

</div>
</body>
</html>

<script>
    const formElement = document.getElementById('form');
    const resultElement = document.getElementById('result');
    const errorsElement = document.getElementById('errors');
    const handleResponse = async function (url) {
        const response = await fetch(url);
        if (response.ok) {
            const result = await response.json();
            errorsElement.innerHTML = "";
            resultElement.innerText = result.result;
        } else {
            const result = await response.json();
            resultElement.innerText = 'error';
            console.log(result.errors);
            errorsElement.innerHTML = result.errors.map((e) => `<li>${e}</li>`).join("");
        }
    }
    formElement.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(formElement);
        const url = `fibonacci?from=${formData.get('from')}&to=${formData.get('to')}`;
        handleResponse(url);
    });
</script>
