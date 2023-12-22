let showDropDown = () => {
  document.getElementById("drop-down").style.visibility = "visible";
  document.getElementById("arrow-flip").style.transform = "rotate(180deg)";
  // document.getElementById("student-link").style.color = "aqua";
  // document.getElementById("student-link").style.textDecoration = "underline";
};
let hideDropDown = () => {
  document.getElementById("drop-down").style.visibility = "hidden";
  document.getElementById("arrow-flip").style.transform = "rotate(0deg)";
  document.getElementById("student-link").style.color = "#fff";
  document.getElementById("student-link").style.textDecoration = "none";
};
