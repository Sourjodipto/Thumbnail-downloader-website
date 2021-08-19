<?php
  if(isset($_POST['button'])){
    $imgUrl = $_POST['imgurl'];
    $ch = curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $downloadImg = curl_exec($ch);
    curl_close($ch);
    header('Content-type: image/jpg');
    header('Content-Disposition: attachment;filename="thumbnail.jpg"');
    echo $downloadImg;
  }
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download YouTube Thumbnail </title>
  <link rel="stylesheet" href="style.css">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
  />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <header>
    <nav class="main-nav">
      <input type="checkbox" id="check" />
      <label for="check" class="menu-btn">
        <i class="fas fa-bars"></i>
      </label>
      <a href="index.html" class="logo">Thumbnail Downloader</a>
      <ul class="navlinks">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="#">Other Tools</a></li>
        <li><a href="contact.html" class="contact">Contact</a></li>
      </ul>
    </nav>
  </header>
  <div class="form-space">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <h1>Thumbnail Downloader</h1>
      <div class="url-input">
        <span class="title">Paste the youtube video URL :</span>
        <div class="field">
          <input type="text" placeholder="https://youtu.be/FFSju41SA5w" required>
          <input class="hidden-input" type="hidden" name="imgurl">
          <span class="bottom-line"></span>
        </div>
      </div>
      <div class="preview-area">
        <img class="thumbnail" src="" alt="">
        <span>Preview</span>
      </div>
      <button class="download-btn" type="submit" name="button">Download</button>
    </form>
  </div>
  <footer>
    <p class="copyright">© SOURJODIPTO 2021</p>
  </footer>
  <script>
    const urlField = document.querySelector(".field input"),
    previewArea = document.querySelector(".preview-area"),
    imgTag = previewArea.querySelector(".thumbnail"),
    hiddenInput = document.querySelector(".hidden-input"),
    button = document.querySelector(".download-btn");
    urlField.onkeyup = ()=>{
      let imgUrl = urlField.value;
      previewArea.classList.add("active");
      button.style.pointerEvents = "auto";
      if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1){
        let vidId = imgUrl.split('v=')[1].substring(0, 11);
        let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src = ytImgUrl;
      }else if(imgUrl.indexOf("https://youtu.be/") != -1){
        let vidId = imgUrl.split('be/')[1].substring(0, 11);
        let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
        imgTag.src = ytImgUrl;
      }else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)){
        imgTag.src = imgUrl;
      }else{
        imgTag.src = "";
        button.style.pointerEvents = "none";
        previewArea.classList.remove("active");
      }
      hiddenInput.value = imgTag.src;
    }
  </script>

</body>
</html>