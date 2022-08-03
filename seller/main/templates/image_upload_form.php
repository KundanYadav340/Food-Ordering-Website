<!DOCTYPE html>
<html>
<body>

<form action="image_upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="text" name="id" hidden required>
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>