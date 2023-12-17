let showDropDown = () => {
  document.getElementById("drop-down").style.visibility = "visible";
  document.getElementById("arrow-flip").style.transform = "rotate(180deg)";
};
let hideDropDown = () => {
  document.getElementById("drop-down").style.visibility = "hidden";
  document.getElementById("arrow-flip").style.transform = "rotate(0deg)";
};
