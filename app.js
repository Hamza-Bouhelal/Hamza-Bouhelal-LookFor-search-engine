var textInp = document.getElementById("searchinput");
var bool = false;
var sugf_displ = false;
var looking = false;
var currenttab = "All";
function changetab(newtab) {
  currenttab = newtab;
}
function changeloc(newloc) {
  window.location.href =
    window.location.href.replace("index.php", "") +
    "login-register/" +
    newloc +
    ".php";
}
function goback() {
  bool = true;
  hide_suggestions();
  looking = false;
  currenttab = "All";
  document.getElementById("tabone").click();
  resetpagination();
  //go back to main overlay
  //change css and content back to the way it was:
  document.getElementById("resulttime").innerHTML = "";
  document.getElementById("loading").style.display = "none";
  document.getElementsByClassName("tabs")[0].style.display = "none";
  document.getElementsByClassName("wrap")[0].style.top = "40%";
  document.getElementsByClassName("wrap")[0].style.width = "60%";
  document.getElementsByClassName("imgtitle")[0].style.top = "30%";
  document.getElementsByClassName("imgtitle")[0].style.left = "50%";
  document.getElementsByClassName("imgtitle")[0].style.width = "20%";
  document.getElementsByClassName("searchTerm")[0].style.height = "30px";
  document.getElementsByClassName("searchButton")[0].style.height = "46px";
  document.getElementsByClassName("searchButton")[0].style.width = "46px";
  textInp.select();

  for (var i = 0; i < 10; i++) {
    document.getElementsByClassName("line")[i].style.display = "none";
    document.getElementsByClassName("links")[i].style.display = "none";
    document.getElementsByClassName("p")[i].style.display = "none";
    document.getElementsByClassName("links")[i].href = "";
    document.getElementsByClassName("links")[i].innerHTML = "";
    document.getElementsByClassName("p")[i].innerHTML = "";
  }
  looking = false;
}
function changepagination(next) {
  if (
    next.name == document.getElementsByClassName("a")[6] ||
    next.name == document.getElementsByClassName("a")[14]
  ) {
    explore_pagination_right(1, 5);
    return;
  }
  window.scrollTo({ top: 0, behavior: "smooth" });
  var as = document.getElementsByClassName("a");
  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    as[i].style.color = "#646464";
    as[i].style.backgroundColor = "white";
    if (as[i].name == next.name) {
      as[i].style.backgroundColor = "#00b4cc";
      as[i].style.color = "white";
    }
  }
  next.style.backgroundColor = "#00b4cc";
  next.style.color = "white";
  setTimeout(function () {
    document.getElementById("loading").style.display = "flex";
  }, 100);
  var num = parseInt(next.name) * 10 + 3;
  var url =
    "https://google-search3.p.rapidapi.com/api/v1/search/q=" +
    textInp.value.replace(" ", "+") +
    "&num=" +
    num.toString() +
    "&start=" +
    (num - 13).toString();
  fetch(url, {
    method: "GET",
    headers: {
      "x-user-agent": "desktop",
      "x-proxy-location": "US",
      "x-rapidapi-host": "google-search3.p.rapidapi.com",
      "x-rapidapi-key": "b8b5df92fcmsh8b7f96dec7efc5ep181350jsnf248e187c4e7",
    },
  })
    .then((response) => response.json())
    .then((response) => {
      var t = 0;
      //fill predefinied <a/> and <p/> with api response
      for (var i = 0; i < 10; i++) {
        document.getElementsByClassName("line")[i].style.display = "none";
        document.getElementsByClassName("links")[i].style.display = "none";
        document.getElementsByClassName("p")[i].style.display = "none";
        document.getElementsByClassName("links")[i].href = "";
        document.getElementsByClassName("links")[i].innerHTML = "";
        document.getElementsByClassName("p")[i].innerHTML = "";
        try {
          document.getElementsByClassName("line")[i].style.display = "flex";
          document.getElementsByClassName("links")[i].style.display = "flex";
          document.getElementsByClassName("p")[i].style.display = "flex";
          document.getElementsByClassName("links")[i].href =
            response["results"][i]["link"];
          document.getElementsByClassName("links")[i].innerHTML =
            response["results"][i]["title"];
          document.getElementsByClassName("p")[i].innerHTML =
            response["results"][i]["description"];
        } catch {
          t++;
          document.getElementsByClassName("line")[i].style.display = "none";
          document.getElementsByClassName("links")[i].style.display = "none";
          document.getElementsByClassName("p")[i].style.display = "none";
          document.getElementsByClassName("links")[i].href = "";
          document.getElementsByClassName("links")[i].innerHTML = "";
          document.getElementsByClassName("p")[i].innerHTML = "";
          if (i == 9) {
            document.getElementsByClassName("line")[i - 1].style.display =
              "none";
          }
        }
      }
      if (t > 8) {
        alert("Looks like an error occured!");
        location.reload();
      }
      //writing response time to the class resulttime
      var sub =
        "Results obtained in " +
        response["ts"].toString().substring(0, 4) +
        " Seconds.";
      document.getElementById("resulttime").innerHTML = sub;
      document.getElementsByClassName("line")[i - 1].style.display = "none";
      document.getElementById("loading").style.display = "none";
      document.getElementsByClassName("tabs")[0].style.display = "flex";
    })
    .catch((err) => {
      console.error(err);
    });
}

