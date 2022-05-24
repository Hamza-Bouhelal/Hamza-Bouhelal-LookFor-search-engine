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
  <div id="cont">
    <button  style="display: none" class="btn borderbutton" id="logout" onclick="changeloc('logout');">Logout</button>
    <a id="changepass" style="display: <?php if(checkLogin()) { echo "block";} else {echo "none";}?>"class="changePass" href="login-register/changePassword.php">Change Password</a>
  </div>
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
          <img src="login-register/images/copy.png" class="copytext2" onclick="copytranslatedtext()" />
        </center>
        <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      </div>
    </div>
    <input type="radio" name="tabs" id="tabfive"
      onclick="changetab('grammar');document.getElementById('transfromgr').value = document.getElementById('searchinput').value;searchgrammar();">
    <label for="tabfive">Spell Check</label>
    <div class="tab">
    <div style="min-height: 70px"></div>
      <div class="grammar">
        <center>
          <span style="display: inline"><button class="btn_grammar" onclick="searchgrammar()">Check Spelling</button><div class="score" id="score"></div> </span>
          <br/>
          <textarea placeholder="Enter or paste text here" id="transfromgr" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'
            class="input-element2"></textarea>
            <p id="transtogr" class="input-elemen2"></p>
            <img src="login-register/images/copy.png" class="copytext" onclick="copycheckedtext()" />

        </center>
        <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
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
  textInp.focus();
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
  function update_search_history() {
  var user_id = <?php echo $_SESSION['user_id']; ?>;
  if (logged) {
    if(! (<?php echo json_encode( $_SESSION['user_data']); ?>).toLowerCase().includes(textInp.value.toLowerCase())){
      $.ajax({
        url: "UpdateSearchHistory.php?query=" + textInp.value + "&user_id=" + user_id,
      }).done(function(data) {
        console.log(data);
      });
    }
  }
}
function getdata(){
  return <?php 
    if(isset($_SESSION['user_data'])){
      echo json_encode($_SESSION['user_data']);
    } else {
      echo json_encode("");
    }
  ?>;
}
textInp.onkeypress = function (e) {
  if (e.key == "Enter") {
    hide_suggestions();
    glob_search();
  } else if (e.key == " " && textInp.value.replace(" ", "") != "") {
    fetch(
      "https://bing-autosuggest1.p.rapidapi.com/suggestions?q=" +
        textInp.value.replace(" ", "%20"),
      {
        method: "GET",
        headers: {
          "x-bingapis-sdk": "true",
          "x-rapidapi-host": "bing-autosuggest1.p.rapidapi.com",
          "x-rapidapi-key":
            "b2f149e06bmsh8efd678074bb06ap1105f6jsnd63b170f9f28",
        },
      }
    )
      .then((response) => response.json())
      .then((response) => {
        var autoitems = document.getElementsByClassName("autocomplete_item");
        var tempp = 0;
        if(logged){
          var data = getdata();
          if(data !== ""){
            var autocompletelist = data.split("*-sep-*");
            for (var j = 0; j < autocompletelist.length; j++) {
              if (autocompletelist[j].toLowerCase().includes(textInp.value.toLowerCase())) {
                autoitems[tempp].innerHTML = autocompletelist[j];
                autoitems[tempp].style.color = "#9963b3";
                autoitems[tempp].style.display = "block";
                tempp++;
              }
              if(tempp == 3){
                break;
              }
            }
          }
        }
        var k = 0;
        for (var i = tempp; i < autoitems.length; i++) {
          autoitems[i].style.color = "#000000";
          if (
            i + k >=
            response["suggestionGroups"][0]["searchSuggestions"].length
          ) {
            break;
          }
          autoitems[i].innerHTML =
            response["suggestionGroups"][0]["searchSuggestions"][i + k][
              "query"
            ];
          autoitems[i].style.display = "flex";
        }
        if (response["suggestionGroups"][0]["searchSuggestions"].length == 0) {
          hide_suggestions();
        } else {
          if (looking) {
            document.getElementsByClassName("wrap")[0].style.top = "16.7%";
          } else {
            document.getElementsByClassName("wrap")[0].style.top = "52%";
          }
        }
        sugf_displ = true;
        document.getElementById("autocomplete").style.display = "block";
      })
      .catch((err) => {
        console.error(err);
      });
  } else {
    hide_suggestions();
  }
};
</script>
</html>