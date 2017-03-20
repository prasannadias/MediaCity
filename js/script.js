var bgText   = new Array();
var bgImages = new Array();
var imgNo=1;
var totalImg = 1;
function arrowClicked(dir)
{
  if (dir == 1) {
   if (imgNo == 1)
    imgNo = totalImg;
   else
    imgNo = imgNo - 1;
  }
  else {
   if (imgNo == totalImg)
    imgNo = 1;
   else
    imgNo = imgNo + 1;
  }
  document.getElementById("bgImg").src = bgImages[imgNo];
  document.getElementById("bgInfotext").innerHTML = bgText[imgNo] ;
}

