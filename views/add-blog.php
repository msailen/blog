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
          <form>
            <div class="form-group mb-2">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" placeholder="Enter Titile" required>
            </div>
            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="ckEditor" id="content" placeholder="Content" required></textarea>
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
      imageUploadURL: '/upload-img',
      imageAllowedTypes: ['jpeg', 'jpg', 'png'],
      'image.uploaded': (res) => {
        console.log(res);
      }
    })
  </script>

  <?php require_once "global/footer.php"; ?>

</body>

</html>