<div class="container">
  <div class="content content-title">
    <h2>Tambah User</h2>
  </div>
  <div class="content">
    <div class="form-bungkus">
      <form id="inputForm" class="form-group" method="POST" action="<?= BASEURL; ?>/admin/userman/tambah" enctype="multipart/form-data">
        <div class="input-group" id="text1">
          <span>Username</span>
          <input type="text" name="username" placeholder="Username">
        </div>

        <div class="input-group" id="text2">
          <span>Password</span>
          <input type="password" name="pass" placeholder="Password">
        </div>

        <div class="input-group">
          <span>Tambah user via xls / xlsx <a href="http://192.168.1.13:8081/public/img/tes.xlsx">Template xlsx</a></span>
          <div class="xlsx">
            <input type="file" class="inputfile" id="file" name="file" onchange="uploadXls(event)">
            <label for="file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="namaUpload">Upload File</span></label>
            <button type="submit" name="preview" class="btn-preview">Preview</button>
          </div>
        </div>

        <div class="input-group-btn">
          <input class="btn submit" type="submit" value="Submit">
          <a class="btn close" onClick='history.back();'> Batal </a>
        </div>
      </form>
    </div>
  </div>

  <div id="preview"></div>

</div>
