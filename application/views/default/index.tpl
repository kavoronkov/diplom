<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript">
        var obj = {
            "module":"news",
            "category":"politics",
            "source":"liga",
            "count":"20",
            "older":"true",
            "lastId":"-1"};

        function sendTestJSON() {
            $.ajax({
                "url": "/index/test",
                "dataType": "json",
                "type": "POST",
                "data": JSON.stringify(obj),
                "contentType": "application/json;charset=utf-8",
                "success": function(data) {
                    console.log(data);
                }
            });

        }
    </script>
</head>

<body>
    <button type="button" onclick="sendTestJSON();">Test</button>

</body>

</html>