function explore_pagination_right(step, pos) {
  var as = document.getElementsByClassName("a");
  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    if (as[i].name != "next" && as[i].name != "prev") {
      var tu = parseInt(as[i].name) + step;
      as[i].name = tu.toString();
      as[i].innerHTML = tu.toString();
    }
  }
  changepagination(document.getElementsByClassName("a")[pos]);
}

function explore_pagination_left(step, pos) {
  var as = document.getElementsByClassName("a");
  if (parseInt(as[1].name) == "1") {
    changepagination(document.getElementsByClassName("a")[pos]);
    return;
  }
  for (var i = 0; i < as.length; i++) {
    if (as[i].name != "next" && as[i].name != "prev") {
      var tu = parseInt(as[i].name) - step;
      as[i].name = tu.toString();
      as[i].innerHTML = tu.toString();
    }
  }
  changepagination(document.getElementsByClassName("a")[pos]);
}

function resetpagination() {
  //reset color and value of all pagination
  var as = document.getElementsByClassName("a");
  for (var i = 1; i < as.length - 1; i++) {
    if (i == 1 || i == 9 || i == 17 || i == 25 || i == 33 || i == 41) {
      as[i].name = "1";
      as[i].innerHTML = "1";
      as[i].style.backgroundColor = "#00b4cc";
      as[i].style.color = "white";
    } else {
      as[i].style.color = "#646464";
      as[i].style.backgroundColor = "white";
      if (
        i == 7 ||
        i == 8 ||
        i == 15 ||
        i == 16 ||
        i == 23 ||
        i == 24 ||
        i == 31 ||
        i == 32 ||
        i == 39 ||
        i == 40
      ) {
        //do nothing, as[i] is an extend pagination element (<< or >>)
      } else if (i < 7) {
        as[i].name = i.toString();
        as[i].innerHTML = i.toString();
      } else if (i < 15) {
        as[i].name = (i - 8).toString();
        as[i].innerHTML = (i - 8).toString();
      } else if (i < 23) {
        as[i].name = (i - 16).toString();
        as[i].innerHTML = (i - 16).toString();
      } else if (i < 31) {
        as[i].name = (i - 24).toString();
        as[i].innerHTML = (i - 24).toString();
      } else if (i < 39) {
        as[i].name = (i - 32).toString();
        as[i].innerHTML = (i - 32).toString();
      } else {
        as[i].name = (i - 40).toString();
        as[i].innerHTML = (i - 40).toString();
      }
    }
  }
}
function isURL(str) {
  //check if input is an url
  var a = document.createElement("a");
  a.href = str;
  return a.host && a.host != window.location.host;
}

