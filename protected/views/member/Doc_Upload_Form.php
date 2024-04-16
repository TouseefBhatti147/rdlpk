<div class="container-fluid" style="font-size:12px; background:#FFF;">

<div class="row-fluid">
<html>
<head>
<title>File Uploading Form</title>
</head>
<body>
<h3>File Upload:</h3>

Select a file to upload: <br />
<form action="Doc_Upload" method="post"     enctype="multipart/form-data">
<input type="file" name="file[]" size="50" multiple />
<br />
<input type="submit" value="Upload File" />
</form>
</body>
</html>
</div>
</div>