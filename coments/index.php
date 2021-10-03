<?php
require_once("../conn.php");
$dat = returnContentsFailed($pdo);
$pel = returnContentsPelFailed($pdo);

function returnContentsFailed($pdo){
  $sta=$pdo->prepare("select co.*, c.* from comentary c join content_vid co on(co.id=c.id_comentary and c.type='_vid') order by c.hire_date desc");
  $sta->execute(array());
  $sta=$sta->fetchAll();
  return($sta);  
}

function returnContentsPelFailed($pdo){
  $sta=$pdo->prepare("select co.*, c.* from comentary c join content_pel co on(co.id=c.id_comentary and c.type='_pel') order by c.hire_date desc");
  $sta->execute(array());
  $sta=$sta->fetchAll();
  return($sta);  
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../css-materialize/materialize.min.css">    
  <link rel="stylesheet" type="text/css" href="../css-materialize/style.css">
  <meta charset="utf-8">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div id="responsive" class="section scrollspy">
          <h3 class="header">Comentary _vid</h3>
          <div class="row">
            <div class="col s2"><b>id_com</b></div>
            <div class="col s4"><b>coments</b></div>
            <div class="col s3"><b>response</b></div>
            <div class="col s3"><b>hire_date</b></div>
          </div>
          <div class="row">
            <ul class="collapsible popout">
              <?php foreach ($dat as $key => $value): ?>
              <li>
                <div class="collapsible-header">
                  <div class="col s1"><a href="../description/index.php?id=<?=$value['id_comentary']?>&type=<?=$value['type']?>" target="_blank"><?=$value['id_comentary']?></a></div>
                  <div class="col s12"><?=$value['coments']?></div>
                  <div class="col s12"><a href="mailto:<?=$value['email']?>"><?=$value['email']?></a></div>
                  <div class="col s12"><?=$value['hire_date']?></div>
                </div> 
                 <div class="collapsible-body">
                  <form action="../update/index.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$value['id']?>">
                    <input type="hidden" name="type" value="<?=$value['type']?>">
                    <input type="hidden" name="chgimage" value="<?=$value['image']?>">
                    <input  type="text" name="title" required="" value="<?=$value['title']?>">
                      <div class="row">
                        <div class="input-field col s12">
                          <textarea name="description" class="materialize-textarea font-min"><?=$value['description']?></textarea>
                          <label>description</label>
                        </div>
                      </div>
                    
                    <div class="col s2">
                      <label>category</label>
                        <?php
                        switch ($value['category']) {
                          case 'Progr':
                          ?>
                          <select class="browser-default" name="category" required="">
                            <option>Progr</option>
                            <option>DataB</option>
                            <option>DiWeb</option>
                            <option>Redes</option>
                            <option>Movil</option>
                            <option>SeInf</option>
                          </select>
                          <?php                         
                            break;
                          case 'DataB':
                          ?>
                          <select class="browser-default" name="category" required="">
                            <option>DataB</option>
                            <option>Progr</option>
                            <option>DiWeb</option>
                            <option>Redes</option>
                            <option>Movil</option>
                            <option>SeInf</option>
                          </select>
                          <?php 
                            break;
                          case 'DiWeb':
                          ?>
                          <select class="browser-default" name="category" required="">
                            <option>DiWeb</option>
                            <option>Progr</option>
                            <option>DataB</option>
                            <option>Redes</option>
                            <option>Movil</option>
                            <option>SeInf</option>
                          </select>
                          <?php
                            break;
                          case 'Redes':
                          ?>
                          <select class="browser-default" name="category" required="">
                            <option>Redes</option>
                            <option>Progr</option>
                            <option>DataB</option>
                            <option>DiWeb</option>
                            <option>Movil</option>
                            <option>SeInf</option>
                          </select>
                          <?php
                            break;
                          case 'SeInf':
                          ?>
                          <select class="browser-default" name="category" required="">
                            <option>SeInf</option>
                            <option>Redes</option>
                            <option>Progr</option>
                            <option>DataB</option>
                            <option>DiWeb</option>
                            <option>Movil</option>
                          </select>
                          <?php
                            break;
                          case 'Movil':
                          ?>
                          <select class="browser-default" name="category" required="">
                            <option>Movil</option>
                            <option>SeInf</option>
                            <option>Redes</option>
                            <option>Progr</option>
                            <option>DataB</option>
                            <option>DiWeb</option>
                          </select>
                          <?php
                            break;
                        }
                        ?>
                    </div>
                    <div class="col s5">
                      <label>password</label>
                      <input type="text" name="password" required="" value="<?=$value['password']?>">
                    </div>
                    <div class="col s5">
                      <label>size</label>
                      <input  type="text" name="size" required="" value="<?=$value['size']?>">  
                    </div>
                    <div class="col s12">
                      <label >url</label>
                      <input type="text" name="url" required="" value="<?=$value['all_links']?>">  
                    </div>                    
                    <div class="row">
                      <div class="col s9">
                        <div class="file-field input-field">
                          <div class="btn">
                            <span>File</span>
                            <input type="file" name="imagen">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="imagen" required="" value="<?=$value['image']?>">
                            </div>
                        </div>
                      </div>
                      <div class="col s3">
                        <div class="file-field input-field">
                          <button class="btn waves-effect waves-light" type="submit">Submit
                            <i class="material-icons right"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    
                  </form>
                 </div>
              </li>
              <?php endforeach ?>
              <div id="options" class="scrollspy section"></div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col s12">
        <div id="responsive" class="section scrollspy">
          <h3 class="header">Comentary _pel</h3>
          <div class="row">
            <div class="col s2"><b>id_com</b></div>
            <div class="col s4"><b>coments</b></div>
            <div class="col s3"><b>response</b></div>
            <div class="col s3"><b>edited</b></div>
          </div>
          <div class="row">
            <ul class="collapsible popout">
              <?php foreach ($pel as $key => $value): ?>
              <li>
                <div class="collapsible-header">
                  <div class="col s1"><a href="../description/index.php?id=<?=$value['id_comentary']?>&type=<?=$value['type']?>" target="_blank"><?=$value['id_comentary']?></a></div>
                  <div class="col s12"><?=$value['coments']?></div>
                  <div class="col s12"><a href="mailto:<?=$value['email']?>"><?=$value['email']?></a></div>
                  <div class="col s1"><label><input type="checkbox" /><span></span></label></div>
                </div> 
                 <div class="collapsible-body">
                  <form action="../submit.php" method="post" enctype="multipart/form-data" id="_form">
                    <input  type="text" name="title" required="" value="<?=$value['title']?>">
                      <div class="row">
                        <div class="input-field col s12">
                          <textarea name="description" id="textarea1" class="materialize-textarea"><?=$value['description']?></textarea>
                          <label for="textarea1">description</label>
                        </div>
                      </div>
                    
                    <div class="col s2">
                      <label>type</label>
                        <select class="browser-default" name="category" required="">
                          <option value="1">Progr</option>
                          <option value="2">DataB</option>
                          <option value="3">DiWeb</option>
                          <option value="3">Redes</option>
                        </select>
                    </div>
                    <div class="col s5">
                      <label for="textarea1">password</label>
                      <input type="text" name="password" required="" value="<?=$value['password']?>">
                    </div>
                    <div class="col s5">
                      <label>size</label>
                      <input  type="text" name="size" required="" value="<?=$value['size']?>">  
                    </div>
                    <div class="col s12">
                      <label >url</label>
                      <input type="text" name="url" required="" value="<?=$value['all_links']?>">  
                    </div>                    
                    <div class="row">
                      <div class="col s9">
                        <div class="file-field input-field">
                          <div class="btn">
                            <span>File</span>
                            <input type="file">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="imagen" required="" value="<?=$value['image']?>">
                            </div>
                        </div>
                      </div>
                      <div class="col s3">
                        <div class="file-field input-field">
                          <button class="btn waves-effect waves-light" type="submit">Submit
                            <i class="material-icons right"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    
                  </form>
                 </div>
              </li>
              <?php endforeach ?>
              <div id="options" class="scrollspy section"></div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

          
  <script type="text/javascript" src="../css-materialize/materialize.min.js"></script>
  <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.collapsible');
        var instances = M.Collapsible.init(elems, options);
      });
    </script>
  <script type="text/javascript" src="../css-materialize/materialize.min.js"></script>
</body>
</html>