function Searchtext() {
  hide_suggestions();
  if (bool) {
    bool = false;
    return;
  }

  document.getElementsByClassName("pagination")[0].style.display = "none";
  document.getElementsByClassName("pagination")[1].style.display = "none";
  resetpagination();
  hide_suggestions();
  if (isURL(textInp.value)) {
    window.location.href = textInp.value;
  }

  if (textInp.value == "") {
    textInp.focus();
    textInp.select();
    return;
  }
  if (textInp.value.includes("?")) {
    document.getElementsByClassName("use_chat")[0].style.display = "block";
  }
  looking = true;
  var add_links = document.getElementsByClassName("additional_link");
  for (var i = 0; i < add_links.length; i++) {
    add_links[i].style.display = "none";
  }
  //change css to second overlay
  if (sugf_displ) {
    document.getElementsByClassName("wrap")[0].style.top = "16.7%";
  } else {
    document.getElementsByClassName("wrap")[0].style.top = "3.7%";
  }
  document.getElementsByClassName("wrap")[0].style.width = "30%";
  document.getElementsByClassName("imgtitle")[0].style.top = "3.2%";
  document.getElementsByClassName("imgtitle")[0].style.left = "10%";
  document.getElementsByClassName("imgtitle")[0].style.width = "13%";
  document.getElementsByClassName("searchTerm")[0].style.height = "20px";
  document.getElementsByClassName("searchButton")[0].style.height = "36px";
  document.getElementsByClassName("searchButton")[0].style.width = "36px";
  //show the loader after 0.1 sec to avoid it appearing before the css changes are over
  setTimeout(function () {
    document.getElementById("loading").style.display = "flex";
  }, 100);

  var url =
    "https://google-search3.p.rapidapi.com/api/v1/search/q=" +
    textInp.value.replace(" ", "+") +
    "&num=13";
  fetch(url, {
    method: "GET",
    headers: {
      "x-user-agent": "desktop",
      "x-proxy-location": "US",
      "x-rapidapi-host": "google-search3.p.rapidapi.com",
      "x-rapidapi-key": "b8b5df92fcmsh8b7f96dec7efc5ep181350jsnf248e187c4e7",
    },
  })
    .then((response) => response.json())
    .then((response) => {
      hide_suggestions();
      //fill predefinied <a/> and <p/> with api response
      for (var i = 0; i < 10; i++) {
        document.getElementsByClassName("line")[i].style.display = "none";
        document.getElementsByClassName("links")[i].style.display = "none";
        document.getElementsByClassName("p")[i].style.display = "none";
        document.getElementsByClassName("links")[i].href = "";
        document.getElementsByClassName("links")[i].innerHTML = "";
        document.getElementsByClassName("p")[i].innerHTML = "";
        try {
          document.getElementsByClassName("line")[i].style.display = "flex";
          document.getElementsByClassName("links")[i].style.display = "flex";
          document.getElementsByClassName("p")[i].style.display = "flex";
          document.getElementsByClassName("links")[i].href =
            response["results"][i]["link"];
          document.getElementsByClassName("links")[i].innerHTML =
            response["results"][i]["title"];
          document.getElementsByClassName("p")[i].innerHTML =
            response["results"][i]["description"];
        } catch {
          document.getElementsByClassName("line")[i - 1].style.display = "none";
          document.getElementsByClassName("links")[i].style.display = "none";
          document.getElementsByClassName("p")[i].style.display = "none";
        }
      }
      //writing response time to the class resulttime
      var sub =
        "Results obtained in " +
        response["ts"].toString().substring(0, 4) +
        " Seconds.";
      document.getElementById("resulttime").innerHTML = sub;
      document.getElementsByClassName("line")[i - 1].style.display = "none";
      document.getElementById("loading").style.display = "none";
      document.getElementsByClassName("tabs")[0].style.display = "flex";
      document.getElementsByClassName("pagination")[0].style.display = "flex";
      document.getElementsByClassName("pagination")[1].style.display = "flex";
    })
    .catch((err) => {
      console.error(err);
    });
}
function hide_suggestions() {
  var autoitems = document.getElementsByClassName("autocomplete_item");
  for (var i = 0; i < autoitems.length; i++) {
    autoitems[i].style.display = "none";
  }
  sugf_displ = false;
  if (looking) {
    document.getElementsByClassName("wrap")[0].style.top = "3.7%";
  } else {
    document.getElementsByClassName("wrap")[0].style.top = "40%";
  }
}
var currenthover = 0;
textInp.onkeydown = function (e) {
  var suggestionss = document.getElementsByClassName("autocomplete_item");
  if (textInp.value.length == 0) {
    hide_suggestions();
  } else if (sugf_displ) {
    if (e.keyCode == "40") {
      suggestionss[currenthover].style.background = "white";
      if (currenthover == 4) {
        currenthover == 0;
      } else {
        currenthover++;
      }
      suggestionss[currenthover].style.backgroundColor =
        "rgba(140, 140, 140, 0.65) !important";
    } else if (e.keyCode == "38") {
      suggestionss[currenthover].style.background = "white";
      if (currenthover == 0) {
        currenthover == 4;
      } else {
        currenthover--;
      }
      suggestionss[currenthover].style.backgroundColor =
        "rgba(140, 140, 140, 0.65) !important";
    }
  }
};
function autocomplete(element) {
  textInp.value = element.innerHTML;
  looking = true;
  hide_suggestions();
  looking = true;
  Searchtext();
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
        var k = 0;
        for (var i = 0; i < autoitems.length; i++) {
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
function check() {
  if (textInp.value.length == 0) {
    hide_suggestions();
  }
}
window.onload = function () {
  textInp.focus();
  textInp.select();
};

function searchnews() {
  hide_suggestions();
  var start = new Date().getTime();
  document.getElementsByClassName("pagination")[2].style.display = "none";
  var newscontainer = document.getElementsByClassName("newscontainer");
  document.getElementById("loading").style.display = "flex";
  fetch(
    "https://free-news.p.rapidapi.com/v1/search?q=" +
      textInp.value.replace(" ", "%20") +
      "&lang=en&page=1&page_size=10",
    {
      method: "GET",
      headers: {
        "x-rapidapi-host": "free-news.p.rapidapi.com",
        "x-rapidapi-key": "b2f149e06bmsh8efd678074bb06ap1105f6jsnd63b170f9f28",
      },
    }
  )
    .then((response) => response.json())
    .then((response) => {
      hide_suggestions();
      for (var i = 0; i < newscontainer.length; i++) {
        newscontainer[i].style.display = "none";
      }
      var end = new Date().getTime();
      document.getElementsByClassName("pagination")[2].style.display = "flex";
      document.getElementById("newsresulttime").innerHTML =
        "Results obtained in " +
        ((end - start) / 1000).toString() +
        " Seconds.";
      document.getElementById("newsresulttime").style.display = "flex";
      document.getElementById("loading").style.display = "none";
      for (var i = 0; i < newscontainer.length; i++) {
        if (i == response["articles"].length) {
          break;
        }
        newscontainer[i].getElementsByClassName("newssource")[0].innerHTML =
          response["articles"][i]["author"] +
          " " +
          response["articles"][i]["published_date"];
        newscontainer[i].getElementsByClassName("newstitle")[0].href =
          response["articles"][i]["link"];
        newscontainer[i].getElementsByClassName("newstitle")[0].innerHTML =
          response["articles"][i]["title"];
        newscontainer[i].getElementsByClassName("newssummary")[0].innerHTML =
          response["articles"][i]["summary"].substring(0, 750) + "...";
        newscontainer[i].getElementsByClassName("newsimage")[0].src =
          response["articles"][i]["media"];
        newscontainer[i].getElementsByClassName("newsimage")[0].href =
          response["articles"][i]["media"];
        newscontainer[i].style.display = "block";
      }
    })
    .catch((err) => {
      console.error(err);
    });
}

function news_changepagination(next) {
  var imgs = document.getElementsByClassName("newsimage");
  for (var j = 0; j < imgs.length; j++) {
    imgs[j].src = "";
  }
  document.getElementById("loading").style.display = "flex";
  var start = new Date().getTime();
  var newscontainer = document.getElementsByClassName("newscontainer");
  if (
    next.name ==
      document
        .getElementsByClassName("tab")[3]
        .getElementsByClassName("a")[6] ||
    next.name ==
      document.getElementsByClassName("tab")[1].getElementsByClassName("a")[14]
  ) {
    news_explore_pagination_right(1, 5);
    return;
  }
  window.scrollTo({ top: 0, behavior: "smooth" });
  var as = document
    .getElementsByClassName("tab")[1]
    .getElementsByClassName("a");
  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    as[i].style.color = "#646464";
    as[i].style.backgroundColor = "white";
    if (as[i].name == next.name) {
      as[i].style.backgroundColor = "#00b4cc";
      as[i].style.color = "white";
    }
  }
  next.style.backgroundColor = "#00b4cc";
  next.style.color = "white";
  fetch(
    "https://free-news.p.rapidapi.com/v1/search?q=" +
      textInp.value.replace(" ", "%20") +
      "&lang=en&page=" +
      next.name +
      "&page_size=10",
    {
      method: "GET",
      headers: {
        "x-rapidapi-host": "free-news.p.rapidapi.com",
        "x-rapidapi-key": "b2f149e06bmsh8efd678074bb06ap1105f6jsnd63b170f9f28",
      },
    }
  )
    .then((response) => response.json())
    .then((response) => {
      document.getElementById("loading").style.display = "none";
      var end = new Date().getTime();

      document.getElementsByClassName("pagination")[2].style.display = "flex";
      document.getElementById("newsresulttime").innerHTML =
        "Results obtained in " +
        ((end - start) / 1000).toString().substring(0, 3) +
        " Seconds.";
      document.getElementById("newsresulttime").style.display = "flex";
      document.getElementById("loading").style.display = "none";
      for (var i = 0; i < newscontainer.length; i++) {
        newscontainer[i].getElementsByClassName("newssource")[0].innerHTML =
          response["articles"][i]["author"] +
          " " +
          response["articles"][i]["published_date"];
        newscontainer[i].getElementsByClassName("newstitle")[0].href =
          response["articles"][i]["link"];
        newscontainer[i].getElementsByClassName("newstitle")[0].innerHTML =
          response["articles"][i]["title"];
        newscontainer[i].getElementsByClassName("newssummary")[0].innerHTML =
          response["articles"][i]["summary"].substring(0, 750) + "...";
        newscontainer[i].getElementsByClassName("newsimage")[0].src =
          response["articles"][i]["media"];
        newscontainer[i].getElementsByClassName("newsimage")[0].href =
          response["articles"][i]["media"];
        newscontainer[i].style.display = "block";
        var imgs = document.getElementsByClassName("newsimage");
      }
    })
    .catch((err) => {
      console.error(err);
    });
}

function news_explore_pagination_left(step, pos) {
  var as = document
    .getElementsByClassName("tab")[1]
    .getElementsByClassName("a");
  if (parseInt(as[1].name) == "1") {
    news_changepagination(
      document.getElementsByClassName("tab")[1].getElementsByClassName("a")[pos]
    );
    return;
  }

  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    if (as[i].name != "next" && as[i].name != "prev") {
      var tu = parseInt(as[i].name) - step;
      as[i].name = tu.toString();
      as[i].innerHTML = tu.toString();
    }
  }
  news_changepagination(
    document.getElementsByClassName("tab")[1].getElementsByClassName("a")[pos]
  );
}

