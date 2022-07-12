<?php

try {
  // File Route.
  $fileRoute = "/uploads/";

  $fieldname = "file";

  // Get filename.
  $filename = explode(".", $_FILES[$fieldname]["name"]);

  // Validate uploaded files.
  // Do not use $_FILES["file"]["type"] as it can be easily forged.
  $finfo = finfo_open(FILEINFO_MIME_TYPE);

  // Get temp file name.
  $tmpName = $_FILES[$fieldname]["tmp_name"];

  // Get mime type.
  $mimeType = finfo_file($finfo, $tmpName);

  // Get extension. You must include fileinfo PHP extension.
  $extension = end($filename);

  // Allowed extensions.
  $allowedExts = array("jpeg", "jpg", "png");

  // Allowed mime types.
  $allowedMimeTypes = array("image/jpeg", "image/pjpeg", "image/x-png", "image/png");

  // Validate image.
  if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
    throw new \Exception("File does not meet the validation.");
  }

  // Generate new random name.
  $name = strtotime("now") . "." . $extension;
  $fullNamePath = $_SERVER['DOCUMENT_ROOT'] . $fileRoute . $name;

  // Check server protocol and load resources accordingly.
  if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
    $protocol = "https://";
  } else {
    $protocol = "http://";
  }

  // Save file in the uploads folder.
  move_uploaded_file($tmpName, $fullNamePath);

  // Generate response.
  $response = new \StdClass;
  $response->link = $fileRoute . $name;

  // Send response.
  echo stripslashes(json_encode($response));
} catch (Exception $e) {
  // Send error response.
  echo $e->getMessage();
  http_response_code(404);
}