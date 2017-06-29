var callback = function(){

    // Handler when the DOM is fully loaded
    var acc = document.getElementsByClassName("js-tab-title");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){

            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            //this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        }
    }
};

if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
  callback();
} else {
  document.addEventListener("DOMContentLoaded", callback);
}