function news_explore_pagination_right(step, pos) {
  var as = document
    .getElementsByClassName("tab")[1]
    .getElementsByClassName("a");
  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    if (as[i].name != "next" && as[i].name != "prev") {
      var tu = parseInt(as[i].name) + step;
      as[i].name = tu.toString();
      as[i].innerHTML = tu.toString();
    }
  }

  news_changepagination(
    document.getElementsByClassName("tab")[1].getElementsByClassName("a")[pos]
  );
}
function searchimg() {
  hide_suggestions();
  document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("pagination")[0].style.display = "none";
  document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("pagination")[1].style.display = "none";
  var start = new Date().getTime();
  var img_items = document.getElementsByClassName("img_item");
  for (var i = 0; i < img_items.length; i++) {
    img_items[i].style.display = "none";
  }
  document.getElementById("loading").style.display = "flex";
  const options = {
    method: "GET",
    headers: {
      "X-RapidAPI-Host": "bing-image-search1.p.rapidapi.com",
      "X-RapidAPI-Key": "3f2dacd9bamsh9a0071b788ba582p1181f8jsne6c4556605c6",
    },
  };

  fetch(
    "https://bing-image-search1.p.rapidapi.com/images/search?q=" +
      textInp.value +
      "&count=20&offset=0",
    options
  )
    .then((response) => response.json())
    .then((response) => {
      hide_suggestions();
      document
        .getElementsByClassName("tab")[2]
        .getElementsByClassName("pagination")[0].style.display = "block";
      document
        .getElementsByClassName("tab")[2]
        .getElementsByClassName("pagination")[1].style.display = "block";
      var end = new Date().getTime();
      document.getElementById("imgsresulttime").innerHTML =
        "Results obtained in " +
        ((end - start) / 1000).toString() +
        " Seconds.";
      document.getElementById("imgsresulttime").style.display = "flex";
      document.getElementById("loading").style.display = "none";
      for (var i = 0; i < img_items.length; i++) {
        try {
          img_items[i].getElementsByClassName("imgg")[0].src =
            response["value"][i]["thumbnailUrl"];
          img_items[i].getElementsByClassName("img_description")[0].href =
            response["value"][i]["hostPageUrl"];
          img_items[i].getElementsByClassName("img_description")[0].innerHTML =
            response["value"][i]["name"];
          img_items[i].style.display = "block";
        } catch {
          img_items[i].getElementsByClassName("imgg")[0].src = "";
          img_items[i].getElementsByClassName("img_description")[0].href = "";
          img_items[i].getElementsByClassName("img_description")[0].innerHTML =
            "";
          img_items[i].style.display = "none";
        }
      }
    })
    .catch((err) => console.error(err));
}

