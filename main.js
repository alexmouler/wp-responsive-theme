//Make title header sticky on large screens and push down main wrapper
var titleHeight = document.querySelector(".page-title").clientHeight;
document.querySelector(".main-wrapper").style.top = titleHeight + "px";

window.addEventListener("scroll", () => {
  if (window.scrollY > 1) {
    document.querySelector(".page-title").classList.add("page-title-sticky");
  } else {
    document.querySelector(".page-title").classList.remove("page-title-sticky");
  }
});

//Unapproved comments
var unapprovedComment = document.querySelector(".comment-awaiting-moderation");
if (unapprovedComment != null) {
  var parentComment = unapprovedComment.parentElement;
  var beforeContent = parentComment.querySelector(".comment-meta");
  var commentHTML =
    "<p id='comment-text'>" + parentComment.childNodes[8].data + "</p>";
  //childNodes[8] is the raw comment text inside the comment div. commentHTML adds it to a p tag for style purposes.
  beforeContent.insertAdjacentHTML("afterend", commentHTML);
  const childs = [];
  for (let i = 0; i < parentComment.children.length; i++) {
    childs.push(parentComment.children[i]);
  }
  parentComment.innerHTML = "";
  for (let i = 0; i < childs.length; i++) {
    parentComment.appendChild(childs[i]);
  }

  function mediaQueryM(medium) {
    if (medium.matches) {
      document
        .getElementById("comment-text")
        .setAttribute("style", "margin-top: 50px;");
    } else {
      document
        .getElementById("comment-text")
        .setAttribute("style", "margin-top: 25px;");
    }
  }

  var medium = window.matchMedia("(max-width: 1240px)");
  mediaQueryM(medium);
  medium.addEventListener("change", mediaQueryM);

  function mediaQueryS(small) {
    if (small.matches) {
      document
        .getElementById("comment-text")
        .setAttribute("style", "margin-top: 40px;");
    } else {
      document
        .getElementById("comment-text")
        .setAttribute("style", "margin-top: 50px;");
    }
  }

  var small = window.matchMedia("(max-width: 576px)");
  mediaQueryM(small);
  small.addEventListener("change", mediaQueryS);
}

//Adding BS classes to search
var searchForms = document.querySelectorAll("form[role='search']");
var searchInputs = [];
var searchButtons = [];
searchForms.forEach((element) => {
  searchInputs.push(element.querySelectorAll("input:not([type=submit])"));
  searchButtons.push(element.querySelectorAll("input[type=submit]"));
  searchButtons.push(element.querySelectorAll("button[type=submit]"));
});
for (var i = 0; i < searchInputs.length; i++) {
  for (var j = 0; j < searchInputs[i].length; j++) {
    searchInputs[i][j].classList.add("form-control");
    searchInputs[i][j].setAttribute("placeholder", "Search");
  }
}
for (var i = 0; i < searchButtons.length; i++) {
  for (var j = 0; j < searchButtons[i].length; j++) {
    searchButtons[i][j].classList.add("btn");
    searchButtons[i][j].classList.add("btn-outline-primary");
  }
}

//Adding BS Classes to menu items
var menuItems = document.querySelectorAll("#nav-links > li");
console.log(menuItems);
menuItems[0].classList.add("nav-item");
for (var i = 1; i < menuItems.length; i++) {
  menuItems[i].classList.add("nav-item", "mt-2");
}
