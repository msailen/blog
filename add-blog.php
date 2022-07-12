<?php
session_start();
$error = false;
$formValue['title'] = '';
$formValue['content'] = '';
//redirects to homepage if user session is active
if (!isset($_SESSION['isAdmin'])) {
  header("location: 404.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $formValue['title'] = $_POST['title'];
  $formValue['content'] =  $_POST['content'];

  require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/blog.controller.php";

  if (!empty($_POST['title']) && !empty($_POST['content']) && !$error) {
    try {
      $userId = Blog::addBlog($formValue);
      header("Location: index.php");
    } catch (Exception $err) {
      $error = "Failed To Add Blog";
    }
  } else {
    $error = "All Fields Are Required";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Blog</title>
  <?php require_once "global/head.php"; ?>
  <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
  <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/plugins/image.min.css' rel='stylesheet' type='text/css' />
</head>

<body>
  <?php require_once "global/header.php"; ?>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Create a New Blog Post</h5>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <span class="text-danger"><?php if (isset($error)) echo $error; ?></span>
            <div class="form-group mb-2">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" placeholder="Enter Titile" required value="<?php echo $formValue['title']; ?>">
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="ckEditor" id="content" name="content" placeholder="Content" required value="<?php echo $formValue['content']; ?>">
              </textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2">Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/image.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/lists.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/fullscreen.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/font_size.min.js'></script>
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/plugins/font_family.min.js'></script>

  <script>
    new FroalaEditor('#content', {
      heightMin: 400,
      quickInsertEnabled: false,
      toolbarButtons: {
        'moreText': {
          'buttons': ['bold', 'italic', 'underline', 'fontFamily', 'fontSize'],
          'buttonsVisible': 5
        },
        'moreParagraph': {
          'buttons': ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'formatOL', 'formatUL'],
          'buttonsVisible': 6
        },
        'moreRich': {
          'buttons': ['insertLink', 'insertImage']
        },
        'moreMisc': {
          'buttons': ['undo', 'redo', 'fullscreen'],
          'align': 'right',
          'buttonsVisible': 3
        }

      },
      imageUploadURL: '/upload.php',
      imageAllowedTypes: ['jpeg', 'jpg', 'png'],
    })
  </script>

  <?php require_once "global/footer.php"; ?>

</body>

</html>