function img_changepagination(next) {
  hide_suggestions();
  document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("pagination")[0].style.display = "none";
  document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("pagination")[1].style.display = "none";

  var img_items = document.getElementsByClassName("img_item");
  for (var i = 0; i < img_items.length; i++) {
    img_items[i].style.display = "none";
  }
  document.getElementById("loading").style.display = "flex";
  var start = new Date().getTime();
  if (
    next ==
      document
        .getElementsByClassName("tab")[2]
        .getElementsByClassName("a")[6] ||
    next ==
      document.getElementsByClassName("tab")[2].getElementsByClassName("a")[14]
  ) {
    img_explore_pagination_right(1, 5);
    return;
  }
  window.scrollTo({ top: 0, behavior: "smooth" });
  var as = document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("a");
  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    as[i].style.color = "#646464";
    as[i].style.backgroundColor = "white";
    if (as[i].name == next.name || as[i].innerHTML == next.name) {
      as[i].style.backgroundColor = "#00b4cc";
      as[i].style.color = "white";
    }
  }
  const options = {
    method: "GET",
    headers: {
      "X-RapidAPI-Host": "bing-image-search1.p.rapidapi.com",
      "X-RapidAPI-Key": "3f2dacd9bamsh9a0071b788ba582p1181f8jsne6c4556605c6",
    },
  };
  fetch(
    "https://bing-image-search1.p.rapidapi.com/images/search?q=" +
      textInp.value +
      "&count=20&offset=" +
      ((parseInt(next.name) - 1) * 20).toString(),
    options
  )
    .then((response) => response.json())
    .then((response) => {
      hide_suggestions();
      document
        .getElementsByClassName("tab")[2]
        .getElementsByClassName("pagination")[0].style.display = "block";
      document
        .getElementsByClassName("tab")[2]
        .getElementsByClassName("pagination")[1].style.display = "block";
      var end = new Date().getTime();
      document.getElementById("imgsresulttime").innerHTML =
        "Results obtained in " +
        ((end - start) / 1000).toString() +
        " Seconds.";
      document.getElementById("imgsresulttime").style.display = "flex";
      document.getElementById("loading").style.display = "none";
      for (var i = 0; i < img_items.length; i++) {
        try {
          img_items[i].getElementsByClassName("imgg")[0].src =
            response["value"][i]["thumbnailUrl"];
          img_items[i].getElementsByClassName("img_description")[0].href =
            response["value"][i]["hostPageUrl"];
          img_items[i].getElementsByClassName("img_description")[0].innerHTML =
            response["value"][i]["name"];
          img_items[i].style.display = "block";
        } catch {
          img_items[i].getElementsByClassName("imgg")[0].src = "";
          img_items[i].getElementsByClassName("img_description")[0].href = "";
          img_items[i].getElementsByClassName("img_description")[0].innerHTML =
            "";
          img_items[i].style.display = "none";
        }
      }
    })
    .catch((err) => console.error(err));
}

