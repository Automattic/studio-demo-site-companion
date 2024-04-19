if (document.cookie.indexOf("studio-companion-notice") == -1) {
  var notice = document.createElement("div");
  var logoImg = document.createElement("img");
  logoImg.src = window.studioCompanionNotice.images.logo;
  var paragraph = document.createElement("p");
  var link = document.createElement("a");
  var closeButton = document.createElement("button");
  var closeImg = document.createElement("img");
  closeImg.src = window.studioCompanionNotice.images.close;

  notice.setAttribute("id", "studio-companion-notice");
  notice.append(logoImg);

  paragraph.innerHTML = window.studioCompanionNotice.description;
  notice.append(paragraph);

  link.innerText = window.studioCompanionNotice.linkText;
  link.href = window.studioCompanionNotice.linkUrl;
  link.setAttribute("target", "_blank");
  notice.append(link);

  closeButton.setAttribute("id", "studio-companion-notice__close");
  closeButton.append(closeImg);
  notice.append(closeButton);

  document.body.insertBefore(notice, document.body.firstChild);
  closeButton.addEventListener("click", function () {
    notice.remove();
    document.cookie =
      "studio-companion-notice=1; expires=Fri, 31 Dec 9999 23:59:59 GMT";
  });
}
