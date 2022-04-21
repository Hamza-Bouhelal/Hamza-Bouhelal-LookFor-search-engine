<?php 
require_once "login-register/connect.php";
session_start();
function checkLogin(){
  if (!empty($_SESSION['user_id'])) {
      return true;
  } else {
      return false;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LookFor Search Engine</title>
  <link rel="stylesheet" href="style.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="jquery-3.6.0.min.js"></script>
  </head>

<body>
  <button style="" class="btn2 borderbutton" id="register" onclick="changeloc('register');">Register</button>
  <button  style="" class="btn borderbutton" id="login" onclick="changeloc('login');">Login</button>
  <h4  style="display: none;" class="welcome" id="welcome"></h4>
  <button  style="display: none" class="btn borderbutton" id="logout" onclick="changeloc('logout');">Logout</button>
  <center>
    <img src="login-register/images/title.png" class="imgtitle" onclick="goback()" />
  </center>
  <div class="wrap">
    <div class="search">
      <input type="text" name="searchinp" id="searchinput" class="searchTerm" placeholder="Search key or URL" />

      <button type="submit" class="searchButton" onclick="glob_search()">
        <i class="fa fa-search"></i>
      </button>
    </div>
    <div class="autocomplete_item" onclick="autocomplete(this)">item</div>
    <div class="autocomplete_item" onclick="autocomplete(this)">item</div>
    <div class="autocomplete_item" onclick="autocomplete(this)">item</div>
    <div class="autocomplete_item" onclick="autocomplete(this)">item</div>
    <div class="autocomplete_item" onclick="autocomplete(this)">item</div>

  </div>

  <br />
  <br />
  <br />
  <div id="loading" style="display: none;">
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="loader"></div>
  </div>
  <div class="tabs">

    <input type="radio" name="tabs" id="tabone" checked="checked"
      onclick="changetab('All');resetpagination();Searchtext();">
    <label for="tabone">All</label>
    <div class="tab">
    <div class="use_chat" onclick="usechatbot()">Have a question? Use the chatbot!</div>
      <div style="display: inline-block;">
        <div class="pagination">
          <a class="a" name="prev" onclick="explore_pagination_left(2, 3)">&laquo;</a>
          <a class="a active" name="1" onclick="explore_pagination_left(2, 1)">1</a>
          <a class="a" name="2" onclick="changepagination(this)">2</a>
          <a class="a" name="3" onclick="changepagination(this)">3</a>
          <a class="a" name="4" onclick="changepagination(this)">4</a>
          <a class="a" name="5" onclick="changepagination(this)">5</a>
          <a class="a" name="6" onclick="explore_pagination_right(2, 4)">6</a>
          <a class="a" name="next" onclick="explore_pagination_right(2, 4)">&raquo;</a>
        </div>
        <h5 id="resulttime" style="color: #646464; margin-top: -33px;">
      </div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <a href="somewhere.com" class="links"></a>
      <p class="p"></p>
      <div class="line"></div>
      <br />
      <br />
      <div class="pagination">
        <a class="a" name="prev" onclick="explore_pagination_left(2, 3)">&laquo;</a>
        <a class="a active" name="1" onclick="explore_pagination_left(2, 1)">1</a>
        <a class="a" name="2" onclick="changepagination(this)">2</a>
        <a class="a" name="3" onclick="changepagination(this)">3</a>
        <a class="a" name="4" onclick="changepagination(this)">4</a>
        <a class="a" name="5" onclick="changepagination(this)">5</a>
        <a class="a" name="6" onclick="explore_pagination_right(2, 4)">6</a>
        <a class="a" name="next" onclick="explore_pagination_right(2, 4)">&raquo;</a>
      </div>
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
    </div>
    <input type="radio" name="tabs" id="tabthree" onclick="changetab('News');searchnews();resetpagination()">
    <label for="tabthree">News</label>
    <div class="tab">
      <br />
      <br />
      <div class="pagination">
        <a class="a" name="prev" onclick="news_explore_pagination_left(2, 3)">&laquo;</a>
        <a class="a active" name="1" onclick="news_explore_pagination_left(2, 1)">1</a>
        <a class="a" name="2" onclick="news_changepagination(this)">2</a>
        <a class="a" name="3" onclick="news_changepagination(this)">3</a>
        <a class="a" name="4" onclick="news_changepagination(this)">4</a>
        <a class="a" name="5" onclick="news_changepagination(this)">5</a>
        <a class="a" name="6" onclick="news_explore_pagination_right(2, 4)">6</a>
        <a class="a" name="next" onclick="news_explore_pagination_right(2, 4)">&raquo;</a>
      </div>
      <h5 id="newsresulttime" style="color: #646464; margin-top: -33px;"></h5>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <div class="newscontainer" href="">
        <p class="newssource"></p>
        <div class="split">
          <div class="split-text">
            <a class="newstitle" href=""></a>
            <p class="newssummary"></p>
          </div>
          <div class="split-img">
            <img class="newsimage" href="" target="_blank" src="" />
          </div>
        </div>
      </div>
      <br />
      <br />
      <div class="pagination">
        <a class="a" name="prev" onclick="news_explore_pagination_left(2, 3)">&laquo;</a>
        <a class="a active" name="1" onclick="news_explore_pagination_left(2, 1)">1</a>
        <a class="a" name="2" onclick="news_changepagination(this)">2</a>
        <a class="a" name="3" onclick="news_changepagination(this)">3</a>
        <a class="a" name="4" onclick="news_changepagination(this)">4</a>
        <a class="a" name="5" onclick="news_changepagination(this)">5</a>
        <a class="a" name="6" onclick="news_explore_pagination_right(2, 4)">6</a>
        <a class="a" name="next" onclick="news_explore_pagination_right(2, 4)">&raquo;</a>
      </div>
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
    </div>
    <input type="radio" name="tabs" id="tabtwo" onclick="changetab('Img');searchimg();resetpagination()">
    <label for="tabtwo">Images</label>
    <div class="tab">
      <br />
      <br />
      <div class="pagination">
        <a class="a" name="prev" onclick="img_explore_pagination_left(2, 3)">&laquo;</a>
        <a class="a active" name="1" onclick="img_explore_pagination_left(2, 1)">1</a>
        <a class="a" name="2" onclick="img_changepagination(this)">2</a>
        <a class="a" name="3" onclick="img_changepagination(this)">3</a>
        <a class="a" name="4" onclick="img_changepagination(this)">4</a>
        <a class="a" name="5" onclick="img_changepagination(this)">5</a>
        <a class="a" name="6" onclick="img_explore_pagination_right(2, 4)">6</a>
        <a class="a" name="next" onclick="img_explore_pagination_right(2, 4)">&raquo;</a>
      </div>
      <h5 id="imgsresulttime" style="color: #646464; margin-top: -33px; display:none"></h5>
      <div class="img_container">
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
        <div class="img_item">
          <img class="imgg" src="">
          <br />
          <a class="img_description" href=""></a>
        </div>
      </div>
      <br />
      <br />
      <div class="pagination">
        <a class="a" name="prev" onclick="img_explore_pagination_left(2, 3)">&laquo;</a>
        <a class="a active" name="1" onclick="img_explore_pagination_left(2, 1)">1</a>
        <a class="a" name="2" onclick="img_changepagination(this)">2</a>
        <a class="a" name="3" onclick="img_changepagination(this)">3</a>
        <a class="a" name="4" onclick="img_changepagination(this)">4</a>
        <a class="a" name="5" onclick="img_changepagination(this)">5</a>
        <a class="a" name="6" onclick="img_explore_pagination_right(2, 4)">6</a>
        <a class="a" name="next" onclick="img_explore_pagination_right(2, 4)">&raquo;</a>
      </div>
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
    </div>

    <input type="radio" name="tabs" id="tabfour"
      onclick="changetab('translate');document.getElementById('transfrom').value = document.getElementById('searchinput').value;translatetext();">
    <label for="tabfour">Translation</label>
    <div class="tab">
      <div class="split_translate left">
        <center>
          <p><a onclick="changefrom(this)" class="languages active1">Auto-Detect</a><a onclick="changefrom(this)"
              class="languages">English</a><a onclick="changefrom(this)" class="languages">French</a><a
              onclick="changefrom(this)" class="languages">Spanish</a></p>
          <div style="margin-top: 15px;">Translate from <strong id="from">Auto-Detect</strong></div>
          <textarea id="transfrom" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
            class="input-element"></textarea>
        </center>
      </div>

      <div class="split_translate right">
        <center>
          <p><a onclick="changeto(this)" class="languages active1">English</a><a onclick="changeto(this)"
              class="languages">French</a><a onclick="changeto(this)" class="languages">Spanish</a></p>
          <div style="margin-top: 15px;">Translate to <strong id="to">English</strong></div>
          <textarea placeholder="Translation" id="transto"
            oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' class="input-element"
            readonly></textarea>
          <br />
          <img src="login-register/images/copy.png" class="copytext" onclick="copytranslatedtext()" />
        </center>
      </div>
    </div>
  </div>
  <div class="chatbox">
    <center>
    <img src="login-register/images/title_ass.png" class="chat_title"/> 
    </center>
    <div class="line2"></div>
    <div class="chatcontainer"> 
      <div class="chat_from ai">
      <img src="login-register/images/openai.png" alt="Avatar" class="leftchat_img">
        <p>Hello, I am LookFor Chatbot powered by OpenAI. How can I help you?</p>
      </div>
    </div>
    <input type="text" class="chat_input">
    <script>
      function conditional_send(){
        if (<?php echo json_encode(checkLogin());?>) {
          sendchat(<?php echo json_encode($_SESSION['user_name']); ?>);
        } else {
          sendchat("");
        }
      }
    </script>
    <img src="login-register/images/send.png" class="send_button" onclick="conditional_send()">

  </div>
  <img src="login-register/images/chat.png" class="chat_img" onclick="handle_chat_click()"/>
  <div class="footer">
    <p>LOOKFOR &copy; 2022</p>
    <h6>Made by Hamza Bouhelal</h1>
      <a href="https://github.com/Hamza-Bouhelal" class="link link-footer">
        <img src="login-register/images/github.svg" class="social-img"/>
      </a>
  </div>
</body>
<script type="text/javascript" src="app.js"></script>
<script>
  var logged = false;
function onloaded(){
    var isloggedin = <?php $t = checkLogin(); echo $t; ?>;
     if (isloggedin == 1) {
       logged = true;
       var id = <?php echo $_SESSION['user_id']; ?>;
        var name = <?php 
        $result = mysqli_query($conn, "SELECT * FROM users WHERE uid = '" . $_SESSION['user_id'] . "'");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_data'] = $row['data'];
        $_SESSION['user_id'] = $row['uid'];
        echo json_encode($row['name']);
        ?>;
        document.getElementById("login").style.display = "none";
        document.getElementById("logout").style.display = "block";
        document.getElementById("register").style.display = "none";
        document.getElementById("welcome").style.display = "block";
        document.getElementById("welcome").innerHTML = "Welcome, " +  name;
      } else {
        document.getElementById("login").style.display = "block";
        document.getElementById("logout").style.display = "none";
        document.getElementById("register").style.display = "block";
        document.getElementById("welcome").style.display = "none";
    }
}
  window.onload= onloaded();
</script>
</html>