function img_explore_pagination_left(step, pos) {
  var as = document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("a");
  if (parseInt(as[1].name) == "1") {
    img_changepagination(
      document.getElementsByClassName("tab")[2].getElementsByClassName("a")[pos]
    );
    return;
  }

  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    if (as[i].name != "next" && as[i].name != "prev") {
      var tu = parseInt(as[i].name) - step;
      as[i].name = tu.toString();
      as[i].innerHTML = tu.toString();
    }
  }
  img_changepagination(
    document.getElementsByClassName("tab")[2].getElementsByClassName("a")[pos]
  );
}

function img_explore_pagination_right(step, pos) {
  var as = document
    .getElementsByClassName("tab")[2]
    .getElementsByClassName("a");
  //reset color to all pagination
  for (var i = 0; i < as.length; i++) {
    if (as[i].name != "next" && as[i].name != "prev") {
      var tu = parseInt(as[i].name) + step;
      as[i].name = tu.toString();
      as[i].innerHTML = tu.toString();
    }
  }

  img_changepagination(
    document.getElementsByClassName("tab")[2].getElementsByClassName("a")[pos]
  );
}

function glob_search() {
  resetpagination();
  document.getElementsByClassName("use_chat")[0].style.display = "block";
  if (currenttab == "All") {
    Searchtext();
  } else if (currenttab == "News") {
    searchnews();
  } else if (currenttab == "Img") {
    searchimg();
  } else if (currenttab == "translate") {
    translatetext();
  }
}

