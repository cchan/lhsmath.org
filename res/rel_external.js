/* 
 * res/rel_external.js
 * LHS Math Club Website
 * 
 * Converts link with rel="external" to open in a new tab
 * Written by Kevin Yank at SitePoint
 */
function externalLinks() {
  if (!document.getElementsByTagName) return;
  var anchors = document.getElementsByTagName("a");
  for (var i=0; i<anchors.length; i++) {
    var anchor = anchors[i];
    if (anchor.getAttribute("href") &&
        anchor.getAttribute("rel") == "external")
      anchor.target = "_blank";
  }
}
window.onload = externalLinks;