window.onclick = (e) => {
  //hide suggestions if click target is not an autocomplete item
  var container = document.getElementsByClassName("autocomplete_item");
  for (var i = 0; i < container.length; i++) {
    if (e.target == container[i]) {
      return;
    }
  }
  hide_suggestions();
};

var transfrom = "";
var transto = "en";

function changefrom(ele) {
  var lang = document
    .getElementsByClassName("left")[0]
    .getElementsByClassName("languages");
  for (var i = 0; i < lang.length; i++) {
    lang[i].className = "languages";
  }
  ele.className = "languages active1";
  if (ele.innerHTML == "Auto-Detect") {
    transfrom = "";
  } else if (ele.innerHTML == "English") {
    transfrom = "en";
  } else if (ele.innerHTML == "French") {
    transfrom = "fr";
  } else if (ele.innerHTML == "Spanish") {
    transfrom = "es";
  }
  document.getElementById("from").innerHTML = ele.innerHTML;
  translatetext();
}

function changeto(ele) {
  var lang = document
    .getElementsByClassName("right")[0]
    .getElementsByClassName("languages");
  for (var i = 0; i < lang.length; i++) {
    lang[i].className = "languages";
  }
  ele.className = "languages active1";
  if (ele.innerHTML == "English") {
    transto = "en";
  } else if (ele.innerHTML == "French") {
    transto = "fr";
  } else if (ele.innerHTML == "Spanish") {
    transto = "es";
  }
  document.getElementById("to").innerHTML = ele.innerHTML;
  translatetext();
}

var text = document.getElementById("transfrom");

function translatetext() {
  if (transfrom == "") {
    var options = {
      method: "POST",
      headers: {
        "content-type": "application/x-www-form-urlencoded",
        "Accept-Encoding": "application/gzip",
        "X-RapidAPI-Host": "google-translate1.p.rapidapi.com",
        "X-RapidAPI-Key": "19765bc4a2mshd0d2aa14304d44fp1a383djsn5896751789d5",
      },
      body: new URLSearchParams({ q: text.value, target: transto }),
    };
  } else {
    var options = {
      method: "POST",
      headers: {
        "content-type": "application/x-www-form-urlencoded",
        "Accept-Encoding": "application/gzip",
        "X-RapidAPI-Host": "google-translate1.p.rapidapi.com",
        "X-RapidAPI-Key": "19765bc4a2mshd0d2aa14304d44fp1a383djsn5896751789d5",
      },
      body: new URLSearchParams({
        q: text.value,
        target: transto,
        source: transfrom,
      }),
    };
  }

  fetch(
    "https://google-translate1.p.rapidapi.com/language/translate/v2",
    options
  )
    .then((response) => response.json())
    .then((response) => {
      try {
        document.getElementById("transto").value =
          response["data"]["translations"][0]["translatedText"];
      } catch (e) {
        alert(response["message"].toString());
      }
    })
    .catch((err) => console.error(err));
}
text.onkeypress = function (e) {
  if (e.key == " ") {
    translatetext();
  }
};

function copytranslatedtext() {
  navigator.clipboard.writeText(document.getElementById("transto").value);
}

function handle_chat_click() {
  var chat = document.getElementsByClassName("chat_input")[0];
  var img = document.getElementsByClassName("chat_img")[0];
  if (img.src.includes("hide_chat.png")) {
    img.src = "login-register/images/chat.png";
    document.getElementsByClassName("chatbox")[0].style.display = "none";
  } else {
    img.src = "login-register/images/hide_chat.png";
    document.getElementsByClassName("chatbox")[0].style.display = "block";
    chat.focus();
  }
}

function sendchat(name) {
  var chat = document.getElementsByClassName("chat_input")[0];
  var val = chat.value;
  chat.value = "";
  if (val !== "") {
    var chat_div = document.getElementsByClassName("chatcontainer")[0];
    var message =
      '<div class="chat_from user"><img src="login-register/images/Default_avatar.png" alt="Avatar" class="rightchat_img"><p>' +
      val +
      "</p></div>";
    chat_div.innerHTML += message;
    chat_div.scrollTop = chat_div.scrollHeight;
    var preprompt = name === "" ? "user: " : name + ": ";
    var theprompt =
      preprompt.replace(" ", "%20") + val.replace(" ", "%20") + ",AI:";
    $.ajax({
      url: "try.php?prompt=" + theprompt,
    }).done(function (data) {
      var temp = data
        .toString()
        .replace(theprompt, "")
        .replace(preprompt, "")
        .replace(preprompt.replace(" ", "%20"), "")
        .replace(val, "")
        .replace(",AI:", "")
        .replace(":", "");
      chat_div.innerHTML +=
        '<div style="margin-top: -8px;" class="chat_to ai"><img src="login-register/images/openai.png" alt="Avatar" class="leftchat_img"><p class="msgai"></br>' +
        (temp === ""
          ? "Got no response, Try to reformulate your question"
          : temp) +
        "</p></div>";
      chat_div.scrollTop = chat_div.scrollHeight;
    });
  }
}

document.getElementsByClassName("chat_input")[0].onkeypress = function (e) {
  if (e.key == "Enter") {
    document.getElementsByClassName("send_button")[0].click();
  }
};

function usechatbot() {
  var img = document.getElementsByClassName("chat_img")[0];
  if (img.src.includes("login-register/images/chat.png")) {
    handle_chat_click();
  }
  document.getElementsByClassName("chat_input")[0].value = textInp.value;
  document.getElementsByClassName("send_button")[0].click();
}
